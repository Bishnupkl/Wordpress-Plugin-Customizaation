<!-- recent news 1 starts -->
<?php
  $category_id = get_theme_mod( 'recent_news_category' );
  $title = get_theme_mod( 'recent_news_section_title' );
  $recent_news_display = get_theme_mod( 'recent_news_display_option', false );
?>

<?php if( $recent_news_display ) : ?>

  <?php
    $category_args = array(
      'cat' => absint( $category_id ),
      'posts_per_page' => 5,
    );
  ?>

  <?php $query = new WP_Query( $category_args );
  if ( $query->have_posts() ) : ?>
    <div class="recent-news">       
      <?php if( $title ) : ?><h2 class="news-heading"><?php echo esc_html( $title ); ?></h2><?php endif; ?>
      <div class="row">
        <div class="col-sm-12">
          <div class="row">
            <?php
              $item_counter = 1;            
            ?>
             <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <?php if( $item_counter == 1 ) {
                  $class = "col-sm-12 big-block";
                  $image_size = "full";
                }
                else {
                	$class = "col-sm-6";
                  $image_size = "thumbnail";
                }
                ?>
                  <div class="<?php echo esc_attr( $class ); ?>">
                    <div class="news-snippet">
                      <?php if ( has_post_thumbnail() ) : ?>
                      <a href="<?php the_permalink(); ?>" rel="bookmark" class="featured-image"><?php the_post_thumbnail( esc_attr($image_size) ); ?></a>                    
                      <?php endif; ?>  
                      <!-- summary -->
                      <div class="summary">
                        <h4 class="news-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
                        <small class="date"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo esc_attr(get_the_date()); ?></small>
                      </div>
                      <!-- summary -->
                    </div>
                  </div>              
                <?php $item_counter++; ?>
            <?php endwhile; wp_reset_postdata(); ?>
          </div>
        </div>
      </div>
    </div> 

  <?php endif; ?>
  <!-- recent news 1 ends -->
<?php endif; ?>