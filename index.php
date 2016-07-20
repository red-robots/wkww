<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header("home"); ?>

	<div id="primary-home" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="row gallery-nav-title clear-bottom">
				<div class="gallery wrapper left-column">
					<?php if(get_field("gallery")): 
						$images = get_field("gallery");
						if($images!=null && count($images)>0): ?>
							<ul class="slides">
								<?php for($i=0;$i<count($images);$i++):?>
									<li class="slide"><img src="<?php echo $images[$i][url];?>" alt="<?php echo $images[$i]['title'];?>"></li>
								<?php endfor;?>
							</ul>
						<?php endif; //if images 
					endif; //if gallery?>
				</div><!--.gallery .wrapper .left-column-->
				<div class="nav-title wrapper right-column">
					<?php if(get_field("title_of_firm","option")):?>
						<h1 class="title"><?php echo get_field("title_of_firm","option");?></h1>
					<?php endif; ?>
					<nav>
						<?php wp_nav_menu( array( 'theme_location'=>'primary' ) ); ?>
					</nav>
				</div><!--.nav-title .wrapper .right-column-->
			</div><!--.row .gallery-nav-title .clear-bottom-->
			<div class="row copy">
				<?php the_content();?>
			</div><!--.row .copy-->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer("home");
