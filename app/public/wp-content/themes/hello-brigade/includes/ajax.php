<?php

/**
 * AJAX functions
 * 
 */


/**
 * This is just a boilerplate AJAX function
 *
 * @return void
 */
function test_ajax_function () {
    //
}
add_action( 'wp_ajax_test_ajax_function', 'test_ajax_function' );
add_action( 'wp_ajax_nopriv_test_ajax_function', 'test_ajax_function' );
