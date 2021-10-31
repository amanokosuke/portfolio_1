<?php
//アイキャッチ画像 -------------------
add_theme_support('post-thumbnails');
set_post_thumbnail_size(260, 110, true);

add_action('pre_get_posts', 'add_post_tag_archive', 10, 1);
function add_post_tag_archive($wp_query) {
    if ($wp_query->is_main_query() && $wp_query->is_tag()) {
        $wp_query->set('post_type', [
            'post',
            'service'
        ]);
    }
}