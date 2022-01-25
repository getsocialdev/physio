<?php 
/*
Template Name: Home
*/
get_header(); ?> 
<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
    <div class="main-content">
		<?php if (get_permalink() == "https://advantagesportmed.ca/contact-us/"): ?>
			<div style="background:black;">
				<div class="container">
					<?php the_content(); ?>
				</div>
			</div>
		<?php else: ?>
			<div class="container">
				<?php the_content(); ?>
			</div>
		<?php endif; ?>
    </div>
	<?php endwhile; ?>
<?php else : ?>
<?php endif; ?>
<?php get_footer(); ?>