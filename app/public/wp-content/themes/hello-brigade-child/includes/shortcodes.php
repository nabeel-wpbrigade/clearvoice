<?php

/**
 * Contains all the shortcodes
 * 
 */


if ( ! function_exists('brigadechild_current_year_shortcode') ) {
	/**
	 * Get the current year.
	 *
	 * @return string
	 */
	function brigadechild_current_year_shortcode() {
		return date( "Y" );
	}
}
add_shortcode( 'brigadechild_current_year', 'brigadechild_current_year_shortcode' );

