<?php
/**
 * Film Africa Theme Theme Customizer
 *
 * @package Film_Africa_Theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function film_africa_wp_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'film_africa_wp_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'film_africa_wp_customize_partial_blogdescription',
			)
		);
	}

    //theme dark logo
    $wp_customize->add_setting('theme_dark_logo');
    $wp_customize->add_control(new \WP_Customize_Image_Control($wp_customize, 'theme_dark_logo',
        array(
            'label' => 'Upload Dark Logo',
            'section' => 'title_tagline',
            'settings' => 'theme_dark_logo',
        )
    ));
}
add_action( 'customize_register', 'film_africa_wp_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function film_africa_wp_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function film_africa_wp_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function film_africa_wp_customize_preview_js() {
	wp_enqueue_script( 'film-africa-wp-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'film_africa_wp_customize_preview_js' );
