<?php
/**
 * Register Mega Menu Content Custom Post Type
 *
 * @package MelaTheme Core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register the Mega Menu Content CPT.
 */
function melatheme_core_register_megamenu_cpt() {
	$labels = array(
		'name'                  => _x( 'Mega Menu Content', 'Post Type General Name', 'melatheme-core' ),
		'singular_name'         => _x( 'Mega Menu Content', 'Post Type Singular Name', 'melatheme-core' ),
		'menu_name'             => __( 'Mega Menu Content', 'melatheme-core' ),
		'archives'              => __( 'Content Archives', 'melatheme-core' ),
		'attributes'            => __( 'Content Attributes', 'melatheme-core' ),
		'parent_item_colon'     => __( 'Parent Content:', 'melatheme-core' ),
		'all_items'             => __( 'All Mega Menu Content', 'melatheme-core' ),
		'add_new_item'          => __( 'Add New Mega Menu Content', 'melatheme-core' ),
		'add_new'               => __( 'Add New', 'melatheme-core' ),
		'new_item'              => __( 'New Content', 'melatheme-core' ),
		'edit_item'             => __( 'Edit Content', 'melatheme-core' ),
		'update_item'           => __( 'Update Content', 'melatheme-core' ),
		'view_item'             => __( 'View Content', 'melatheme-core' ),
		'view_items'            => __( 'View Contents', 'melatheme-core' ),
		'search_items'          => __( 'Search Content', 'melatheme-core' ),
		'not_found'             => __( 'Not found', 'melatheme-core' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'melatheme-core' ),
		'featured_image'        => __( 'Featured Image', 'melatheme-core' ),
		'set_featured_image'    => __( 'Set featured image', 'melatheme-core' ),
		'remove_featured_image' => __( 'Remove featured image', 'melatheme-core' ),
		'use_featured_image'    => __( 'Use as featured image', 'melatheme-core' ),
		'insert_into_item'      => __( 'Insert into content', 'melatheme-core' ),
		'uploaded_to_this_item' => __( 'Uploaded to this content', 'melatheme-core' ),
		'items_list'            => __( 'Contents list', 'melatheme-core' ),
		'items_list_navigation' => __( 'Contents list navigation', 'melatheme-core' ),
		'filter_items_list'     => __( 'Filter contents list', 'melatheme-core' ),
	);
	$args   = array(
		'label'               => __( 'Mega Menu Content', 'melatheme-core' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'revisions' ),
		'hierarchical'        => false,
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 25,
		'menu_icon'           => 'dashicons-list-view',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'capability_type'     => 'post',
		'show_in_rest'        => true,
	);
	register_post_type( 'megamenu_content', $args );
}
add_action( 'init', 'melatheme_core_register_megamenu_cpt', 0 );

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
			'desc' => __( 'Enter a shortcode.', 'melatheme-core' ),
			'id'   => $prefix . 'shortcode',
			'type' => 'text',
            'attributes'  => array(
                'data-conditional-id'    => $prefix . 'content_type',
                'data-conditional-value' => 'shortcode',
            ),
		)
	);
}
add_action( 'cmb2_admin_init', 'melatheme_core_megamenu_metaboxes' );
