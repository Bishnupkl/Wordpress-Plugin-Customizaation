<?php
function magazine_press_enqueue_child_styles() {
    $parent_style = 'magazine-press-style';
   
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style(
        'magazine-press',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'bootstrap', $parent_style ),
        wp_get_theme()->get('Version') );


}
add_action( 'wp_enqueue_scripts', 'magazine_press_enqueue_child_styles' );