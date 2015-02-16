<?php
//
//  HOOKS
//

add_action('widgets_init', 'apper_register_sidebars');

//
//  FUNCTIONS
//

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