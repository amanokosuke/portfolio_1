<?php

/**
 * サービスカテゴリー取得
 * @param $slug
 * @return mixed
 */
function get_service_category_by_slug($slug) {
    $taxonomies = [
        'service_category'
    ];
    $args = [
        'orderby' => 'description',
        'order' => 'ASC',
        'hide_empty' => false,
        //        'exclude'       => array(),
        //        'exclude_tree'  => array(),
        //        'include'       => array(),
        //        'number'        => '',
        //        'fields'        => 'all',
        'slug' => $slug,
        //        'parent' => $parent,
        //        'hierarchical'  => true,
        //        'child_of'      => 0,
        //        'childless'     => false,
        //        'get'           => '',
        //        'name__like'    => '',
        //        'description__like' => '',
        //        'pad_counts'    => false,
        //        'offset'        => '',
        //        'search'        => '',
        //        'cache_domain'  => 'core'
    ];

    return get_terms($taxonomies, $args);
}

/**
 * サービスカテゴリー取得
 * @param $term_id term_id
 * @return mixed
 */
function get_service_category_by_id($term_id) {
    $taxonomies = [
        'service_category'
    ];

    $args = [
        'orderby' => 'description',
        'order' => 'ASC',
        'hide_empty' => false,
        //        'exclude'       => array(),
        //        'exclude_tree'  => array(),
        'include' => [$term_id],
        //        'number'        => '',
        //        'fields'        => 'all',
        //        'slug'          => $slug,
        //        'parent' => $parent,
        //        'hierarchical'  => true,
        //        'child_of'      => 0,
        //        'childless'     => false,
        //        'get'           => '',
        //        'name__like'    => '',
        //        'description__like' => '',
        //        'pad_counts'    => false,
        //        'offset'        => '',
        //        'search'        => '',
        //        'cache_domain'  => 'core'
    ];

    return get_terms($taxonomies, $args);
}

/**
 * サービス子カテゴリー取得
 * @param string $parent parent_uid
 * @param string $numberposts
 * @return mixed
 */
function get_service_categories($parent = '0', $numberposts = '') {
    $taxonomies = [
        'service_category'
    ];
    $args = [
        'orderby' => 'description',
        'order' => 'ASC',
        'hide_empty' => false,
        //        'exclude'       => array(),
        //        'exclude_tree'  => array(),
        //        'include'       => array(),
        'number' => $numberposts,
        //        'fields'        => 'all',
        //        'slug'          => '',
        'parent' => $parent,
        //        'hierarchical'  => true,
        //        'child_of'      => 0,
        //        'childless'     => false,
        //        'get'           => '',
        //        'name__like'    => '',
        //        'description__like' => '',
        //        'pad_counts'    => false,
        //        'offset'        => '',
        //        'search'        => '',
        //        'cache_domain'  => 'core'
    ];

    return get_terms($taxonomies, $args);
}

/**
 * サービスカテゴリーのselect表示
 * @param int $parent term_uid
 */
function select_service_categories($parent = 0) {
    $terms = get_service_categories('0');

    echo "<select id=\"search_category\" name=\"search_category\">";
    echo "<option value=\"\">カテゴリー</option>";
    foreach ($terms as $term) {
        $slug = $term->slug;
        if (strcmp($slug, $_GET['search_category']) == 0) {
            echo "<option value=\"$term->slug\" selected>$term->name</option>";
        } else {
            echo "<option value=\"$term->slug\">$term->name</option>";
        }
        $children = get_service_categories($term->term_id);
        foreach ($children as $child) {
            $slug = $term->slug . "|" . $child->slug;
            if (strcmp($slug, $_GET['search_category']) == 0) {
                echo "<option value=\"$slug\" selected>&nbsp;-&nbsp;$child->name</option>";
            } else {
                echo "<option value=\"$slug\">&nbsp;-&nbsp;$child->name</option>";
            }
        }
    }
    echo "</select>";
}


/**
 * サービスカタグ取得
 * @param string $parent parent_uid
 * @return mixed
 */
