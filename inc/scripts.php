<?php
/**
 * Enqueue scripts and styles.
 */
function acstarter_scripts() {
	wp_enqueue_style( 'acstarter-style', get_stylesheet_uri() );

		
	wp_enqueue_script( 
			'acstarter-custom', 
			get_template_directory_uri() . '/js/custom.js', 
			array(), '20120206', 
			true 
		);

	wp_enqueue_script( 
			'acstarter-blocks', 
			get_template_directory_uri() . '/js/blocks.js', 
			array(), '20120206', 
			true 
		);

	wp_enqueue_script( 
			'acstarter-flexslider', 
			get_template_directory_uri() . '/js/flexslider.js', 
			array(), '20120206', 
			true 
		);

	wp_enqueue_script( 
			'acstarter-colorbox', 
			get_template_directory_uri() . '/js/colorbox.js', 
			array(), '20120206', 
			true 
		);

	wp_enqueue_script( 
			'acstarter-isotope', 
			get_template_directory_uri() . '/js/isotope.js', 
			array(), '20120206', 
			true 
		);

	wp_enqueue_script( 
			'acstarter-images-loaded', 
			get_template_directory_uri() . '/js/images-loaded.js', 
			array(), '20120206', 
			true 
		);


	wp_enqueue_script( 
			'acstarter-navigation', 
			get_template_directory_uri() . '/js/navigation.js', 
			array(), '20120206', 
			true 
		);

	wp_enqueue_script( 
			'acstarter-skip-link-focus-fix', 
			get_template_directory_uri() . '/js/skip-link-focus-fix.js', 
			array(), '20130115', 
			true 
		);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'acstarter_scripts' );