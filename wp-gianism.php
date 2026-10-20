<?php
/**
 * Plugin Name: Gianism
 * Plugin URI: https://wordpress.org/extend/plugins/gianism/
 * Description: Connect user accounts with major web services like Facebook, x, etc. Stand on the shoulders of giants!
 * Author: Hametuha
 * Version: nightly
 * Requires at least: 6.6
 * Requires PHP: 7.4
 * Author URI: https://hametuha.co.jp
 * Text Domain: gianism
 * Domain Path: /language/
 * License: GPL2 or Later
 */

/*
	Copyright 2010 Takahashi Fumiki (email : takahashi.fumiki@hametuha.co.jp)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Don't allow plugin to be loaded directory.
defined( 'ABSPATH' ) || die( 'Do not load directly.' );

// Get data from header.
$info = get_file_data(
	__FILE__,
	array(
		'version'     => 'Version',
		'php_version' => 'Requires PHP',
		'text_domain' => 'Text Domain',
	)
);

/**
 * Plugin version
 *
 * @const string
 */
define( 'GIANISM_VERSION', $info['version'] );

/**
 * Domain for i18n
 *
 * @const string
 */
define( 'GIANISM_DOMAIN', $info['text_domain'] );

/**
 * Gianism PHP Version
 *
 * @const string
 */
define( 'GIANISM_PHP_VERSION', $info['php_version'] );

// Add action after plugins are loaded.
add_action( 'plugins_loaded', 'gianism_setup_after_plugins_loaded', 11 );

// Use bundled translation as per-string fallback of language packs.
add_filter( 'override_load_textdomain', 'gianism_load_bundled_translation', 10, 4 );

/**
 * Load bundled translation after language pack.
 *
 * WordPress loads only one file per text domain, so a language pack hides
 * the bundled translation entirely. Load both and let the language pack win
 * (the first loaded file has priority), so strings missing in the pack still
 * get translated.
 *
 * @ignore
 * @param bool        $override Whether to override.
 * @param string      $domain   Text domain.
 * @param string      $mofile   Path to the file to load.
 * @param string|null $locale   Locale.
 * @return bool
 */
function gianism_load_bundled_translation( $override, $domain, $mofile, $locale = null ) {
	static $loading = false;
	if ( $override || $loading || 'gianism' !== $domain ) {
		return $override;
	}
	$bundled_dir = wp_normalize_path( __DIR__ . '/language' );
	if ( dirname( wp_normalize_path( $mofile ) ) === $bundled_dir ) {
		// This is bundled file itself.
		return $override;
	}
	$bundled = sprintf( '%s/gianism-%s.mo', $bundled_dir, $locale ? $locale : determine_locale() );
	if ( ! is_readable( $bundled ) ) {
		return $override;
	}
	$loading = true;
	$loaded  = load_textdomain( $domain, $mofile, $locale );
	$loaded  = load_textdomain( $domain, $bundled, $locale ) || $loaded;
	$loading = false;
	return $loaded;
}

/**
 * Start plugin
 *
 * @ignore
 */
function gianism_setup_after_plugins_loaded() {
	// Add i18n for here for other plugins.
	load_plugin_textdomain( 'gianism', false, basename( __DIR__ ) . '/language' );
	// Check PHP version.
	try {
		if ( ! version_compare( phpversion(), GIANISM_PHP_VERSION, '>=' ) ) {
			// translators: %1$s is required PHP version, %2$s is current PHP version.
			throw new Exception( sprintf( __( '[Gianism] PHP <code>%1$s</code> is required, but your version is <code>%2$s</code>. So this plugin is still in silence. Please contact server administrator.', 'gianism' ), GIANISM_PHP_VERSION, phpversion() ) );
		}
		// Load composer.
		$auto_loader = __DIR__ . '/vendor/autoload.php';
		if ( ! file_exists( $auto_loader ) ) {
			// translators: %s is file path, %2$s is composer command.
			throw new Exception( sprintf( esc_html( __( '[Gianism] missing composer\'s auto loader at %1$s. Did you run %2$s?', 'gianism' ) ), __DIR__ . '/vendor/autoload.php', '<code>composer install</code>' ) );
		}
		// Load auto loader.
		require $auto_loader;
		// Avoiding syntax error, call Bootstrap.
		if ( ! class_exists( 'Gianism\\Bootstrap' ) ) {
			throw new Exception( esc_html__( '[Gianism] Bootstrap file not found.', 'gianism' ) );
		}
		// Load functions.
		require __DIR__ . '/functions.php';
		// Load all functions and hooks.
		foreach ( array( 'functions', 'hooks' ) as $dir ) {
			$dir_path = __DIR__ . '/' . $dir;
			if ( ! is_dir( $dir_path ) ) {
				continue;
			}
			foreach ( scandir( $dir_path ) as $file ) {
				if ( preg_match( '#^[^._].*\.php$#u', $file ) ) {
					require $dir_path . '/' . $file;
				}
			}
		}
		// Can skip deprecated functions(for debugging)
		if ( defined( 'GIANISM_SKIP_DEPRECATED' ) ) {
			require __DIR__ . '/functions-deprecated.php';
		}
		// Call bootstrap.
		call_user_func( array( 'Gianism\\Bootstrap', 'init' ) );
	} catch ( Exception $e ) {
		gianism_internal_error( $e->getMessage() );
		add_action( 'admin_notices', 'gianism_internal_notice' );
	} // End try().
}

/**
 * Display admin error message.
 *
 * @since 3.1.0
 * @ignore
 */
function gianism_internal_notice() {
	printf( '<div class="error"><p>%s</p></div>', esc_html( gianism_internal_error() ) );
}

/**
 * Error message holder.
 *
 * @since 3.1.0
 * @ignore
 * @param string $message Message string which will be saved if not empty.
 * @return string
 */
function gianism_internal_error( $message = '' ) {
	static $store = '';
	if ( $message ) {
		$store = $message;
	}
	return $store;
}

/**
 * Get root directory.
 *
 * @since 4.2.0
 * @return string
 */
function gianism_root_dir() {
	return __DIR__;
}