function get_service_tags($parent = '0') {
    $taxonomies = [
        'service_tag'
    ];

    $args = [
        'orderby' => 'description',
        'order' => 'ASC',
        'hide_empty' => false,
        //        'exclude'       => array(),
        //        'exclude_tree'  => array(),
        //        'include'       => array(),
        //        'number'        => '',
        //        'fields'        => 'all',
        //        'slug'          => '',
        'parent' => $parent,
        //        'hierarchical'  => true,
        //        'child_of'      => 0,
        //        'childless'     => false,
        //        'get'           => '',
        //        'name__like'    => '',
        //        'description__like' => '',
        //        'pad_counts'    => false,
        //        'offset'        => '',
        //        'search'        => '',
        //        'cache_domain'  => 'core'
    ];

    return get_terms($taxonomies, $args);
}

/**
 * サービスタグのselect表示
 * @param int $parent term_uid
 */
function select_service_tags($parent = 0) {
    $tags = get_service_tags('0');

    echo "<select id=\"search_tag\" name=\"search_tag\">";
    echo "<option value=\"\">タグ</option>";
    foreach ($tags as $tag) {
        if (strcmp($tag->slug, $_GET['search_tag']) == 0) {
            echo "<option value=\"$tag->slug\" selected>$tag->name</option>";
        } else {
            echo "<option value=\"$tag->slug\">$tag->name</option>";
        }
    }
    echo "</select>";
}

function search_service_category_articles($numberposts = 20) {
    $args = [
        'numberposts' => $numberposts,
        'post_type' => 'list',
        'orderby' => 'post_date',
        'order' => 'DESC',
        'tax_query' => [
            [
                'taxonomy' => 'article_type',
                'field' => 'slug',
                'terms' => 'service_subcategory_article_type',
                'include_children' => 0
            ]
        ]
    ];
    if (isset($_GET['search_category']) && empty($_GET['search_category']) === false) {
        $slug = $_GET['search_category'];
        $split = explode('|', $slug);

        if (count($split) == 1) {
            $args['tax_query'] += ['relation' => 'AND'];
            array_push($args['tax_query'], [
                'taxonomy' => 'service_category',
                'field' => 'slug',
                'terms' => $split[0],
                'include_children' => 0
            ]);
        }
        if (count($split) == 2) {
            $args['tax_query'] += ['relation' => 'AND'];
            array_push($args['tax_query'], [
                'taxonomy' => 'service_category',
                'field' => 'slug',
                'terms' => $split[1],
                'include_children' => 0
            ]);
        }
    }

    if (isset($_GET['search_tag']) && empty($_GET['search_tag']) === false) {
        $args['tax_query'] += ['relation' => 'AND'];
        array_push($args['tax_query'], [
            'taxonomy' => 'service_tag',
            'field' => 'slug',
            'terms' => $_GET['search_tag'],
            'include_children' => 0
        ]);
    }

    if (isset($_GET['q']) && empty($_GET['q']) === false) {
        $q = $_GET['q'];
        $args['meta_query'] = [
            [
                'key' => 'article_name',
                'value' => $q,
                'type' => 'CHAR',
                'compare' => 'LIKE',
            ],
            [
                'key' => 'article_content',
                'value' => $q,
                'type' => 'CHAR',
                'compare' => 'LIKE',
            ]
        ];
        $args['meta_query']['relation'] = 'OR';
    }

    return get_posts($args);
}

function top_service_category_articles($page_count) {
    if ((isset($_GET['search_category']) && empty($_GET['search_category']) === false) ||
        (isset($_GET['search_tag']) && empty($_GET['search_tag']) === false) ||
        (isset($_GET['q']) && empty($_GET['q']) === false)
    ) {
        $result = search_service_category_articles();
        return $result;
    } else {
        $recommends = get_service_category_articles_recommend_sort();
        $result = search_service_category_articles($page_count);

        for ($i = count($result) - 1; $i >= 0; $i--) {
            foreach ($recommends as $recommend) {
                if ($recommend->ID == $result[$i]->ID) {
                    array_splice($result, $i, 1);
                }
            }
        }

        if (count($result) > 4) {
            $split = array_splice($result, 0, 4);
            $result = array_merge($split, $recommends, $result);
        } else {
            $result = array_merge($result, $recommends);
        }
        return $result;
    }
}

