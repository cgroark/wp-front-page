<?php
/**
 * Functions
 *
 * @package      custom
 * @author       colin groark
 * @copyright    Copyright (c) 2022, colin groark
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */

/**
 * Theme Setup
 *
 * This setup function attaches all of the site-wide functions 
 * to the correct actions and filters. All the functions themselves
 * are defined below this setup function.
 *
 */

add_action('genesis_setup','child_theme_setup', 15);
function child_theme_setup() {
    
    // ** Backend **

	// Remove Metaboxes
	add_action( 'genesis_theme_settings_metaboxes', 'be_remove_metaboxes' );

	//Remove post author and date; 
	remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
	remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

	//Remove Site Title
	remove_action( 'genesis_site_title', 'genesis_seo_site_title' );

	// ** Frontend **

    // Add Nav to Header
    add_action( 'genesis_before_header', 'be_nav_menus' );

	//Custom Header Widget
	genesis_register_sidebar( array(
		'id' => 'header-widget',
		'name' => __( 'Header Widget', 'genesis' ),
		'description' => __( 'Header Widget Area', 'childtheme' ),
	) );

	//Place Header Widget
	add_action( 'genesis_header', 'add_genesis_widget_area' );

	//Custom Footer Widget
	genesis_register_sidebar( array(
		'id' => 'footer-full-widget',
		'name' => __( 'Full Width Footer Widget', 'genesis' ),
		'description' => __( 'Full Width Footer Widget Area', 'childtheme' ),
	) );

	//Place Footer Widget
	add_action( 'genesis_footer', 'add_genesis_footer_widget_area' );
	
	// Add Search to Footer
	/*add_action( 'genesis_before_footer', 'be_search', 4 );
	add_filter( 'genesis_search_text', '__return_false' );
	add_filter( 'genesis_search_button_text', 'be_search_button_text' );*/

    //Add Foooter Widgets
    add_theme_support( 'genesis-footer-widgets', 6 );

    // Footer
	remove_action( 'genesis_footer', 'genesis_do_footer' );
	add_action( 'genesis_footer', 'be_footer' );

	//Add Custom Style Sheet and JS files
	add_action( 'wp_enqueue_scripts', 'wsm_custom_stylesheet' );

	//Add boostrap
	add_action('wp_enqueue_scripts', 'wpbootstrap_enqueue_styles');

	//Add google fonts
	add_action( 'wp_enqueue_scripts', 'wpb_add_google_fonts' );

	//Add font  awesome
	add_action( 'wp_enqueue_scripts', 'enqueue_load_fa');

}
add_filter( 'genesis_post_title_output', 'custom_post_title' );
	function custom_post_title( $title ) {
		if( get_post_type( get_the_ID() ) == 'post' ) {
			$post_title = get_the_title( get_the_ID() );
			$slug = strtolower(str_replace(" ", "-", $post_title));
			$title = '<h2 class="entry-title" id="' . $slug .'" >' . $post_title . '</h3>';
	}
	return $title;
}
/**
 * Remove Metaboxes
 * This removes unused or unneeded metaboxes from Genesis > Theme Settings. See /genesis/lib/admin/theme-settings.php for all metaboxes.
 *
 */

function be_remove_metaboxes( $_genesis_theme_settings_pagehook ) {
	remove_meta_box( 'genesis-theme-settings-nav', $_genesis_theme_settings_pagehook, 'main' );
}
/**
 * Add Nav Menus to Header
 *
 */

function be_nav_menus() {
	echo '<nav><div class="primary-nav">';
	wp_nav_menu( array( 'menu' => 'Primary' ) );
	echo '</div></nav>';
}
/* Place Header Widget */
function add_genesis_widget_area() {
	genesis_widget_area( 'header-widget', array(
	'before' => '<div class="header-widget widget-area">',
	'after'  => '</div>',
	) );
}
/**
 * Add Search to Footer
 *
 */
/*
function be_search() {
	?>
	<div id="searchbar">
		<div class="wrap">
			<p>Can't find what you're looking for? </p> <?php get_search_form(); ?>
		</div>
	</div>
	<?php
}
*/
/**
 * Change search button text to Go 
 *
 */
/*
function be_search_button_text( $text ) {
	return esc_attr( 'Go' );
}
*/
/**
 * Footer
 *
 */
/*Add custom footer widget */
function add_genesis_footer_widget_area() {
	genesis_widget_area( 'footer-full-widget', array(
	'before' => '<div class="full-width-footer-widget widget-area">',
	'after'  => '</div>',
	) );
}
function be_footer() {
	echo '<div class="left"><p>© Copyright ' . date('Y') . '</div>';
	/*wp_nav_menu( array( 'menu' => 'Footer' ) );*/
	echo '</div>';
}
//Import Custom Style Sheet
function wsm_custom_stylesheet() {
	wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/custom.css' );
	wp_enqueue_script( 'nav', get_stylesheet_directory_uri() . '/js/nav.js', array('jquery'));

}

//Add bootstrap
function wpbootstrap_enqueue_styles() {
	wp_enqueue_style( 'bootstrap', '//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' );
	wp_enqueue_script( 'bootstrap', '//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', array('jquery'));
}

//Add google fonts

function wpb_add_google_fonts() {
	wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&family=Tenor+Sans&display=swap', false );
}

//Add font awesome
function enqueue_load_fa() {
	wp_enqueue_style( 'load-fa', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css' );
}
  
