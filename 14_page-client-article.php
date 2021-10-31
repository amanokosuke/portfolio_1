<!-- Template Name: クライアント記事
Template Post Type: post, page, service
-->
<?php
$postId = get_the_ID();
$parent = get_post(wp_get_post_parent_id($postId));
$terms = get_the_terms($postId, "service_category");
$post_category = null;
$post_subcategory = null;
foreach ($terms as $term) {
    if ($term->parent == 0) {
        $post_category = $term;
    }
    else {
        $post_subcategory = $term;
    }
}
?>
<?php get_header(); ?>
<head>
	<link rel="stylesheet"
		  href="/kyozon-theme/css/kyozon_mypage.css">
	<script type="text/javascript"
			src="/kyozon-theme/js/kyozon_mypage.js"></script>
</head>
<main>
	<div class="index_main">

		<div class="index_contents">
			<div class="pankuzu">
				<div class="breadcrumbs">
					<a href="/">トップページ</a> ＞ <a href="/list/<?= $post_category->slug ?>/article/"><?= $post_category->name ?></a> ＞
					<a href="/list/<?= $post_category->slug ?>/<?= $post_subcategory->slug ?>/article/"><?= $post_subcategory->name ?></a> ＞
					<a href="<?= get_permalink($parent->ID) ?>/"><?php echo get_post_meta($parent->ID, "service_name", true); ?></a>
				</div>
			</div>
			<div class="edit_article">
				<div class="article_title">
					<h2><?php echo post_custom('article_name'); ?><!--タイトル--></h2>
					<span><?php echo get_the_date(); ?> <!--YYYY/MM/DD--></span>
					<p><?php echo post_custom('article_content') ?><!--要約--></p>
				</div>
				<div class="article_tag">
					<?php
						if ($terms = get_the_terms($postId, 'service_tag')) {
							foreach ($terms as $term) {
								$term_slug = $term->slug;
								echo "<div><a>" . $term->name . '</a></div>';
							}
						}
					?>
				</div>
				<ul class="service_sns">
					<?=share_buttons()?>
                    <?=show_add_favorite(get_the_ID())?>
				</ul>
				<div class="edit_article_block">
					<div class="edit_article_content">
                        <?php if (have_posts()): the_post(); ?>
                            <?php echo get_the_content(); ?>
                        <?php endif; ?>
					</div>
				</div>
				<ul class="service_sns">
					<?=share_buttons()?>
				</ul>
				<div class="edit_article_block">
					<h2>関連するサービス</h2>
					<div class="service_flame_list">
                        <?php
                        $posts = get_service_articles([
                            $post_category->slug,
                            $post_subcategory->slug
                        ], 4);
                        foreach ($posts as $post):
                            $terms = get_the_terms($post->ID, "service_category");
                            $service_category = "";
                            $service_subcategory = "";
                            foreach ($terms as $term) {
                                if ($term->parent == 0) {
                                    $service_category = $term->name;
                                }
                                else {
                                    $service_subcategory = $term->name;
                                }
                            }
                            ?>
							<div class="service_flame">
								<a href="<?= get_permalink($post->ID) ?>"
								   class="service_link">
									<div class="service_flame_1">

										<h3><?php echo get_post_meta($post->ID, "article_name", true); ?></h3>
										<h4><?php echo get_post_meta($post->ID, "service_office_name", true); ?></h4>

									</div>
									<div class="service_flame_2">
										<!--<p>♡</p>
                                        <a>資料DL</a>-->
                                        <?= the_post_thumbnail($post->ID); ?>
									</div>

									<div class="service_flame_3">
										<div>
                                            <?= $service_category ?>
										</div>
										>
										<div>
                                            <?= $service_subcategory ?>
										</div>
									</div>
								</a>
								<div class="service_flame_4">
									<div class="service_tag">
                                         <?php
                                        if ($terms = get_the_terms($post->ID, 'service_tag')) {
                                            foreach ($terms as $term) {
                                                $term_slug = $term->slug;
                                                echo "<div><a>" . $term->name . '</a></div>';
                                            }
                                        }
                                        ?>
									</div>
									<div class="service_osusume">
<!-- 										<li>☆☆☆☆☆</li> -->
									</div>
								</div>
								<a href="<?= get_permalink($post->ID) ?>"
								   class="service_link">

									<div class="service_flame_5">
										<p><?php echo get_post_meta($post->ID, "service_wrap_up", true); ?></p>
									</div>
									<div class="service_flame_6">
										<div class="service_flame_plan">
                                            <?php if (get_field('free_trial')) { ?>
                                                <?php
                                                echo "<div>Free<br>トライアル</div>";
                                            }
                                            else {
                                                echo "";
                                                ?>
                                            <?php } ?>  
                                            <?php if (get_field('free_plan')) { ?>
                                                <?php
                                                echo "<div>FreePlan</div>";
                                            }
                                            else {
                                                echo "";
                                                ?>
                                            <?php } ?>
										</div>
										<div class="service_flame_cost">
											<p><?php echo get_post_meta($post->ID, "service_cost", true); ?></p>
										</div>
									</div>
								</a>

							</div>
                        <?php endforeach;
                        wp_reset_postdata();
                        ?>

					</div>

				</div>

				<div class="edit_article_block">
					<h2>関連する記事</h2>
					<div class="article_flame_list">
                        <?php
                        $posts = get_service_category_articles([
                            $post_category->slug,
                            $post_subcategory->slug
                        ], 4);
                        foreach ($posts as $post):
                            ?>
							<article class="article_flame">
								<a href="<?= get_permalink($post->ID) ?>"
								   class="article_link">
									<div class="article_flame_title">
										<h3><?php echo get_post_meta($post->ID, 'article_name', true); ?></h3>
									</div>
									<div class="article_flame_img">
                                        <?= the_post_thumbnail($post->ID); ?>
									</div>
								</a>
								<div class="article_flame_block flex_start">
									<li class="article_flame_date">
                                        <?php echo get_the_modified_time('Y/m/d', $post->ID) ?></li>
									<li class="article_flame_author"><?php echo get_post_meta($post->ID, 'article_author', true); ?></li>
									<div class="article_flame_tag">
                                         <?php
                                        if ($terms = get_the_terms($post->ID, 'service_tag')) {
                                            foreach ($terms as $term) {
                                                $term_slug = $term->slug;
                                                echo "<div><a>" . $term->name . '</a></div>';
                                            }
                                        }
                                        ?>
									</div>
								</div>
								<div class="article_flame_block">
									<div class="article_flame_category">
										<div><?php echo get_post_meta($post->ID, 'article_category', true); ?></div>
										>
										<div><?php echo get_post_meta($post->ID, 'article_subcategory', true); ?></div>
									</div>
									 
									<div class="article_flame_osusume">
<!-- 										<p>☆☆☆☆☆</p> -->
									</div>

								</div>
								<a href="<?= get_permalink($post->ID) ?>"
								   class="article_link">
									<div class="article_flame_description">
										<p><?php echo get_post_meta($post->ID, 'article_content', true); ?></p>
									</div>
								</a>
							</article>

                        <?php endforeach;
                        wp_reset_postdata();
                        ?>
					</div>
				</div>
				<div class="edit_article_block">
					<div class="edit_article_comment">
						<h2>コメント</h2>
                        <?php comments_template(); ?>
					</div>
				</div>
			</div>
		</div>
        <?php get_sidebar(); ?>
	</div>
</main>
<?php get_footer(); ?>
