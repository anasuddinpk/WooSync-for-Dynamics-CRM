<?php

/**
 * Send Order details to Dynamics CRM via Power Automate.
 *
 * @package woosync-for-dcrms
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('WSDCRM_send_order_to_powerautomate')) {

    /**
     * Class WSDCRM_send_order_to_powerautomate.
     */
    class WSDCRM_send_order_to_powerautomate
    {

        /**
         *  Constructor.
         */
        public function __construct($order_data)
        {
            $this->send_order_to_power_automate($order_data);
        }

        /**
         *  Send Order details to Power Automate.
         *
         * @param order_data $order_data The WooCommerce Order object.
         */
        public function send_order_to_power_automate($order_data)
        {

            // Set up the HTTP request
            $url = 'https://prod-00.northeurope.logic.azure.com:443/workflows/69d6db0cbb3f416e96e8ae0d2870cad4/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=UpV7T2Ce5ZaEaAsvo64OlTFZKWJL14Gy_lkKw-aUeG4';

            $response = wp_remote_post($url, array(
                'method' => 'POST',
                'body' => json_encode($order_data),
                'headers' => array(
                    'Content-Type' => 'application/json',
                ),
            ));

            // Check for success or failure
            if (is_wp_error($response)) 
            {
                $error_message = $response->get_error_message();
                error_log("Failed to send order to Power Automate: $error_message");
            } else {
                error_log("Order sent to Power Automate successfully.");
            }
        }
    }
}
