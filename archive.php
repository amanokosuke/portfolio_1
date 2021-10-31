<?php get_header(); ?>

	<main>
		<div class="index_main">

				<div class="index_contents">

					<?php if(is_month()) : ?>
						<p id="ttlArchives"><?php echo $year . '年' . $monthnum . '月'; ?></p>
					<?php endif; ?>

					<?php if(is_category()) : ?>
						<p id="ttlArchives"><?php single_cat_title(); ?></p>
					<?php endif ?>

					<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
						<div class="post">
							<!-- タイトル表示 -->
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h2>

							<!-- サムネイル表示 -->
							<?php if (has_post_thumbnail()) : ?>
        <?php the_post_thumbnail('thumbnail'); ?>
    <?php else : ?>
        <img src="<?php bloginfo('template_url'); ?>/img/no-image.gif" width="160" height="100" alt="デフォルト画像" />
    <?php endif ; ?>

							<!-- 日時表示 -->
							<p class="date"><?php echo get_the_date(); ?></p>

							<!-- 内容を表示 -->
							<div class="posttxt">
								<?php the_content(); ?>
							</div>

							<!-- タグを表示 -->
							<div class="postFoot">
								<p>category: <?php the_category(','); ?>
								comment: <?php comments_number('(0)','(1)','(%)'); ?></p>
							</div>

						</div>
					<?php endwhile; endif; ?>
					<!-- 次へ　前へ　を表示 -->
					<div class="nextprev clearfix">
						<p class="prev"><?php previous_posts_link(); ?></p>
						<p class="next"><?php next_posts_link(); ?></p>
					</div>
				</div>

		<?php get_sidebar(); ?>
		</div>
	</main>

  <?php get_footer(); ?>
