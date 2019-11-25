<?php

/**
 * ======== What's This? ========
 * Create a new section in the customizer for the Login from/screen.
 *
 * [1] Register the new section
 * [2] Option for Logo
 * [3] Options for Form colors
 * [4] Options for Button colors
 * [5] Options for page colors
 */
add_action( 'customize_register', function ( $wp_customize ) {
	$wp_customize->add_section( 'login_form', array(
		'title' => 'Login Form Style',
		'priority' => 10,
		'description' => 'Customize the login form that your admins and members see when logging in.',
	) );


	/**
	 * [1] ---------- Logo ----------------
	 */
	$wp_customize->add_setting( 'login_logo' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'login_logo',
		array(
			'label'    => 'Upload Logo',
			'section'  => 'login_form',
			'settings' => 'login_logo',
		) ) );


	/**
	 * [2] ---------- Form ----------------
	 */
	$wp_customize->add_setting( 'login_form_background_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'login_form_background_color',
		array(
			'label'    => 'Form Background Color',
			'section'  => 'login_form',
			'settings' => 'login_form_background_color',
		) ) );

	$wp_customize->add_setting( 'login_form_text_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'login_form_text_color',
		array(
			'label'    => 'Form Text Color',
			'section'  => 'login_form',
			'settings' => 'login_form_text_color',
		) ) );


	/**
	 * [3] ---------- Button ----------------
	 */
	$wp_customize->add_setting( 'login_form_button_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'login_form_button_color',
		array(
			'label'    => 'Button Color',
			'section'  => 'login_form',
			'settings' => 'login_form_button_color',
		) ) );

	$wp_customize->add_setting( 'login_form_button_hover_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'login_form_button_hover_color',
		array(
			'label'    => 'On Hover: Button Color',
			'section'  => 'login_form',
			'settings' => 'login_form_button_hover_color',
		) ) );


	$wp_customize->add_setting( 'login_form_button_text_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'login_form_button_text_color',
		array(
			'label'    => 'Button Text Color',
			'section'  => 'login_form',
			'settings' => 'login_form_button_text_color',
		) ) );

	$wp_customize->add_setting( 'login_form_button_text_hover_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'login_form_button_text_hover_color',
		array(
			'label'    => 'On Hover: Button Text Color',
			'section'  => 'login_form',
			'settings' => 'login_form_button_text_hover_color',
		) ) );


	$wp_customize->add_setting( 'login_form_button_border_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'login_form_button_border_color',
		array(
			'label'    => 'Button Border Color',
			'section'  => 'login_form',
			'settings' => 'login_form_button_border_color',
		) ) );

	$wp_customize->add_setting( 'login_form_button_hover_border_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'login_form_button_hover_border_color',
		array(
			'label'    => 'On Hover: Button Border Color',
			'section'  => 'login_form',
			'settings' => 'login_form_button_hover_border_color',
		) ) );


	/**
	 * [4] ---------- Page ----------------
	 */
	$wp_customize->add_setting( 'login_page_background_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'login_page_background_color',
		array(
			'label'    => 'Page Background Color',
			'section'  => 'login_form',
			'settings' => 'login_page_background_color',
		) ) );
} );
