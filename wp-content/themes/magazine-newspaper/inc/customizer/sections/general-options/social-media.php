<?php
/**
 * Social Media Sections
 *
 * @package Magazine Newspaper
 */
add_action( 'customize_register', 'magazine_newspaper_social_media_sections' );

function magazine_newspaper_social_media_sections( $wp_customize ) {

	$wp_customize->add_section( 'magazine_newspaper_social_media_sections', array(
	    'title'          => esc_html__( 'Social Media', 'magazine-newspaper' ),
	    'description'    => esc_html__( 'Social Media', 'magazine-newspaper' ),
	    'priority'       => 2,
	    'panel'			 => 'magazine_newspaper_general_panel',
	) );

	$wp_customize->add_setting( new Magazine_Newspaper_Repeater_Setting( $wp_customize, 'magazine_newspaper_social_media', array(
        'default'     => '',
		'sanitize_callback' => array( 'Magazine_Newspaper_Repeater_Setting', 'sanitize_repeater_setting' ),
    ) ) );
    
    $wp_customize->add_control( new Magazine_Newspaper_Control_Repeater( $wp_customize, 'magazine_newspaper_social_media', array(
		'section' => 'magazine_newspaper_social_media_sections',
		'settings'    => 'magazine_newspaper_social_media',
		'label'	  => esc_html__( 'Social Links', 'magazine-newspaper' ),
		'fields' => array(
			'social_media_title' => array(
				'type'        => 'text',
				'label'       => esc_html__( 'Social Media Title', 'magazine-newspaper' ),
				'description' => esc_html__( 'This will be the label.', 'magazine-newspaper' ),
				'default'     => '',
			),
			'social_media_class' => array(
				'type'        => 'text',
				'label'       => esc_html__( 'Social Media Class', 'magazine-newspaper' ),
				'default'     => '',
			),
			'social_media_link' => array(
				'type'      => 'url',
				'label'     => esc_html__( 'Social Media Links', 'magazine-newspaper' ),
		        'default'   => '',
			),			
		),
        'row_label' => array(
			'type'  => 'field',
			'value' => esc_html__('Social Media', 'magazine-newspaper' ),
			'field' => 'social_media_title',
		),                        
	) ) );
	
}