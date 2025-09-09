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
/**
 * Load Plugin Constants
 */
require_once __DIR__ . '/constants.php';

/**
 * Load CMB2
 */
require_once MELATHEME_CORE_BASE_DIR . '/vendor/cmb2/init.php';


// Include the Mega Menu Content CPT registration.
require_once MELATHEME_CORE_BASE_DIR . '/cpt-megamenu-content.php';

// Include the Nav Menu Custom Fields.
require_once MELATHEME_CORE_BASE_DIR . '/nav-menu-custom-fields.php';


