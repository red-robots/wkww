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
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<?php $post = get_post(2);
setup_postdata($post);?>

<body <?php body_class(); ?>>
<div id="page-home" class="site" <?php if(get_field("background"))echo 'style="background-image: url(\''.wp_get_attachment_image_src(get_field("background"),"full")[0].'\');"'?>>
	<div id="content" class="site-content wrapper">
