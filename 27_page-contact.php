<!--
Template Name: お問合わせ
Template Post Type: post, page, company
-->

<?php get_header(); ?>

<main id="contact_page">
	<div class="index_main">

    <div class="index_contents not_sidebar" id="contact_contents">
      <div class="contact">
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
       <?php the_content(); ?>
<?php endwhile; endif; ?>
      </div>

    </div>
  </div>



</main>

<?php get_footer(); ?>
