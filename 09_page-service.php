<?php
/**
 * Template Name: サービス紹介
 * Template Post Type: post, page, service
 */
$postId = get_the_ID();
$service_name = get_post_meta($postId, "service_name", true);
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
$post = get_post(get_the_ID());
$parent_post_name = $post->post_name;
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
					<a href="/list/<?= $post_category->slug ?>/<?= $post_subcategory->slug ?>/article/"><?= $post_subcategory->name ?></a>
				</div>
			</div>

			<div class="service">
				<div class="service_title">
					<div class="service_title_image">
						<?= the_post_thumbnail($post->ID); ?>
					</div>
					<div class="service_title_content">
						<div class="service_title_content_mobile">
							<h1><?= $service_name ?></h1>
						<div class="service_title_content_tag">
						<li><?= $post_category->name ?></li><li><?= $post_subcategory->name ?></li>
						</div>
						</div>
						<p><?php the_field("service_wrap_up") ?></p>
					</div>
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
				<?php
					$posts = get_service_attachments($postId);
					if( count($posts) > 0){
				?>
 				<div class="service_block">
					<h2 id="materials">サービス資料</h2>
					<div class="service_article_flame_list">
                        <?php
                        $posts = get_service_attachments($postId);
                        foreach ($posts as $post):
                            $file_path = "";
                            ?>
							<div class="service_article_flame">

									<div class="service_article_flame_2">
									<p class="attchment"><?= get_post_meta($post->ID, 'service_attchement_title', true); ?></p>
								</div>
								<div class="service_article_flame_1">
                                    <?= the_post_thumbnail($post->ID); ?>
								</div>
								<div class="service_article_flame_3">

                    <?php if ( is_preview() ){ ?>
									<a class="header_login">プレビュー中</a>
                    <?php } elseif (is_user_logged_in()) { ?>
									<form action="/mypage/api/user/material/" method="post">
										<input type="hidden" name="file_code" value="<?=$post->post_name?>">
										<input type="submit" class="service_link" value="資料を確認する">
									</form>
							<?php } else { ?>
									<a class="header_login header_login_button"  href="#" data-mfp-src="<?= home_url() ?>/login">資料を確認する</a>
                    <?php } ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>

					<?php
				if(count($posts) > 4){
					echo '<a class="flame_more">さらに表示する</a>';
				}
				?>

				</div>
				<?php }
					wp_reset_postdata();
				?>
				<div class="service_block">
					<div class="service_kiji_content">
                        <?php if (have_posts()){ echo do_shortcode(get_the_content()); } ?>
					</div>
				</div>

				<div class="service_block">
					<h2>会社概要</h2>
					<div class="service_office">
						<div class="service_office_img">
						<img src="<?php echo wp_get_attachment_url(get_post_meta($post->ID, "service_office_image", true)); ?>"
							 alt="">
						</div>
						<div class="service_office_list">
							<div class="service_office_content">
								<li>会社名</li>
								<p><?php the_field("service_office_name") ?></p>
							</div>
							<div class="service_office_content">
								<li>所在地</li>
								<p><?php the_field("service_office_location") ?></p>
							</div>
							<div class="service_office_content">
								<li>代表者名</li>
								<p><?php the_field("service_office_represenative") ?></p>
							</div>
							<div class="service_office_content">
								<li>資本金</li>
								<p>
									<?php echo number_format(get_post_meta($post->ID,"service_office_capital",true));?>万円
								</p>
							</div>
							<div class="service_office_content">
								<li>設立年月日</li>
								<p><?php the_field("service_office_time") ?></p>
							</div>
						</div>
					</div>
				</div>
				<div class="service_block">
					<h2>コメント</h2>
                    <?php comments_template(); ?>
				</div>
				<div class="service_block">
					<h2>このサービスに関する記事</h2>
					<div class="service_article_flame_list">
                        <?php
                        $posts = get_service_client_articles($postId);
                        foreach ($posts as $post):
                            ?>
							<div class="service_article_flame">

								<div class="service_article_flame_1">
                                    <?= the_post_thumbnail($post->ID); ?>
								</div>
								<div class="service_article_flame_2">
									<a href="<?= get_permalink($post->ID) ?>"
									   class="service_link">
										<p><?php echo get_post_meta($post->ID, "article_name", true); ?></p>
									</a>
								</div>
							</div>
                        <?php endforeach;
                        wp_reset_postdata();
                        ?>
					</div>
				</div>
				<?php
                        $posts = get_service_client_articles($postId);
				if(count($posts) > 4){
					echo '<a class="flame_more">さらに表示する</a>';
				}
				?>



				<div class="service_block">
					<h2>その他<?= $post_category->name ?>のサービス</h2>
					<div class="service_flame_list">
                        <?php
                        $posts = get_service_articles($post_category->slug);
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
							<div class="service_article_flame">
								<a href="<?= get_permalink($post->ID) ?>"
								   class="service_link">
									<div class="service_article_flame_1">
                                        <?= the_post_thumbnail($post->ID); ?>
									</div>
									<div class="service_article_flame_2">
										<p class="service_name"><?php echo get_post_meta($post->ID, "service_name", true); ?><p>
									</div>
									<div class="service_article_flame_3">
										<li><?= $service_subcategory ?></li>
									</div>
								</a>
							</div>

                        <?php endforeach;
                        wp_reset_postdata();
                        ?>
					</div>
				</div>
			</div>
		</div>
        <?php get_sidebar(); ?>
	</div>


</main>

<?php get_footer(); ?>
