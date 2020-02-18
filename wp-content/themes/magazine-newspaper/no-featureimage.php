<?php
/**
 * Template Name: No Featured Image
 * The template used for displaying fullwidth page content in fullwidth.php
 *
 * @package magazine-newspaper
 */
get_header(); ?>
<div class="inside-page">
<div class="container">
<section class="page-section">
          
      <div class="detail-content">
            
              <?php while ( have_posts() ) : the_post(); ?>
					<div class="page-title">
					<h1><?php the_title(); ?></h1>
					</div>

					<div class="single-post">
					<div class="post-content">
     

					<article>
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'magazine-newspaper' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</article> <!-- /.end of article -->
					</div>


					</div>


					<div class="entry-meta">
					<?php edit_post_link( __( 'Edit', 'magazine-newspaper' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-meta -->  

              <?php endwhile; // End of the loop. ?> 

              <?php comments_template(); ?>         

          </div> <!-- /.end of detail-content -->

  
</section><!-- /.end of section -->
</div>
</div>
<?php get_footer(); ?>