<div class="sidebar">
    <?php
    $args = array(
        'numberposts' => 1,
        'post_type' => 'sidebar_ad',
        'orderby' => 'modified',
        'order' => 'desc'
    );
    $posts = get_posts($args);
    if (count($posts) > 0) {
        $post = $posts[0];

        $sidebar_ad_image = get_post_meta($post->ID, "sidebar_ad_image", true);
        $url = wp_get_attachment_url($sidebar_ad_image);
        $alt = get_post_meta($sidebar_ad_image, '_wp_attachment_image_alt', true);

        $sidebar_ad_link = get_post_meta($post->ID, "siderbar_ad_link", true);
        $sidebar_ad_link_alt = get_post_meta($post->ID, "sidebar_ad_link_alt", true);
        ?>
		<a href="<?= $sidebar_ad_link ?>"
		   class="koukoku">
			<img src="<?= $url ?>"
				 alt="<?= $alt ?>">
		</a>
        <?php
    }
    ?>
	<h2>週間ランキング</h2>
	<div class="title_bar"></div>
	<ul class="index_category">
        <?php
        if (function_exists('wpp_get_mostpopular')) {
            $wpp = array(
                'post_type' => 'list',
				     'taxonomy' => 'article_type',
                'term_id' => '48,-46,-47,-89,-88',
                'limit' => '5',
                'range' => 'all',
                'order_by' => 'views',
                'stats_comments' => '0',
                'stats_views' => '0',
                'title_length' => '20',
                'thumbnail_width' => '70',
                'thumbnail_height' => '70',
                'stats_category' => '0',
                'wpp_start' => '<div id="weekly_ranking"><ul class="wpp-list">',
                'wpp_end=' => '</ul></div>'
            );
            wpp_get_mostpopular($wpp);
        }
        ?>
	</ul>
</div>
