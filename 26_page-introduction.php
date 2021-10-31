<!--
Template Name: Company
Template Post Type: company
-->
<?php get_header(); ?>

<main>
	<div class="index_main">
		<div class="index_contents">
			<?php if (have_posts()): the_post(); ?>
			<?php echo get_the_content(); ?>
			<?php endif; ?>
		</div>
      <?php get_sidebar(); ?>
	</div>
</main>
<?php get_footer(); ?>
