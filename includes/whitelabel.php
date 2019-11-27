<?php

if ( ! defined( 'WPINC' ) ) {
	die;
}


// Hide the WordPress logo from the admin bar
add_action( 'wp_before_admin_bar_render', function () {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'wp-logo' );
} );

// Change WordPress login page logo link
add_filter( 'login_headertext', function () {
	return 'https://leapsparkagency.com';
} );

// Remove WordPress link from admin footer
add_filter( 'admin_footer_text', function () {
	return '';
} );

// Change the look and feel of the login page
add_action( 'login_enqueue_scripts', function () {

	wp_enqueue_style( 'spark-login-style', plugin_dir_path( __DIR__ ) . 'css/login-style.css', '', SPARK_EXPERIENCE_VERSION );

	$s = function ( $value ) {
		return wp_strip_all_tags( $value );
	};

	$logo                           = $s( get_theme_mod( 'login_logo' ) ?? '' );
	$page_background_color          = $s( get_theme_mod( 'login_page_background_color' ) ?? '' );
	$form_label_color               = $s( get_theme_mod( 'login_form_text_color' ) ?? '' );
	$form_background_color          = $s( get_theme_mod( 'login_form_background_color' ) ?? '' );
	$button_background_color        = $s( get_theme_mod( 'login_form_button_color' ) ?? '' );
	$button_background_hover_color  = $s( get_theme_mod( 'login_form_button_hover_color' ) ?? '' );
	$button_text_color              = $s( get_theme_mod( 'login_form_button_text_color' ) ?? '' );
	$button_text_hover_color        = $s( get_theme_mod( 'login_form_button_text_hover_color' ) ?? '' );
	$button_border_color            = $s( get_theme_mod( 'login_form_button_border_color' ) ?? '' );
	$button_border_hover_color      = $s( get_theme_mod( 'login_form_button_hover_border_color' ) ?? '' );

	$style = "
			body {
				background: {$page_background_color};
			}

			.login form {
				background: {$form_background_color};
			}

			.login form label {
				color: {$form_label_color};
			}

			.login h1 a {
				background-image: url('{$logo}');
				background-size: 250px;
				margin: 0 auto;
				width: 320px;
			}

			.wp-core-ui .button-primary {
				background: {$button_background_color};
				border-color: {$button_border_color};
				color: {$button_text_color};
			}

			.wp-core-ui .button-primary:hover {
				background: {$button_background_hover_color};
				border-color: {$button_border_hover_color};
				color: {$button_text_hover_color};
			}";

	wp_add_inline_style( 'spark-login-style',	$style );
} );
