<?php
namespace Steroids;

defined('ABSPATH') || exit;
require dirname(__DIR__, 4) . '/vendor/autoload.php';

/*
 * The functions defined below are meant to be called directly in the templates
 */

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function print_pagination() {
    global $wp_query;

    echo paginate_links([
        'format' => 'page/%#%/',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ]);
}

// Custom View Article link to Post
function print_view_article($more) {
    global $post;
    return '… <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'steroids') . '</a>';
}
// add_filter('excerpt_more', 'Steroids\print_view_article');

// If posts (or anything) are saved in Md, this ƒn will convert it into HTML
// To be used with get_the_content (for posts/pages) because the_content echoes instead of returning
// Alse be carefull because the_content doesn't any sanitisation (you can apply them later on if required)
function parse_markdown($content, $echo = false) {
    $Parsedown = new \Parsedown();

    if ($echo) echo $Parsedown->text(wptexturize($content));
    return $Parsedown->text(wptexturize($content));
}
