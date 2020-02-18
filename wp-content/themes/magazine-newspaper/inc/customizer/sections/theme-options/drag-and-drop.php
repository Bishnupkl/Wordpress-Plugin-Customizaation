<?php
/**
 * Drag & Drop Sections
 *
 * @package Magazine Newspaper
 */
add_action( 'customize_register', 'magazine_newspaper_drag_and_drop_sections' );

function magazine_newspaper_drag_and_drop_sections( $wp_customize ) {

	$wp_customize->add_section( 'magazine_newspaper_sort_homepage_sections', array(
	    'title'          => esc_html__( 'Drag & Drop', 'magazine-newspaper' ),
	    'panel'          => 'magazine_newspaper_theme_options_panel',
	    'priority'       => 6,
	) );

	$wp_customize->add_setting( 'reorder_news_section', array(  
      'sanitize_callback' => 'wp_kses_post',
      'default'     => '',
    ) );

    $wp_customize->add_control( new Magazine_Newspaper_Custom_Text( $wp_customize, 'reorder_news_section', array(
      'label' => esc_html__( 'This feature is available in Pro Version.','magazine-newspaper' ),
      'section' => 'magazine_newspaper_sort_homepage_sections',
      'settings' => 'reorder_news_section',
      'type'=> 'customtext',
    ) ) );

}