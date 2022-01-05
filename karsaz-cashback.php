<?php

/**
 * Plugin Name:       Karsaz Cashback
 * Plugin URI:        https://karsaz.app
 * Description:       Handle karsaz cashback web service with this plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            alrez96
 * Author URI:        https://alrez96.ir
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       karsaz-cashback
 */

defined('ABSPATH') or exit;

define('KARSAZCASHBACK_DIR', plugin_dir_path(__FILE__));
define('KARSAZCASHBACK_PUBLIC_DIR', trailingslashit(KARSAZCASHBACK_DIR . 'public'));
define('KARSAZCASHBACK_PUBLIC_INCLUDES_DIR', trailingslashit(KARSAZCASHBACK_PUBLIC_DIR . 'includes'));
define('KARSAZCASHBACK_ADMIN_DIR', trailingslashit(KARSAZCASHBACK_DIR . 'admin'));
define('KARSAZCASHBACK_ADMIN_INCLUDES_DIR', trailingslashit(KARSAZCASHBACK_ADMIN_DIR . 'includes'));
define('KARSAZCASHBACK_URL', plugin_dir_url(__FILE__));
define('KARSAZCASHBACK_ASSETS_URL', trailingslashit(KARSAZCASHBACK_URL . 'assets'));
define('KARSAZCASHBACK_CSS_URL', trailingslashit(KARSAZCASHBACK_ASSETS_URL . 'css'));
define('KARSAZCASHBACK_JS_URL', trailingslashit(KARSAZCASHBACK_ASSETS_URL . 'js'));
define('KARSAZCASHBACK_IMAGES_URL', trailingslashit(KARSAZCASHBACK_ASSETS_URL . 'images'));

function karsazcashback_activate()
{
    add_option('karsaz_cashback_utm_source', 'karsaz');
    add_option('karsaz_cashback_academy_token');

    global $wpdb;

    $sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}karsaz_cashbacks (
        `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        `order_id` INT(10) NOT NULL,
        `user_token` VARCHAR(256) NOT NULL,
        `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (`id`),
        UNIQUE (`order_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    dbDelta($sql);
}

function karsazcashback_deactivate()
{
    //
}

register_activation_hook(__FILE__, 'karsazcashback_activate');
register_deactivation_hook(__FILE__, 'karsazcashback_deactivate');

include_once(KARSAZCASHBACK_PUBLIC_INCLUDES_DIR . 'karsaz-public-init.php');

if (is_admin()) {
    require_once(KARSAZCASHBACK_ADMIN_INCLUDES_DIR . 'karsaz-admin-languages.php');
    include_once(KARSAZCASHBACK_ADMIN_INCLUDES_DIR . 'karsaz-admin-init.php');
    include_once(KARSAZCASHBACK_ADMIN_INCLUDES_DIR . 'karsaz-admin-pages.php');
    include_once(KARSAZCASHBACK_ADMIN_INCLUDES_DIR . 'karsaz-admin-ajax.php');
}
