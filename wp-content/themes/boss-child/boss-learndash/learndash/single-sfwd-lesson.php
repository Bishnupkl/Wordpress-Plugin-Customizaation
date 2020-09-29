<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Boss
 * @since Boss 1.0.0
 */
get_header();

if ( is_active_sidebar( 'learndash-lesson' ) ) :
	echo '<div class="page-right-sidebar">';
else :
	echo '<div class="page-full-width">';
endif;
?>

<div id="primary" class="site-content">

	<div id="content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div class="entry-content">
					<?php 
	
					$course_id = learndash_get_course_id( get_the_ID());
					$user=wp_get_current_user();
						$user_meta=get_user_meta($user->ID,'quiz_result_'.$course_id,true);
						if($user_meta=="true"){
						?> 
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'boss-learndash' ), 'after' => '</div>' ) ); ?>
										 <?php }else{
											echo "you couldn't verify your identity, Call us for support at: 512-280 4499";
										}?>

				</div>

				<footer class="entry-meta">
					<?php edit_post_link( __( 'Edit', 'boss-learndash' ), '<span class="edit-link">', '</span>' ); ?>
				</footer>

			</article>

			<?php comments_template( '', true ); ?>

		<?php endwhile; ?>

	</div>

</div>

<?php
// Check sidebar
if ( is_active_sidebar( 'learndash-lesson' ) ) :
	global $boss_learndash;
	$boss_learndash->boss_edu_load_template( 'sidebar-learndash-lesson' );
endif;

// Closing div for page-right-sidebar/page-full-width
echo '</div>';

get_footer();
