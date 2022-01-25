<?php get_header(); ?>
<?php if (have_posts()) : ?>
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
  	if(get_field('banner_image','category_'.$cat_id)) {
		echo wp_get_attachment_image(get_field('banner_image','category_'.$cat_id),'full',"",array("class"=>"banner-img"));
	}
	?>
      <div class="banner-inner">
        <div class="banner-content">
          <div class="container">
            <div class="banner-heading">
                <?php
                if ( is_category() ) :
                echo '<h1 class="heading">';
                    single_cat_title();
                    echo '</h1>';
                elseif ( is_tag() ) :
                    echo '<h1 class="heading">';
                    single_tag_title();
                    echo '</h1>';
                elseif ( is_author() ) :
                    echo '<h1 class="heading">';
                    _e( 'Author: ', 'physio' ); 
                    echo get_the_author();
                    echo '</h1>';
                elseif ( is_day() ) :
                    echo '<h1 class="heading">';
                    _e( 'Date: ', 'physio' );
                    echo get_the_date(); 
                    echo '</h1>';
                elseif ( is_month() ) :
                    echo '<h1 class="heading">';
                    _e( 'Month: ', 'physio' );
                    echo get_the_date( _x( 'F Y', 'monthly archives date format', 'physio' ) );
                    echo '</h1>';
                elseif ( is_year() ) :
                    echo '<h1 class="heading">';
                    _e( 'Year: ', 'physio' ); 
                    echo get_the_date( _x( 'Y', 'yearly archives date format', 'physio' ) );
                    echo '</h1>';
                else :
                echo '<h1 class="heading">';
                    _e( 'Archives', 'physio' );
                    echo '</h1>';
                endif;
                ?>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<div class="main-content">
	<div class="container">
		<div class="blog-grid style-1">
		<?php while (have_posts()) : the_post(); ?> 
            <?php
				$term_obj_list = get_the_terms( $post->ID, 'category' );
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
						<span class="blog-type"><?php echo get_the_term_list( $post->ID, 'category', '', ', ' ); ?></span>
						<h4 class="blog-title">
							<a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title(); ?><i class="fas fa-chevron-right"></i></a>
						</h4>
					</div> 
				</article>
		<?php endwhile; ?>
        <div class="col-xs-12 navigation clearfix">
            	<?php physio_paging_nav(); ?>
            </div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php get_footer(); ?>