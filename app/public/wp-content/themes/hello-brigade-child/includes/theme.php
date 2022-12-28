<?php

/**
 * Theme setup, support and script/style enqueue
 * 
 */

if ( ! function_exists( 'brigadechild_scripts_styles' ) ) {
	
	/**
	 * Theme Scripts & Styles.
	 *
	 * @return void
	 */
	function brigadechild_scripts_styles() {

		// dequeue some scripts loaded by 'hello-brigade'
		wp_dequeue_script( 'jquery-match-height-js' );
		wp_dequeue_script( 'hello-brigade-main-js' );

		wp_enqueue_style(
			'brigadechild',
			BRIGADECHILD_THEME_URI . '/style.css',
			[],
			BRIGADECHILD_THEME_VERSION
		);

		// wp_enqueue_style(
		// 	'brigadechild-google-fonts',
		// 	'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Poppins:wght@500;600;700&display=swap',
		// 	[],
		// 	NULL
		// );
	
		wp_enqueue_style(
			'brigadechild-main',
			BRIGADECHILD_THEME_URI . '/assets/css/main.css',
			[],
			BRIGADECHILD_THEME_VERSION
		);
				
		// jQuery iScroll
		wp_enqueue_script(
			'brigadechild-main',
			BRIGADECHILD_THEME_URI . '/assets/js/main.js',
			array( 'jquery' ),
			BRIGADECHILD_THEME_VERSION,
			true
		);

	}
}
add_action( 'wp_enqueue_scripts', 'brigadechild_scripts_styles', 200 );


/**
 * Register sidebars
 * 
 */
if ( ! function_exists( 'brigadechild_widgets_init' ) ) {
	function brigadechild_widgets_init() {
		
		// this is just a boilerplate
		/*register_sidebar( array(
			'name'          => __( 'Sidebar Name', 'brigadechild' ),
			'id'            => 'sidebar-id',
			'description'   => __( 'Some description', 'brigadechild' ),
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h2 class="heading">',
			'after_title'   => '</h2>',
		) );*/
	}
}
//add_action( 'widgets_init', 'brigadechild_widgets_init' );
