<?php
//
// HOOKS
//

add_action( 'after_setup_theme', 'apper_setup_theme');

//
// FUNCTIONS
//

function apper_setup_theme()
{

    add_editor_style(get_stylesheet_directory_uri() . '/library/css/editor-style.css');

    //  theme support
    set_post_thumbnail_size(125, 125, true);
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('menus');
    add_theme_support('html5', array(
        'comment-list',
        'search-form',
        'comment-form'
    ));

    // menus
    register_nav_menus(
        array(
            'main-nav' => __('Main Menu', 'apper'),   // main nav in header
            'footer-menu' => __('Footer Menu', 'apper') // secondary nav in footer
        )
    );



}
