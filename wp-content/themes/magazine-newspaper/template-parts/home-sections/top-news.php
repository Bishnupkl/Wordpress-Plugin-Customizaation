<?php
  $category_id = get_theme_mod( 'top_news_category' );            
  $category = get_category( $category_id );
  $title = get_theme_mod( 'top_news_section_title' );

  $args = array(
    'cat' => esc_attr($category_id),
    'posts_per_page' => 6
  );

  $loop = new WP_Query( $args );
?>
<?php if ( $loop->have_posts() ) : ?>
  <?php $default_image = array( '1' => '1.jpg', '2' => '2.jpg', '3' => '3.jpg', '4' => '4.jpg', '5' => '1.jpg', '6' => '2.jpg' ); ?>
<!-- Top News  -->
  <section class="top-news spacer">
      <div class="container">
        <div class="inside-wrapper">
                
          <?php if( $title ) : ?><h4><?php echo esc_html( $title ); ?></h4><?php endif; ?>  
            <div id="owl-topnews" class="owl-carousel">
              <?php $i = 1; ?>
              <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
              <div class="item">
                  <div class="news-snippet">
                    <?php if ( has_post_thumbnail() ) : ?>
                      <a href="<?php the_permalink(); ?>" rel="bookmark" class="featured-image"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
                    <?php else : ?>
                      <?php $image = get_template_directory_uri() . '/images/' . $default_image[$i]; ?>
                      <a href="<?php the_permalink(); ?>" rel="bookmark" class="featured-image">
                        <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>">
                      </a>
                    <?php endif; ?>  
                  <!-- summary -->
                  <div class="summary">
                    <h4 class="news-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
                    <small class="date"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo esc_attr(get_the_date()); ?></small>
                  </div>
                  <!-- summary -->
                  </div>
              </div>
            <?php
              $i++;
              endwhile;
                  wp_reset_postdata();              
            ?>
          </div>
      </div>
    </div>  <!-- /.end of container -->
  </section>  <!-- /.end of section -->
  <!-- Top News  -->
<?php endif;