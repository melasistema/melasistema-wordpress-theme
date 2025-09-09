<?php

/**
 * Plugin Name: MelaTheme Core
 * Plugin URI: https://github.com/melasistema
 * Description: This is the core companion plugin for the `melatheme` underscore child theme. It is designed to contain all the essential business logic, custom functionalities, and data management features that power the theme.
 * Version: 0.0.1
 * Author: Luca Visciola
 * Author URI: https://github.com/melasistema
 * Text Domain: melatheme-core
 * Domain Path: /language
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define plugin version.


/**
 * Load Plugin Constants
 */
require_once __DIR__ . '/constants.php';

/**
 * Load CMB2
 */
if ( is_admin() ) {
	require_once MELATHEME_CORE_BASE_DIR . '/vendor/cmb2/init.php';
}

/**
 * Load the main plugin class.
 */
require_once MELATHEME_CORE_BASE_DIR . '/includes/core/class-melatheme-core-plugin.php';

/**
 * Instantiate the plugin.
 */
function melatheme_core_run() {
	new MelaTheme_Core_Plugin();
}
add_action( 'plugins_loaded', 'melatheme_core_run' );