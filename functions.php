<?php
/*
Author: Michael Bryne
https://github.com/mbryne/apper-theme
*/

//
// INCLUDES
//

//  apper library
require_once('library/apper.php');

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );

//
// HOOKS
//

add_action( 'wp_enqueue_scripts', 'apper_enqueue_scripts', 999);
add_action( 'after_setup_theme', 'apper_load');
add_action( 'apper_before_title', 'apper_before_title' ); 
add_filter( 'apper_before_content', 'apper_before_content' );
add_filter( 'apper_after_content', 'apper_after_content' );
add_action( 'body_class', 'apper_body_class' );

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

function apper_load()
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

    //  sidebars
    add_action('widgets_init', 'apper_register_sidebars');

    //  cleanup
    add_action('init', 'apper_cleanup_head');
    add_filter('wp_title', 'apper_cleanup_title', 10, 3);
    add_filter('the_generator', 'apper_remove_rss_version');
    add_filter('wp_head', 'apper_remove_wp_widget_recent_comments_style', 1);
    add_action('wp_head', 'apper_remove_recent_comments_style', 1);
    add_filter('gallery_style', 'apper_remove_gallery_style');
    add_filter('the_content', 'apper_filter_ptags_on_images');
    add_filter('excerpt_more', 'apper_excerpt_more');

}

function apper_register_sidebars()
{
    register_sidebar(array(
        'id' => 'sidebar1',
        'name' => __('Main Sidebar', 'apper'),
        'description' => __('The first sidebar.', 'apper'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));

}

function apper_template_part_name( $section = 'pages', $path = null ) {

    if ($path == null)
        $path = current_path_processed();

    $partial = "content/" . $section . '/' . $path;
    if ( $partial == 'content/' . $section . '/')
        $partial .= "home";

    return $partial;
}

function apper_before_title($content)
{
    get_template_part( apper_template_part_name('header') );
}

function apper_before_content($content)
{

    get_template_part( apper_template_part_name() );
}

function apper_after_content($content)
{
    get_template_part( apper_template_part_name('footer') );
}

function apper_body_class($classes)
{
    if (is_page())
        $classes[] = 'path-' . current_path_processed();
    elseif (is_singular())
        $classes[] = 'path-' . current_path_processed();

    return $classes;
}

if (!isset($content_width))
    $content_width = 920;

