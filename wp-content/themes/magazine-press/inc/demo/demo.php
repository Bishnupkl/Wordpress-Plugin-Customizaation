<?php
/**
 * Demo configuration
 *
 * @package Magazine Press
 */

$config = array(
	'ocdi'           => array(
		array(
			'import_file_name'             => esc_html__( 'Import Magazine Newspaper Demo', 'magazine-press' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demo/contents.xml',      		
      		'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/demo/customizer.dat',
      		'import_notice'					=> esc_html__( 'It will overwrite your settings', 'magazine-press' ),
      		'preview_url'					=> esc_url( 'https://thebootstrapthemes.com/demo/magazine-press/' ),
		),		
	),
);

magazine_press_Demo::init( apply_filters( 'magazine_press_demo_filter', $config ) );


function magazine_press_after_import_menu_setup() {
	// Assign menus to their locations.
	$main_menu = get_term_by( 'name', 'main menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'primary' => $main_menu->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Home' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'magazine_press_after_import_menu_setup' );
