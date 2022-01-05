<?php

function karsazcashback_academy_token_submit()
{
    $karsazcashback_academy_token = $_POST['academy_token'];

    update_option('karsaz_cashback_academy_token', $karsazcashback_academy_token);

    wp_die();
}

add_action('wp_ajax_karsazcashback_academy_token_submit_action', 'karsazcashback_academy_token_submit');
