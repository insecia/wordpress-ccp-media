<?php


add_action('admin_menu', function() {
    add_options_page(
        'Insecia CCP Media', 
        'Insecia CCP Media', 
        'manage_options', 
        'insecia-ccp-media', 
        'insecia_ccp_media_page' 
    );
});
 
 
add_action('admin_init', function() {
    register_setting('insecia-ccp-media-settings', 'insecia_ccp_media_api_base_path');
    register_setting('insecia-ccp-media-settings', 'insecia_ccp_media_project_id');
    register_setting('insecia-ccp-media-settings', 'insecia_ccp_media_root_directory_id');
    register_setting('insecia-ccp-media-settings', 'insecia_ccp_media_login_page_url');
    register_setting('insecia-ccp-media-settings', 'insecia_ccp_media_redirect_after_login_url');
    register_setting('insecia-ccp-media-settings', 'insecia_ccp_media_registration_form_url');

    register_setting('insecia-ccp-media-settings', 'insecia_ccp_media_directory_template');
    register_setting('insecia-ccp-media-settings', 'insecia_ccp_media_file_template');
    register_setting('insecia-ccp-media-settings', 'insecia_ccp_media_media_browser_style');
    register_setting('insecia-ccp-media-settings', 'insecia_ccp_media_image_details_template');
    register_setting('insecia-ccp-media-settings', 'insecia_ccp_media_login_form_template');

    register_setting('insecia-ccp-media-settings', 'insecia_ccp_media_error_token_invalid');
    register_setting('insecia-ccp-media-settings', 'insecia_ccp_media_error_no_rights');
    register_setting('insecia-ccp-media-settings', 'insecia_ccp_media_error_token_expired');
});
 
 
function insecia_ccp_media_page() 
{ ?>

    <div class="wrap">
        <h1>Insecia CCP Media</h1> <hr><br />
        <form action="options.php" method="post">
            <?php
            settings_fields('insecia-ccp-media-settings');
            do_settings_sections('insecia-ccp-media-settings');
            ?>

            <h2><i>General (mandatory)</i></h2><hr>
            <table>
                <tr>
                    <th>Api Base Path</th>
                    <td><input type="text" name="insecia_ccp_media_api_base_path" value="<?= esc_attr(get_option('insecia_ccp_media_api_base_path')) ?>" size="50" /></td>
                </tr>
                <tr>
                    <th>Project ID</th>
                    <td><input type="number" min="1" name="insecia_ccp_media_project_id" value="<?= get_option('insecia_ccp_media_project_id') ?>" /></td>
                </tr>
                <tr>
                    <th>Root Directory ID</th>
                    <td><input type="number" min="1" name="insecia_ccp_media_root_directory_id" value="<?= get_option('insecia_ccp_media_root_directory_id') ?>" /></td>
                </tr>
                <tr>
                    <th>Login Page URL</th>
                    <td><input type="text" name="insecia_ccp_media_login_page_url" value="<?= esc_attr(get_option('insecia_ccp_media_login_page_url')) ?>" size="50" /></td>
                </tr>
                <tr>
                    <th>Redirect After Login URL</th>
                    <td><input type="text" name="insecia_ccp_media_redirect_after_login_url" value="<?= esc_attr(get_option('insecia_ccp_media_redirect_after_login_url')) ?>" size="50" /></td>
                </tr>
                <tr>
                    <th>Registration Form URL</th>
                    <td><input type="text" name="insecia_ccp_media_registration_form_url" value="<?= esc_attr(get_option('insecia_ccp_media_registration_form_url')) ?>" size="50" /></td>
                </tr>
            </table> <br />

            <h2><i>Templates</i></h2><hr>
            <table>
                <tr>
                    <th>Directory Template</th>
                    <td><textarea name="insecia_ccp_media_directory_template" rows="10" cols="120"><?= esc_attr(get_option('insecia_ccp_media_directory_template')) ?></textarea></td>
                </tr>
                <tr>
                    <th>File Template</th>
                    <td><textarea name="insecia_ccp_media_file_template" rows="10" cols="120"><?= esc_attr(get_option('insecia_ccp_media_file_template')) ?></textarea></td>
                </tr>
                <tr>
                    <th>Media Browser Style</th>
                    <td><textarea name="insecia_ccp_media_media_browser_style" rows="20" cols="120"><?= esc_attr(get_option('insecia_ccp_media_media_browser_style')) ?></textarea></td>
                </tr>
                <tr>
                    <th>Image Details Template</th>
                    <td><textarea name="insecia_ccp_media_image_details_template" rows="20" cols="120"><?= esc_attr(get_option('insecia_ccp_media_image_details_template')) ?></textarea></td>
                </tr>
                <tr>
                    <th>Login Form Template</th>
                    <td><textarea name="insecia_ccp_media_login_form_template" rows="20" cols="120"><?= esc_attr(get_option('insecia_ccp_media_login_form_template')) ?></textarea></td>
                </tr>
                <tr>
                    <th>Token Invalid Error</th>
                    <td><textarea name="insecia_ccp_media_error_token_invalid" rows="1" cols="120"><?= esc_attr(get_option('insecia_ccp_media_error_token_invalid')) ?></textarea></td>
                </tr>
                <tr>
                    <th>No Rights Error</th>
                    <td><textarea name="insecia_ccp_media_error_no_rights" rows="1" cols="120"><?= esc_attr(get_option('insecia_ccp_media_error_no_rights')) ?></textarea></td>
                </tr>
                <tr>
                    <th>Token Expired Error</th>
                    <td><textarea name="insecia_ccp_media_error_token_expired" rows="1" cols="120"><?= esc_attr(get_option('insecia_ccp_media_error_token_expired')) ?></textarea></td>
                </tr>

                <tr>
                    <td><?php submit_button(); ?></td>
                </tr>
            </table>
        </form>
    </div>

<?php }
