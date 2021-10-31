<?php
function share_buttons() {
    $share_url = get_permalink();

    if (strcmp($share_url, (home_url() . "/")) == 0) {
        $tw =
            '<div class="snslink"><a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button"  data-size="large" data-text="デジタルトレンドを知れば業務はさらにスマートになる「kyozon.」" data-url="https://kyozon.net/" data-via="kyozon" data-hashtags="kyozon" data-lang="ja" data-show-count="false">Tweet</a></div>';
    } else {
        $tw =
            '<div class="snslink"><a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-via="kyozon_comix" data-hashtags="kyozon_comix" data-related="kyozon_comix" data-lang="ja" data-show-count="false">Tweet</a></div>';
    }
    $fb = '<div class="fb-share-button snslink" data-href="' .
        $share_url .
        '" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=' .
        urlencode($share_url) .
        '&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">シェア</a></div>';

    $cl = '<div class="snslink"><a class="clipboard"><img src="/images/clipboard.png"></a></div>';

    return $tw . $fb . $cl;
}

function get_twitter_card() {
    wp_reset_postdata();
    if (strcmp(get_the_permalink(), (home_url() . "/")) == 0) {
        echo 'summary_large_image';
    } else {
        $post = get_post(get_the_ID());
        if (strcmp($post->post_type, "list") == 0
            || strcmp($post->post_type, "service") == 0
        ) {
            echo 'summary_large_image';
        } else {
            echo 'summary_large_image';
        }
    }
}

function get_ogimage_url() {
    wp_reset_postdata();
    if (strcmp(get_the_permalink(), (home_url() . "/")) == 0) {
        echo 'https://kyozon.net/images/logo_og.png';
    } else {
        $post = get_post(get_the_ID());
        if (strcmp($post->post_type, "list") == 0
            || strcmp($post->post_type, "service") == 0
        ) {
            echo get_the_post_thumbnail_url(get_the_ID(), 'large');
        } else {
            echo 'https://kyozon.net/images/logo_og.png?t=' . $post->post_type;
        }
    }
}
