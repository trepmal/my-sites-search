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

	if( ! is_user_logged_in() || mss_my_sites_count_below_minimum() ) {
		return;
	}

	$wp_admin_bar->add_menu( array(
		'parent' => 'my-sites-list',
		'id'     => 'my-sites-search',
		'title'  => '<label for="my-sites-search-text">'. __( 'Filter My Sites', 'mss' ) .'</label>' .
					'<input type="text" id="my-sites-search-text" placeholder="'. __( 'Search Sites', 'mss' ) .'" />',
		'meta'   => array(
			'class' => 'hide-if-no-js'
		)
	) );
}

add_action( 'admin_bar_menu', 'mss_admin_bar_menu' );

function mss_enqueue_assets( ) {
	if ( ! is_admin_bar_showing() || !is_user_logged_in() || mss_my_sites_count_below_minimum() ) {
		return;
	}

	wp_enqueue_script( 'my-sites-search', plugins_url( 'my-sites-search.js', __FILE__ ), array('jquery'), '2014.07.30', true );
	wp_enqueue_style( 'my-sites-search', plugins_url( 'my-sites-search.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'mss_enqueue_assets' );
add_action( 'admin_enqueue_scripts', 'mss_enqueue_assets' );

// optionally provide a way for site administrators to specify a
// minimum via a filter 'mms_show_search_minimum_sites'
function mss_my_sites_count_below_minimum(){
	static $below_min = null;
	if ( ! is_null( $below_min ) ) {
		return $below_min;
	}

	$below_min = false;
	$minimum = apply_filters( 'mms_show_search_minimum_sites', false );
	if ( is_numeric( $minimum ) ) {
		$below_min = count( get_blogs_of_user( get_current_user_id() ) ) < intval( $minimum );
	}

	return $below_min;
}
