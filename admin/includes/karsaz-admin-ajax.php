<?php

function karsazcashback_academy_token_submit()
{
    if (!empty($_POST) && check_admin_referer('karsazcashback_academy_token_submit_action', 'karsazcashback_academy_token_submit_nonce') && current_user_can('administrator')) {
        $karsazcashback_academy_token = sanitize_text_field($_POST['academy_token']);

        update_option('karsaz_cashback_academy_token', $karsazcashback_academy_token);

        wp_die();
    }
}

add_action('wp_ajax_karsazcashback_academy_token_submit_action', 'karsazcashback_academy_token_submit');
