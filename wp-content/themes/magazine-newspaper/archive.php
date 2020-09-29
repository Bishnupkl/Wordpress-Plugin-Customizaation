<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package magazine-newspaper
 */

get_header(); ?>
<?php
	global $wp_query;
	$max_pages = $wp_query->max_num_pages;
?>
<div class=" post-list">
	<div class="container">
  
        <div class="row">
        <div  class="col-sm-8">

        <?php
    if( have_posts() ) :
          the_archive_title( '<h1 class="category-title">', '</h1>' );
          the_archive_description( '<div class="taxonomy-description">', '</div>' );
      endif;
    ?>
        <?php if ( have_posts() ) : ?>
          <?php $default_image = array( '1' => '1.jpg', '2' => '2.jpg', '3' => '3.jpg', '4' => '4.jpg' ); ?>

                
        <div class="row">
            <?php /* Start the Loop */ ?>
            <?php $i = 1; ?>
            <?php while ( have_posts() ) : the_post(); ?>

                <?php

                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    set_query_var( 'default_image', $default_image );
                    set_query_var( 'i', $i );
                    get_template_part( 'template-parts/content' );
                ?>

            <?php $i++; endwhile; ?>

            <ul class="pagination">
          <li id="previous-posts">
            <?php previous_posts_link( '<< Previous Posts', $max_pages ); ?>
          </li>
          <li id="next-posts">
            <?php next_posts_link( 'Next Posts >>', $max_pages ); ?>
          </li>
        </ul>  
    </div>
        <?php else : ?>

            <?php get_template_part( 'template-parts/content', 'none' ); ?>

        <?php endif; ?>
        
          
        </div>
    <div class="col-sm-4"><?php get_sidebar(); ?>
    </div>
    </div>


</div>
</div>
<?php get_footer(); ?>
