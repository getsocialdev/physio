<?php get_header(); ?>
<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
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
					$term_obj_list = get_the_terms( $post->ID, 'treatment_cat' );
					if ( ! empty( $term_obj_list ) && ! is_wp_error( $term_obj_list ) ) {
						$terms_string = join(' ', wp_list_pluck($term_obj_list, 'name'));
					}
					?>
					<?php /*?><p class="post-cat"><?php echo $terms_string; ?></p><?php */?>
					<?php /*?><span class="blog-type"><?php echo get_the_term_list( $post->ID, 'treatment_cat', '', ', ' ); ?></span><?php */?>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="main-content main-wrapper">
            <div class="container">
                <?php the_content(); ?>
            </div>
        </div>
	<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>