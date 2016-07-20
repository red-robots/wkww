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
				<h1 class="title"><?php echo get_the_title();?></h1>
				<?php if(get_field("pre_architect_sentence")):?>
					<div class="copy pre-architect">
						<?php echo get_field("pre_architect_sentence");?>
					</div><!--.copy .pre-architect-->
				<?php endif;?>
				<?php if(have_rows("architects")):?>
					<div class="architect wrapper">
						<?php while(have_rows("architects")):the_row();
							$person = get_sub_field("name");
							$copy = get_sub_field("description");
							if($copy && $person):?>
								<div class="architect js-blocks">
									<h2><?php echo $person?></h2>
									<div class="copy"><?php echo $copy;?></div><!--.copy-->
								</div><!--.architect-->
							<?php endif;//endif for person and copy?>
						<?php endwhile;//endwhile for have rows?>
					</div><!--.architect .wrapper-->
				<?php endif;//if for have rows?>
				<section class="copy">
					<?php if(get_field("title_of_firm","option")):?>
						<h2><?php echo get_field("title_of_firm","option");?></h2>
					<?php endif;?>
					<div class="copy-image wrapper">
						<?php $copy = get_field("description");
						$featured_image_url = wp_get_attachment_image_src(get_field("featured_image"),"full")[0];
						$thumbnail = get_post(get_field("featured_image"));
						if($copy):
							if($featured_image_url):?>
								<div class="copy left-column">
							<?php else : ?>
								<div class="copy no-column">
							<?php endif;?>
								<?php echo $copy;?>
							</div><!--.copy .left-column || .no-column-->
						<?php endif;
						if($featured_image_url):?>
							<div class="featured-image right-column">
								<img src="<?php echo $featured_image_url;?>" alt="<?php if($thumbnail)echo $thumbnail->post_title;?>">
							</div><!--.featured-image .right-column-->
						<?php endif;?>
					</div><!--.copy-image wrapper-->
				</section><!--.copy-->
			<?php endif; //for for main loop?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
