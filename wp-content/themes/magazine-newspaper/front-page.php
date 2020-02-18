<?php
/**
 *
 * @package magazine-newspaper
 */

if ( 'posts' == get_option( 'show_on_front' ) ) {
    include( get_home_template() );
} else {
    get_template_part( 'template', 'home' );
}