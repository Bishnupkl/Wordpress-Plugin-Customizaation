<?php
/**
 * Header Settings
 *
 * @package Magazine Newspaper
 */

add_action( 'customize_register', 'magazine_newspaper_customize_register_header_panel' );

function magazine_newspaper_customize_register_header_panel( $wp_customize ) {
	$wp_customize->add_panel( 'magazine_newspaper_header_panel', array(
	    'priority'    => 11,
	    'title'       => esc_html__( 'Header Options', 'magazine-newspaper' ),
	    'description' => esc_html__( 'Header Options', 'magazine-newspaper' ),
	) );
}