<?php

if (false === strpos(get_site_url(), 'wordpress.dev')) {
    add_filter('ot_show_pages', '__return_false');
    add_filter('ot_show_new_layout', '__return_false');    
} else {
    add_filter('ot_show_new_layout', '__return_true');
    add_filter('ot_show_pages', '__return_true');
}

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Required: include OptionTree.
 */
load_template( __DIR__. '/../option-tree/ot-loader.php' );
load_template(__DIR__.'/theme-options.php');

function ot_custom_style()
{
    //wp_register_style('custom_wp_admin_css', get_template_directory_uri() . '/option-tree/option-tree-custom/option-tree-custom.css', false, '1.0.0');
    //wp_enqueue_style('custom_wp_admin_css');
}

add_action('admin_head', 'ot_custom_style');

?>