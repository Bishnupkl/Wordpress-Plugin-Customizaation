<?php
/**
 * Header Layout Settings
 *
 * @package Magazine Newspaper
 */

add_action( 'customize_register', 'magazine_newspaper_top_news_section' );

function magazine_newspaper_top_news_section( $wp_customize ) {

    $wp_customize->add_section( 'magazine_newspaper_top_news_section', array(
        'title'          => esc_html__( 'Top News', 'magazine-newspaper' ),
        'panel'          => 'magazine_newspaper_header_panel',
        'priority'       => 2,
        'capability'     => 'edit_theme_options',
    ) );

    $wp_customize->add_setting( 'top_news_display', array(
        'sanitize_callback' => 'magazine_newspaper_sanitize_checkbox',
        'default' => true
    ) );

    $wp_customize->add_control( new Magazine_Newspaper_Toggle_Control( $wp_customize, 'top_news_display', array(
        'label' => esc_attr__( 'Show / Hide Top News','magazine-newspaper' ),
        'section' => 'magazine_newspaper_top_news_section',
        'settings' => 'top_news_display',
        'type' => 'toggle',
    ) ) );

    $wp_customize->add_setting( 'top_news_section_title', array(
        'sanitize_callback' => 'wp_kses_post',
        'default' => esc_attr__( 'Top News', 'magazine-newspaper' ),
    ) );

    $wp_customize->add_control( 'top_news_section_title', array(
        'label' => esc_attr__( 'Title','magazine-newspaper' ),
        'section' => 'magazine_newspaper_top_news_section',
        'settings' => 'top_news_section_title',
        'type' => 'text'
    ) );

    $wp_customize->add_setting( 'top_news_category',array(
        'sanitize_callback' => 'magazine_newspaper_sanitize_category',
        'default' => ''
    ) );

    $wp_customize->add_control( new Magazine_Newspaper_Customize_Dropdown_Taxonomies_Control( $wp_customize, 'top_news_category', array(
        'label' => esc_attr__('Choose category','magazine-newspaper'),
        'section' => 'magazine_newspaper_top_news_section',
        'settings' => 'top_news_category',
        'type'=> 'dropdown-taxonomies'
    ) ) );
}