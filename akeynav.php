<?php
/**
 * Plugin Name: Arrow Keys Navigation
 * Description: Enable navigation to next and previous posts (and custom posts) using the right and left arrows on keyboard.
 * Version: 1.0.1
 * Author: Ernesto Ortiz
 * Author URI:
 * License: GNU General Public License v3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: akeynav
 * Domain Path: languages
 */

// load plugin text domain
function akeynav_init() {
    load_plugin_textdomain( 'akeynav', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action('plugins_loaded', 'akeynav_init');


// Styles & Scripts
function akeynav_frontend_scripts() {
    //plugin style
    if(is_admin()) return;
    wp_enqueue_style('akeynav_style', plugins_url('/css/style.css',__FILE__));
    //ajax scripts
    wp_enqueue_script( 'akeynav_queries', plugins_url( '/js/queries.js' , __FILE__ ), array('jquery'), '1.0', true );
}
add_action('wp_enqueue_scripts', 'akeynav_frontend_scripts');


/** regular FUNCTIONS **/
include 'functions.php';

/** AJAX FUNCTIONS **/
include "ajaxes.php";


// To set where to go on key pressed
function akeynav_wildcard() {
    if (!is_custom_post_type()) return;
    global $post;
    $next_url =''; $prev_url='';
    $next_post = get_next_post();
    $prev_post = get_previous_post();
    if (!empty( $next_post ))
        $next_url = get_permalink( $next_post->ID );
    if (!empty( $prev_post ))
        $prev_url = get_permalink( $prev_post->ID );
    //put it inside a div
    echo "<div id='akeynav_wildcard' style='background:yellow'>". $prev_url .",".  $next_url ."</div>";
}
add_action( 'wp_footer', 'akeynav_wildcard');

?>
