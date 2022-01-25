<?php 
/*
Template Name: Landing
*/
get_header(); ?>
<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
    <div class="main-content">
        <div class="container">
            	<?php the_content(); ?>
        </div>
    </div>
	<?php endwhile; ?>
<?php else : ?>
<?php endif; ?>
<?php get_footer(); ?>