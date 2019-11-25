<?php

/**
 * Instant Page is a script that enables link pre-fetching. It makes the site feel faster and more responsive.
 *
 * @since 1.0.0
 */
function se_instant_page() {
	echo '<script src="//instant.page/3.0.0" type="module" defer integrity="sha384-OeDn4XE77tdHo8pGtE1apMPmAipjoxUQ++eeJa6EtJCfHlvijigWiJpD7VDPWXV1"></script>';
}
add_action( 'wp_footer', 'se_instant_page' );
