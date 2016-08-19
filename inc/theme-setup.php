<?php 
if ( ! function_exists( 'acstarter_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function acstarter_setup() {
  /*
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   * If you're building a theme based on ACStarter, use a find and replace
   * to change 'acstarter' to the name of your theme in all the template files.
   */
  load_theme_textdomain( 'acstarter', get_template_directory() . '/languages' );

  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );

  /*
   * Enable support for Post Thumbnails on posts and pages.
   *
   * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
   */
  add_theme_support( 'post-thumbnails' );

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'footer' => esc_html__('footer'),
    'primary' => esc_html__( 'Primary', 'acstarter' ),
    'sitemap' => esc_html__( 'Sitemap', 'acstarter' ),
  ) );

  /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ) );

  /*
   * Enable support for Post Formats.
   * See https://developer.wordpress.org/themes/functionality/post-formats/
   */
  // add_theme_support( 'post-formats', array(
  //  'aside',
  //  'image',
  //  'video',
  //  'quote',
  //  'link',
  // ) );

  // Set up the WordPress core custom background feature.
  add_theme_support( 'custom-background', apply_filters( 'acstarter_custom_background_args', array(
    'default-color' => 'ffffff',
    'default-image' => '',
  ) ) );
}
endif;
add_action( 'after_setup_theme', 'acstarter_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function acstarter_content_width() {
  $GLOBALS['content_width'] = apply_filters( 'acstarter_content_width', 640 );
}
add_action( 'after_setup_theme', 'acstarter_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function acstarter_widgets_init() {
  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar', 'acstarter' ),
    'id'            => 'sidebar-1',
    'description'   => '',
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
  
  
function custom_get_pagenum_link($custom_url, $pagenum = 1, $escape = true ) {
    global $wp_rewrite;
 
    $pagenum = (int) $pagenum;
    $root = home_url();
    $custom_url = str_replace($root,'',$custom_url);
    $request = $custom_url;
 
    $home_root = parse_url(home_url());
    $home_root = ( isset($home_root['path']) ) ? $home_root['path'] : '';
    $home_root = preg_quote( $home_root, '|' );
 
    $request = preg_replace('|^'. $home_root . '|i', '', $request);
    $request = preg_replace('|^/+|', '', $request);
 
    if ( !$wp_rewrite->using_permalinks() || is_admin() ) {
        $base = trailingslashit( get_bloginfo( 'url' ) );
 
        if ( $pagenum > 1 ) {
            $result = add_query_arg( 'paged', $pagenum, $base . $request );
        } else {
            $result = $base . $request;
        }
    } else {
        $qs_regex = '|\?.*?$|';
        preg_match( $qs_regex, $request, $qs_match );
 
        if ( !empty( $qs_match[0] ) ) {
            $query_string = $qs_match[0];
            $request = preg_replace( $qs_regex, '', $request );
        } else {
            $query_string = '';
        }
 
        $request = preg_replace( "|$wp_rewrite->pagination_base/\d+/?$|", '', $request);
        $request = preg_replace( '|^' . preg_quote( $wp_rewrite->index, '|' ) . '|i', '', $request);
        $request = ltrim($request, '/');
 
        $base = trailingslashit( get_bloginfo( 'url' ) );
 
        if ( $wp_rewrite->using_index_permalinks() && ( $pagenum > 1 || '' != $request ) )
            $base .= $wp_rewrite->index . '/';
 
        if ( $pagenum > 1 ) {
            $request = ( ( !empty( $request ) ) ? trailingslashit( $request ) : $request ) . user_trailingslashit( $wp_rewrite->pagination_base . "/" . $pagenum, 'paged' );
        }
 
        $result = $base . $request . $query_string;
    }
 
    /**
     * Filters the page number link for the current request.
     *
     * @since 2.5.0
     *
     * @param string $result The page number link.
     */
    $result = apply_filters( 'get_pagenum_link', $result );
 
    if ( $escape )
        return esc_url( $result );
    else
        return esc_url_raw( $result );
}



}
add_action( 'widgets_init', 'acstarter_widgets_init' );
