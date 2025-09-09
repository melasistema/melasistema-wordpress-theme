<?php
/**
 * Mega Menu Content CMB2 Metaboxes
 *
 * @package MelaTheme Core
 * @subpackage MegaMenu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define the metabox and fields for the Mega Menu Content CPT.
 */
function melatheme_core_megamenu_metaboxes() {
	$prefix = '_melatheme_core_megamenu_';

	$cmb = new_cmb2_box(
		array(
			'id'           => $prefix . 'content_options',
			'title'        => __( 'Mega Menu Content Options', 'melatheme-core' ),
			'object_types' => array( 'megamenu_content' ),
			'context'      => 'normal',
			'priority'     => 'high',
			'show_names'   => true,
		)
	);

	$cmb->add_field(
		array(
			'name'    => __( 'Content Type', 'melatheme-core' ),
			'desc'    => __( 'Select the type of content to display.', 'melatheme-core' ),
			'id'      => $prefix . 'content_type',
			'type'    => 'select',
			'options' => array(
				'wysiwyg'   => __( 'WYSIWYG Editor', 'melatheme-core' ),
				'shortcode' => __( 'Shortcode', 'melatheme-core' ),
				'image'     => __( 'Image with Text', 'melatheme-core' ),
			),
			'default' => 'wysiwyg',
		)
	);

	$cmb->add_field(
		array(
			'name' => __( 'Image Cover', 'melatheme-core' ),
			'desc' => __( 'Upload an image.', 'melatheme-core' ),
			'id'   => $prefix . 'image',
			'type' => 'file',
            'options' => array(
                'url' => false, // Hide the text input for the url
            ),
            'attributes'  => array(
                'data-conditional-id'    => $prefix . 'content_type',
                'data-conditional-value' => 'image',
            ),
		)
	);

	$cmb->add_field(
		array(
			'name'    => __( 'Text Content', 'melatheme-core' ),
			'desc'    => __( 'Enter the text content.', 'melatheme-core' ),
			'id'      => $prefix . 'text_content',
			'type'    => 'wysiwyg',
			'options' => array(
				'textarea_rows' => 7,
			),
            'attributes'  => array(
                'data-conditional-id'    => $prefix . 'content_type',
                'data-conditional-value' => wp_json_encode( array( 'wysiwyg', 'image' ) ),
            ),
		)
	);

	$cmb->add_field(
		array(
			'name' => __( 'Shortcode', 'melatheme-core' ),
			'desc' => __( 'Enter a shortcode.', 'melatheme-core' ), 'id'   => $prefix . 'shortcode',
			'type' => 'text',
            'attributes'  => array(
                'data-conditional-id'    => $prefix . 'content_type',
                'data-conditional-value' => 'shortcode',
            ),
		)
	);
}
add_action( 'cmb2_admin_init', 'melatheme_core_megamenu_metaboxes' );
