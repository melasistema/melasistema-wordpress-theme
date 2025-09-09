<?php
/**
 * MelaTheme Customizer functionality
 *
 * @package MelaTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function melatheme_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	// Add custom sections, settings, and controls here.

	// Theme Colors Section
	$wp_customize->add_section( 'melatheme_colors_section', array(
		'title'    => __( 'Theme Colors', 'melatheme' ),
		'priority' => 10,
	) );

	// Primary Color
	$wp_customize->add_setting( 'melatheme_primary_color', array(
		'default'           => '#007bff', // Bootstrap primary blue
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'melatheme_primary_color', array(
		'label'    => __( 'Primary Color', 'melatheme' ),
		'section'  => 'melatheme_colors_section',
	) ) );

	// Secondary Color
	$wp_customize->add_setting( 'melatheme_secondary_color', array(
		'default'           => '#6c757d', // Bootstrap secondary gray
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'melatheme_secondary_color', array(
		'label'    => __( 'Secondary Color', 'melatheme' ),
		'section'  => 'melatheme_colors_section',
	) ) );

	// Extra Color (Accent)
	$wp_customize->add_setting( 'melatheme_extra_color', array(
		'default'           => '#28a745', // Bootstrap success green
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'melatheme_extra_color', array(
		'label'    => __( 'Accent Color', 'melatheme' ),
		'section'  => 'melatheme_colors_section',
	) ) );

	// Navbar Colors Section
	$wp_customize->add_section( 'melatheme_navbar_colors_section', array(
		'title'    => __( 'Navbar Colors', 'melatheme' ),
		'priority' => 15, // Between Theme Colors (10) and Typography (20)
	) );

	// Navbar Background Color
	$wp_customize->add_setting( 'melatheme_navbar_background_color', array(
		'default'           => '#343a40', // Bootstrap dark gray
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'melatheme_navbar_background_color', array(
		'label'    => __( 'Navbar Background Color', 'melatheme' ),
		'section'  => 'melatheme_navbar_colors_section',
	) ) );

	// Navbar Link Color
	$wp_customize->add_setting( 'melatheme_navbar_link_color', array(
		'default'           => '#ffffff', // White
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'melatheme_navbar_link_color', array(
		'label'    => __( 'Navbar Link Color', 'melatheme' ),
		'section'  => 'melatheme_navbar_colors_section',
	) ) );

	// Navbar Link Hover Color
	$wp_customize->add_setting( 'melatheme_navbar_link_hover_color', array(
		'default'           => '#cccccc', // Light gray
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'melatheme_navbar_link_hover_color', array(
		'label'    => __( 'Navbar Link Hover Color', 'melatheme' ),
		'section'  => 'melatheme_navbar_colors_section',
	) ) );

	// Mega Menu Colors Section
	$wp_customize->add_section( 'melatheme_megamenu_colors_section', array(
		'title'    => __( 'Mega Menu Colors', 'melatheme' ),
		'priority' => 16, // After Navbar Colors (15)
	) );

	// Mega Menu Background Color
	$wp_customize->add_setting( 'melatheme_megamenu_background_color', array(
		'default'           => '#ffffff', // White
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'melatheme_megamenu_background_color', array(
		'label'    => __( 'Mega Menu Background Color', 'melatheme' ),
		'section'  => 'melatheme_megamenu_colors_section',
	) ) );

	// Mega Menu Text Color
	$wp_customize->add_setting( 'melatheme_megamenu_text_color', array(
		'default'           => '#333333', // Dark gray
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'melatheme_megamenu_text_color', array(
		'label'    => __( 'Mega Menu Text Color', 'melatheme' ),
		'section'  => 'melatheme_megamenu_colors_section',
	) ) );

	

	// Theme Typography Section
	$wp_customize->add_section( 'melatheme_typography_section', array(
		'title'    => __( 'Theme Typography', 'melatheme' ),
		'priority' => 20,
	) );

	// Font choices
	$font_choices = array(
		'Arial, sans-serif'             => 'Arial',
		'Helvetica, sans-serif'         => 'Helvetica',
		'Times New Roman, serif'    => 'Times New Roman',
		'Georgia, serif'                => 'Georgia',
		'Verdana, sans-serif'           => 'Verdana',
		'Courier New, monospace'    => 'Courier New',
		'Lucida Console, monospace' => 'Lucida Console',
		'Open Sans, sans-serif'     => 'Open Sans (Web Safe)', // Common web font
		'Roboto, sans-serif'            => 'Roboto (Web Safe)',    // Common web font
	);

	// Overall Font
	$wp_customize->add_setting( 'melatheme_base_font', array(
		'default'           => 'Arial, sans-serif',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'melatheme_base_font', array(
		'label'    => __( 'Overall Base Font', 'melatheme' ),
		'section'  => 'melatheme_typography_section',
		'type'     => 'select',
		'choices'  => $font_choices,
	) );

	// H1 Font
	$wp_customize->add_setting( 'melatheme_h1_font', array(
		'default'           => 'Arial, sans-serif',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'melatheme_h1_font', array(
		'label'    => __( 'H1 Heading Font', 'melatheme' ),
		'section'  => 'melatheme_typography_section',
		'type'     => 'select',
		'choices'  => $font_choices,
	) );

	// H2 Font
	$wp_customize->add_setting( 'melatheme_h2_font', array(
		'default'           => 'Arial, sans-serif',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'melatheme_h2_font', array(
		'label'    => __( 'H2 Heading Font', 'melatheme' ),
		'section'  => 'melatheme_typography_section',
		'type'     => 'select',
		'choices'  => $font_choices,
	) );

	// H3 Font
	$wp_customize->add_setting( 'melatheme_h3_font', array(
		'default'           => 'Arial, sans-serif',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'melatheme_h3_font', array(
		'label'    => __( 'H3 Heading Font', 'melatheme' ),
		'section'  => 'melatheme_typography_section',
		'type'     => 'select',
		'choices'  => $font_choices,
	) );

	// Paragraph Font
	$wp_customize->add_setting( 'melatheme_p_font', array(
		'default'           => 'Arial, sans-serif',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'melatheme_p_font', array(
		'label'    => __( 'Paragraph Font', 'melatheme' ),
		'section'  => 'melatheme_typography_section',
		'type'     => 'select',
		'choices'  => $font_choices,
	) );

}

/**
 * Output custom CSS to the frontend.
 */
