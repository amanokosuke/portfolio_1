<!-- Template Name: サービスサブカテゴリ
Template Post Type: post, page, list
-->
<?php
$parent = get_the_ID();
$subcategory_name = get_post_meta($parent, "category_name", true);
$slug = get_post(get_the_ID())->post_name;
$terms = get_service_category_by_slug($slug);
$term = $terms[0];
$term_parents = get_service_category_by_id($term->parent);
$term_parent = $term_parents[0];
?>
<?php get_header(); ?>
<main>
	<div class="index_main">
		<div class="index_contents">
			<div class="pankuzu">
				<div class="breadcrumbs">
					<a href="/">トップページ</a> ＞ <a href="/list/<?= $term_parent->slug ?>/"><?= $term_parent->name ?></a> ＞ <?= $subcategory_name ?>
				</div>
			</div>

			<div class="subcategory_service category_list_content">
				<div class="subcategory_list">
                    <?php
                    $children1 = get_service_categories($term_parent->term_id);
                    foreach ($children1 as $child1) {
                        ?>
						<div>
                            <?php
                            if ($child1->slug == $slug) {
                                ?>
								<div><?= $child1->name ?></div>
                                <?php
                            }
                            else {
                                ?>
								<a href="/list/<?= $term_parent->slug ?>/<?= $child1->slug ?>/">
									<div><?= $child1->name ?></div>
								</a>
                                <?php
                            }
                            ?>
						</div>
                        <?php
                    }
                    ?>
				</div>

				<h1><?= $subcategory_name ?>のサービス</h1>
				<div class="service_flame_list">
                    <?php
                    $posts = get_service_articles($slug);
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

								<div class="service_flame_2">
									<!--<p>♡</p>
                                    <a>資料DL</a>-->
                                    <?= the_post_thumbnail($post->ID); ?>
								</div>

								<div class="service_flame_3">
									<div>
                                        <?= $service_category ?>><?= $service_subcategory ?>
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
<!-- 									<li>☆☆☆☆☆</li> -->
								</div>
							</div>
							<a href="<?= get_permalink($post->ID) ?>"
							   class="service_link">

								<div class="service_flame_1">

									<h3><?php echo get_post_meta($post->ID, "service_name", true); ?></h3>
									<h4><?php echo get_post_meta($post->ID, "service_office_name", true); ?></h4>

								</div>

<!-- 								<div class="service_flame_5">
									<p><?php echo get_post_meta($post->ID, "service_wrap_up", true); ?></p>
								</div> -->
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

 
				<h2><?= $subcategory_name ?>とは</h2>
				<p><?= nl2br(post_custom('category_content')); ?></p> 


				<h2><?= $subcategory_name ?>に関する記事</h2>

				<div class="article_search">
					<form acction="<?=get_permalink()?>" method="get">
						<input type="text"
							   name="q"
							   size="40"
							   placeholder="キーワードで絞り込み検索"
							   value="<?php if( isset($_GET["q"])){ echo $_GET["q"]; } ?>">
						<input type="submit"  value="検索" class="icn_search">
					</form>

				</div>
				<div class="article_client_area">
					<div class="article_flame_list">
                        <?php
                        $posts = get_service_category_articles($slug);
                        foreach ($posts as $post):
                            ?>
							<article class="article_flame">
								<a href="<?= get_permalink($post->ID) ?>"
								   class="article_link">
									<div class="article_flame_img">
                                        <?= the_post_thumbnail($post->ID); ?>
									</div>
								</a>
								<div class="article_flame_block flex_start">
									<li class="article_flame_date">
                                        <?php echo get_the_modified_time('Y/m/d', $post->ID) ?></li>
									<li class="article_flame_author"><?php echo get_post_meta($post->ID, 'article_author', true); ?></li>
<!-- 									<div class="article_flame_tag">
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
				<a href="<?= get_permalink($post->ID) ?>" class="article_link">
									<div class="article_flame_title">
										<h3><?php echo get_post_meta($post->ID, 'article_name', true); ?></h3>
									</div>

								</a>
<!-- 								<div class="article_flame_block">
									<div class="article_flame_category">
										 <div><?php echo get_post_meta($post->ID, 'article_category', true); ?>><?php echo get_post_meta($post->ID, 'article_subcategory', true); ?></div>
									</div>
									 
									<div class="article_flame_osusume">
										<p>☆☆☆☆☆</p>
									</div>

								</div> -->
<!-- 								<a href="<?= get_permalink($post->ID) ?>"
								   class="article_link">
									<div class="article_flame_description">
										<p><?php echo get_post_meta($post->ID, 'article_content', true); ?></p>
									</div>
								</a> -->
							</article>

                        <?php endforeach;
                        wp_reset_postdata();
                        ?>
					</div>
				</div>

				<?php
                 $posts = get_service_category_articles($slug);
				if(count($posts) > 16){
					echo '<a class="flame_more">さらに表示する</a>';
				}
				?>

			</div>


		</div>
        <?php get_sidebar(); ?>
	</div>


</main>

<?php get_footer(); ?>
