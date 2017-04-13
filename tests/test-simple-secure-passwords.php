<?php
/**
 * Test_Simple_Secure_Passwords
 *
 * @package SimpleSecurePasswords
 */

namespace SimpleSecurePasswords;

/**
 * Class Test_Simple_Secure_Passwords
 *
 * @package SimpleSecurePasswords
 */
class Test_Simple_Secure_Passwords extends \WP_UnitTestCase {

	/**
	 * Test _simple_secure_passwords_php_version_error().
	 *
	 * @see _simple_secure_passwords_php_version_error()
	 */
	public function test_simple_secure_passwords_php_version_error() {
		ob_start();
		_simple_secure_passwords_php_version_error();
		$buffer = ob_get_clean();
		$this->assertContains( '<div class="error">', $buffer );
	}

	/**
	 * Test _simple_secure_passwords_php_version_text().
	 *
	 * @see _simple_secure_passwords_php_version_text()
	 */
	public function test_simple_secure_passwords_php_version_text() {
		$this->assertContains( 'Simple Secure Passwords plugin error:', _simple_secure_passwords_php_version_text() );
	}
}
