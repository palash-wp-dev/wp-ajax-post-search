<?php 
/**
 * Plugin Name: WP ajax post search
 * Description: A simple plugin to search WordPress posts using ajax
 * Version: 1.0
 * Author: Shahadat Hossain
 */

 if ( ! defined( 'ABSPATH' ) ) exit;

 // script enqusion
 function ajax_enqueue_scripts() {
    wp_enqueue_script( 'ajax-script', plugin_dir_url( __FILE__ ) . 'search.js', [ 'jquery' ], null, true );

    wp_localize_script( 'ajax-script', 'ajax_object', [ 'ajax_url' => admin_url( 'admin-ajax.php' ) ] );
 }
 add_action( 'wp_enqueue_scripts', 'ajax_enqueue_scripts' );

 // ajax code
 function search_post() {
   $search_query = isset( $_POST['query'] ) ? sanitize_text_field( $_POST['query'] ) : '';

   if ( empty( $search_query ) ) {
      wp_send_json_error( 'No search query provided.' );
      wp_die();
   }

   $args = [
      'post_type'      => 'post',
      'posts_per_page' => 5,
      's'              => $search_query
   ];

   $query = new WP_Query($args);
 }

 add_action( 'wp_ajax_search_post', 'search_post' );
 add_action( 'wp_ajax_nopriv_search_post', 'search_post' );