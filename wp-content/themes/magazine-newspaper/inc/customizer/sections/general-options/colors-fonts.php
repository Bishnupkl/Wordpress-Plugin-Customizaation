<?php
/**
 * Colors and Fonts Settings
 *
 * @package Magazine Newspaper
 */


add_action( 'customize_register', 'magazine_newspaper_change_colors_panel' );

function magazine_newspaper_change_colors_panel( $wp_customize)  {
    $wp_customize->get_section( 'colors' )->title = esc_html__( 'Colors and Fonts', 'magazine-newspaper' );
    $wp_customize->get_section( 'colors' )->priority = 1;
    $wp_customize->get_section( 'colors' )->panel = 'magazine_newspaper_general_panel';
}


add_action( 'customize_register', 'magazine_newspaper_customize_color_options' );

function magazine_newspaper_customize_color_options( $wp_customize ) {
            
    $wp_customize->add_setting( 'more_color_options', array(  
      'sanitize_callback' => 'sanitize_text_field',
      'default'     => '',
    ) );

    $wp_customize->add_control( new Magazine_Newspaper_Custom_Text( $wp_customize, 'more_color_options', array(
      'label' => esc_html__( 'More color options available in Pro Version.','magazine-newspaper' ),
      'section' => 'colors',
      'settings' => 'more_color_options',
      'type'=> 'customtext',
    ) ) );

}