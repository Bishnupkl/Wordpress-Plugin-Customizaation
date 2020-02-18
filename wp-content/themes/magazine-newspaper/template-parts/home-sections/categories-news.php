<?php $cat_news_display = get_theme_mod( 'category_news_display_option', false ); ?>
<?php if( $cat_news_display ) : ?>
  <!-- category news starts -->
  <?php
    for( $i = 1; $i <= 2; $i++ ) :
      $category_id = get_theme_mod( 'category_news_' . $i );
      $category_name = get_cat_name( $category_id );
      $title = get_theme_mod( 'category_title_' . $i );
      if( ! $title ) {
        $title = $category_name;
      }
      
      $args = array(
        'cat' => esc_attr($category_id),
        'posts_per_page' => 4
      );
      $query = new WP_Query( $args );
  ?>
      
      <?php if ( $query->have_posts() ) : ?>
          <div class="recent-news spacer"> 
            <?php if( $title ) : ?><h2 class="news-heading"><?php echo esc_html( $title ); ?></h2><?php endif; ?>
            <div class="row">
              <div class="col-sm-12">
                <div class="row">
                 <?php while ( $query ->have_posts() ) : $query ->the_post(); ?>                             
                    <div class="col-sm-6"> 
                      <div class="news-snippet">
                        <?php if ( has_post_thumbnail() ) : ?>
                        <a href="<?php the_permalink(); ?>" rel="bookmark" class="featured-image"><?php the_post_thumbnail( 'thumbnail' ); ?></a>                      
                        <?php endif; ?>  
                      <!-- summary -->
                      <div class="summary">
                        <h4 class="news-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
                        <small class="date"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo esc_attr(get_the_date()); ?></small>
                      </div>
                      <!-- summary -->
                      </div>
                    </div>            
                  <?php endwhile; wp_reset_postdata(); ?>
                </div>
              </div>
            </div>
          </div> 
      <?php endif; ?>
  <?php endfor; ?>
    <!-- category news ends -->
<?php endif; ?>