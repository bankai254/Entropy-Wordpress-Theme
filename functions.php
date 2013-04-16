<?php

// register admin scripts
function entropy_admin_register_scripts() {
    wp_register_script('media_upload_helper', get_template_directory_uri() . '/js/media_upload_helper.js', array('jquery'));
}

add_action('admin_init', 'entropy_admin_register_scripts');

function entropy_enqueue_admin_scripts() {
    // enqueue scripts
    wp_enqueue_script('media_upload_helper');
    wp_enqueue_script('thickbox');
    wp_enqueue_script('media-upload');
        
    // enqueue styles
    wp_enqueue_style('thickbox');
}

add_action('admin_enqueue_scripts', 'entropy_enqueue_admin_scripts');


add_action('admin_init', 'entropy_theme_options_init');
add_action('admin_menu', 'entropy_theme_options_add_page');

/*
 * This function is used to initialize the theme options page
 */
function entropy_theme_options_init() {
    // http://codex.wordpress.org/Function_Reference/register_setting
    register_setting('entropy_theme_options', 'entropy_options');
}

/*
 * This adds a sub menu to the Appearance Menu, which displays
 * as a theme options page
 */
function entropy_theme_options_add_page() {
    add_theme_page(
            __('Page Title', 'entropy_theme'), // $page_title
            __('Theme Options', 'entropy_theme'), // $menu_title
            'edit_theme_options', // $capability
            'entropy-theme-options', // $menu_slug
            'entropy_show_options' // $function
            ); 
}

/*
 * This function shows the content of the options page
 */
function entropy_show_options() {
    global $select_options;
    // start the wrap div
    echo '<div class="wrap">';
    // display the settings updated message, if it exists
    if(isset($_GET['settings-updated']) && ($_GET['settings-updated'] == true)) {
        echo '<div class="updated">
                <p><strong>';
        _e('Settings saved.', 'entropy_theme');
        echo '</strong></p>
            </div>';
    }
    // Add the page title and icon
    ?>
    <div id="icon-themes" class="icon32">
        <br />
    </div>
    <h2>Theme Options</h2>
<form method="post" action="options.php">
    <?php settings_fields( 'entropy_theme_options');
    // get the options that are already set, if any
    $options = get_option('entropy_options');
    // create the options table
    ?>
    <table>
        <tr>
            <th scope="row" style="vertical-align: top; padding: 5px 20px 0 20px;"><?php _e('User Photo', 'entropy_theme'); ?></th>
            <td>
                <input type="hidden" class="media-id" name="entropy_options[user_photo_id]" value="<?php if(isset($options['user_photo_id'])) echo $options['user_photo_id']; ?>" />
                <button type="button" class="button-secondary get-media"><?php _e('Upload Photo', 'entropy_theme'); ?></button>
                <button type="button" class="button-secondary delete-media"><?php _e('Remove Photo', 'entropy_theme'); ?></button>
                <p class="description"><?php _e('The dimensions should be 200x200px', 'entropy_theme'); ?></p>
                <?php
                if(isset($options['user_photo_id']) && !empty($options['background_photo_id'])) {
                    $user_photo_src = wp_get_attachment_image_src($options['user_photo_id']);
                    echo '<div class="preview" style="float: left;">';
                } else {
                    echo '<div class="preview hidden" style="float: left;">';
                }
                ?>
                    <p><strong><?php _e('Preview:', 'entropy_theme'); ?></strong></p>
                    <img src="<?php if(isset($user_photo_src)) echo $user_photo_src[0]; ?>" class="image-preview" />
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row" style="vertical-align: top; padding: 5px 20px 0 20px;"><?php _e('Header Background Photo', 'entropy_theme'); ?></th>
            <td>
                <input type="hidden" class="media-id" name="entropy_options[background_photo_id]" value="<?php if(isset($options['background_photo_id'])) echo $options['background_photo_id']; ?>" />
                <button type="button" class="button-secondary get-media"><?php _e('Upload Photo', 'entropy_theme'); ?></button>
                <button type="button" class="button-secondary delete-media"><?php _e('Remove Photo', 'entropy_theme'); ?></button>
                <p class="description"><?php _e('Dimensions should be at least 1,000px wide', 'entropy_theme'); ?></p>
                <?php
                if(isset($options['background_photo_id']) && !empty($options['background_photo_id'])) {
                    $back_photo_src = wp_get_attachment_image_src($options['background_photo_id']);
                    echo '<div class="preview" style="float: left;">';
                } else {
                    echo '<div class="preview hidden" style="float: left;">';
                }
                ?>
                    <p><strong><?php _e('Preview:', 'entropy_theme'); ?></strong></p>
                    <img src="<?php if(isset($back_photo_src)) echo $back_photo_src[0]; ?>" class="image-preview" />
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="entropy_options[submit]" class="button-primary" value="<?php _e('Save Settings', 'entropy_theme'); ?>" /></td>
        </tr>
    </table>
</div><!-- end .wrap div -->
<?php
}





