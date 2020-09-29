<?php
/**
 * Site Identity Settings
 *
 * @package Magazine Newspaper
 */


add_action( 'customize_register', 'magazine_newspaper_change_site_identity_panel' );

function magazine_newspaper_change_site_identity_panel( $wp_customize)  {
    $wp_customize->get_section( 'title_tagline' )->priority = 3;
    $wp_customize->get_section( 'title_tagline' )->panel = 'magazine_newspaper_header_panel';

    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}