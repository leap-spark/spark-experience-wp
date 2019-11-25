<?php
/**
 * Plugin Name: Spark Experience
 * Plugin URI: https://leapsparkagency.com
 * Description: Enhance WordPress,the LEAP Spark way!
 * Version: 1.1.0
 * Author: LEAP Spark
 * Author URI: https://leapsparkagency.com
 * License: GPL2
 * Text Domain: leapspark
 * Domain Path: /languages/
 *
 * @package Spark_Experience
 **/

namespace Spark_Experience;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SPARK_EXPERIENCE_VERSION', '1.1.0' );

require_once __DIR__ . '/includes/cleanup.php';
require_once __DIR__ . '/includes/security.php';
require_once __DIR__ . '/includes/show-author.php';
require_once __DIR__ . '/includes/performance.php';
require_once __DIR__ . '/includes/show-template.php';
require_once __DIR__ . '/includes/customizer.php';
require_once __DIR__ . '/includes/whitelabel.php';
