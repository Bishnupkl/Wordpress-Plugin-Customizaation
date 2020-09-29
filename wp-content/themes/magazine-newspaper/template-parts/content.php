<?php
/**
 * Template part for displaying posts.
 *
 * @package magazine-newspaper
 */
?>

<div class="col-sm-12">
    <div class="news-snippet">
    <?php if ( has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink(); ?>" rel="bookmark" class="featured-image"><?php the_post_thumbnail('post-thumbs'); ?></a>
    <?php else : ?>
        <?php $image = get_template_directory_uri() . '/images/' . $default_image[$i]; ?>
        <a href="<?php the_permalink(); ?>" rel="bookmark" class="featured-image">
            <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>">
        </a>
    <?php endif; ?>  
    <div class="summary">
                        <h4 class="news-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>

    <small class="date"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo esc_attr(get_the_date()); ?></small>
this is test
        <?php the_content(); ?>
        
        <a href="<?php the_permalink(); ?>" rel="bookmark" title="" class="readmore"><?php esc_html_e('Read More','magazine-newspaper'); ?> </a>

    </div>
</div>
</div>
