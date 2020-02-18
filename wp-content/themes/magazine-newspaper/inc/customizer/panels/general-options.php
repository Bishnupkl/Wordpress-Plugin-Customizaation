<?php
/**
 * General Settings
 *
 * @package Magazine Newspaper
 */

add_action( 'customize_register', 'magazine_newspaper_customize_register_general_panel' );

function magazine_newspaper_customize_register_general_panel( $wp_customize ) {
	$wp_customize->add_panel( 'magazine_newspaper_general_panel', array(
	    'priority'    => 10,
	    'title'       => esc_html__( 'General Options', 'magazine-newspaper' ),
	    'description' => esc_html__( 'General Options', 'magazine-newspaper' ),
	) );
}