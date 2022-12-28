<?php

/**
 * Functions/Hooks related to ACF
 * 
 */


// For setting up option pages
function hello_brigade_options_sub_page() {

    // Check function exists.
    if( function_exists('acf_add_options_sub_page') ) {

        // Add sub page under Appearance.
        $child = acf_add_options_sub_page(array(
            'page_title'    => __('Promos'),
            'menu_title'    => __('Promos'),
            'parent_slug'   => 'edit.php?post_type=product',
            'position'      => '22'
        ));
    }
}
//add_action('acf/init', 'hello_brigade_options_sub_page');
