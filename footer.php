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

	<footer id="colophon" class="site-footer" role="contentinfo" style="background-image: url('<?php if(get_field("footer_background","option")):
        $img = wp_get_attachment_image_src(get_field("footer_background","option"),"full");
        echo $img[0];
    endif;?>');">
        <?php $facebook_link = get_field("facebook_link","option");
        $instagram_link = get_field("instagram_link","option");
        $row_1 = false;
        if($facebook_link||$instagram_link):
            $row_1 = true;?>
            <div class="social-row">
                <?php if($facebook_link) echo '<a href="'.$facebook_link.'" target="_blank"><i class="fa fa-facebook"></i></a>';
                if($instagram_link) echo '<a href="'.$instagram_link.'" target="_blank"><i class="fa fa-instagram"></i></a>';?>
            </div><!--.social-row-->
        <?php endif;?>
		<div class="wrapper <?php if($row_1)echo "row-above";?>">
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
					<?php if(get_field("telephone_number_link","option")):?>
						<div class="telephone-number"><a href="tel://<?php echo get_field("telephone_number_link","option");?>" target="_blank"><?php echo get_field("telephone_number","option");?></a></div><!--.telephone-number-->
					<?php else: ?>
						<div class="telephone-number"><?php echo get_field("telephone_number","option");?></div><!--.telephone-number-->
					<?php endif;?>
				<?php endif;?>
			</div><!-- .site-info -->
			<nav class="footer-desc-menu">
				<ul>
					<?php if(get_field("footer_menu_1","option")):?>
						<li>
							<span><?php echo get_field("footer_menu_1","option");?></span>
						</li>
					<?php endif; ?>
					<?php if(get_field("footer_menu_2","option")):?>
						<li>
							<span><?php echo get_field("footer_menu_2","option");?></span>
						</li>
					<?php endif; ?>
					<?php if(get_field("footer_menu_3","option")):?>
						<li>
							<span><?php echo get_field("footer_menu_3","option");?></span>
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
