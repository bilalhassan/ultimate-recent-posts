<?php
/*
  Plugin Name: Ultimate Recent Posts
  Plugin URI: http://smartcatdesign.net/wp-popup
  Description: A highly customizable plugi
  Version: 1.0
  Author: SmartCat
  Author URI: http://smartcatdesign.net
  License: GPL v2
 */


register_activation_hook(__FILE__, 'my_plugin_activate');

if(!defined('SC_URP_VERSION'))
    define('SC_URP_VERSION','1.0');
if(!defined('SC_URP_PATH'))
    define('SC_URP_PATH',plugin_dir_url(__FILE__));

function my_plugin_activate() {
    add_option('sc_urp_activation_redirect', true);
    
    
    sc_urp_register_options();
}

function sc_urp_register_options() {
    // declare options array
    $sc_urp_options = array(
        'sc_urp_template' => 'slider',
        'sc_urp_category' => '',
        'sc_urp_tag' => '',
        'sc_urp_slide_timer' => '4000',
        'sc_urp_carousel_number' => '4',
        'sc_urp_height' => '200px',
        'sc_urp_num_posts' => '8'
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
        wp_redirect(admin_url() . 'options-general.php?page=sc_urp_options.php');
    }
}

add_action('admin_menu', 'sc_urp_menu');

function sc_urp_menu() {
    
    global $menu;
    if(!isset( $menu['smartkit_meow']))
        add_menu_page('Smartkit', 'Smartkit', 'manage_options', 'smartkit_menu', 'smartkit_meow', SC_URP_PATH . 'img/smartcat.png' );
    
    add_submenu_page('smartkit_menu', 'Ultimate Recent Posts', 'Ultimate Recent Posts', 'manage_options', 'smartkit_urp', 'sc_urp_options');
}
/*
 * Create smartkit menu
 */
if( !function_exists('smartkit_meow') ) :
    function smartkit_meow(){
        include_once 'inc/smartkit/sk.php';
    }
endif;

/*
 * Create Plugin menu
 */
function sc_urp_options(){
    if(isset($_REQUEST['sc_urp_submit']) && $_REQUEST['sc_urp_submit'] == 'save'){
        sc_urp_register_options();
    }
    include_once 'inc/options.php';
}


// add CSS & JS
add_action('wp_enqueue_scripts','sc_urp_load_styles_scripts');
function sc_urp_load_styles_scripts(){


    //slider
    wp_enqueue_style('sc_urp_slider_css',SC_URP_PATH . 'lib/slider/camera.css',false, SC_URP_VERSION);
    wp_enqueue_script('sc_urp_easing_js',SC_URP_PATH . 'lib/slider/jquery.easing.1.3.js',array('jquery'),SC_URP_VERSION);
    wp_enqueue_script('sc_urp_slider_js',SC_URP_PATH . 'lib/slider/camera.min.js',false,SC_URP_VERSION);


    //carousel
    wp_enqueue_style('sc_urp_carousel_css',SC_URP_PATH . 'lib/carousel/owl.carousel.css',false, SC_URP_VERSION);
    wp_enqueue_style('sc_urp_carousel_theme_css',SC_URP_PATH . 'lib/carousel/owl.theme.css',false, SC_URP_VERSION);
    wp_enqueue_style('sc_urp_carousel_transitions_css',SC_URP_PATH . 'lib/carousel/owl.transitions.css',false, SC_URP_VERSION);
    wp_enqueue_script('sc_urp_carousel_js',SC_URP_PATH . 'lib/carousel/owl.carousel.min.js',false,SC_URP_VERSION);

    // plugin main style
    wp_enqueue_style('sc_urp_default_style',SC_URP_PATH . 'style/default.css',false, '1.0');
    $custom_css = '#sc-carousel-slider .item img{ height : ' . get_option('sc_urp_height') . 'px; }';
    wp_add_inline_style('sc_urp_default_style', $custom_css);    

    // plugin main script
    wp_enqueue_script('sc_urp_default_script',SC_URP_PATH . 'script/sc_urp_script.js',array('jquery'), SC_URP_VERSION);
}


// create the shortcode
add_shortcode('urp_posts','set_urp');
function set_urp($atts){
    extract(shortcode_atts(array(
        'id' => '1'
    ), $atts));
    
    global $content;
    ob_start();    
    
    if('slider' == get_option('sc_urp_template')) :
        include 'inc/urp-posts-slider.php';
        $output = ob_get_clean();
    elseif('carousel' == get_option('sc_urp_template')) :
        include 'inc/urp-posts-slider-carousel.php';
        $output = ob_get_clean();
    endif;
    return $output;
}





