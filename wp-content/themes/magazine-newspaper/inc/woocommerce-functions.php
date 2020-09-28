<?php

/**
 * Woocommerce related hooks
*/
add_action( 'after_setup_theme', 'magazine_newspaper_woocommerce_support');

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

add_action( 'woocommerce_before_main_content', 'magazine_newspaper_wc_wrapper', 10 );
add_action( 'woocommerce_after_main_content',  'magazine_newspaper_wc_wrapper_end', 10 );
add_action( 'widgets_init', 'magazine_newspaper_wc_widgets_init' );
add_action( 'magazine_newspaper_wo_sidebar', 'magazine_newspaper_wc_sidebar_cb' );


/**
 * Declare Woocommerce Support
*/
function magazine_newspaper_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

/**
 * Before Content
 * Wraps all WooCommerce content in wrappers which match the theme markup
*/
function magazine_newspaper_wc_wrapper(){    
    ?>
    <div class="container"><div class="magazine-newspaper-woo spacer"><div class="row">
        <main id="main" class="col-sm-8" role="main">
    <?php
}

/**
 * After Content
 * Closes the wrapping divs
*/
function magazine_newspaper_wc_wrapper_end(){
    ?>
        </main>
    <?php
    if( is_active_sidebar( 'shop-sidebar' ) );
    do_action( 'magazine_newspaper_wo_sidebar' );
}


/**
 * Woocommerce Sidebar
*/
function magazine_newspaper_wc_widgets_init(){
    register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'magazine-newspaper' ),
		'id'            => 'shop-sidebar',
		'description'   => esc_html__( 'Sidebar displaying only in woocommerce pages.', 'magazine-newspaper' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );    
}


/**
 * Callback function for Shop sidebar
*/
function magazine_newspaper_wc_sidebar_cb(){
    if( is_active_sidebar( 'shop-sidebar' ) ){
        echo '<div class="col-sm-4 magazine-newspaper-woo-sidebar" role="complementary">';
        dynamic_sidebar( 'shop-sidebar' );
        echo '</div></div></div></div>'; 
    }
}

?>