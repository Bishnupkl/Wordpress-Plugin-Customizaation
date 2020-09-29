<?php
/**
 * Recommended Trips Settings
 *
 * @package Magazine Newspaper
 */


add_action( 'customize_register', 'magazine_newspaper_customize_register_banner_section' );
function magazine_newspaper_customize_register_banner_section( $wp_customize ) {
    
	$wp_customize->add_section( 'magazine_newspaper_banner_sections', array(
	    'title'          => esc_html__( 'Banner News', 'magazine-newspaper' ),
	    'description'    => esc_html__( 'Banner News :', 'magazine-newspaper' ),
	    'panel'          => 'magazine_newspaper_theme_options_panel',
	    'priority'       => 2,
	) );

    $wp_customize->add_setting( 'banner_display_option', array(
        'capability'  => 'edit_theme_options',
        'sanitize_callback'     =>  'magazine_newspaper_sanitize_checkbox',
        'default'               =>  false
    ) );

    $wp_customize->add_control( new Magazine_Newspaper_Toggle_Control( $wp_customize, 'banner_display_option', array(
        'label' => esc_html__( 'Hide / Show','magazine-newspaper' ),
        'section' => 'magazine_newspaper_banner_sections',
        'settings' => 'banner_display_option',
        'type'=> 'toggle',
    ) ) );

    $wp_customize->add_setting( 'banner_section_title', array(
        'sanitize_callback' => 'wp_kses_post',
        'default' => ''
    ) );

    $wp_customize->add_control( 'banner_section_title', array(
        'label' => esc_attr__( 'Title','magazine-newspaper' ),
        'section' => 'magazine_newspaper_banner_sections',
        'settings' => 'banner_section_title',
        'type' => 'text'
    ) );

    $wp_customize->add_setting( 'banner_category', array(
        'capability'  => 'edit_theme_options',        
        'sanitize_callback' => 'wp_kses_post',
    ) );

    $wp_customize->add_control( new Magazine_Newspaper_Customize_Dropdown_Taxonomies_Control( $wp_customize, 'banner_category', array(
        'label' => esc_html__( 'Choose category', 'magazine-newspaper' ),
        'section' => 'magazine_newspaper_banner_sections',
        'settings' => 'banner_category',
        'type'=> 'dropdown-taxonomies',
    ) ) );

}