<?php

// if add_filter does not exist, too early, die.
if ( ! function_exists( 'add_filter' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	die;
}

/**
 * If the wp_check_password, wp_hash_password, and wp_set_password
 * functions are not already registered, override them.
 */
if ( ! function_exists( 'wp_check_password' )
     && ! function_exists( 'wp_hash_password' )
     && ! function_exists( 'wp_set_password' )
) {

	define( 'WP_OLD_HASH_PREFIX', '$P$' );

	/**
	 * Check if the user has entered the correct password
	 *
	 * password_hash https://secure.php.net/manual/en/function.password-hash.php
	 * wp_hash_password https://codex.wordpress.org/Function_Reference/wp_hash_password
	 *
	 * @param $password
	 * @param $hash
	 * @param string $user_id
	 *
	 * @return mixed|void
	 */
	function wp_check_password( $password, $hash, $user_id = '' ) {

		if ( strpos( $hash, WP_OLD_HASH_PREFIX ) === 0 ) {
			global $wp_hasher;

			/**
			 * If no $wp_hasher, create it.
			 */
			if ( empty( $wp_hasher ) ) {
				require_once( ABSPATH . WPINC . '/class-phpass.php' );
				$wp_hasher = new PasswordHash( 8, true );
			}

			// Do the check now that we have what we need.
			$check = $wp_hasher->CheckPassword( $password, $hash );

			// if check returns true, and if we have the user id, set new password.
			if ( $check && $user_id ) {
				$hash = wp_set_password( $password, $user_id );
			}
		}

		$check = password_verify( $password, $hash );

		return apply_filters( 'check_password', $check, $password, $hash, $user_id );
	}

	/**
	 * Hash the WordPress Password
	 *
	 * password_hash https://secure.php.net/manual/en/function.password-hash.php
	 * wp_hash_password https://codex.wordpress.org/Function_Reference/wp_hash_password
	 *
	 * @param $password
	 *
	 * @return bool|string
	 */
	function wp_hash_password( $password ) {
		$hash_options = apply_filters( 'wp_hash_password_options', [] );

		return password_hash( $password, PASSWORD_DEFAULT, $hash_options );
	}

	/**
	 * Set the WordPress Hashed Password for current user
	 * https://codex.wordpress.org/Function_Reference/wp_set_password
	 *
	 * @param $password
	 * @param $user_id
	 *
	 * @return bool|string
	 */
	function wp_set_password( $password, $user_id ) {
		global $wpdb;

		$hash = wp_hash_password( $password );
		$wpdb->update( $wpdb->users, [ 'user_pass' => $hash, 'user_activation_key' => '' ], [ 'ID' => $user_id ] );
		wp_cache_delete( $user_id, 'users' );

		return $hash;
	}
}

