<?php
add_action('widgets_init', function () {
    register_sidebar([
        'id' => 'carousel',
        'name' => 'carousel',
        'description' => 'カルーセルのためのウィジェットです。',
    ]);
});

// WordPress Popular Postsカスタマイズ
/**
 * @param $post_html
 * @param $p
 * @param $instance
 * @return string
 */
function my_custom_popular_post($post_html, $p, $instance) {
    $thumbnail_id = get_post_thumbnail_id($p->id);
    $thumbnail_img = wp_get_attachment_image_src($thumbnail_id, 'wpp_thumbnails');
    $article_types = get_the_terms($p->id, "article_type", true);
    $title = $p->post_title;
    if (count($article_types) > 0) {
        $article_type = $article_types[0]->slug;
        if ($article_type == 'service_category_type' ||
            $article_type == 'service_category_article_list_type' ||
            $article_type == 'service_subcategory_type' ||
            $article_type == 'service_subcategory_article_list_type'
        ) {
            $title = get_post_meta($p->id, "category_name", true);
        }
        if ($article_type == 'service_subcategory_article_type' ||
            $article_type == 'service_article_type' ||
            $article_type == 'service_client_article_type'
        ) {
            $title = get_post_meta($p->id, "article_name", true);
        }
    }

    $views = wpp_get_views($p->id, 'monthly', true);
    $output = '<li>
    <div class="weekly_rank_row">
        <div class="weekly_rank_photo">
            <a href="' . get_the_permalink($p->id) . '" title="' . $title . '">
                <img src="' . $thumbnail_img[0] . '" width="80">
            </a>
        </div>
        <div class="weekly_rank_title">
            <a href="' . get_the_permalink($p->id) . '" " title="' . $title . '">
                <p>' . $title . '</p>
            </a>
        </div>
    </div>
    </li>';
    return $output;
}

add_filter('wpp_post', 'my_custom_popular_post', 10, 3);

//サイドバーを1つ設置する
register_sidebar([
    'name' => 'サイドバー',
    'before_widget' => '<div class="sidebar-wrapper">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="sidebar-title">',
    'after_title' => '</h4>'
]);

add_action('widgets_init', function () {
    register_sidebar([
        'id' => 'carousel',
        'name' => 'carousel',
        'description' => 'カルーセルのためのウィジェットです。',
    ]);
});