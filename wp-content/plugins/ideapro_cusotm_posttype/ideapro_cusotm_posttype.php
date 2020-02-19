<?php
/**
 *
* Plugin Name:Idea Pro Custom Post Type
 *
 **/

function ideapro_custom_posttype()
{
    register_post_type('example',
    array(
        'labels'=>array(
            'name'=>__('Examples')
        ),
        'menu_position' => 5,
        'public'=>true,
        'supports' => array('title', 'editor', 'thumbnail'),
    )
    );
}

add_action('init','ideapro_custom_posttype');
?>