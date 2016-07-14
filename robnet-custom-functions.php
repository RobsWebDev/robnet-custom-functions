<?php
/**
* Plugin Name: RobNet Custom Functions
* Plugin URI: http://robmcdonald.net/
* Description: Adds custom code snippits to Rob McDonald websites.
* Author: Rob McDonald
* Author URI: https://robmcdonald.net/
* Version: 1.0
* Text Domain: robnet-custom-functions
*
* Copyright: (c) 2016 Rob McDonald (spam@robmcdonald.net)
*
* License: GNU General Public License v3.0
* License URI: http://www.gnu.org/licenses/gpl-3.0.html
*
* @author    Rob McDonald
* @copyright Copyright (c) 2016, Rob McDonald.
* @license  http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
*
*/


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
 Enable shortcodes in widgets
************************************************************ */

// Enable shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

/*
 Enqueue and Load Font Awesome
************************************************************ */


wp_enqueue_style( 'prefix-font-awesome', 'http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css', array(), '4.5.0' );

/*
 Enqueue and Load Google Fonts
************************************************************ */

//* Enqueue Lato Google font
add_action( 'wp_enqueue_scripts', 'rm_load_google_fonts' );
function rm_load_google_fonts() {
	wp_enqueue_style( 'google-font-lato', '//fonts.googleapis.com/css?family=Lato:300,400,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'google-font-roboto', '//fonts.googleapis.com/css?family=Roboto:300,400,500,700', array(), CHILD_THEME_VERSION );
}

// Filter the title with a custom function
add_filter('genesis_seo_title', 'rm_site_title' );

// Add additional custom style to site header
function rm_site_title( $title ) {

    	// Change $custom_title text as you wish
	$custom_title = '<span class="custom-title">ROB</span>MCDONALD';

	// Don't change the rest of this on down

	// If we're on the front page or home page, use `h1` heading, otherwise us a `p` tag
	$tag = ( is_home() || is_front_page() ) ? 'h1' : 'p';

	// Compose link with title
	$inside = sprintf( '<a href="%s" title="%s">%s</a>', trailingslashit( home_url() ), esc_attr( get_bloginfo( 'name' ) ), $custom_title );

	// Wrap link and title in semantic markup
	$title = sprintf ( '<%s class="site-title" itemprop="headline">%s</%s>', $tag, $inside, $tag );
	return $title;

}