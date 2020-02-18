<?php
/**
 * Shop Settings
 *
 * @package Magazine Newspaper
 */

add_action( 'customize_register', 'magazine_newspaper_customize_register_category_news' );

function magazine_newspaper_customize_register_category_news( $wp_customize ) {
	$wp_customize->add_section( 'magazine_newspaper_category_news_sections', array(
	    'title'          => esc_html__( 'Category News', 'magazine-newspaper' ),
	    'panel'          => 'magazine_newspaper_theme_options_panel',
	    'priority'       => 5,
	) );

    $wp_customize->add_setting( 'category_news_display_option', array(
      'sanitize_callback'     =>  'magazine_newspaper_sanitize_checkbox',
      'default'               =>  false
    ) );

    $wp_customize->add_control( new Magazine_Newspaper_Toggle_Control( $wp_customize, 'category_news_display_option', array(
      'label' => esc_html__( 'Hide / Show','magazine-newspaper' ),
      'section' => 'magazine_newspaper_category_news_sections',
      'settings' => 'category_news_display_option',
      'type'=> 'toggle',
    ) ) );


    for( $i = 1; $i <= 2; $i++ ) {
        
        $wp_customize->add_setting( 'category_title_' . $i, array(
          'sanitize_callback' => 'wp_kses_post',
          'default' => ''
        ) );

        $wp_customize->add_control( 'category_title_' . $i, array(
          'label' => esc_attr__( 'Category Title', 'magazine-newspaper' ) . ' ' . $i,
          'section' => 'magazine_newspaper_category_news_sections',
          'settings' => 'category_title_' . $i,
          'type' => 'text'
        ) );

        $wp_customize->add_setting( 'category_news_'.$i, array(
          'sanitize_callback' => 'magazine_newspaper_sanitize_category',
          'default' => ''
        ) );

        $wp_customize->add_control( new Magazine_Newspaper_Customize_Dropdown_Taxonomies_Control( $wp_customize, 'category_news_'.$i,array(
          'label' => esc_attr__( 'Choose Category', 'magazine-newspaper' ) . ' ' . $i,
          'section' => 'magazine_newspaper_category_news_sections',
          'settings' => 'category_news_'.$i,
          'type'=> 'dropdown-taxonomies'
        ) ) );
    }

}