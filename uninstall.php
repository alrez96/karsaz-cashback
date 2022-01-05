<?php

defined('WP_UNINSTALL_PLUGIN') or exit;

delete_option('karsaz_cashback_utm_source');
delete_option('karsaz_cashback_academy_token');

global $wpdb;

$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}karsaz_cashbacks");