function get_service_category_articles_recommend_sort($numberposts = 4) {
    $args = [
        'numberposts' => $numberposts,
        'post_type' => 'list',
        'orderby' => 'meta_value',
        'meta_key' => 'recommend_value',
        'order' => 'DESC'
    ];
    return get_posts($args);
}


/**
 * 編集記事一覧
 * @param string $slug slug
 * @param int $numberposts
 * @param int $rank
 * @return
 */
function get_service_category_articles($slug = '', $numberposts = 32, $rank = 0) {
    $args = [
        'numberposts' => $numberposts,
        'post_type' => 'list',
        'orderby' => 'post_date',
        'order' => 'DESC',
        'tax_query' => [
            [
                'taxonomy' => 'article_type',
                'field' => 'slug',
                'terms' => 'service_subcategory_article_type',
                'include_children' => 0
            ]
        ]
    ];
    if ($slug != '') {
        $args['tax_query'] += ['relation' => 'AND'];
        array_push($args['tax_query'], [
            'taxonomy' => 'service_category',
            'field' => 'slug',
            'terms' => $slug,
            'include_children' => 0
        ]);
    }
    if (isset($_GET['q']) && empty($_GET['q']) === false) {
        $q = $_GET['q'];
        $args['meta_query'] = [];
        array_push($args['meta_query'], [
            [
                'key' => 'article_name',
                'value' => $q,
                'type' => 'string',
                'compare' => 'LIKE',
            ]
        ]);
    }
    return get_posts($args);
}

/**
 * サービス記事一覧
 * @param string $slug term_uid
 * @param int $numberposts
 * @param int $rank
 * @return posts
 */
function get_service_articles($slug = '', $numberposts = 32, $rank = 0) {
    $args = [
        'numberposts' => $numberposts,
        'post_type' => 'service',
        'orderby' => 'post_date',
        'order' => 'DESC',
        'tax_query' => [
            [
                'taxonomy' => 'article_type',
                'field' => 'slug',
                'terms' => ['service_article_type'],
                'include_children' => 0
            ]
        ]
    ];
    if ($slug != '') {
        $args['tax_query'] += ['relation' => 'AND'];
        array_push($args['tax_query'], [
            'taxonomy' => 'service_category',
            'field' => 'slug',
            'terms' => $slug,
            'include_children' => 0
        ]);
    }
    if (isset($_GET['q']) && empty($_GET['q']) === false) {
        $q = $_GET['q'];
        $args['meta_query'] = [];
        array_push($args['meta_query'], [
            [
                'key' => 'article_name',
                'value' => $q,
                'type' => 'string',
                'compare' => 'LIKE',
            ]
        ]);
    }
    return get_posts($args);
}

/**
 * サービス記事資料一覧
 * @param $parent
 * @return posts
 */
function get_service_attachments($parent) {
    $args = [
        'numberposts' => 10,
        'post_type' => 'service',
        'orderby' => 'post_date',
        'order' => 'DESC',
        'post_parent' => $parent,
        'tax_query' => [
            [
                'taxonomy' => 'article_type',
                'field' => 'slug',
                'terms' => ['service_article_attchement_type'],
                'include_children' => 0
            ]
        ]
    ];
    return get_posts($args);
}

/**
 * サービス記事資料一覧
 * @param $parent
 * @return posts
 */
function get_service_client_articles($parent) {
    $args = [
        'numberposts' => 10,
        'post_type' => 'service',
        'orderby' => 'post_date',
        'order' => 'DESC',
        'post_parent' => $parent,
        'tax_query' => [
            [
                'taxonomy' => 'article_type',
                'field' => 'slug',
                'terms' => ['service_client_article_type'],
                'include_children' => 0
            ]
        ]
    ];
    return get_posts($args);
}