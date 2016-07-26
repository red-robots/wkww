<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php if ( have_posts() ) : the_post();?>
				<article class="page">
					<header>
						<h1 class="title"><?php the_title();?></h1>
					</header>
					<?php if(get_the_content()):?>
						<section class="copy page">
							<?php the_content();?>
						</section>
					<?php endif;?>
				</article>
			<?php endif; // endif for have posts?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
