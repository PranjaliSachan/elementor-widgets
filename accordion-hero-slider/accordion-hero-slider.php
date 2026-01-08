<?php
/**
 * Plugin Name: Accordion Hero Slider
 * Description: A premium horizontal accordion hero slider with industry-focused design and dynamic client logos.
 * Version: 1.1.0
 * Author: Pranjali Sachan
 * Text Domain: accordion-hero-slider
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * 
 * Requires Plugins: elementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register Widget.
 */
function register_hero_slider_widget( $widgets_manager ) {
	require_once( __DIR__ . '/widgets/hero-slider-widget.php' );
	$widgets_manager->register( new \Hero_Slider_Widget() );
}
add_action( 'elementor/widgets/register', 'register_hero_slider_widget' );

/**
 * Enqueue Styles and Scripts.
 */
function enqueue_hero_slider_assets() {
	wp_enqueue_style( 
		'hero-slider-styles', 
		plugins_url( '/assets/css/hero-slider.css', __FILE__ ), 
		[], 
		'1.1.0' 
	);

	wp_enqueue_script( 
		'hero-slider-scripts', 
		plugins_url( '/assets/js/hero-slider.js', __FILE__ ), 
		['jquery'], 
		'1.1.0', 
		true 
	);

    // Enqueue Google Fonts
    wp_enqueue_style( 'google-fonts-hero', 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=Inter:wght@300;400;500;600&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'enqueue_hero_slider_assets' );
function enqueue_hero_slider_editor_assets() {
    wp_enqueue_style( 'hero-slider-styles', plugins_url( '/assets/css/hero-slider.css', __FILE__ ) );
}
add_action( 'elementor/editor/after_enqueue_scripts', 'enqueue_hero_slider_editor_assets' );
