<?php
/**
 * Template Name: Right Sidebar
 *
 * Description: Use this page template for a page with a right sidebar.
 *
 * @package WordPress
 * @subpackage Boss
 * @since Boss 1.0.0
 */
get_header(); ?>

<div class="page-right-sidebar">

	<div id="primary" class="site-content">
	
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post();

				if ( function_exists( 'bp_is_groups_directory' ) && bp_is_groups_directory() ) {
					get_template_part( 'content', 'buddypress' );
				} else {
					get_template_part( 'content', 'page' );
				}

				// Comments Template
				comments_template( '', true );

			endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
	
    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>