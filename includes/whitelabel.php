<?php
/**
 * White label WordPress a little bit.
 *
 * @package Spark_Experience
 */

namespace Spark_Experience;

/**
 * Execute white label stuff.
 */
function white_label() {
	// Hide the WordPress logo from the admin bar
	add_action(
		'wp_before_admin_bar_render',
		function () {
			global $wp_admin_bar;
			$wp_admin_bar->remove_menu( 'wp-logo' );
		}
	);

	// Change WordPress login page logo link
	add_filter(
		'login_headertext',
		function () {
			return 'https://leapsparkagency.com';
		}
	);

	// Remove WordPress link from admin footer
	add_filter(
		'admin_footer_text',
		function () {
			return '';
		}
	);

	// Change the look and feel of the login page
	add_action(
		'login_head',
		function () {
			?>
		<style type="text/css">
			body {
				background: #fff;
			}

			.login form {
				background: #f8cb16;
			}

			.login form label {
				color: #101010;
			}

			.login h1 a {
				background-image: url(
				<?php
				echo esc_url( plugins_url( '/assets/img/leap-spark-logo.jpg', dirname( __FILE__ ) ) );
				?>
				);
				background-size: 250px;
				margin: 0 auto;
				height: 50px;
				width: 320px;
			}

			.wp-core-ui .button-primary {
				background: #26d77f;
				border-color: #0fb060;
			}

			.wp-core-ui .button-primary:hover {
				background: #0fb060;
				border-color: #0fb060;
			}
		</style>
			<?php
		}
	);
}

white_label();