function melatheme_customizer_css() {
	?>
	<style type="text/css">
		/* Colors */
		:root {
			--melatheme-primary-color: <?php echo get_theme_mod( 'melatheme_primary_color', '#007bff' ); ?>;
			--melatheme-secondary-color: <?php echo get_theme_mod( 'melatheme_secondary_color', '#6c757d' ); ?>;
			--melatheme-extra-color: <?php echo get_theme_mod( 'melatheme_extra_color', '#28a745' ); ?>;
			--melatheme-navbar-background-color: <?php echo get_theme_mod( 'melatheme_navbar_background_color', '#343a40' ); ?>;
			--melatheme-navbar-link-color: <?php echo get_theme_mod( 'melatheme_navbar_link_color', '#ffffff' ); ?>;
			--melatheme-navbar-link-hover-color: <?php echo get_theme_mod( 'melatheme_navbar_link_hover_color', '#cccccc' ); ?>;
			--melatheme-megamenu-background-color: <?php echo get_theme_mod( 'melatheme_megamenu_background_color', '#ffffff' ); ?>;
			--melatheme-megamenu-text-color: <?php echo get_theme_mod( 'melatheme_megamenu_text_color', '#333333' ); ?>;
			
		}

		/* Typography */
		body {
			font-family: <?php echo get_theme_mod( 'melatheme_base_font', 'Arial, sans-serif' ); ?>;
		}
		h1 {
			font-family: <?php echo get_theme_mod( 'melatheme_h1_font', 'Arial, sans-serif' ); ?>;
		}
		h2 {
			font-family: <?php echo get_theme_mod( 'melatheme_h2_font', 'Arial, sans-serif' ); ?>;
		}
		h3 {
			font-family: <?php echo get_theme_mod( 'melatheme_h3_font', 'Arial, sans-serif' ); ?>;
		}
		p {
			font-family: <?php echo get_theme_mod( 'melatheme_p_font', 'Arial, sans-serif' ); ?>;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'melatheme_customizer_css' );

add_action( 'customize_register', 'melatheme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function melatheme_customize_preview_js() {
	wp_enqueue_script( 'melatheme-customizer', get_template_directory_uri() . '/inc/customizer.js', array( 'customize-preview' ), wp_get_theme()->get( 'Version' ), true );
}
add_action( 'customize_preview_init', 'melatheme_customize_preview_js' );
