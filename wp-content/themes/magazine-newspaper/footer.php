<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package magazine-newspaper
 */

?>
	<footer class="sec-bg-color">
		<div class="container">
		<?php dynamic_sidebar( 'footer-1' ); ?>
	</div>
	</footer>
		<div class="copyright text-center spacer">
		    <?php esc_html_e( "Powered by", 'magazine-newspaper' ); ?> <a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>"><?php esc_html_e( "WordPress", 'magazine-newspaper' ); ?></a> | <a href="<?php echo esc_url( 'https://thebootstrapthemes.com/' ); ?>" target="_blank"><?php esc_html_e( 'Bootstrap Themes','magazine-newspaper' ); ?></a>
		</div>
		<div class="scroll-top-wrapper"> <span class="scroll-top-inner"><i class="fa fa-2x fa-angle-up"></i></span></div> 
		
		<?php wp_footer(); ?>
	</body>
</html>