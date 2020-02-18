<?php
/**
 * Template part for displaying single posts.
 *
 * @package magazine-newspaper
 */

?>

<div class="page-title">
  <h1><?php the_title(); ?></h1>
</div>

<div class="single-post">
  <div class="info">
    <ul class="list-inline">
    <?php $archive_year  = get_the_time('Y'); $archive_month = get_the_time('m'); $archive_day = get_the_time('d'); ?>
      <li>
        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
      <?php $avatar = get_avatar( get_the_author_meta( 'ID' ), $size = 60 ); ?>
      <?php if( $avatar ) : ?>
        <div class="author-image"> 
          <?php echo $avatar; ?>
        </div>
      <?php endif; ?>
       <?php echo esc_html( get_the_author() ); ?></a></li>
      <li><i class="fa fa-clock-o"></i> <a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>"><?php echo esc_attr(get_the_date()); ?></a></li>
      <li><i class="fa fa-comments-o"></i> <?php comments_popup_link( __( 'zero comment', 'magazine-newspaper' ), __( 'one comment', 'magazine-newspaper' ), __( '% comments', 'magazine-newspaper' ) ); ?></li>
    </ul>
  </div>

  <div class="post-content">
    <figure class="feature-image">
      <?php if ( has_post_thumbnail() ) : ?>
        <?php the_post_thumbnail('full'); ?>
      <?php endif; ?> 
    </figure>
    
    <article>
      <?php the_content(); ?>
      <?php the_excerpt(); ?>

      <?php
        wp_link_pages( array(
          'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'magazine-newspaper' ),
          'after'  => '</div>',
        ) );
      ?>     
    </article>

    </div>

    <?php if( get_theme_mod( 'show_author', true ) ) : ?>
      <div class="author-post clearfix">
        <?php $avatar = get_avatar( get_the_author_meta( 'ID' ), $size = 75 ); ?>
        <?php if( $avatar ) : ?>
          <div class="author-image"> 
            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo $avatar; ?></a>
          </div>
        <?php endif; ?>
        <div class="author-details">
        <h4><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></h4>
        <p><?php echo esc_html( get_the_author_meta('description') ); ?></p>
        </div>
      </div>
    <?php endif; ?>


  </div>


  