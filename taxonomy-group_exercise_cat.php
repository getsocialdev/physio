<?php get_header(); ?>
<?php
global $post, $wp_query;
$term = $wp_query->queried_object;
$cat_id = $term->term_id;
$cat_slug = $term->slug;
$cat_name = $term->name;
?>
<div class="banner-section">
    <div class="banner-hero">
      <div class="overlay"></div>
        <?php
        if(get_field('banner_image','group_exercise_cat_'.$cat_id)) {
            echo wp_get_attachment_image(get_field('banner_image','group_exercise_cat_'.$cat_id),'full',"",array("class"=>"banner-img"));
        }
        ?>
      <div class="banner-inner">
        <div class="banner-content">
          <div class="container">
          <?php if(!empty($cat_name)){ ?>
            <div class="banner-heading"><h1 class="heading"><?php echo $cat_name; ?></h1></div>
          <?php } ?>
          </div>
        </div>
      </div>
    </div>
</div>
<div class="main-content">
    <div class="container">
    <div class="term-content"><?php echo term_description($cat_id,'group_exercise_cat'); ?></div>
    	<?php
            if ( get_query_var('paged') ) $paged = get_query_var('paged');  
            if ( get_query_var('page') ) $paged = get_query_var('page'); ?>
		<?php
        $group_exercise_args = array(
            'post_type' => 'group_exercise',
            'post_status' => 'publish', 
            'paged' => $paged,
            'orderby'  => 'title',
            'order'    => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'group_exercise_cat',
                    'field' => 'id',
                    'terms' => $cat_id
                )
            ),
        );
        $group_exercise = new WP_Query( $group_exercise_args );
        if( $group_exercise->have_posts() ) : ?>
                <div class="blog-grid style-2"> 
                    <?php while( $group_exercise->have_posts() ) : $group_exercise->the_post(); ?>
                    <?php
                        $term_obj_list = get_the_terms( $post->ID, 'group_exercise_cat' );
                        if ( ! empty( $term_obj_list ) && ! is_wp_error( $term_obj_list ) ) {
                            $terms_slug_string = join(' ', wp_list_pluck($term_obj_list, 'slug'));
                        }
                        ?>
                        <article class="blog-item <?php echo $terms_slug_string; ?>"> 
                            <div class="blog-image"> 
                                <a href="<?php echo get_permalink($post->ID); ?>"> 
                                    <?php echo get_the_post_thumbnail($post->ID, 'full'); ?>
                                </a> 
                            </div> 
                            <?php
                            if ( ! empty( $term_obj_list ) && ! is_wp_error( $term_obj_list ) ) {
                                $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));
                            }
                            ?>
                            <div class="blog-header">
                            <span class="blog-type"><?php echo get_the_term_list( $post->ID, 'group_exercise_cat', '', ', ' ); ?></span>
                            <h4 class="blog-title"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title(); ?><i class="fas fa-chevron-right"></i></a></h4>
                            </div> 
                        </article>	
                    <?php endwhile; ?>
                    <div class="col-xs-12 navigation clearfix">
                    <?php physio_paging_nav(); ?>
                  </div>
        		</div>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
	</div>
</div>
<?php get_footer(); ?>