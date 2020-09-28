<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <header>
 *
 * @package Magazine Press
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
				<div class="col-sm-8 text-left">
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
								<div class="news-ticker news-ticker-2">
										<?php $breaking_news_title = get_theme_mod( 'breaking_news_title', __( 'Breaking News', 'magazine-press' ) ); ?>
										<b><?php echo esc_html( $breaking_news_title ); ?></b>
										<div id="example">
										  <ul>
										  	<?php while( $query->have_posts() ) : $query->the_post(); ?>
										    	<li><small class="date"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo get_the_date(); ?></small> <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="break-news"><?php the_title(); ?></a></li>
										    <?php endwhile; wp_reset_postdata(); ?>		    
										  </ul>
										</div>
								</div>
								<!-- ticker -->
							<?php endif; ?>
						<?php endif;?>
				
				</div>
				<?php
					$social = array();
		            $social['facebook'] = get_theme_mod( 'facebook_textbox' );
		            $social['twitter'] = get_theme_mod( 'twitter_textbox' );
		            $social['google-plus'] = get_theme_mod( 'googleplus_textbox' );
		            $social['youtube-play'] = get_theme_mod( 'youtube_textbox' );
		            $social['linkedin'] = get_theme_mod( 'linkedin_textbox' );
		            $social['pinterest'] = get_theme_mod( 'pinterest_textbox' );
		            $social['instagram'] = get_theme_mod( 'instagram_textbox' );
	            	$social = array_filter( $social );
	            ?>

				<?php if ( ! empty( $social ) && is_array( $social ) ) : ?>
					<div class="col-sm-4 text-right search-social">					
						<div class="social-icons">
					        <ul class="list-inline">
					        	<?php foreach ( $social as $key => $value ) { ?>
					            		<li class="<?php echo esc_attr( $key ); ?>"><a href="<?php echo esc_url( $value ); ?>" target="_blank"><i class="fa fa-<?php echo esc_attr( $key ); ?>"></i></a></li>
				            		<?php } ?>
					    	</ul>
						</div>				
					</div>
				<?php endif; ?>
				
			</div>
		</div>
	</section>
	<!-- top-bar -->

	<section class="logo">
		<div class="container">
			<div class="row">
			<!-- Brand and toggle get grouped for better mobile display -->		
			<div class="col-sm-3 text-left">			
				<?php if ( has_custom_logo() ) : the_custom_logo(); else: ?>
      			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><h1 class="site-title" style="color:<?php echo "#". $header_text_color;?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
      			<h2 class="site-description" style="color:<?php echo "#". $header_text_color;?>"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></h2><?php endif; ?></a>
			</div>
			
			</div>
		</div> <!-- /.end of container -->
	</section> <!-- /.end of section -->
	
	<section  class="sec-bg-color main-nav<?php if( $menu_sticky ) echo ' sticky-header'; ?>">
		<div class="container">
			<nav class="navbar navbar-inverse">
		      	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'magazine-press' ); ?></span>
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
</header>



