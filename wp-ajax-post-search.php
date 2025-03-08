<?php 
/**
 * Plugin Name: WP ajax post search
 * Description: A simple plugin to search WordPress posts using ajax
 * Version: 1.0
 * Author: Shahadat Hossain
 */

 if ( ! defined( 'ABSPATH' ) ) exit;

 function ajax_enqueue_scripts() {
    wp_enqueue_script( 'ajax-script', plugin_dir_url( __FILE__ ) . 'search.js', [ 'jquery' ], null, true );
 }

 add_action( 'wp_enqueue_scripts', 'ajax_enqueue_scripts' );