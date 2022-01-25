<?php get_header(); ?>
<?php if (have_posts()) : ?>
<section class="main-content main-wrapper">
  <div class="content-inner">
    <div class="container">
      <div class="content-sidebar clearfix">
      <?php while (have_posts()) : the_post(); ?>
        <div class="primery-block">
            <?php the_content(); ?>
        </div>
         <?php endwhile; ?>
		 <?php if(is_active_sidebar( 'sidebar-1' )) : ?>
            <div id="page-sidebar" class="page-sidebar">
                <?php dynamic_sidebar( 'sidebar-1' ); ?>
            </div>
        <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php get_footer(); ?>