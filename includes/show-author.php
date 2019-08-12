<?php
/**
 * Hide the author pages for any account that belongs to Leap Spark.
 *
 * @package Spark_Experience
 */

namespace Spark_Experience;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Check to see if author archive page should be disabled for 10up user accounts
 */
function maybe_disable_author_archive() {

	if ( ! is_author() ) {
		return;
	}

	$is_author_disabled = false;
	$author             = get_queried_object();
	$current_domain     = wp_parse_url( get_site_url(), PHP_URL_HOST );
	// Domain names that are whitelisted allowed to index 10up users to be indexed
	$whitelisted_domains = [];
	// Perform partial match on domains to catch subdomains or variation of domain name
	$filtered_domains = array_filter(
		$whitelisted_domains,
		function ( $domain ) use ( $current_domain ) {
			return false !== stripos( $current_domain, $domain );
		}
	);
	// If the query object doesn't have a user e-mail address
	if ( ! empty( $filtered_domains ) || empty( $author->data->user_email ) ) {
		return;
	}
	// E-mail addresses containing 10up.com (get10up.com inclusive) will be filtered out on the front-end
	if ( false !== stripos( $author->data->user_email, 'leapsparkagency.com' ) ) {
		$is_author_disabled = true;
	}
	if ( true === $is_author_disabled ) {
		\wp_safe_redirect( '/', '301' );
		exit();
	}
}

add_action( 'wp', __NAMESPACE__ . '\\maybe_disable_author_archive' );
