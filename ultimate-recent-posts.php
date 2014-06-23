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


// add CSS & JS
add_action('wp_enqueue_scripts','sc_urp_load_styles_scripts');
function sc_urp_load_styles_scripts(){


    //slider
    wp_enqueue_style('sc_urp_slider_css',plugins_url() . '/ultimate-recent-posts/lib/slider/bjqs-1.3.css',false, '1.3');
    wp_enqueue_script('sc_urp_slider_js',plugins_url() . '/ultimate-recent-posts/lib/slider/bjqs-1.3.min.js',array('jquery'),'1.3');


    // plugin main style
    wp_enqueue_style('sc_urp_default_style',plugins_url() . '/ultimate-recent-posts/style/default.css',false, '1.0');

    // plugin main script
    wp_enqueue_script('sc_urp_default_script',plugins_url() . '/ultimate-recent-posts/script/sc_urp_script.js',array('jquery'), '1.0');


}


// create the shortcode
add_shortcode('urp','set_urp');
function set_urp($atts){
    extract(shortcode_atts(array(
        'id' => '1'
    ), $atts));

//    include_once 'inc/urp-posts-slider.php';
    $args = array(
        'post_type' => 'team_member',
    );
    $products = new WP_Query( $args );
    if( $products->have_posts() ) {
        while( $products->have_posts() ) {
            $products->the_post();
            ?>
            <h1><?php the_title() ?></h1>
            <div class='content'>
                <?php the_post_thumbnail(); ?>
                <?php the_content(); ?>
                <?php the_time('F jS, Y'); ?>
                <?php echo get_post_meta(get_the_ID(),'team_member_facebook',true); ?>
            </div>
        <?php
        }
    }
    else {
        echo 'Oh ohm no products!';
    }

}


add_action( 'init', 'team_members' );
function team_members() {
    $labels = array(
        'name'               => _x( 'Team', 'post type general name' ),
        'singular_name'      => _x( 'Team Member', 'post type singular name' ),
        'add_new'            => _x( 'Add New', 'book' ),
        'add_new_item'       => __( 'Add New Member' ),
        'edit_item'          => __( 'Edit Member' ),
        'new_item'           => __( 'New Team Member' ),
        'all_items'          => __( 'All Team Members' ),
        'view_item'          => __( 'View Team Member' ),
        'search_items'       => __( 'Search Team Members' ),
        'not_found'          => __( 'No member found' ),
        'not_found_in_trash' => __( 'No member found in the Trash' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'Our Team'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our team members specific data',
        'public'        => true,
        'menu_position' => 5,
        'supports'      => array( 'title', 'editor', 'thumbnail'),
        'has_archive'   => true,
    );
    register_post_type( 'team_member', $args );
}


/*
 * Handle Taxonomy for custom types
 */
add_action( 'init', 'team_member_positions', 0 );
function team_member_positions() {
    $labels = array(
        'name'              => _x( 'Positions', 'taxonomy general name' ),
        'singular_name'     => _x( 'Position', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Positions' ),
        'all_items'         => __( 'All Positions' ),
        'parent_item'       => __( 'Parent Position' ),
        'parent_item_colon' => __( 'Parent Position:' ),
        'edit_item'         => __( 'Edit Position' ),
        'update_item'       => __( 'Update Position' ),
        'add_new_item'      => __( 'Add New Position' ),
        'new_item_name'     => __( 'New Position' ),
        'menu_name'         => __( 'Positions' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
    );
    register_taxonomy( 'team_member_position', 'team_member', $args );
}

/**
 * Hook to add custom fields box
 * calls a function
 */
add_action( 'add_meta_boxes', 'team_member_info_box' );
function team_member_info_box() {
    add_meta_box(
        'team_member_info_box',
        __( 'Additional Information', 'myplugin_textdomain' ),
        'team_member_info_box_content',
        'team_member',
        'advanced',
        'high'
    );
}
/**
 * function called by team_member_info_box
 */
function team_member_info_box_content($post_id){
    //nonce
    wp_nonce_field(plugin_basename( __FILE__), 'team_member_info_box_content_nonce');

    //social
    echo '<lablel for="team_member_facebook">Facebook URL</lablel>';
    echo '<input type="text" id="team_member_facebook" name="team_member_facebook" placeholder="Enter Facebook URL"/><br/>';

    echo '<label for="team_member_twitter">Twitter URL</lablel>';
    echo '<input type="text" id="team_member_twitter" name="team_member_twitter" placeholder="Enter Twitter URL"/><br/>';

    echo '<lablel for="team_member_linkedin">Linkedin URL</lablel>';
    echo '<input type="text" id="team_member_linkedin" name="team_member_linkedin" placeholder="Enter Linkedin URL"/><br/>';

    echo '<lablel for="team_member_gplus">Google Plus URL</lablel>';
    echo '<input type="text" id="team_member_gplus" name="team_member_gplus" placeholder="Enter Google Plus URL"/><br/>';
}

/**
 * Hook that handles submitted data
 */
add_action('save_post','team_member_box_save');
function team_member_box_save($post_id){

//    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
//        return;
//
//    if(!wp_verify_nonce($_POST['team_member_info_box_content_nonce'], plugin_basename( __FILE__)))
//        return;
//
//    // dont allow unauthorized users to edit
//    if ( 'page' == $_POST['post_type'] ) {
//        if ( !current_user_can( 'edit_page', $post_id ) )
//            return;
//    } else {
//        if ( !current_user_can( 'edit_post', $post_id ) )
//            return;
//    }

    // get var values
    $facebook_url = $_POST['team_member_facebook'];
    $twitter_url = $_POST['team_member_twitter'];
    $linkedin_url = $_POST['team_member_linkedin'];
    $gplus_url = $_POST['team_member_gplus'];

    // set var values
    update_post_meta($post_id,'team_member_facebook', $facebook_url);
    update_post_meta($post_id,'team_member_twitter', $twitter_url);
    update_post_meta($post_id,'team_member_linkedin', $linkedin_url);
    update_post_meta($post_id,'team_member_gplus', $gplus_url);



}




