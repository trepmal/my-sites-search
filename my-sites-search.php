<?php
/*
 * Plugin Name: My Sites Search
 * Plugin URI: trepmal.com
 * Description: https://twitter.com/trepmal/status/443189183478132736
 * Version: 2014.07.30
 * Author: Kailey Lampert
 * Author URI: kaileylampert.com
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * TextDomain: mss
 * DomainPath:
 * Network: true
 */

function mss_admin_bar_menu( $wp_admin_bar ) {
	$wp_admin_bar->add_menu( array(
		'parent' => 'my-sites-list',
		'id'     => 'my-sites-search',
		'title'  => '<input type="text" placeholder="'. __( 'Search sites', 'mss' ) .'" />',
		'meta'   => array(
			'class' => 'hide-if-no-js'
		)
	) );
}
add_action( 'admin_bar_menu', 'mss_admin_bar_menu' );

function mss_enqueue_assets( ) {
	if ( ! is_admin_bar_showing() ) return;
	wp_enqueue_script( 'my-sites-search', plugins_url( 'my-sites-search.js', __FILE__ ), array('jquery'), '2014.07.30', true );
	wp_enqueue_style( 'my-sites-search', plugins_url( 'my-sites-search.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'mss_enqueue_assets' );
add_action( 'admin_enqueue_scripts', 'mss_enqueue_assets' );