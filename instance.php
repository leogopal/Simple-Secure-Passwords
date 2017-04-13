<?php
/**
 * Instantiates the Simple Secure Passwords plugin
 *
 * @package SimpleSecurePasswords
 */

namespace SimpleSecurePasswords;

global $simple_secure_passwords_plugin;

require_once __DIR__ . '/php/class-simple-secure-passwords-base.php';
require_once __DIR__ . '/php/class-simple-secure-passwords.php';
require_once __DIR__ . '/php/bcrypt-wp-overrides.php';

$simple_secure_passwords_plugin = new Simple_Secure_Passwords();

/**
 * Simple Secure Passwords Plugin Instance
 *
 * @return Simple_Secure_Passwords
 */
function get_plugin_instance() {
	global $simple_secure_passwords_plugin;
	return $simple_secure_passwords_plugin;
}
