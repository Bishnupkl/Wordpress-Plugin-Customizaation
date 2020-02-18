<?php
/**
 * Demo configuration
 *
 * @package Magazine Newspaper
 */

$config = array(
	'ocdi'           => array(
		array(
			'import_file_name'             => esc_html__( 'Import Magazine Newspaper Demo', 'magazine-newspaper' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demo/contents.xml',      		
      		'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/demo/customizer.dat',
      		'import_notice'					=> esc_html__( 'It will overwrite your settings', 'magazine-newspaper' ),
      		'preview_url'					=> esc_url( 'https://thebootstrapthemes.com/demo/magazine-newspaper/' ),
      		'import_preview_image_url'		=> esc_url( 'http://thebootstrapthemes.com/demo/1.jpg' )
		),		
	),
);

Magazine_Newspaper_Demo::init( apply_filters( 'magazine_newspaper_demo_filter', $config ) );