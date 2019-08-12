<?php
/**
 * Clean up WordPress defaults
 *
 * @package Ingen
 * @since Ingen 1.0.0
 */

namespace Spark_Experience;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}


/**
 * Remove the WordPress version from appearing in RSS feeds and Head
 *
 * @return string
 */
function remove_wp_version() {
	return '';
}
add_filter( 'the_generator', __NAMESPACE__ . '\\remove_wp_version' );
remove_action( 'wp_head', 'wp_generator' );


/**
 * Cleanup the <head> of the website.
 */
function cleanup_head() {
	// EditURI link.
	remove_action( 'wp_head', 'rsd_link' );

	// Category feed links.
	remove_action( 'wp_head', 'feed_links_extra', 3 );

	// Post and comment feed links.
	remove_action( 'wp_head', 'feed_links', 2 );

	// Windows Live Writer.
	remove_action( 'wp_head', 'wlwmanifest_link' );

	// Index link.
	remove_action( 'wp_head', 'index_rel_link' );

	// Previous link.
	remove_action( 'wp_head', 'parent_post_rel_link', 10 );

	// Start link.
	remove_action( 'wp_head', 'start_post_rel_link', 10 );

	// Canonical.
	remove_action( 'wp_head', 'rel_canonical', 10 );

	// Shortlink.
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );

	// Links for adjacent posts.
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );

	// WP version.
	remove_action( 'wp_head', 'wp_generator' );

	// Emoji detection script.
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );

	// Emoji styles.
	remove_action( 'wp_print_styles', 'print_emoji_styles' );

	// Remove default JS for Contact Form 7
	// Note: Tread carefully as I believe this will prevent features such as validation
	if ( function_exists( 'wpcf7_load_js' ) ) {
		add_filter( 'wpcf7_load_js', '__return_false' );
	}

	// Remove default css for Contact Form 7
	if ( function_exists( 'wpcf7_load_css' ) ) {
		add_filter( 'wpcf7_load_css', '__return_false' );
	}
}
add_action( 'init', __NAMESPACE__ . '\\cleanup_head' );


/**
 * Remove the default widget comment styles.
 */
function remove_widget_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}
add_filter( 'wp_head', __NAMESPACE__ . '\\remove_widget_comments_style', 1 );


/**
 * Remove recent comments style.
 */
function remove_recent_comments_style() {
	global $wp_widget_factory;

	if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
		remove_action(
			'wp_head',
			array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' )
		);
	}
}
add_action( 'wp_head', __NAMESPACE__ . '\\remove_recent_comments_style', 1 );


/**
 * Remove the inline <figure> styling.
 *
 * @param string $empty     The empty string?
 * @param array  $attr      Attributes
 * @param string $content   The content
 *
 * @return string
 */
function remove_figure_inline_style( string $empty, array $attr, string $content ): string {
	$atts = shortcode_atts(
		array(
			'id'      => '',
			'align'   => 'alignnone',
			'width'   => '',
			'caption' => '',
			'class'   => '',
		),
		$attr,
		'caption'
	);

	$atts['width'] = (int) $atts['width'];

	if ( $atts['width'] < 1 || empty( $atts['caption'] ) ) {
		return $content;
	}

	if ( ! empty( $atts['id'] ) ) {
		$atts['id'] = 'id="' . esc_attr( $atts['id'] ) . '" ';
	}

	$class = trim( 'wp-caption ' . $atts['align'] . ' ' . $atts['class'] );

	return '<figure ' . $atts['id'] . ' class="' . esc_attr( $class ) . '">' . do_shortcode( $content ) . '<figcaption class="wp-caption-text">' . $atts['caption'] . '</figcaption></figure>';
}
add_filter( 'img_caption_shortcode', __NAMESPACE__ . '\\remove_figure_inline_style', 10, 3 );


/**
 * Remove all of the default dashboard widgets.
 */
function remove_dashboard_widgets() {
	global $wp_meta_boxes;

	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'] );
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'] );
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] );
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts'] );

	// Yoast SEO
	unset( $wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget'] );

	// Gravity Forms
	unset( $wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard'] );
}
add_action( 'wp_dashboard_setup', __NAMESPACE__ . '\\remove_dashboard_widgets', 999 );
