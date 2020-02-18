<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package magazine-newspaper
 */

get_header();?>

<?php
if( get_theme_mod( 'top_news_display', $default = true ) ) {
  get_template_part( 'template-parts/home-sections/top', 'news' );
}
if( get_theme_mod( 'banner_news_display', $default = true ) ) {
  get_template_part( 'template-parts/home-sections/banner', 'news' );
}

?>


<?php  
    $offset_archive_news = "";
    if( get_theme_mod( 'banner_news_display', $default = true ) && ! get_theme_mod( 'banner_news_category' ) ) {
      $offset_archive_news = 3;
    }
  
    $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
    $default_posts_per_page = get_option( 'posts_per_page' );

    $offset = $offset_archive_news + ( $default_posts_per_page * ( $paged - 1 ) );

    $args = array(
        'post_type' => 'post',
        'offset'    => $offset,
        'paged'     => $paged
    );
    $query = new WP_Query( $args );

    $max_pages = ceil( ( $query->found_posts - $offset_archive_news ) / $default_posts_per_page );
    
?>

<div class="inside-page post-list home-archive">
    <div class="container">        
        <div class="row">
            <div  class="col-sm-8">    
                <?php if ( $query->have_posts() ) : ?>
                    <?php $default_image = array( '1' => '1.jpg', '2' => '2.jpg', '3' => '3.jpg', '4' => '4.jpg' ); ?>
                    <?php $archive_title = get_theme_mod( 'archive_news_section_title' ); ?>
                    <?php if( ! empty( $archive_title ) ) { ?><h2 class="news-heading"><?php echo esc_html( $archive_title ); ?></h2><?php } ?>               
                    <div class="row">
                        <?php /* Start the Loop */ ?>
                        <?php $i = 1; ?>
                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                            <?php

                                /*
                                 * Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */                                
                                set_query_var( 'default_image', $default_image );
                                set_query_var( 'i', $i );
                                
                                get_template_part( 'template-parts/content' );
                            ?>
                        <?php $i++; endwhile; ?>                                       
                    </div>
                    <ul class="pagination">
                      <li id="previous-posts">
                        <?php previous_posts_link( '<< Previous Posts', $max_pages ); ?>
                      </li>
                      <li id="next-posts">
                        <?php next_posts_link( 'Next Posts >>', $max_pages ); ?>
                      </li>
                    </ul>          
                <?php else : ?>
                    <?php get_template_part( 'template-parts/content', 'none' ); ?>
                <?php endif; wp_reset_postdata(); ?>
            </div>            
            <div class="col-sm-4"><?php get_sidebar(); ?></div>
        </div>
    </div>
</div>
<!-- main-content area-->


 
<?php get_footer(); ?>