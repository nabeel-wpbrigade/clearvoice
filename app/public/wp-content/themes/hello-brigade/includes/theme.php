<?php

/**
 * Theme setup, support and script/style enqueue
 * 
 */


if ( ! function_exists( 'hello_brigade_setup' ) ) {
	/**
	 * Set up theme support.
	 *
	 * @return void
	 */
	function hello_brigade_setup() {

		// boilerplate for adding a new image size
		//add_image_size( 'gallery-thumbnails', 540, 540 );

		$hook_result = apply_filters_deprecated( 'elementor_hello_theme_register_menus', [ true ], '2.0', 'hello_brigade_register_menus' );
		if ( apply_filters( 'hello_brigade_register_menus', $hook_result ) ) {
			register_nav_menus( array( 'menu-1' => __( 'Primary', 'hello-brigade' ) ) );
		}

		$hook_result = apply_filters_deprecated( 'elementor_hello_theme_add_theme_support', [ true ], '2.0', 'hello_brigade_add_theme_support' );
		if ( apply_filters( 'hello_brigade_add_theme_support', $hook_result ) ) {
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'title-tag' );
			add_theme_support(
				'html5',
				array(
					'search-form',
					'gallery',
					'caption',
				)
			);

			/*
			 * Editor Style.
			 */
			add_editor_style( 'editor-style.css' );
			
			/*
			 * Gutenberg wide images.
			 */
			add_theme_support( 'align-wide' );

			/*
			 * WooCommerce.
			 */
			$hook_result = apply_filters_deprecated( 'elementor_hello_theme_add_woocommerce_support', [ true ], '2.0', 'hello_brigade_add_woocommerce_support' );
			if ( apply_filters( 'hello_brigade_add_woocommerce_support', $hook_result ) ) {
				// WooCommerce in general.
				//add_theme_support( 'woocommerce' );
				// Enabling WooCommerce product gallery features (are off by default since WC 3.0.0).
				// zoom.
				//add_theme_support( 'wc-product-gallery-zoom' );
				// lightbox.
				//add_theme_support( 'wc-product-gallery-lightbox' );
				// swipe.
				//add_theme_support( 'wc-product-gallery-slider' );
			}
		}
	}
}
add_action( 'after_setup_theme', 'hello_brigade_setup' );


if ( ! function_exists( 'hello_brigade_scripts_styles' ) ) {
	/**
	 * Theme Scripts & Styles.
	 *
	 * @return void
	 */
	function hello_brigade_scripts_styles() {
		$enqueue_basic_style = apply_filters_deprecated( 'elementor_hello_theme_enqueue_style', [ true ], '2.0', 'hello_brigade_enqueue_style' );

		if ( apply_filters( 'hello_brigade_enqueue_style', $enqueue_basic_style ) ) {
			wp_enqueue_style(
				'hello-brigade',
				HELLO_BRIGADE_URI . '/assets/css/style.css',
				[],
				HELLO_BRIGADE_VERSION
			);
		}

		if ( apply_filters( 'hello_brigade_enqueue_theme_style', true ) ) {
			wp_enqueue_style(
				'hello-brigade-theme-style',
				HELLO_BRIGADE_URI . '/theme.css',
				[],
				HELLO_BRIGADE_VERSION
			);
		}

		// jQuery match height 
		wp_enqueue_script(
			'jquery-match-height',
			HELLO_BRIGADE_URI . '/assets/vendor/jquery-match-height.js',
			array( 'jquery' ),
			'0.7.2',
			true
		);

		// jQuery iScroll
		wp_enqueue_script(
			'jquery-iscroll',
			HELLO_BRIGADE_URI . '/assets/js/main.js',
			array( 'jquery' ),
			'1.0.0',
			true
		);
				
		// jQuery Main
		// wp_enqueue_script(
		// 	'hello-brigade-main',
		// 	HELLO_BRIGADE_URI . '/assets/js/main.js',
		// 	array( 'jquery', 'jquery-match-height', 'jquery-iscroll' ),
		// 	HELLO_BRIGADE_VERSION,
		// 	true
		// );

	}
}
add_action( 'wp_enqueue_scripts', 'hello_brigade_scripts_styles' );


/**
 * Register sidebars
 * 
 */
if ( ! function_exists( 'hello_brigade_widgets_init' ) ) {
	function hello_brigade_widgets_init() {
		
		// this is just a boilerplate
		/*register_sidebar( array(
			'name'          => __( 'Sidebar Name', 'hello-brigade' ),
			'id'            => 'sidebar-id',
			'description'   => __( 'Some description', 'hello-brigade' ),
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h2 class="heading">',
			'after_title'   => '</h2>',
		) );*/
	}
}
add_action( 'widgets_init', 'hello_brigade_widgets_init' );


if ( ! function_exists( 'hello_brigade_register_elementor_locations' ) ) {
	/**
	 * Register Elementor Locations.
	 *
	 * @param ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager theme manager.
	 *
	 * @return void
	 */
	function hello_brigade_register_elementor_locations( $elementor_theme_manager ) {
		$hook_result = apply_filters_deprecated( 'elementor_hello_theme_register_elementor_locations', [ true ], '2.0', 'hello_brigade_register_elementor_locations' );
		if ( apply_filters( 'hello_brigade_register_elementor_locations', $hook_result ) ) {
			$elementor_theme_manager->register_all_core_location();
		}
	}
}
add_action( 'elementor/theme/register_locations', 'hello_brigade_register_elementor_locations' );


if ( ! function_exists( 'hello_brigade_content_width' ) ) {
	/**
	 * Set default content width.
	 *
	 * @return void
	 */
	function hello_brigade_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'hello_brigade_content_width', 800 );
	}
}
add_action( 'after_setup_theme', 'hello_brigade_content_width', 0 );


if ( ! function_exists( 'hello_brigade_check_hide_title' ) ) {
	/**
	 * Check hide title.
	 *
	 * @param bool $val default value.
	 *
	 * @return bool
	 */
	function hello_brigade_check_hide_title( $val ) {
		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			$current_doc = \Elementor\Plugin::instance()->documents->get( get_the_ID() );
			if ( $current_doc && 'yes' === $current_doc->get_settings( 'hide_title' ) ) {
				$val = false;
			}
		}
		return $val;
	}
}
add_filter( 'hello_brigade_page_title', 'hello_brigade_check_hide_title' );


/**
 * Wrapper function to deal with backwards compatibility.
 */
if ( ! function_exists( 'hello_brigade_body_open' ) ) {
	function hello_brigade_body_open() {
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open();
		} else {
			do_action( 'wp_body_open' );
		}
	}
}
