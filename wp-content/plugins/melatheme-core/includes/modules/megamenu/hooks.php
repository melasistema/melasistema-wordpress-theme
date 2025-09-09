<?php
/**
 * Mega Menu Module Hooks
 *
 * @package MelaTheme Core
 * @subpackage MegaMenu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'wp_nav_menu_item_custom_fields', 'melatheme_core_add_custom_fields_to_menu_items', 10, 4 );
add_action( 'wp_update_nav_menu_item', 'melatheme_core_save_custom_menu_item_fields', 10, 3 );
