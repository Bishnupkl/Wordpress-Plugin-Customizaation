<?php
/**
 * Post Settings
 *
 * @package Magazine Newspaper
 */


add_action( 'customize_register', 'magazine_newspaper_customize_post_option' );

function magazine_newspaper_customize_post_option( $wp_customize ) {

    $wp_customize->add_section( 'magazine_newspaper_post_section', array(
        'title'          => esc_html__( 'Post Options', 'magazine-newspaper' ),
        'panel'          => 'magazine_newspaper_general_panel',
        'priority'       => 1,
    ) );

    $wp_customize->add_setting( 'show_author', array(
      'sanitize_callback'     =>  'magazine_newspaper_sanitize_checkbox',
      'default'               =>  false
    ) );

    $wp_customize->add_control( new Magazine_Newspaper_Toggle_Control( $wp_customize, 'show_author', array(
      'label' => esc_html__( 'Hide / Show Author Section','magazine-newspaper' ),
      'section' => 'magazine_newspaper_post_section',
      'settings' => 'show_author',
      'type'=> 'toggle',
    ) ) );
}