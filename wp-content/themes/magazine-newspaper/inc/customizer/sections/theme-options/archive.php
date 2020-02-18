<?php
/**
 * Shop Settings
 *
 * @package Magazine Newspaper
 */

add_action( 'customize_register', 'magazine_newspaper_customize_register_archive_news' );

function magazine_newspaper_customize_register_archive_news( $wp_customize ) {
	$wp_customize->add_section( 'magazine_newspaper_archive_news_sections', array(
	    'title'          => esc_html__( 'Archive News', 'magazine-newspaper' ),
	    'panel'          => 'magazine_newspaper_theme_options_panel',
	    'priority'       => 5,
	) );

    $wp_customize->add_setting( 'archive_news_display_option', array(
      'sanitize_callback'     =>  'magazine_newspaper_sanitize_checkbox',
      'default'               =>  false
    ) );

    $wp_customize->add_control( new Magazine_Newspaper_Toggle_Control( $wp_customize, 'archive_news_display_option', array(
      'label' => esc_html__( 'Hide / Show','magazine-newspaper' ),
      'section' => 'magazine_newspaper_archive_news_sections',
      'settings' => 'archive_news_display_option',
      'type'=> 'toggle',
    ) ) );


    $wp_customize->add_setting( 'archive_news_section_title', array(
        'sanitize_callback'     =>  'wp_kses_post',
        'default'               =>  ''
    ) );

    $wp_customize->add_control( 'archive_news_section_title', array(
        'label' => esc_html__( 'Title', 'magazine-newspaper' ),
        'section' => 'magazine_newspaper_archive_news_sections',
        'settings' => 'archive_news_section_title',
        'type'=> 'text',
    ) );

    $wp_customize->add_setting( 'archive_news_category', array(
        'capability'  => 'edit_theme_options',        
        'sanitize_callback' => 'magazine_newspaper_sanitize_category',
        'default'     => '',
    ) );

    $wp_customize->add_control( new Magazine_Newspaper_Customize_Dropdown_Taxonomies_Control( $wp_customize, 'archive_news_category', array(
        'label' => esc_html__( 'Choose Category', 'magazine-newspaper' ),
        'section' => 'magazine_newspaper_archive_news_sections',
        'settings' => 'archive_news_category',
        'type'=> 'dropdown-taxonomies',
    ) ) );

}