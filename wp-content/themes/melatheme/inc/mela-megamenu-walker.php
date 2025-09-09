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

		$megamenu_content_id = get_post_meta( $item->ID, '_melatheme_megamenu_content_id', true );

		// Add column classes to the LI for depth 1.
		if ( $this->is_megamenu && $depth === 1 ) {
			$item->classes[] = 'col-md-4 col-lg-3 py-3';
		}

		// If a Mega Menu Content block is assigned, render it.
		if ( $this->is_megamenu && $depth === 1 && ! empty( $megamenu_content_id ) ) {
			$li_classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$li_class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $li_classes ), $item, $args, $depth ) );
			$output .= '<li class="' . esc_attr( $li_class_names ) . '">';

			$content_post = get_post( $megamenu_content_id );
			if ( $content_post ) {
				$prefix = '_melatheme_core_megamenu_';
				$content_type = get_post_meta( $content_post->ID, $prefix . 'content_type', true );
				$text_content = get_post_meta( $content_post->ID, $prefix . 'text_content', true );
				$image_id = get_post_meta( $content_post->ID, $prefix . 'image_id', true );
				$shortcode = get_post_meta( $content_post->ID, $prefix . 'shortcode', true );
                $hide_title   = get_post_meta( $item->ID, '_melatheme_hide_column_title', true );

				// Render column title from the menu item itself, if not hidden.
                if ( ! $hide_title ) {
                    $output .= '<h5 class="megamenu-column-title">' . esc_html( $item->title ) . '</h5>';
                }

				switch ( $content_type ) {
					case 'image':
						if ( $image_id ) {
							$output .= '<div class="megamenu-content-block megamenu-image-block">';
							$output .= wp_get_attachment_image( $image_id, 'medium_large', false, array( 'class' => 'img-fluid mb-3' ) );
							if ( ! empty( $text_content ) ) {
								$output .= '<div class="megamenu-image-text">' . apply_filters( 'the_content', $text_content ) . '</div>';
							}
							$output .= '</div>';
						}
						break;

					case 'shortcode':
						if ( ! empty( $shortcode ) ) {
							$output .= '<div class="megamenu-content-block megamenu-shortcode-block">';
							$output .= do_shortcode( $shortcode );
							$output .= '</div>';
						}
						break;

					case 'wysiwyg':
					default:
						if ( ! empty( $text_content ) ) {
							$output .= '<div class="megamenu-content-block megamenu-wysiwyg-block">';
							$output .= apply_filters( 'the_content', $text_content );
							$output .= '</div>';
						}
						break;
				}
			}
			// The `</li>` will be added by end_el.

		} elseif ( $this->is_megamenu && $depth === 1 && $args->has_children ) {
			// If it's a column header that has children (and no content block), render it as a non-linked title.
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
		$megamenu_content_id = get_post_meta( $item->ID, '_melatheme_megamenu_content_id', true );

		// Use a custom end element for our non-linked column headers and content blocks.
		if ( $this->is_megamenu && $depth === 1 && ( $args->has_children || ! empty( $megamenu_content_id ) ) ) {
			$output .= "</li>\n";
		} else {
			parent::end_el( $output, $item, $depth, $args );
		}
	}
}