<?php

/**
 * Get WooCommerce Order Details.
 *
 * @package woosync-for-dcrms
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('WSDCRM_get_wc_order_details')) {

    /**
     * Class WSDCRM_get_wc_order_details.
     */
    class WSDCRM_get_wc_order_details
    {

        /**
         *  Constructor.
         */
        public function __construct()
        {
            // Hook into WooCommerce checkout order created.
            add_action('woocommerce_thankyou', array($this, 'get_order_details'), 10, 1);
        }

        /**
         *  Get WooCommerce order details.
         *
         * @param order_id $order_id The WooCommerce Order Id.
         */
        public function get_order_details($order_id)
        {
            $order = wc_get_order($order_id);

            if ($order) {
                $order_data = array(
                    'order_id' => $order->get_id(),
                    'order_date' => $order->get_date_created()->date('Y-m-d H:i:s'),
                    'customer_name' => $order->get_billing_first_name() . ' ' . $order->get_billing_last_name(),
                    'customer_email' => $order->get_billing_email(),
                    'customer_phone' => $order->get_billing_phone() ?: 'N/A',
                    'total' => $order->get_total(),
                    'status' => $order->get_status(),
                    'billing_address' => $order->get_billing_address_1(),
                    'billing_city' => $order->get_billing_city(),
                    'shipping_address' => $order->get_shipping_address_1()
                );

                $items = [];
                foreach ($order->get_items() as $item_id => $item) {
                    $product = $item->get_product();
                    $items[] = array(
                        'product_name' => $item->get_name(),
                        'product_sku' => $product->get_sku(),
                        'quantity' => $item->get_quantity(),
                        'unit_price' => $item->get_total() / $item->get_quantity(),
                        'total_price' => $item->get_total(),
                    );
                }
            }

            $order_data['items'] = $items;

            new WSDCRM_send_order_to_powerautomate($order_data);
        }
    }
}

// Instantiate the class.
new WSDCRM_get_wc_order_details();
