<?php
/**
 * Header Image Settings
 *
 * @package Magazine Newspaper
 */


add_action( 'customize_register', 'magazine_newspaper_change_header_image_panel' );

function magazine_newspaper_change_header_image_panel( $wp_customize)  {
    $wp_customize->get_section( 'header_image' )->priority = 1;
    $wp_customize->get_section( 'header_image' )->panel = 'magazine_newspaper_header_panel';
}