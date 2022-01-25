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
					$term_obj_list = get_the_terms( $post->ID, 'team_cat' );
					if ( ! empty( $term_obj_list ) && ! is_wp_error( $term_obj_list ) ) {
						$terms_string = join(' ', wp_list_pluck($term_obj_list, 'name'));
					}
					?>
					<?php /*?><p class="post-cat"><?php echo $terms_string; ?></p><?php */?>
					<?php /*?><span class="blog-type"><?php echo get_the_term_list( $post->ID, 'team_cat', '', ', ' ); ?></span><?php */?>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="main-content main-wrapper">
            <div class="container">
                <?php
                $team_id = get_the_ID();
                $team_title = get_the_title;
                $team_data = get_post($team_id);
                ?>
                <div class="team-item team-single">
                    <div class="team-image">
                    <?php
                    if(has_post_thumbnail($team_id)){
                        echo get_the_post_thumbnail($team_id,'full');
                    }
                    ?>
                    </div>
                    <div class="team-content">
                    <?php
                    $term_obj_list = get_the_terms($team_id,'team_cat');
                    if(!empty( $term_obj_list) && !is_wp_error($term_obj_list)){
                        $terms_string = join(', ',wp_list_pluck($term_obj_list, 'name'));
                    }
                    //$terms_string = get_the_term_list($team_id,'team_cat','',', ');
                    ?>
                    <h5 class="team-category"><?php echo $terms_string; ?></h5>
                    <h4 class="team-name"><?php echo $team_data->post_title; ?><a href="javascript:void(0);" class="team-close close-lighbox"></a></h4>
                      <div class="team-desc">
                         <?php //echo $team_data->post_content; ?>
						  <?php echo apply_filters('the_content', $team_data->post_content); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>