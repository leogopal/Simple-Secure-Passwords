<?php
/**
 * Plugin Name: Simple Secure Passwords
 * Plugin URI: https://github.com/leogopal/simple-secure-passwords
 * Description: Secure your WordPress Passwords Simply with bcrypt and other Simple Secure Passwords add-ons.
 * Version: 0.1
 * Author:  Leo Gopal
 * Author URI: https://xwp.co/
 * License: GPLv2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: simple-secure-passwords
 * Domain Path: /languages
 *
 * Copyright (c) 2016 XWP (https://xwp.co/)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
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
 * @package SimpleSecurePasswords
 */

// If this file is called directly, you're in trouble.
if ( ! defined( 'WPINC' ) ) {
	_e( "You have come to the wrong place, move along now.", 'simple-secure-passwords' );
	die;
}

// autoloader
require __DIR__ . '/vendor/autoload.php';

/**
 * Check required PHP version before starting up.
 */
$needs_php_version = new WPUpdatePhp( '5.6.0' );
if ( $needs_php_version->does_it_meet_required_php_version( PHP_VERSION ) ) {
	// Run plugin
	require_once __DIR__ . '/instance.php';
}