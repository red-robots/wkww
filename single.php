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
			<header>
				<?php $args = array('taxonomy'=>"category",'order'=>'DESC','orderby'=>'name','hide_empty'=>0,'exclude'=>array(1));
				$project_types = get_terms($args);
				$query_from = get_query_var('type_from',null);
				$category_name = get_query_var("category_name",null);
				if($category_name!==null):
					$args['slug'] = $category_name;
				else:
					if($query_from!==null)
						$args['slug'] = $query_from;
				endif;//endif for query from !== null
				$types_from = get_terms($args);
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
									<a href="<?php echo esc_url(add_query_arg('type_from',$type_from->slug,get_term_link($type->term_id)));?>"><?php echo $type->name; ?></a>
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
				<div class="copy project-type description">
					<?php echo $type_from->description; ?>
				</div><!--.copy .project-type .description-->
			<?php endif;//endif for type from !== null?>
			<div class="projects-sub-title wrapper">
				<h2 class="sub-title"><?php $post_obj = get_post_type_object('post');
				if($post_obj!==null)echo $post_obj->labels->name;?></h2>
				<?php $post_type = get_query_var('post_type',null);?>
				<div class="projects-featured-project wrapper">
					<div class="projects wrapper left-column">
						<?php $projects_args = array('post_type'=>'post','order'=>'ASC','orderby'=>'name','posts_per_page'=>-1);
						if($type_from!==null)
							$projects_args['tax_query']=array(
								array(
									'taxonomy'=>'category',
									'field'=>'slug',
									'terms'=>$type_from->slug
								)
							);
						$query = new WP_Query($projects_args);
						if($query->have_posts()):
							while($query->have_posts()):$query->the_post();?>
								<div class="project">
									<div class="image wrapper js-blocks" style="background-image: url('<?php
										$images = get_field('gallery');
										if(is_array($images)&&!empty($images))
											echo $images[0]['sizes']['medium'];
									?>');">
									</div><!--.image .wrapper-->
									<div class="title wrapper js-blocks">
										<h3 class="title"><?php echo get_the_title();?></h3>
										<?php if(get_field("location")):?>
											<p class="location"><?php echo get_field("location");?></p>
										<?php endif;?>
									</div><!--.title .wrapper-->
									<a href="<?php echo get_the_permalink();?>" class="surrounding full-article"></a>
								</div><!--.project-->
							<?php endwhile;//endwhile for have projects
							wp_reset_postdata();
						endif;//end if for have projects?>
					</div><!--.projects .wrapper .left-column-->
					<div class="featured-project wrapper right-column">
						<?php $reset = 0;
						if($post_type===null||strcmp($post_type,'post')!==0):
							$query = new WP_Query($projects_args);
							if($query->have_posts()):$query->the_post();$reset=1;endif;?>
						<?php else:?>
							<?php if ( have_posts() ): the_post();$reset=1;endif;?>
						<?php endif;//endif for if post type is null?>
						<?php if($reset===1):?>
							<header>
								<h2 class="title"><?php the_title();?></h2>
								<?php if(get_field("location")):?>
									<p class="location"><?php echo get_field("location");?></p>
								<?php endif;?>
							</header>
							<?php $images = get_field('gallery');
							if(is_array($images)&&!empty($images)):?>									
								<div class="gallery wrapper">
									<div class="featured-image wrapper">
										<img src="<?php echo $images[0]['url'];?>" alt="<?php echo $images[0]['title'];?>"> 
									</div><!--.featured-image .wrapper-->
									<div class="thumbnail wrapper">
										<?php foreach($images as $image):?>
											<div class="thumbnail">		
												<img src="<?php echo $image['url'];?>" alt="<?php echo $image['title'];?>">
											</div><!--.thumbnail-->
										<?php endforeach;?>
									</div><!--.thumbnail .wrapper-->
								</div><!--.gallery .wrapper-->
							<?php endif;?>
							<?php if(get_the_content()):?>
								<div class="copy">
									<?php the_content();?>
								</div><!--.copy-->
							<?php endif;?>
							<?php wp_reset_postdata();?>
						<?php endif;//endif for if reset 1?>
					</div><!--.featured-project .wrapper .right-column-->
				</div><!--.projects-featured-project .wrapper-->
			</div><!--.projects-sub-title .wrapper-->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
