<?php
/**
 * Front Page
 *
 * @package      Custom
 * @author       colin groark
 * @copyright    Copyright (c) 2022
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */
// Force full width
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Remove Page Title
remove_action( 'genesis_post_title', 'genesis_do_post_title' );

// Add Rotator
add_action( 'genesis_after_header', 'be_home_rotator' );

/**
 * Rotator 
 *
 */


function be_home_rotator() {
	do_action( 'home_rotator' );
}
genesis();
?>