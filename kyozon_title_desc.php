<?php

function get_kyozon_title() {
    $title = "";
    global $post;
    if (preg_match('/\/list\/(.+?)\/(.+?)\/(.+?)\/(.+)\//', get_the_permalink(), $matches)) {
        $article_name = get_post_meta($post->ID, "article_name", true);
        $title = $article_name . "｜【kyozon.｜キョーゾン】SaaSの比較・検索";
    } else if (preg_match('/\/list\/(.+?)\/(.+?)\/(.+)\//', get_the_permalink(), $matches)) {
        $terms = get_the_terms($post->ID, "service_category");
        $post_category = null;
        $post_subcategory = null;
        foreach ($terms as $term) {
            if ($term->parent == 0) {
                $post_category = $term;
            } else {
                $post_subcategory = $term;
            }
        }

        if (strcmp($matches[2], "article") == 0) {
            $article_name = get_post_meta($post->ID, "article_name", true);
            $title = $article_name . "｜【kyozon.｜キョーゾン】SaaSの比較・検索";
        } else {
            $title = $post_subcategory->name . 'の記事、トレンド情報一覧｜【kyozon.｜キョーゾン】SaaSの比較・検索';
        }
    } else if (preg_match('/\/list\/(.+?)\/(.+)\//', get_the_permalink(), $matches)) {
        $terms = get_the_terms($post->ID, "service_category");
        $post_category = null;
        $post_subcategory = null;
        foreach ($terms as $term) {
            if ($term->parent == 0) {
                $post_category = $term;
            } else {
                $post_subcategory = $term;
            }
        }
        if (strcmp($matches[2], "article") == 0) {
            $title = $post_category->name . 'の記事、トレンド情報一覧｜【kyozon.｜キョーゾン】SaaSの比較・検索';
        } else {
            $title = $post_subcategory->name . 'のサービス一覧、価格比較｜【kyozon.｜キョーゾン】SaaSの比較・検索索';
        }
    } else if (preg_match('/\/list\/(.+)\//', get_the_permalink(), $matches)) {
        $terms = get_the_terms($post->ID, "service_category");
        $post_category = null;
        $post_subcategory = null;
        foreach ($terms as $term) {
            if ($term->parent == 0) {
                $post_category = $term;
            } else {
                $post_subcategory = $term;
            }
        }
        $title = $post_category->name . 'のサービス一覧、価格比較｜【kyozon.｜キョーゾン】SaaSの比較・検索';
    } else if (preg_match('/\/list\//', get_the_permalink(), $matches)) {
        $title = "サービス一覧、価格比較｜【kyozon.｜キョーゾン】SaaSの比較・検索";
    }
    if (preg_match('/\/service\/(.+?)\/(.+)\//', get_the_permalink(), $matches)) {
        $article_name = get_post_meta($post->ID, "article_name", true);
        $service_name = get_post_meta($post->post_parent, "service_name", true);
        $title = $article_name . "｜" . $service_name . "の記事｜【kyozon.｜キョーゾン】SaaSの比較・検索";
    } else if (preg_match('/\/service\/(.+)\//', get_the_permalink(), $matches)) {
        $service_name = get_post_meta($post->ID, "service_name", true);
        $title = $service_name . "の機能・価格｜【kyozon.｜キョーゾン】SaaSの比較・検索";
    } else if (strcmp(get_the_permalink(), (home_url() . "/")) == 0) {
        $title = "SaaSの比較・検索なら【kyozon.｜キョーゾン】S｜デジタルトレンドから最適なツールが見つかる";
    } else if (preg_match('/\/company\/(.+)\//', get_the_permalink(), $matches)) {
        $title = get_post_meta($post->ID, "kyozon_page_title", true);
    }
    return $title;
}

