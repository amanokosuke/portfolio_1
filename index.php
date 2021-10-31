<?php get_header(); ?>

	<main>
		<div class="index_main">

				<div class="index_contents">
					<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
						<div class="post">
							<h2><?php the_title(); ?></h2>
							<div class="posttxt">
								<?php the_content(); ?>
							</div>
						<?php endwhile; endif; ?>
						</div>
				</div>

		<?php get_sidebar(); ?>
		</div>
	</main>

  <?php get_footer(); ?>
