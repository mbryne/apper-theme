<?php

//
// HOOKS
//

add_action( 'apper_before_title', 'apper_before_title' );
add_filter( 'apper_before_content', 'apper_before_content' );
add_filter( 'apper_after_content', 'apper_after_content' );
add_action( 'body_class', 'apper_body_class' );

//
// FUNCTIONS
//

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
