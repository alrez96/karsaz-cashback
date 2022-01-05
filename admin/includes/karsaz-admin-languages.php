<?php

define('KARSAZCASHBACK_LANGUAGES', [
    'admin_menu_main_page_title' => 'Karsaz Cashback',
    'admin_menu_main_menu_title' => 'Karsaz Plugin',
    'admin_main_page_title' => 'Karsaz Plugin Settings',
    'admin_main_page_token_input_title' => 'Academy Token',
    'admin_main_page_token_input_placeholder' => 'Enter academy token',
    'admin_main_page_token_input_description' => 'Enter token sent from karsaz.',
    'admin_main_page_token_input_description_strong' => 'If this value is empty or incorrect, the plugin will not work.',
    'admin_main_page_token_submit_button' => 'Save Changes'
]);

if (get_locale() == 'fa_IR') {
    define('KARSAZCASHBACK_LANGUAGES', [
        'admin_menu_main_page_title' => 'بازگشت وجه کارساز',
        'admin_menu_main_menu_title' => 'افزونه کارساز',
        'admin_main_page_title' => 'تنظیمات افزونه کارساز',
        'admin_main_page_token_input_title' => 'توکن آموزشگاه',
        'admin_main_page_token_input_placeholder' => 'ورود توکن آموزشگاه',
        'admin_main_page_token_input_description' => 'در این قسمت توکن ارسال شده از سمت کارساز را وارد نمایید.',
        'admin_main_page_token_input_description_strong' => 'در صورت خالی یا نادرست بودن این مقدار عملکرد افزونه بامشکل مواجه می‌شود.',
        'admin_main_page_token_submit_button' => 'ذخیره تغییرات'
    ]);
}
