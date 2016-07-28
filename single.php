<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ACStarter
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="portfolio-page wrapper">
				<header class="portfolio">
					<?php $args = array('taxonomy'=>"category",'order'=>'DESC','orderby'=>'name','hide_empty'=>0,'exclude'=>array(1));
					$project_types = get_terms($args);
					$query_from = isset($_GET['type_from']) ? $_GET['type_from'] : null;
					$category_name = get_query_var("category_name",null);
					$this_post = null;
					if(have_posts()):
						the_post();
						$this_post = $post;
					endif;
					if($category_name!==null && !empty($category_name)):
						$args['slug'] = $category_name;
					else:
						if($query_from!==null):
							$args['slug'] = $query_from;
						else:
							if($this_post!==null):
								$this_post_terms = get_the_terms($this_post->ID,'category');
								if(!is_wp_error($this_post_terms)&&is_array($this_post_terms)&&!empty($this_post_terms)):
									$list_of_terms = array();
									foreach($this_post_terms as $term):
										$list_of_terms[] = $term->slug;	
									endforeach;
									sort($list_of_terms,SORT_STRING);
									$list_of_terms = array_reverse($list_of_terms);
									$args['slug']=$list_of_terms[0];								
								endif;
							endif;	
						endif;
					endif;//endif for query from !== null
					$types_from = get_terms($args);
					//type from holds either the current category or the project type the post came from
					$type_from = null;
					if(!is_wp_error($types_from)&&is_array($types_from)&&!empty($types_from)):
						$type_from = $types_from[0];
					endif;//endif for types from exists
					if(!is_wp_error($project_types)&&is_array($project_types)&&!empty($project_types)): ?>
						<nav class="project-type">
							<ul>
								<?php foreach($project_types as $type):
									if($type_from!==null && strcmp($type->slug,$type_from->slug)===0):?>
										<li class="active">
									<?php else: ?>
										<li>
									<?php endif;?>
										<a href="<?php echo get_term_link($type->term_id);?>"><?php echo $type->name; ?></a>
									</li>
								<?php endforeach;?>
							</ul>
						</nav><!--.project-type-->
					<?php endif;//endif  for project types exist
					if($type_from!==null):?>
						<h1 class="title"><?php echo $type_from->name;?></h1>
					<?php endif;//endif for type from !== null?>
				</header>
				<?php if($type_from!==null):?>
					<section class="copy project-type">
						<?php echo get_field("category_description",$type_from); ?>
					</section><!--.copy .project-type .description-->
				<?php endif;//endif for type from !== null?>
				<section class="projects-sub-title wrapper">
					<?php $post_obj = get_post_type_object('post');
					if($post_obj!==null):?>
						<header>
							<h2 class="sub-title"><?php echo $post_obj->labels->name;?></h2>
						</header>
					<?php endif;?>
					<?php $post_type = get_query_var('post_type',null);
					$slug_of_active_project = null;?>
					<div class="projects-featured-project wrapper">
						<div class="featured-project wrapper right-column">
							<?php $projects_args = array('post_type'=>'post','order'=>'ASC','orderby'=>'name','posts_per_page'=>-1);
							if($type_from!==null)
								$projects_args['tax_query']=array(
									array(
										'taxonomy'=>'category',
										'field'=>'slug',
										'terms'=>$type_from->slug
									)
								);
							$reset = 0;
							$this_page_is_post = true;
							if ( $this_post):
								if(strcmp($post->post_type,"post")!==0):
									$this_page_is_post = false;
								else:
									$reset=1;
									$slug_of_active_project=$post->post_name;
								endif;
							else:
								$this_page_is_post = false;
							endif;
							if(!$this_page_is_post):
								$query = new WP_Query($projects_args);
								if($query->have_posts()):$query->the_post();$reset=1;$slug_of_active_project=$query->post->post_name;endif;
							endif;//endif for if have posts
							if($reset===1):?>
								<article class="featured-article">
									<header>
										<h2 class="title"><?php the_title();?></h2>
										<?php if(get_field("location")):?>
											<p class="location"><?php echo get_field("location");?></p>
										<?php endif;?>
									</header>
									<?php $images = get_field('gallery');
									if(is_array($images)&&!empty($images)):?>									
										<section class="gallery wrapper">
											<div class="featured-image wrapper">
												<img src="<?php echo $images[0]['url'];?>" alt="<?php echo $images[0]['title'];?>"> 
											</div><!--.featured-image .wrapper-->
											<div class="thumbnail wrapper clear-bottom">
												<?php $count = 0;
												foreach($images as $image):?>
													<div class="thumbnail false-margin wrapper <?php echo "count-".$count%5 ?>">
														<?php if($image == $images[0]):?>
															<div class="thumbnail active ">
														<?php else: ?>
															<div class="thumbnail">
														<?php endif; ?>
															<img data-full-url="<?php echo $image['url'];?>" src="<?php echo $image['sizes']['thumbnail'];?>" alt="<?php echo $image['title'];?>">
														</div><!--.thumbnail-->
													</div><!--.thumbnail .false.margin .wrapper -->
													<?php $count++;
												endforeach;?>
											</div><!--.thumbnail .wrapper-->
										</section><!--.gallery .wrapper-->
									<?php endif;?>
									<?php if(get_the_content()):?>
										<section class="copy">
											<?php the_content();?>
										</section><!--.copy-->
									<?php endif;?>
								</article><!--.featured-article-->
								<?php wp_reset_postdata();?>
							<?php endif;//endif for if reset 1?>
						</div><!--.featured-project .wrapper .right-column-->
						<?php if($post_obj!==null):?>
							<header class="mobile">
								<h3 class="sub-title"><?php echo "Other ".$post_obj->labels->name;?></h3>
							</header>
						<?php endif;?>
						<aside class="projects wrapper left-column">
							<?php $query = new WP_Query($projects_args);
							if($query->have_posts()):
								while($query->have_posts()):$query->the_post();
									if(strcmp($slug_of_active_project,$query->post->post_name)===0):?>
										<div class="project active">
									<?php else :?>
										<div class="project">
									<?php endif;?>
										<div class="image wrapper" style="background-image: url('<?php
											$images = get_field('gallery');
											if(is_array($images)&&!empty($images))
												echo $images[0]['sizes']['medium'];
										?>');">
										</div><!--.image .wrapper-->
										<div class="title-location wrapper">
											<h3 class="title"><?php echo get_the_title();?></h3>
											<?php if(get_field("location")):?>
												<p class="location"><?php echo get_field("location");?></p>
											<?php endif;?>
										</div><!--.title .wrapper-->
										<a href="<?php echo esc_url(add_query_arg('type_from',$type_from->slug,get_the_permalink()));?>" class="surrounding full-article"></a>
									</div><!--.project-->
								<?php endwhile;//endwhile for have projects
								wp_reset_postdata();
							endif;//end if for have projects?>
						</aside><!--.projects .wrapper .left-column-->
					</div><!--.projects-featured-project .wrapper-->
				</section><!--.projects-sub-title .wrapper-->
			</div><!--.portfolio-page .wrapper-->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
