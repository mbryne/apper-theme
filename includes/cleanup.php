<?php
//
//  HOOKS
//

add_action('init', 'apper_cleanup_head');
add_filter('wp_title', 'apper_cleanup_title', 10, 3);
add_filter('the_generator', 'apper_remove_rss_version');
add_filter('wp_head', 'apper_remove_wp_widget_recent_comments_style', 1);
add_action('wp_head', 'apper_remove_recent_comments_style', 1);
add_filter('gallery_style', 'apper_remove_gallery_style');
add_filter('the_content', 'apper_filter_ptags_on_images');
add_filter('excerpt_more', 'apper_excerpt_more');

//
//  BONES INHERITED THEME FUNCTIONS
//

function apper_cleanup_head()
{
    // remove_action( 'wp_head', 'feed_links_extra', 3 ); // category feeds
    // remove_action( 'wp_head', 'feed_links', 2 ); // post and comment feeds
    remove_action('wp_head', 'rsd_link'); // EditURI link
    remove_action('wp_head', 'wlwmanifest_link'); // windows live writer
    remove_action('wp_head', 'parent_post_rel_link', 10, 0); // previous link
    remove_action('wp_head', 'start_post_rel_link', 10, 0); // start link
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); // links for adjacent posts
    remove_action('wp_head', 'wp_generator'); // WP version
    add_filter('style_loader_src', 'apper_remove_wp_ver_css_js', 9999); // remove WP version from css
    add_filter('script_loader_src', 'apper_remove_wp_ver_css_js', 9999); // remove Wp version from scripts
}

function apper_cleanup_title($title, $sep, $seplocation)
{
    global $page, $paged;

    // Don't affect in feeds.
    if (is_feed()) return $title;

    // Add the blog's name
    if ('right' == $seplocation) {
        $title .= get_bloginfo('name');
    } else {
        $title = get_bloginfo('name') . $title;
    }

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo('description', 'display');

    if ($site_description && (is_home() || is_front_page())) {
        $title .= " {$sep} {$site_description}";
    }

    // Add a page number if necessary:
    if ($paged >= 2 || $page >= 2) {
        $title .= " {$sep} " . sprintf(__('Page %s', 'dbt'), max($paged, $page));
    }

    return $title;

}

function apper_remove_rss_version()
{
    return '';
}

function apper_remove_wp_ver_css_js($src)
{
    if (strpos($src, 'ver='))
        $src = remove_query_arg('ver', $src);
    return $src;
}

function apper_remove_wp_widget_recent_comments_style()
{
    if (has_filter('wp_head', 'wp_widget_recent_comments_style')) {
        remove_filter('wp_head', 'wp_widget_recent_comments_style');
    }
}

function apper_remove_recent_comments_style()
{
    global $wp_widget_factory;
    if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
        remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
    }
}

function apper_remove_gallery_style($css)
{
    return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

function apper_related_posts()
{
    echo '<ul id="bones-related-posts">';
    global $post;
    $tags = wp_get_post_tags($post->ID);
    if ($tags) {
        foreach ($tags as $tag) {
            $tag_arr .= $tag->slug . ',';
        }
        $args = array(
            'tag' => $tag_arr,
            'numberposts' => 5, /* you can change this to show more */
            'post__not_in' => array($post->ID)
        );
        $related_posts = get_posts($args);
        if ($related_posts) {
            foreach ($related_posts as $post) : setup_postdata($post); ?>
                <li class="related_post"><a class="entry-unrelated" href="<?php the_permalink() ?>"
                                            title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
            <?php endforeach;
        } else { ?>
            <?php echo '<li class="no_related_post">' . __('No Related Posts Yet!', 'apper') . '</li>'; ?>
        <?php }
    }
    wp_reset_postdata();
    echo '</ul>';
}

function apper_page_navigation()
{
    global $wp_query;
    $bignum = 999999999;
    if ($wp_query->max_num_pages <= 1)
        return;
    echo '<nav class="pagination">';
    echo paginate_links(array(
        'base' => str_replace($bignum, '%#%', esc_url(get_pagenum_link($bignum))),
        'format' => '',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_text' => '&larr;',
        'next_text' => '&rarr;',
        'type' => 'list',
        'end_size' => 3,
        'mid_size' => 3
    ));
    echo '</nav>';
}

function apper_filter_ptags_on_images($content)
{
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This removes the annoying […] to a Read More link
function apper_excerpt_more($more)
{
    global $post;
    // edit here if you like
    return '...  <a class="excerpt-read-more" href="' . get_permalink($post->ID) . '" title="' . __('Read ', 'apper') . esc_attr(get_the_title($post->ID)) . '">' . __('Read more &raquo;', 'apper') . '</a>';
}


function apper_comments($comment, $args, $depth) {

    $GLOBALS['comment'] = $comment;

?>

    <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
        <article class="cf">
            <header class="comment-author vcard">
                <?php
                // create variable
                $bgauthemail = get_comment_author_email();
                ?>
                <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=40"
                     class="load-gravatar avatar avatar-48 photo" height="40" width="40"
                     src="<?php echo get_stylesheet_directory_uri(); ?>/library/images/nothing.gif"/>
                <?php // end custom gravatar call ?>
                <?php printf(__('<cite class="fn">%1$s</cite> %2$s', 'apper'), get_comment_author_link(), edit_comment_link(__('(Edit)', 'apper'), '  ', '')) ?>
                <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a
                        href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>"><?php comment_time(__('F jS, Y', 'apper')); ?> </a>
                </time>

            </header>
            <?php if ($comment->comment_approved == '0') : ?>
                <div class="alert alert-info">
                    <p><?php _e('Your comment is awaiting moderation.', 'apper') ?></p>
                </div>
            <?php endif; ?>
            <section class="comment_content cf">
                <?php comment_text() ?>
            </section>
            <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </article>
        <?php // </li> is added by WordPress automatically ?>
        <?php

    } // don't remove this bracket!

?>