function get_kyozon_desc() {
    $desc = "";
    global $post;
    if (preg_match('/\/list\/(.+?)\/(.+?)\/(.+?)\/(.+)\//', get_the_permalink(), $matches)) {
        $article_content = get_post_meta($post->ID, "article_content", true);
        $desc = $article_content;
    } else if (preg_match('/\/list\/(.+?)\/(.+?)\/(.+)\//', get_the_permalink(), $matches)) {
        $terms = get_the_terms($post->ID, "service_category");
        $post_category = null;
        $post_subcategory = null;
        foreach ($terms as $term) {
            if ($term->parent == 0) {
                $post_category = $term;
            } else {
                $post_subcategory = $term;
            }
        }

        if (strcmp($matches[2], "article") == 0) {
            $article_content = get_post_meta($post->ID, "article_content", true);
            $desc = $article_content;
        } else {
            $desc = $post_subcategory->name .
                '領域の記事やトレンド情報はkyozon.。kyozon.はSaaSの比較や検索、デジタルトレンドの最新情報のご提供を通して、' .
                $post_category->name .
                '領域の日々の業務をスマートにする最適なSaaSやITツール選びをコンシェルジュのようにご支援します ';
        }
    } else if (preg_match('/\/list\/(.+?)\/(.+)\//', get_the_permalink(), $matches)) {
        $terms = get_the_terms($post->ID, "service_category");
        $post_category = null;
        $post_subcategory = null;
        foreach ($terms as $term) {
            if ($term->parent == 0) {
                $post_category = $term;
            } else {
                $post_subcategory = $term;
            }
        }
        if (strcmp($matches[2], "article") == 0) {
            $desc = $post_category->name .
                '領域の記事やトレンド情報はkyozon.。kyozon.はSaaSの比較や検索、デジタルトレンドの最新情報のご提供を通して、' .
                $post_category->name .
                '領域の日々の業務をスマートにする最適なSaaSやITツール選びをコンシェルジュのようにご支援します ';
        } else {
            $desc = $post_subcategory->name .
                '領域のサービス一覧、価格比較はkyozon.。kyozon.はSaaSの比較や検索、デジタルトレンドの最新情報のご提供を通して、' .
                $post_category->name .
                '領域の日々の業務をスマートにする最適なSaaSやITツール選びをコンシェルジュのようにご支援します ';
        }
    } else if (preg_match('/\/list\/(.+)\//', get_the_permalink(), $matches)) {
        $terms = get_the_terms($post->ID, "service_category");
        $post_category = null;
        $post_subcategory = null;
        foreach ($terms as $term) {
            if ($term->parent == 0) {
                $post_category = $term;
            } else {
                $post_subcategory = $term;
            }
        }
        $desc = $post_category->name .
            '領域のサービス一覧、価格比較はkyozon.。kyozon.はSaaSの比較や検索、デジタルトレンドの最新情報のご提供を通して、' .
            $post_category->name .
            '領域の日々の業務をスマートにする最適なSaaSやITツール選びをコンシェルジュのようにご支援します ';
    } else if (preg_match('/\/list\//', get_the_permalink(), $matches)) {
        $desc = "";
    }
    if (preg_match('/\/service\/(.+?)\/(.+)\//', get_the_permalink(), $matches)) {
        $article_content = get_post_meta($post->ID, "article_content", true);
        $desc = $article_content;
    } else if (preg_match('/\/service\/(.+)\//', get_the_permalink(), $matches)) {
        $service_wrap_up = get_post_meta($post->ID, "service_wrap_up", true);
        $desc = $service_wrap_up;
    } else if (strcmp(get_the_permalink(), (home_url() . "/")) == 0) {
        $desc = "kyozon.はSaaSの比較や検索、デジタルトレンドの最新情報などをお届けします。日々の業務をスマートにする最適なSaaSやITツール選びをコンシェルジュのようにご支援します";
    } else if (preg_match('/\/company\/(.+)\//', get_the_permalink(), $matches)) {
        $desc = get_post_meta($post->ID, "kyozon_page_desc", true);
    }
    return $desc;
}
