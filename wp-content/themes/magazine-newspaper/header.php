<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <header>
 *
 * @package magazine-newspaper
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="<?php echo esc_url( 'http://gmpg.org/xfn/11' ); ?>">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>
<?php $header_text_color = get_header_textcolor(); ?>
<header <?php if( has_header_image() ) : ?> style="background:url(<?php echo esc_url( get_header_image() ); ?>)" <?php endif; ?>>
	<!-- top-bar -->
	<section class="pri-bg-color top-nav">
		<div class="container">
			<div class="row">
				<div class="col-sm-5 text-left">
					<?php
					    wp_nav_menu( array(
					            'theme_location'    => 'top',
					            'depth'             => 8,
					            'container'         => 'div',
					            'menu_class'        => 'top-nav list-inline',
					            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
					            'walker'            => new Magazine_Newspaper_Wp_Bootstrap_Navwalker()
					        )
					    );
					?>
				</div>
				<div class="col-sm-7 text-right search-social">
					<?php if( get_theme_mod( 'header_search_display_option', false ) ) { ?>
						<div class="search-top"><?php get_search_form( $echo = true ); ?></div>
					<?php } ?>
					<div class="social-icons">
						<?php							
							$defaults = "";
							$social_media = get_theme_mod( 'magazine_newspaper_social_media', $defaults );
						?>
				        <ul class="list-inline">
				            <?php foreach ( $social_media as $value ) { ?>
								<?php
									$no_space_class = str_replace( 'fa fa-', '', $value['social_media_class'] );
									$class = strtolower( $no_space_class );
								?>
						        <li class="<?php echo esc_attr( $class ); ?>"><a href="<?php echo esc_url( $value['social_media_link'] ); ?>" target="_blank"><i class="<?php echo esc_attr( $value['social_media_class'] ); ?>"></i></a></li>
						    <?php } ?>
				    	</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- top-bar -->

	<section class="logo">
		<div class="container">
			<div class="row">
			<!-- Brand and toggle get grouped for better mobile display -->		
			<div class="col-sm-12 text-left">			
				<?php if ( has_custom_logo() ) : the_custom_logo(); else: ?>
      			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><h1 class="site-title" style="color:<?php echo "#". esc_attr($header_text_color);?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
      			<h2 class="site-description" style="color:<?php echo "#". esc_attr($header_text_color);?>"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></h2><?php endif; ?></a>
			</div>
			</div>
		</div> <!-- /.end of container -->
	</section> <!-- /.end of section -->
	<section  class="sec-bg-color main-nav">
		<div class="container">
			<nav class="navbar navbar-inverse">
		      	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'magazine-newspaper' ); ?></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
		      	</button>	    
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">  							
					<?php
			            wp_nav_menu( array(
			                'theme_location'    => 'primary',
			                'depth'             => 8,
			                'container'         => 'div',
			                'menu_class'        => 'nav navbar-nav',
			                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
			                'walker'            => new Magazine_Newspaper_Wp_Bootstrap_Navwalker()
			            ) );
			        ?>			        
			    </div> <!-- /.end of collaspe navbar-collaspe -->
			</nav>
		</div>

	</section>

<?php 
if( get_theme_mod( 'breaking_news_display', true ) ) :

	$breaking_news = get_theme_mod( 'breaking_news_category' );
	$args = array(
		'cat' => $breaking_news,
    	'posts_per_page' => 6,
	);
	$query = new WP_Query( $args );
?>
	<?php if( $query->have_posts() ) : ?>
		<!-- ticker -->
		<div class="news-ticker">
			<div class="container">
				<?php $breaking_news_title = get_theme_mod( 'breaking_news_section_title', 'Breaking News' ); ?>
				<b><?php echo esc_html( $breaking_news_title ); ?></b>
				<div id="example">
				  <ul>
				  	<?php while( $query->have_posts() ) : $query->the_post(); ?>
				    	<li><small class="date"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo get_the_date(); ?></small> <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="break-news"><?php the_title(); ?></a></li>
				    <?php endwhile; wp_reset_postdata(); ?>		    
				  </ul>
				</div>
			</div>
		</div>
		<!-- ticker -->
	<?php endif; ?>
<?php endif; ?>


</header>