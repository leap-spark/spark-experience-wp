<?php
/**
 * Author: JOTAKI Taisuke
 * Version: 0.3.0
 *
 * License:
 * Released under the GPL license
 * http://www.gnu.org/copyleft/gpl.html
 *
 * Copyright 2013 (email : tekapo@gmail.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package Spark_Experience
 */

namespace Spark_Experience;

use WP_Admin_Bar;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Show the template name in the admin bar area.
 *
 * @param WP_Admin_Bar $wp_admin_bar The WordPress admin bar instance.
 */
function show_template_file_name_on_top( WP_Admin_Bar $wp_admin_bar ) {

	if ( is_admin() || ! is_super_admin() ) {
		return;
	}

	global $template;

	$template_file_name     = basename( $template );
	$template_relative_path = str_replace( ABSPATH . 'wp-content/', '', $template );

	$current_theme = wp_get_theme();
	// phpcs:disable
	$current_theme_name = $current_theme->Name;
	// phpcs:enable
	$parent_or_child = __( 'Theme name: ', 'show-current-template' ) . $current_theme_name . ' (' . __( 'NOT a child theme', 'show-current-template' ) . ')';

	$included_files = get_included_files();

	sort( $included_files );
	$included_files_list = '';

	foreach ( $included_files as $filename ) {
		if ( strstr( $filename, 'themes' ) ) {
			$filepath = strstr( $filename, 'themes' );
			if ( $template_relative_path === $filepath ) {
				$included_files_list .= '';
			} else {
				$included_files_list .= '<li>' . "{$filepath}" . '</li>';
			}
		}
	}

	$args = array(
		'id'    => 'show_template_file_name_on_top',
		'title' => __( 'Template:', 'show-current-template' ) . '<span class="show-template-name"> ' . $template_file_name . '</span>',
		'meta'  => array(
			'class' => 'show-template--adminbar',
		),
	);

	$wp_admin_bar->add_node( $args );
}

add_action( 'admin_bar_menu', __NAMESPACE__ . '\\show_template_file_name_on_top', 9999 );
