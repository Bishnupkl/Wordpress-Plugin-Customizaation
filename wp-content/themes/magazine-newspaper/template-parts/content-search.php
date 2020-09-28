<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package magazine-newspaper
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
	<div class="entry-header">
		

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php magazine_newspaper_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</div><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<div class="entry-footer">
		<?php magazine_newspaper_entry_footer(); ?>
	</div><!-- .entry-footer -->
</article><!-- #post-## -->
<hr>