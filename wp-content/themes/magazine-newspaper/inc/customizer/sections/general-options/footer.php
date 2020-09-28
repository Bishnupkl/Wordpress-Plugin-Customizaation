<?php
/**
 * Footer Settings
 *
 * @package Magazine Newspaper
 */

add_action( 'customize_register', 'magazine_newspaper_customize_register_footer_section' );

function magazine_newspaper_customize_register_footer_section( $wp_customize ) {

    $wp_customize->add_section( 'magazine_newspaper_footer_section', array(
        'title'          => esc_html__( 'Footer / Copyright', 'magazine-newspaper' ),
        'panel'          => 'magazine_newspaper_general_panel',
        'priority'       => 3,        
    ) );

     $wp_customize->add_setting( 'copyright_edit_option', array(  
        'sanitize_callback' => 'sanitize_text_field',
        'default'     => '',
    ) );

    $wp_customize->add_control( new Magazine_Newspaper_Custom_Text( $wp_customize, 'copyright_edit_option', array(
        'label' => esc_html__( 'Footer Copyright text can be edited in Pro Version.','magazine-newspaper' ),
        'section' => 'magazine_newspaper_footer_section',
        'settings' => 'copyright_edit_option',
    ) ) );    

}