<?php
/**
 * Custom theme functions.
 *
 * 
 *
 * @package ACStarter
 */

/*-------------------------------------
	Custom client login, link and title.
---------------------------------------*/
define( 'DISALLOW_FILE_EDIT', true );
function my_login_logo() { ?>
<style type="text/css">
  body.login div#login h1 a {
  	background-image: url(<?php $img = wp_get_attachment_image_src(79,"full"); echo $img[0];?>);
  	background-size: 327px 100px;
  	width: 327px;
  	height: 100px;
  }
</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

// Change Link
function loginpage_custom_link() {
	return the_permalink();
}
add_filter('login_headerurl','loginpage_custom_link');

/*
 *
 */
function custom_background() {?>
<style type="text/css">
  #page-home {
		<?php if(get_field("background_mobile",2)):?>
	  	background-image: url(<?php $img = wp_get_attachment_image_src(get_field("background_mobile",2),"full"); echo $img[0];?>);
		<?php else: if(get_field("background",2))?>
				background-image: url(<?php $img = wp_get_attachment_image_src(get_field("background",2),"full"); echo $img[0];?>);
		<?php endif;?>
  }
	@media screen and (min-width: 500px){
		#page-home {
			<?php if(get_field("background",2)):?>
				background-image: url(<?php $img = wp_get_attachment_image_src(get_field("background",2),"full"); echo $img[0];?>);			
			<?php endif;?>
		}
	}
			
</style>
<?php }
add_action('wp_head', 'custom_background');
/*-------------------------------------
	Favicon.
---------------------------------------*/
function mytheme_favicon() { 
 echo '<link rel="shortcut icon" href="' . get_bloginfo('stylesheet_directory') . '/images/favicon.ico" >'; 
} 
add_action('wp_head', 'mytheme_favicon');

/*-------------------------------------
	Font Awesome
---------------------------------------*/
function mytheme_fontawesome() { 
 echo '<script src="https://use.fontawesome.com/4945cee666.js"></script>'; 
} 
add_action('wp_head', 'mytheme_fontawesome');
/*-------------------------------------
	Adds Options page for ACF.
---------------------------------------*/
if( function_exists('acf_add_options_page') ) {acf_add_options_page();}

/*-------------------------------------
  Hide Front End Admin Menu Bar
---------------------------------------*/
if ( ! current_user_can( 'manage_options' ) ) {
    show_admin_bar( false );
}
/*-------------------------------------
  Custom WYSIWYG Styles

  If you are using the Plugin: MRW Web Design Simple TinyMCE

  Keep this commented out to keep from getting duplicate "Format" dropdowns

---------------------------------------*/
// function acc_custom_styles($buttons) {
//   array_unshift($buttons, 'styleselect');
//   return $buttons;
// }
// add_filter('mce_buttons_2', 'acc_custom_styles');


/*
* Callback function to filter the MCE settings


  But always use this to get the custom formats

*/
 
function my_mce_before_init_insert_formats( $init_array ) {  
 
// Define the style_formats array
 
  $style_formats = array(  
    // Each array child is a format with it's own settings
    array(  
      'title' => 'Custom Color',  
      'block' => 'span',  
      'classes' => 'custom-color',
      'wrapper' => true,
      
    )
  );  
  // Insert the array, JSON ENCODED, into 'style_formats'
  $init_array['style_formats'] = json_encode( $style_formats );  
  
  return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 
// Add styles to WYSIWYG in your theme's editor-style.css file
function my_theme_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );
/*-------------------------------------
  Change Admin Labels
---------------------------------------*/
function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Projects';
    $submenu['edit.php'][5][0] = 'Projects';
    $submenu['edit.php'][10][0] = 'Add Project';
    $submenu['edit.php'][15][0] = 'Project Type'; // Change name for categories
    //$submenu['edit.php'][16][0] = 'Labels'; // Change name for tags
    echo '';
}

function change_post_object_label() {
        global $wp_post_types;
        $labels = &$wp_post_types['post']->labels;
        $labels->name = 'Projects';
        $labels->singular_name = 'Project';
        $labels->add_new = 'Add Project';
        $labels->add_new_item = 'Add Project';
        $labels->edit_item = 'Edit Project';
        $labels->new_item = 'Project';
        $labels->view_item = 'View Project';
        $labels->search_items = 'Search Projects';
        $labels->not_found = 'No Projects found';
        $labels->not_found_in_trash = 'No Projects found in Trash';
    
				//remove post_tags for all post types
				register_taxonomy('post_tag','');
		}
add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );

/*-------------------------------------
  Add a last and first menu class option
---------------------------------------*/

function ac_first_and_last_menu_class($items) {
  foreach($items as $k => $v){
    $parent[$v->menu_item_parent][] = $v;
  }
  foreach($parent as $k => $v){
    $v[0]->classes[] = 'first';
    $v[count($v)-1]->classes[] = 'last';
  }
  return $items;
}
add_filter('wp_nav_menu_objects', 'ac_first_and_last_menu_class');
