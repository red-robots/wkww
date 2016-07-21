<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ACStarter
 */

?>

	</div><!-- #content -->

	<footer id="colophon-home" class="site-footer" role="contentinfo">
		<div class="wrapper">
			<div class="site-info">
				<?php if(get_field("address_line_1","option")):?>
					<div class="address-line-1"><?php echo get_field("address_line_1","option");?></div>
				<?php endif;?>
				<?php if(get_field("address_line_2","option")):?>
					<div class="address-line-2"><?php echo get_field("address_line_2","option");?></div>
				<?php endif;?>
				<?php if(get_field("city_state_zip","option")):?>
					<div class="city-state-zip"><?php echo get_field("city_state_zip","option");?></div>
				<?php endif;?>
				/
				<?php if(get_field("telephone_number","option")):?>
					<div class="telephone-number"><?php echo get_field("telephone_number","option");?></div>
				<?php endif;?>
			</div><!-- .site-info -->
			<nav class="footer-menu">
				<?php wp_nav_menu( array( 'theme_location'=>'footer' ) ); ?>
			</nav>
			<nav class="sitemap">
				<?php wp_nav_menu( array( 'theme_location'=>'sitemap' ) ); ?>
			</nav>
		</div><!-- wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
