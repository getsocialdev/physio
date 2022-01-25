<?php get_header(); ?>
<section class="blog-single">
<?php if (have_posts()) : ?>
<?php $page_id = get_queried_object_id(); ?>

<div class="banner-section">
            <div class="banner-hero">
              <div class="overlay"></div>
                    <?php
					if(get_field('banner_image')) {
						echo wp_get_attachment_image(get_field('banner_image'),'full',"",array("class"=>"banner-img"));
					}
					?>
              <div class="banner-inner">
                <div class="banner-content">
                  <div class="container">
                    <div class="banner-heading">
                    	<h1 class="heading"><?php the_title(); ?></h1>
                    </div>
                    <?php
					$term_obj_list = get_the_terms( $post->ID, 'group_exercise_cat' );
					if ( ! empty( $term_obj_list ) && ! is_wp_error( $term_obj_list ) ) {
						$terms_string = join(' ', wp_list_pluck($term_obj_list, 'name'));
					}
					?>
					<p class="post-cat"><?php echo $terms_string; ?></p>
					<?php /*?><span class="blog-type"><?php echo get_the_term_list( $post->ID, 'category', '', ', ' ); ?></span><?php */?>
                  </div>
                </div>
              </div>
            </div>
        </div>
<div class="main-content main-wrapper">
  <div class="content-inner">
    <div class="container">
      <div class="content-sidebar clearfix">
        <div class="primery-block">
		<?php while (have_posts()) : the_post(); ?> 
            <?php the_content(); ?>
            <?php echo get_the_tag_list('<div class="post-tags"><span class="tag-list-title">Tags:</span> <span class="tag-lists">',',','</span></div>'); ?>
		<?php endwhile; ?>
        </div>
		 <?php if(is_active_sidebar( 'sidebar-1' )) : ?>
            <div id="page-sidebar" class="page-sidebar">
                <?php dynamic_sidebar( 'sidebar-1' ); ?>
            </div>
        <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
</section>
<?php get_footer(); ?>