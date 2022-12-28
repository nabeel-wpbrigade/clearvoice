<?php
/**
 * Theme functions and definitions
 *
 * @package HelloBrigade
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_BRIGADE_VERSION', '2.3.1' );

define( 'HELLO_BRIGADE_URI', get_template_directory_uri() );

define( 'HELLO_BRIGADE_DIR', get_template_directory() );
define( 'HELLO_BRIGADE_INC_DIR', HELLO_BRIGADE_DIR . '/includes/' );


// General functions
require_once HELLO_BRIGADE_INC_DIR . '/general-functions.php';

// Theme setup and script/style enqueue
require_once HELLO_BRIGADE_INC_DIR . '/theme.php';

// WP actions/filters
require_once HELLO_BRIGADE_INC_DIR . '/wp-hooks.php';

// Functions/Hooks related to ACF
require_once HELLO_BRIGADE_INC_DIR . '/acf.php';

// AJAX functions
require_once HELLO_BRIGADE_INC_DIR . '/ajax.php';

// Gravity Forms Hooks
require_once HELLO_BRIGADE_INC_DIR . '/gform.php';

// Contains all the shortcodes
require_once HELLO_BRIGADE_INC_DIR . '/shortcodes.php';

// Admin functions
if ( is_admin() ) {
	require_once HELLO_BRIGADE_INC_DIR . '/admin-functions.php';
}


if ( ! isset( $content_width ) ) {
	$content_width = 800; // Pixels.
}
