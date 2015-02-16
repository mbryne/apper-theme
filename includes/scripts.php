<?php

//
// HOOKS
//

add_action( 'wp_enqueue_scripts', 'apper_enqueue_scripts');

//
// FUNCTIONS
//

function apper_enqueue_scripts()
{

    global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

    if (!is_admin()) {

        //  stylesheets
        wp_register_style('apper-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', array(), '', 'all');
        wp_register_style('apper-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array(), '');

        //  scripts
        wp_register_script('apper-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array('jquery'), '', true);

        //  fonts
        wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');
        //wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600');

        // modernizr (without media query polyfill)
        wp_register_script('apper-modernizr', get_stylesheet_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '2.5.3', false);

        // comment reply script for threaded comments
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }

        // enqueue styles and scripts
        wp_enqueue_script('apper-modernizr');
        wp_enqueue_script('jquery');
        wp_enqueue_script('apper-js');
        wp_enqueue_style('apper-stylesheet');
        wp_enqueue_style('apper-ie-only');
        $wp_styles->add_data('apper-ie-only', 'conditional', 'lt IE 9'); // add conditional wrapper around ie stylesheet

    }

}
