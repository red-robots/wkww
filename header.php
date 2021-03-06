<?php
/**
 * The header for theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ACStarter
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php $ga = get_field("google_analytics","option");if($ga)echo $ga;?>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<header id="masthead" class="site-header" role="banner">
		<div class="wrapper">
			<div class="logo wrapper">
				<img src="<?php if(get_field("logo","option")):
                    $img = wp_get_attachment_image_src(get_field("logo","option"),"full");
                    if($img): 
                        echo $img[0];
                    endif;
                endif;?>" alt="WKWW Architects Logo" id="logo">
				<a href="<?php echo get_bloginfo("url");?>" class="surrounding"></a>
			</div><!--.logo .wrapper-->
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #site-navigation -->
			<div class="telephone-number">
				<?php if(get_field("telephone_number","option"))echo get_field("telephone_number","option");?> 
			</div><!--.telephone-number-->
		</div><!-- wrapper -->
	</header><!-- #masthead -->

	<div id="content" class="site-content wrapper">
