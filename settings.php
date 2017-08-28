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
    register_setting('insecia-ccp-media-settings', 'api_base_path');
    register_setting('insecia-ccp-media-settings', 'project_id');
    register_setting('insecia-ccp-media-settings', 'root_directory_id');
    register_setting('insecia-ccp-media-settings', 'directory_template');
    register_setting('insecia-ccp-media-settings', 'file_template');
    register_setting('insecia-ccp-media-settings', 'directory_template_style');
    register_setting('insecia-ccp-media-settings', 'file_template_style');
    register_setting('insecia-ccp-media-settings', 'image_details_template');
    register_setting('insecia-ccp-media-settings', 'login_form_template');
});
 
 
function insecia_ccp_media_page() 
{ ?>

    <div class="wrap">
        <h1>Insecia CCP Media</h1> <hr><br />
        <form action="options.php" method="post">
            <?php
            settings_fields( 'insecia-ccp-media-settings' );
            do_settings_sections( 'insecia-ccp-media-settings' );
            ?>

            <h2><i>General</i></h2><hr>
            <table>
                <tr>
                    <th>Api Base Path</th>
                    <td><input type="text" name="api_base_path" value="<?= esc_attr(get_option('api_base_path')) ?>" size="50" /></td>
                </tr>
                <tr>
                    <th>Project ID</th>
                    <td><input type="number" min="1" name="project_id" value="<?= get_option('project_id') ?>" /></td>
                </tr>
                <tr>
                    <th>Root Directory ID</th>
                    <td><input type="number" min="1" name="root_directory_id" value="<?= get_option('root_directory_id') ?>" /></td>
                </tr>
            </table> <br />

            <h2><i>Templates</i></h2><hr>
            <table>
                <tr>
                    <th>Directory Template</th>
                    <td><textarea name="directory_template" rows="10" cols="120"><?= esc_attr(get_option('directory_template')) ?></textarea></td>
                </tr>
                <tr>
                    <th>File Template</th>
                    <td><textarea name="file_template" rows="10" cols="120"><?= esc_attr(get_option('file_template')) ?></textarea></td>
                </tr>
                <tr>
                    <th>Directory Template Style</th>
                    <td><textarea name="directory_template_style" rows="10" cols="120"><?= esc_attr(get_option('directory_template_style')) ?></textarea></td>
                </tr>
                <tr>
                    <th>File Template Style</th>
                    <td><textarea name="file_template_style" rows="10" cols="120"><?= esc_attr(get_option('file_template_style')) ?></textarea></td>
                </tr>
                <tr>
                    <th>Image Details Template</th>
                    <td><textarea name="image_details_template" rows="20" cols="120"><?= esc_attr(get_option('image_details_template')) ?></textarea></td>
                </tr>
                <tr>
                    <th>Login Form Template</th>
                    <td><textarea name="login_form_template" rows="20" cols="120"><?= esc_attr(get_option('login_form_template')) ?></textarea></td>
                </tr>

                <tr>
                    <td><?php submit_button(); ?></td>
                </tr>
            </table>
        </form>
    </div>

<?php }
