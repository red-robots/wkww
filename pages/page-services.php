<?php
/**
 * Template Name: Services
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php if(have_posts()):the_post();?>
				<article class="services">
					<header>
						<h1 class="title"><?php echo get_the_title();?></h1>
					</header>
					<?php if(get_the_content()):?>
						<section class="services copy">
							<?php the_content();?>
						</section><!--.copy-->
					<?php endif;?>
					<?php $args = array('post_type'=>'service','posts_per_page'=>-1);
					$query = new WP_Query($args);
					if($query->have_posts()):?>
						<div class="services wrapper clear-bottom">
							<?php $count = 0;
							while($query->have_posts()):$query->the_post();?>
								<div class="service false-margin wrapper js-blocks <?php echo "count-".$count%3 ?>">
									<section class="service">
										<header>
											<h2 class="title"><?php echo get_the_title();?></h2>
										</header>
										<?php if(get_the_content()):?>
											<section class="copy">
												<?php the_content();?>
											</section><!--.copy-->
										<?php endif;?>
									</section><!--.service-->
								</div><!--.service .false-margin .wrapper-->
								<?php $count++;
							endwhile;//endwhile for have posts?>
						</div><!--.services .wrapper-->
					<?php endif;//endif for have posts?>
				</article>
			<?php endif;?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
