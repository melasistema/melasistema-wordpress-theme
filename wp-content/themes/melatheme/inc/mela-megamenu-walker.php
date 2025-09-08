<?php
/**
 * A custom WordPress nav walker for MelaTheme to implement a Bootstrap 5 megamenu.
 *
 * @package MelaTheme
 * @since '0.0.1'
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Mela_Megamenu_Nav_Walker class.
 */
class Mela_Megamenu_Nav_Walker extends Understrap_WP_Bootstrap_Navwalker {
	/**
	 * Is megamenu.
	 *
	 * @var bool
	 */
	private $is_megamenu = false;

	/**
	 * Start level.
	 *
	 * @param string $output Output.
	 * @param int    $depth  Depth.
	 * @param array  $args   Args.
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		if ( $depth === 0 && $this->is_megamenu ) {
			$output .= '<ul class="dropdown-menu megamenu-container"><div class="container-fluid"><div class="row">';
		} elseif ( $this->is_megamenu && $depth === 1 ) {
			// Create a simple list for the links inside a column.
			$output .= '<ul class="list-unstyled megamenu-column-links">';
		} else {
			parent::start_lvl( $output, $depth, $args );
		}
	}

	/**
	 * End level.
	 *
	 * @param string $output Output.
	 * @param int    $depth  Depth.
	 */
	public function end_lvl( &$output, $depth = 0, $args = null ) {
		if ( $depth === 0 && $this->is_megamenu ) {
			$output .= '</div></div></ul>';
			$this->is_megamenu = false;
		} elseif ( $this->is_megamenu && $depth === 1 ) {
			$output .= '</ul>';
		} else {
			parent::end_lvl( $output, $depth, $args );
		}
	}

	/**
	 * Start element.
	 *
	 * @param string $output Output.
	 * @param object $item   Item.
	 * @param int    $depth  Depth.
	 * @param array  $args   Args.
	 * @param int    $id     ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		if ( $depth === 0 ) {
			$this->is_megamenu = in_array( 'megamenu', $item->classes );
		}

		// Add column classes to the LI for depth 1.
		if ( $this->is_megamenu && $depth === 1 ) {
			$item->classes[] = 'col-md-4 col-lg-3 py-3';
		}

		// If it's a column header that has children, render it as a non-linked title.
		if ( $this->is_megamenu && $depth === 1 && $args->has_children ) {
			$li_classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$li_class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $li_classes ), $item, $args, $depth ) );
			$output .= '<li class="' . esc_attr( $li_class_names ) . '">';
			$output .= '<h5 class="megamenu-column-title">' . esc_html( $item->title ) . '</h5>';
			// The `<ul>` for the children will be added by start_lvl.
		} else {
			// For all other items (top-level, links, or columns without children), use the parent walker.
			parent::start_el( $output, $item, $depth, $args, $id );
		}
	}

	/**
	 * End element.
	 *
	 * @param string $output Output.
	 * @param object $item   Item.
	 * @param int    $depth  Depth.
	 * @param array  $args   Args.
	 */
	public function end_el( &$output, $item, $depth = 0, $args = null ) {
		// Use a custom end element for our non-linked column headers.
		if ( $this->is_megamenu && $depth === 1 && $args->has_children ) {
			$output .= "</li>\n";
		} else {
			parent::end_el( $output, $item, $depth, $args );
		}
	}
}
