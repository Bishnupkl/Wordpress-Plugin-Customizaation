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

function get_example_post_types()
{
    $args = array('posts_per_page' => -1,
        'post_type'=>'example');
    $ourPosts = get_posts($args);

    foreach ($ourPosts as $key=>$values) {
        print '<a href="'.get_permalink($values->ID).'"><strong>'. $values->post_title.'</strong></<a href=""></a> <br />';
        print $values->post_content.' <br />';
    }
}

add_shortcode('get_example_posts','get_example_post_types');
?>



