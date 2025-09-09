<?php
/**
 * Main Plugin Class
 *
 * @package MelaTheme Core
 * @subpackage Core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class MelaTheme_Core_Plugin {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->includes();
		$this->hooks();
	}

	/**
	 * Include necessary files.
	 */
	private function includes() {
		// Core includes.
		require_once MELATHEME_CORE_BASE_DIR . '/includes/core/helpers.php';

		// Module includes.
		require_once MELATHEME_CORE_BASE_DIR . '/includes/modules/megamenu/cpt.php';
		require_once MELATHEME_CORE_BASE_DIR . '/includes/modules/megamenu/metaboxes.php';
		require_once MELATHEME_CORE_BASE_DIR . '/includes/modules/megamenu/admin-menu-fields.php';
		require_once MELATHEME_CORE_BASE_DIR . '/includes/modules/megamenu/hooks.php';
	}

	/**
	 * Setup hooks.
	 */
	private function hooks() {
		// Enqueue admin styles.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		// Enqueue admin scripts.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
	}

	/**
	 * Enqueue admin styles.
	 */	public function enqueue_admin_styles() {
		wp_enqueue_style(
			'melatheme-core-admin-styles',
			MELATHEME_CORE_BASE_URL . 'assets/css/admin.css',
			array(),
			MELATHEME_CORE_VERSION
		);
	}

	/**
	 * Enqueue admin scripts.
	 */
	public function enqueue_admin_scripts() {
		wp_enqueue_script(
			'melatheme-core-admin-megamenu',
			MELATHEME_CORE_BASE_URL . 'assets/js/admin-megamenu.js',
			array( 'jquery' ), // Dependency on jQuery
			MELATHEME_CORE_VERSION,
			true // Enqueue in the footer
		);
	}
}