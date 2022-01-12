<?php

function karsazcashback_main_page()
{
?>
    <div class="wrap">
        <h1><?php echo KARSAZCASHBACK_LANGUAGES['admin_main_page_title']; ?></h1>
        <form method="post" action="" novalidate="novalidate">
            <?php wp_nonce_field('karsazcashback_academy_token_submit_action', 'karsazcashback_academy_token_submit_nonce'); ?>
            <table class="form-table" role="presentation">
                <tbody>
                    <tr>
                        <th scope="row">
                            <label for="academy-token"><?php echo KARSAZCASHBACK_LANGUAGES['admin_main_page_token_input_title']; ?></label>
                        </th>
                        <td>
                            <input name="academy-token" type="text" id="academy-token" value="<?php echo get_option('karsaz_cashback_academy_token'); ?>" class="large-text ltr" placeholder="<?php echo KARSAZCASHBACK_LANGUAGES['admin_main_page_token_input_placeholder']; ?>" required>
                            <p class="description" id="academy-token-description"><?php echo KARSAZCASHBACK_LANGUAGES['admin_main_page_token_input_description']; ?> <strong><?php echo KARSAZCASHBACK_LANGUAGES['admin_main_page_token_input_description_strong']; ?></strong></p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p class="submit">
                <input type="button" id="submit-academy-token" class="button button-primary" value="<?php echo KARSAZCASHBACK_LANGUAGES['admin_main_page_token_submit_button']; ?>">
            </p>
        </form>
    </div>
<?php
}
