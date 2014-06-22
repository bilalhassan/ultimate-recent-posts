<?php
/*
  Plugin Name: Ultimate Recent Posts
  Plugin URI: http://smartcatdesign.net/wp-popup
  Description: A highly customizable plugi
  Version: 1.0
  Author: SmartCat, nik-cole
  Author URI: http://smartcatdesign.net
  License: GPL v2
 */

register_activation_hook(__FILE__, 'my_plugin_activate');

function my_plugin_activate() {
    add_option('sc_urp_activation_redirect', true);
    sc_urp_register_options();
}

function sc_urp_register_options() {
    // declare options array
    $sc_urp_options = array(
        'sc_urp_title' => 'Popup Title',
    );
    // check if option is set, if not, add it
    foreach ($sc_urp_options as $option_name => $option_value) {
        if (get_option($option_name) === false) {
            add_option($option_name, $option_value);
        } else {
            update_option($option_name, addslashes($_POST[$option_name]));
        }
    }
}

// redirect when activated
add_action('admin_init', 'sc_urp_activation_redirect');

function sc_urp_activation_redirect() {
    if (get_option('sc_urp_activation_redirect', false)) {
        delete_option('sc_urp_activation_redirect');
        wp_redirect(admin_url() . 'options-general.php?page=urp-options.php');
    }
}

add_action('admin_menu', 'sc_urp_menu');

function sc_urp_menu() {
    add_options_page('Ultimate Recent Posts', 'Ultimate Recent Posts Settings', 'administrator', 'sc_urp_options.php', 'sc_urp_options');
}

function sc_urp_options(){



    include_once 'inc/options.php';

}