<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Boss
 * @since Boss 1.0.0
 */
get_header();


if ( is_active_sidebar( 'learndash-course' ) ) :
    echo '<div class="page-right-sidebar">';
else :
    echo '<div class="page-full-width">';
endif;

 if ( is_user_logged_in() ) 
    {     
    $meta_key="quiz_result_".$post->ID;
	$user=wp_get_current_user();
	$user_meta=get_user_meta($user->ID,$meta_key,true);
  	// var_dump($user_meta);die();

	// if(!empty($user_meta)){

  	global $wpdb;
	$user=wp_get_current_user();
	$billing_address=get_user_meta($user->ID,'billing_address_1',true);
	$date_of_birth=get_user_meta($user->ID,'billing_billing_date_of_birth_dob',true);
	$email=get_user_meta($user->ID,'billing_email',true);
	$Phone=get_user_meta($user->ID,'billing_phone',true);

	//$existing=$wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts WHERE post_type LIKE '%fca_qc_quiz%'");

	//$wpdb->query($wpdb->prepare("UPDATE {$wpdb->prefix}posts WHERE post_type LIKE '%fca_qc_quiz%'" ));
	$post_id = 24228;
	$quizArray = get_post_meta( $post_id, 'quiz_cat_questions' );
	// var_dump($quizArray);
	if($_SERVER['REMOTE_ADDR']=="45.123.221.198"){

	}
	// var_dump($billing_address);
	echo "<br><br>";
	
	// array_push($quizArray[0][0]['answers'][0]['answer'],$billing_address);
	// array_push($quizArray[0][1]['answers'][0]['answer'],$date_of_birth);
	// array_push($quizArray[0][2]['answers'][0]['answer'],$email);
	// array_push($quizArray[0][3]['answers'][0]['answer'],$Phone);
	$quizArray[0][0]['answers'][0]['answer'] = $billing_address;
	$quizArray[0][1]['answers'][0]['answer'] = $date_of_birth;
	$quizArray[0][2]['answers'][0]['answer'] = $email;
	$quizArray[0][3]['answers'][0]['answer'] = $Phone;
	// var_dump($quizArray);
	if($_SERVER['REMOTE_ADDR']=="45.123.221.93"){
		
	}
	echo "<br><br>";

	$quizser=maybe_serialize($quizArray);
	// var_dump("UPDATE {$wpdb->prefix}postmeta SET meta_value='$quizser' WHERE  meta_key LIKE '%quiz_cat_questions%'");
	$sql=$wpdb->query($wpdb->prepare("UPDATE {$wpdb->prefix}postmeta SET meta_value='$quizser' WHERE post_id={$post_id} AND meta_key LIKE '%quiz_cat_questions%'"));
	// var_dump($sql);
if($_SERVER['REMOTE_ADDR']=="45.123.221.198"){
		
	}
	echo "<br><br>";

	// update_post_meta( $post_id, 'quiz_cat_questions', fca_qc_kses_html($quizArray) );
	//echo "<pre>";
	// "</pre>";
	//die();
	if ($sql) {
		# code...
$quizsArray = get_post_meta( $post_id, 'quiz_cat_questions',true );
$quizsArray = maybe_unserialize($quizsArray);
	// var_dump($quizsArray);
	// die();
	if($_SERVER['REMOTE_ADDR']=="45.123.221.198"){
		
	}// var_dump(maybe_unserialize($quizArray[0][0]['answers'][0]['answer']));
	// var_dump($quizArray[0][0]['answers'][0]['answer']);
	// var_dump($quizArray[0][1]['answers'][0]['answer']);
	// var_dump($quizArray[0][2]['answers'][0]['answer']);
	// var_dump($quizArray[0][3]['answers'][0]['answer']);
	}

						
	?>
			
<script>
(function($) {
$(window).load(function() {
        $('.popmake-24270').click();
       	$('.pum-close').css("display","none");
});
})(jQuery);
</script>
<input type="hidden" name="course_id" id="course_id" value="<?php echo $post->ID?>">
<div style="text-align: center; display:none;"><span class="popmake-24270" style="color: #e83e8c;"> here </span></div>
<?php //}
 }?>

	<div id="primary" class="site-content">

		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<section class="course-header">

						<div class="table top">
							<?php $img			 = get_the_post_thumbnail( $post->ID, 'course-single-thumb', array( 'class' => 'thumbnail alignleft' ) ); ?>
							<div class="table-cell <?php echo (esc_html( $img )) ? 'image' : ''; ?>">
								<?php echo $img; ?>
							</div>

							<div class="table-cell content">
								<span><?php echo LearnDash_Custom_Label::get_label( 'course' ) ?></span>
								<header><h1><?php the_title(); ?></h1></header>
								<?php echo '<p class="course-excerpt">' . $post->post_excerpt . '</p>'; ?>
							</div>
						</div>

						<div class="table bottom">
							<div class="table-cell categories">
								<?php
								// Get Course Categories
								$category_list = wp_get_post_terms( $post->ID, array( 'category',  'post_tag' ) );
								$ld_category_list = wp_get_post_terms( $post->ID, array( 'ld_course_category',  'ld_course_tag' ) );

								if ( ! empty( $category_list ) || ! empty( $ld_category_list ) ) {
									?>
									<ul class="post-categories"><?php
										foreach ( $category_list as $category ) {
											if ( $category instanceof WP_Term && trim( $category->name ) !== 'Uncategorized' ) {
												?>
												<li><a rel="category tag" href="<?php echo get_term_link( $category ) . '?post_type=sfwd-courses'; ?>"><?php echo $category->name; ?></a></li><?php
											}
										}

										foreach ( $ld_category_list as $category ) {
											if ( $category instanceof WP_Term && trim( $category->name ) !== 'Uncategorized' ) {
												?>
												<li><a rel="category tag" href="<?php echo get_term_link( $category ); ?>"><?php echo $category->name; ?></a></li><?php
											}
										}
										?>
									</ul><?php }
									?>
							</div>

							<div class="table-cell progress">
								<?php echo do_shortcode( '[learndash_course_progress]' ); ?>
							</div>
						</div>

					</section>

					<div id="course-video">
						<a href="#" id="hide-video" class="button"><i class="fa fa-close"></i></a>
						<?php
						/**
						 * sensei_course_meta_video hook
						 *
						 * @hooked sensei_course_meta_video - 10 (outputs the video for course)
						 */
						$course_video_embed = get_post_meta( $post->ID, '_boss_edu_post_video', true );

						if ( 'http' == substr( $course_video_embed, 0, 4 ) ) {
							// V2 - make width and height a setting for video embed
							$course_video_embed = wp_oembed_get( esc_url( $course_video_embed )/* , array( 'width' => 100 , 'height' => 100) */ );
						}

						if ( '' != $course_video_embed ) {
							?><div class="course-video"><?php echo html_entity_decode( $course_video_embed ); ?></div><?php
							}
							?>
					</div>

					<section id="course-details">
						<span class="course-statistic">
							<?php
							$course_id		 = $post->ID;
							$total_lessons	 = apply_filters( 'boss_edu_course_lessons_list', learndash_get_course_lessons_list( $course_id, null, array( 'posts_per_page' => -1 ) ) );
							$total_lessons	 = is_array( $total_lessons ) ? count( $total_lessons ) : 0;
							printf( _n( '%1$s %2$s', '%1$s %3$s', $total_lessons, 'boss-learndash' ), number_format_i18n($total_lessons), LearnDash_Custom_Label::get_label( 'lesson' ), LearnDash_Custom_Label::get_label( 'lessons' ) );
							?>
						</span>
						<div class="course-buttons">
							<?php
							if ( $course_video_embed ) {
								?>
								<a href="#" id="show-video" class="button"><i class="fa fa-play"></i><?php apply_filters( 'boss_edu_show_video_text', _e( 'Watch Introduction', 'boss-learndash' ) ) ?></a>
								<?php
							}

							$user_id = get_current_user_id();

							if ( function_exists( 'learndash_get_course_certificate_link' ) ):
								$course_certficate_link = learndash_get_course_certificate_link( $course_id, $user_id );

								if ( !empty( $course_certficate_link ) ) :
									?>
									<a href='<?php echo esc_attr( $course_certficate_link ); ?>' id="learndash_course_certificate" class="btn-blue" target="_blank"><?php _e( 'PRINT YOUR CERTIFICATE!', 'boss-learndash' ); ?></a><?php
								endif;

							endif;

							$logged_in = !empty( $user_id );

							if ( $logged_in ) {
								?>
								<span id='learndash_course_status'>
									<?php
									$course_status = learndash_course_status( $course_id, null );

									if ( trim( $course_status ) != 'Not Started' && trim( $course_status ) != 'Completed' ) {
										echo '<i class="fa fa-spinner"></i>';
									}

									echo $course_status;
									?>
								</span>
								<?php
							}

							$has_access = sfwd_lms_has_access( $course_id, $user_id );

							if ( !$has_access ) {
								echo boss_edu_payment_buttons( $post );
							}
							?>
						</div>

					</section>

					<?php
					$group_attached = get_post_meta( $course_id, 'bp_course_group', true );

					if ( function_exists( 'bp_is_active' ) && bp_is_active( 'groups' ) ) {
						$group_data = groups_get_group( array( 'group_id' => $group_attached ) );
					}

					if ( !empty( $group_attached ) && $group_attached != '-1' && !empty( $group_data->id ) && $group_data->is_visible ) {

						$group_slug = trailingslashit( home_url() ) . bp_get_root_slug( 'groups' ) . '/' . $group_data->slug;

						$group_query = array(
							'count_total'		 => '', // Prevents total count
							'populate_extras'	 => false,
							'type'				 => 'alphabetical',
							'group_id'			 => absint( $group_attached ),
							'group_role'		 => array( 'admin', 'member', 'mod' )
						);

						$group_users = new BP_Group_Member_Query( $group_query );
						$forum_id	 = groups_get_groupmeta( $group_attached, 'forum_id' );

						//Send invite tab slug
						if ( defined( 'BP_INVITE_ANYONE_SLUG' ) ) {
							$send_invite_slug = BP_INVITE_ANYONE_SLUG;
						} else {
							$send_invite_slug = 'send-invites';
						}
						?>
						<div id="buddypress">
							<div id="item-nav" class="course-group-nav">
								<div role="navigation" id="object-nav" class="item-list-tabs no-ajax">
									<ul>
										<li id="home-groups-li"><a href="<?php echo $group_slug . '/'; ?>" id="home"><?php _e( 'Home', 'boss-learndash' ); ?></a></li>
										<?php if ( function_exists( 'bbpress' ) && !empty( $group_data->enable_forum ) ): ?>
											<li id="nav-forum-groups-li"><a href="<?php echo $group_slug . '/forum/'; ?>" id="nav-forum"><?php _e( 'Forum', 'boss-learndash' ); ?></a></li>
										<?php endif; ?>
										<li class="current selected" id="home-groups-li"><a href="" id="home"><?php echo LearnDash_Custom_Label::get_label( 'course' ) ?></a></li>
										<li id="members-groups-li"><a href="<?php echo $group_slug . '/members/'; ?>" id="members"><?php _e( 'Members', 'boss-learndash' ); ?><span><?php echo $group_users->total_users; ?></span></a></li>
										<?php if ( bp_groups_user_can_send_invites( $group_attached ) ): ?>
										<li id="invite-groups-li">
											<a href="<?php echo $group_slug . '/' . $send_invite_slug . '/'; ?>" id="invite">
												<?php _e( 'Send Invites', 'boss-learndash' ); ?>
											</a>
										</li>
										<?php endif; ?>
										<?php if ( groups_is_user_admin( get_current_user_id(), absint( $group_attached ) ) ): ?>
											<li id="admin-groups-li"><a href="<?php echo $group_slug . '/admin/edit-details/'; ?>" id="admin"><?php _e( 'Manage', 'boss-learndash' ); ?></a></li>
										<?php endif; ?>
									</ul>
								</div>
							</div>
						</div><?php
					}
					?>

					<div class="entry-content">
						
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'boss-learndash' ), 'after' => '</div>' ) ); ?>

					</div><!-- .entry-content -->

					<footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'boss-learndash' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->

				</article><!-- #post -->

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop.     ?>

		</div><!-- #content -->

	</div><!-- #primary -->

<?php
// Course sidebar
if ( is_active_sidebar( 'learndash-course' ) ) :
    global $boss_learndash;
    $boss_learndash->boss_edu_load_template( 'sidebar-learndash-course' );
endif;
?>

</div>

<?php get_footer(); ?>