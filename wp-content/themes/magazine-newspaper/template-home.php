<?php
/**
 * Template Name: Front Page 
 * The template used for displaying front page contents
 *
 * @package magazine-newspaper
 */
get_header();
if( get_theme_mod( 'top_news_display', $default = true ) ) {
	get_template_part( 'template-parts/home-sections/top', 'news' );
}
if( get_theme_mod( 'banner_news_display', $default = true ) ) {

	$offset_banner_news = "";
	if( ! get_theme_mod( 'banner_news_category' ) ) {
		if( get_theme_mod( 'top_news_display', $default = true ) && ! get_theme_mod( 'top_news_category' ) ) {
			$offset_banner_news = 6;
		}
	}
	set_query_var( 'offset_banner_news', $offset_banner_news );
	get_template_part( 'template-parts/home-sections/banner', 'news' );
}

?>

<?php if( get_theme_mod( 'recent_news_display', $default = true ) || get_theme_mod( 'categories_news_display', $default = true ) ) : ?>
<!-- main-content area-->
<section class="spacer main-content">
<div class="container">
  <div class="row">
    <div class="col-sm-8">
      <?php
      	if( get_theme_mod( 'recent_news_display', $default = true ) ) { 
      		get_template_part( 'template-parts/home-sections/recent', 'news' );
      	}
      	if( get_theme_mod( 'categories_news_display', $default = true ) ) {
      		get_template_part( 'template-parts/home-sections/categories', 'news' );
      	}
      ?>
    </div>
    <div class="col-sm-4">
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>
</section>
<!-- main-content area-->

<?php
  if( get_theme_mod( 'archive_news_display', $default = true ) ) { 
    get_template_part( 'template-parts/home-sections/archive', 'news' );
  }
?>

<?php endif; ?>

<?php get_footer();