<!--
Template Name: トップページ
-->
<?php get_header(); ?>
<main>
    <div class="top_carousel">
        <?php masterslider(1); ?>
    </div>
    <div class="index_main ">
        <div class="index_contents not_sidebar">
            <div class="top_page">
                <div class="top_search">
                    <form action="/" class="top_search_kensaku"
                                                   method="get">
                        <div>
                            <input type="text"
                                   name="q"
                                   size="40"
                                   placeholder="キーワードで記事を検索"
                                   value="<?php if (isset($_GET["q"])) {
                                       echo $_GET["q"];
                                   } ?>">
                            <input type="submit" value="検索" class="icn_search">
                        </div>
                        <div>
                            <?php select_service_categories(); ?>
                            <?php select_service_tags(); ?>
                        </div>
                    </form>
                </div>
                <div class="top_pickup">
                    <div class="article_flame_list">
                        <?php
                        $current_page = 2;
                        if (isset($_GET['post_page']) && empty($_GET['post_page']) === false) {
                            $current_page = $_GET['post_page'];
                        }
                        $current_page = max($current_page,2);

                        $post_count = ($current_page * 8);
                        $posts = top_service_category_articles($post_count + 1);
                        $page_more = false;
                        if (count($posts) > $post_count) {
                            $page_more = true;
                            array_splice($posts, $post_count);
                        }

                        for ($i = 0; $i < count($posts); $i++) {
                            $post = $posts[$i];
                            $terms = get_the_terms($post->ID, "service_category");
                            $service_category = "";
                            $service_subcategory = "";
                            foreach ($terms as $term) {
                                if ($term->parent == 0) {
                                    $service_category = $term->name;
                                } else {
                                    $service_subcategory = $term->name;
                                }
                            }
                            ?>
                            <article class="article_flame">
                                <?php
                                if (($i % 8) == 0) {
                                    $page_num = ($i / 8)+1;
                                    echo "<a id='page${page_num}'>";
                                }
                                ?>
                                <a href="<?= get_permalink($post->ID) ?>"
                                   class="article_link">
                                    <div class="article_flame_img">
                                        <?= the_post_thumbnail($post->ID); ?>
                                    </div>
                                </a>
                                <div class="article_flame_block flex_start">
                                    <li class="article_flame_date">
                                        <?php echo get_the_date('Y/m/d', $post->ID) ?>
                                    </li>
                                    <li class="article_flame_author">
                                        <?php echo get_post_meta($post->ID, 'article_author', true); ?>
                                    </li>
                                    <!--<div class="article_flame_tag">
                                        <?php
                                    if ($terms = get_the_terms($post->ID, 'service_tag')) {
                                        foreach ($terms as $term) {
                                            $term_slug = $term->slug;
                                            echo "<div><a>" . $term->name . '</a></div>';
                                        }
                                    }
                                    ?>
                                    </div> -->
                                </div>
                                <a href="<?= get_permalink($post->ID) ?>"
                                   class="article_link">
                                    <div class="article_flame_title">
                                        <h3><?= get_post_meta($post->ID, 'article_name', true); ?></h3>
                                    </div>
                                </a>
                                <!--<div class="article_flame_block">
                                    <div class="article_flame_category">
                                        <div>
                                        <?php
                                ?><?= $service_category ?><?php if ($service_subcategory != null) {
                                    echo '&nbsp;>&nbsp;' . $service_subcategory;
                                } ?></div>
                                    </div>
                                </div> -->
                                <!--<a href="<?= get_permalink($post->ID) ?>"
                                   class="article_link">
                                    <div class="article_flame_description">
                                        <p><?php echo get_post_meta($post->ID, 'article_content', true); ?></p>
                                    </div>
                                </a> -->
                            </article>
                            <?php
                        }
                        wp_reset_postdata();
                        $next_page = $current_page + 1;
                        ?>
                    </div>
                </div>
                <?php
                if ($page_more == true) {
                    ?>
                    <p class="top_pickup_more">
                        <a id="more" href="/?post_page=<?= $next_page ?>#page<?= $next_page ?>">さらに表示する</a></p>
                <?php } ?>
                <div class="top_service_search">
                    <div class="up_triangle">
                        <img src="/kyozon-theme/img/up.png"
                             alt="">
                    </div>
                    <h2><span>カテゴリーからサービス</span>を見つける</h2>
                    <div class="top_service_list">
                        <?php
                        $terms = get_service_categories('0');
                        foreach ($terms as $term):
                            ?>
                            <div class="top_service_content">
                                <div class="top_service_image">
                                    <a href="/list/<?= $term->slug ?>/">
                                        <img src="/kyozon-theme/img/category_1.png"
                                             alt="サービス画像">

                                        <p><?= $term->name ?></p>
                                    </a>

                                </div>
                                <div class="top_subservice_list">
                                    <ul>
                                        <?php
                                        $children = get_service_categories($term->term_id, '3');
                                        foreach ($children as $child):
                                            ?>
                                            <li>
                                                <span>
                                                    <img src="/kyozon-theme/img/left.png"
                                                         alt="">
                                                </span>
                                                <a href="/list/<?= $term->slug ?>/<?= $child->slug ?>/"><?= $child->name; ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <div>
                                    <a href="/list/<?= $term->slug ?>/"
                                       class="top_service_link">このカテゴリーの一覧を見る</a>
                                </div>
                            </div>

                            <div class="top_service_content_sp">

                                <p><?= $term->name ?></p>
                                <div class="top_subservice_list_sp">
                                    <ul>
                                        <?php
                                        $children = get_service_categories($term->term_id, '10');
                                        foreach ($children as $child):
                                            ?>
                                            <li>
                                                <a href="/list/<?= $term->slug ?>/<?= $child->slug ?>/"><?= $child->name; ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>
