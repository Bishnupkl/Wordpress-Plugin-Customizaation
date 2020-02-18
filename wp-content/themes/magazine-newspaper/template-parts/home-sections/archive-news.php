<?php $archive_display = get_theme_mod( 'archive_news_display_option', false ); ?>

<?php if( $archive_display ) : ?>

    <?php
        global $paged;
        $paged = (get_query_var('page')) ? get_query_var('page') : 1;   
        $default_posts_per_page = get_option( 'posts_per_page' );
        $archive_cat = get_theme_mod( 'archive_news_category' );
        $args = array(
            'post_type' => 'post',
            'cat'       => esc_attr($archive_cat),
            'posts_per_page'    => esc_attr($default_posts_per_page),
            'paged'     => esc_attr($paged)
        );
        $query = new WP_Query( $args );
    ?>
    <div class="home-archive inside-page post-list">
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
                            <?php previous_posts_link( '<< Previous Posts', esc_attr($query->max_num_pages )); ?>
                          </li>
                          <li id="next-posts">
                            <?php next_posts_link( 'Next Posts >>', esc_attr($query->max_num_pages )); ?>
                          </li>
                        </ul>             
                    <?php else : ?>
                        <?php get_template_part( 'template-parts/content', 'none' ); ?>
                    <?php endif; wp_reset_postdata(); ?>
                </div>            
                <div class="col-sm-4"><?php dynamic_sidebar( 'right-sidebar-2' ); ?></div>
            </div>
        </div>
    </div>
<?php endif;