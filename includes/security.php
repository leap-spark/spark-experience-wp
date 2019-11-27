<?php
/**
 * Security related functionality.
 *
 * @package Spark_Experience
 */

namespace Spark_Experience;

use WP_Error;
use WP_User;

if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! defined( 'DISALLOW_FILE_EDIT' ) ) {
	define( 'DISALLOW_FILE_EDIT', true );
}

/**
 * Prevent users from authenticating if they are using a weak password. This function was taken from 10up Experience.
 *
 * @source https://github.com/10up/10up-experience/blob/develop/includes/authentication.php
 *
 * @param WP_User $user User object
 * @param string  $username Username
 * @param string  $password Password
 *
 * @return WP_User|WP_Error
 */
function prevent_weak_password_auth( $user, string $username, string $password ) {
	$test_tlds = array( 'test', 'dev', 'local', 'localhost' );
	$tld       = preg_replace( '#^.*\.(.*)$#', '$1', wp_parse_url( site_url(), PHP_URL_HOST ) );

	if ( ! in_array( $tld, $test_tlds, true ) && in_array( strtolower( trim( $password ) ), weak_passwords(), true ) ) {
		return new WP_Error(
			'Auth Error',
			sprintf(
				'%s <a href="%s">%s</a> %s',
				__( 'Please', 'leapspark' ),
				esc_url( wp_lostpassword_url() ),
				__( 'reset your password', 'leapspark' ),
				__( 'in order to meet current security measures.', 'leapspark' )
			)
		);
	}

	return $user;
}
add_filter( 'authenticate', __NAMESPACE__ . '\prevent_weak_password_auth', 30, 3 );

/**
 * Collection of weak passwords
 *
 * @return array
 */
function weak_passwords() {
	return array(
		'123456',
		'Password',
		'password',
		'12345678',
		'qwerty',
		'12345',
		'123456789',
		'letmein',
		'1234567',
		'football',
		'iloveyou',
		'admin',
		'welcome',
		'monkey',
		'login',
		'abc123',
		'starwars',
		'123123',
		'dragon',
		'passw0rd',
		'master',
		'hello',
		'freedom',
		'whatever',
		'qazwsx',
		'trustno1',
		'654321',
		'jordan23',
		'harley',
		'password1',
		'1234',
		'robert',
		'matthew',
		'jordan',
		'daniel',
	);
}
