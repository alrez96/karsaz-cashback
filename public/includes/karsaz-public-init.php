<?php

function karsazcashback_public_set_session()
{
    if (isset($_GET['utm_source']) && isset($_GET['katoken'])) {
        if (!session_id()) {
            session_start();
        }

        $_SESSION['karsazcashback_utm_source'] = sanitize_text_field($_GET['utm_source']);
        $_SESSION['karsazcashback_utm_token'] = sanitize_text_field($_GET['katoken']);
        $_SESSION['karsazcashback_utm_date'] = date('Y-m-d H:i:s', time());
        $_SESSION['karsazcashback_utm_time'] = time();
    }
}

function karsazcashback_public_validation_session()
{
    if (!session_id()) {
        session_start();
    }

    if (isset($_SESSION['karsazcashback_utm_source']) && isset($_SESSION['karsazcashback_utm_token'])) {
        $karsazcashback_session_valid_duration = 3600;

        if (((time() - $_SESSION['karsazcashback_utm_time']) > $karsazcashback_session_valid_duration)) {
            unset($_SESSION['karsazcashback_utm_source']);
            unset($_SESSION['karsazcashback_utm_token']);
            unset($_SESSION['karsazcashback_utm_date']);
            unset($_SESSION['karsazcashback_utm_time']);

            session_destroy();
        }
    } else {
        session_destroy();
    }
}

add_action('template_redirect', 'karsazcashback_public_set_session', 10);
add_action('template_redirect', 'karsazcashback_public_validation_session', 11);

function karsazcashback_order_tracking($order_id)
{
    if ($_SESSION['karsazcashback_utm_source'] == get_option('karsaz_cashback_utm_source')) {
        global $wpdb;

        $karsazcashback_order_id = null;
        $karsazcashback_user_token = null;

        $karsazcashback_order = wc_get_order($order_id);

        $karsazcashback_order_id = $karsazcashback_order->get_order_number();
        $karsazcashback_user_token = sanitize_text_field($_SESSION['karsazcashback_utm_token']);

        $query_result = $wpdb->query(
            $wpdb->prepare(
                "
                    INSERT IGNORE INTO {$wpdb->prefix}karsaz_cashbacks(order_id, user_token)
                    VALUES('%d', '%s');
                ",
                $karsazcashback_order_id,
                $karsazcashback_user_token
            )
        );

        if ($query_result) {
            $karsazcashback_order_items = [];
            $karsazcashback_order_total = 0;
            $karsazcashback_order_discount = 0;
            $karsazcashback_order_tax = 0;

            $karsazcashback_order_total = $karsazcashback_order->get_total();
            $karsazcashback_order_discount = $karsazcashback_order->get_discount_total();
            $karsazcashback_order_tax = $karsazcashback_order->get_total_tax();

            $line_items = $karsazcashback_order->get_items();

            foreach ($line_items as $item) {
                $product = $karsazcashback_order->get_product_from_item($item);
                $product_name = $product->get_name();
                $item_quantity = $item['quantity'];
                $product_price = $product->get_price();
                $item_total_price = $product->get_price();

                if ($item_quantity >= 2) {
                    $item_total_price = ($item_quantity * $product_price);
                }

                array_push($karsazcashback_order_items, [
                    'name' => $product_name,
                    'quantity' => $item_quantity,
                    'price' => $product_price,
                    'total_price' => $item_total_price
                ]);
            }

            $karsazcashback_base_url = 'https://karsazapp.ir';
            $karsazcashback_purchase_url = '/api/v1/affiliate/track/wp/purchase';

            $remote_endpoint = ($karsazcashback_base_url . $karsazcashback_purchase_url);
            $remote_body = [
                'token'  => $karsazcashback_user_token,
                'transaction_id' => $karsazcashback_order_id,
                'items' => $karsazcashback_order_items,
                'revenue' => $karsazcashback_order_total,
                'discount' => $karsazcashback_order_discount,
                'tax' => $karsazcashback_order_tax
            ];
            $remote_options = [
                'method'      => 'POST',
                'data_format' => 'body',
                'body'        => wp_json_encode($remote_body),
                'headers'     => [
                    'Content-Type' => 'application/json',
                ],
            ];

            $remote_result = wp_remote_post($remote_endpoint, $remote_options);
        }
    }
}

add_action('woocommerce_thankyou', 'karsazcashback_order_tracking');
