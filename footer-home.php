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
					<div class="address-line-1"><?php echo get_field("address_line_1","option");?></div><!--.address-line-1-->
				<?php endif;?>
				<?php if(get_field("address_line_2","option")):?>
					<div class="address-line-2"><?php echo get_field("address_line_2","option");?></div><!--.address-line-2-->
				<?php endif;?>
				<?php if(get_field("city_state_zip","option")):?>
					<div class="city-state-zip"><?php echo get_field("city_state_zip","option");?></div><!--.city-state-zip-->
				<?php endif;?>
				<div class="separator">/</div><!--.seperator-->
				<?php if(get_field("telephone_number","option")):?>
					<div class="telephone-number"><?php echo get_field("telephone_number","option");?></div><!--.telephone-number-->
				<?php endif;?>
			</div><!-- .site-info -->
			<nav class="footer-desc-menu">
				<ul>
					<?php if(get_field("footer_menu_1","option")):?>
						<li>
							<?php echo get_field("footer_menu_1","option");?>
						</li>
					<?php endif; ?>
					<?php if(get_field("footer_menu_2","option")):?>
						<li>
							<?php echo get_field("footer_menu_2","option");?>
						</li>
					<?php endif; ?>
					<?php if(get_field("footer_menu_3","option")):?>
						<li>
							<?php echo get_field("footer_menu_3","option");?>
						</li>
					<?php endif; ?>
				</ul>
			</nav>
			<nav class="footer-menu">
				<?php wp_nav_menu( array( 'theme_location'=>'footer' ) ); ?>
			</nav>
		</div><!-- wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
