<?php
/*
  Plugin Name: Ultimate Recent Posts
  Plugin URI: http://smartcatdesign.net/wp-popup
  Description: Display your recent posts in many ways. Highly customizable, efficient, and beautiful
  Version: 1.0
  Author: SmartCat, nik-cole
  Author URI: http://smartcatdesign.net
  License: GPL v2
 */
?>

<?php
// 1st hook
// activates the plugin
register_activation_hook(__FILE__, 'my_plugin_activate');

function my_plugin_activate() {
    // set redirect to true
    add_option('urp_activation_redirect', true);
    urp_popup_register_options();
}

function urp_popup_register_options() {
    // declare options array
    $urp_popup_options = array(
        'urp_title' => 'Title',

    );
    // check if option is set, if not, add it
    foreach ($urp_popup_options as $option_name => $option_value) {
        if (get_option($option_name) === false) {
            add_option($option_name, $option_value);
        } else {
            update_option($option_name, addslashes($_POST[$option_name]));
        }
    }
}

// 2nd hook - redirect when activated
//add_action('admin_init', 'urp_activation_redirect');
//
//function urp_activation_redirect() {
//    if (get_option('urp_activation_redirect', false)) {
//        delete_option('urp_activation_redirect');
//        wp_redirect(admin_url() . 'options-general.php?page=wp-popup.php');
//    }
//}

