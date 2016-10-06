<?php
/**
 *
 * Template Name: About
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php if ( have_posts() ) : the_post();?>
				<article class="about">
					<header>
						<h1 class="title"><?php echo get_the_title();?></h1>
					</header>
					<?php if(get_field("pre_architect_sentence")):?>
						<section class="copy pre-architect">
							<?php echo get_field("pre_architect_sentence");?>
						</section><!--.copy .pre-architect-->
					<?php endif;?>
					<?php if(have_rows("architects")):?>
						<div class="architect wrapper clear-bottom">
							<?php $count = 0;
							while(have_rows("architects")):the_row();
								$person = get_sub_field("name");
								$copy = get_sub_field("description");
								if($copy && $person):?>
									<div class="architect false-margin wrapper js-blocks <?php echo "count-".$count%3 ?>" <?php if(get_field("architects_background")):
                                        $img =wp_get_attachment_image_src(get_field("architects_background"),"full");
                                        if($img):
                                            echo "style=\"background-image: url('".$img[0]."');\"";
                                        endif;
                                    endif;?>>
										<section class="architect">
											<header>
												<h2><?php echo $person?></h2>
											</header>
											<div class="copy">
												<?php echo $copy;?>
											</div><!--.copy-->
										</section><!--.architect-->
									</div><!--.architect .false-margin .wrapper-->
									<?php $count++;
								endif;//endif for person and copy?>
							<?php endwhile;//endwhile for have rows?>
						</div><!--.architect .wrapper-->
					<?php endif;//if for have rows?>
					<section class="architect copy">
						<?php if(get_field("title_of_firm","option")):?>
							<header>
								<h2><?php echo get_field("title_of_firm","option");?></h2>
							</header>
						<?php endif;?>
						<div class="copy-image wrapper">
							<?php $copy = get_field("description");
							$featured_image_url = wp_get_attachment_image_src(get_field("featured_image"),"full");
							if($featured_image_url):
                                $featured_image_url = $featured_image_url[0];
                            endif;
							$thumbnail = get_post(get_field("featured_image"));
							if($featured_image_url):?>
								<div class="featured-image right-column">
									<img src="<?php echo $featured_image_url;?>" alt="<?php if($thumbnail)echo $thumbnail->post_title;?>">
								</div><!--.featured-image .right-column-->
							<?php endif;
							if($copy):
								if($featured_image_url):?>
									<div class="copy left-column">
								<?php else : ?>
									<div class="copy no-column">
								<?php endif;?>
									<?php echo $copy;?>
								</div><!--.copy .left-column || .no-column-->
							<?php endif;?>
						</div><!--.copy-image wrapper-->
					</section><!--.copy-->
				</article>
			<?php endif; //for for main loop?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
