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
  	if(get_field('banner_image','treatment_cat_'.$cat_id)) {
		echo wp_get_attachment_image(get_field('banner_image','treatment_cat_'.$cat_id),'full',"",array("class"=>"banner-img"));
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
<div class="main-content treatment-archive">
    <div class="container">
        <div class="term-content"><?php echo term_description($cat_id,'treatment_cat'); ?></div>
        <div class="section-heading large-heading center-heading">   
			<h2 class="heading"><span class="heading-inner">Treatments</span></h2>
        </div>
        <?php
            if ( get_query_var('paged') ) $paged = get_query_var('paged');  
            if ( get_query_var('page') ) $paged = get_query_var('page'); ?>
		<?php
        $treatment_args = array(
            'post_type' => 'treatment',
            'post_status' => 'publish', 
            'paged' => $paged,
            'orderby'  => 'title',
            'order'    => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'treatment_cat',
                    'field' => 'id',
                    'terms' => $cat_id
                )
            ),
        );
        $treatment = new WP_Query( $treatment_args );
        if( $treatment->have_posts() ) : ?>
         <div class="main-content">
            <div class="container">
                <div class="treatment-grid archive-grig"> 
                    <div class="treatment-sizer"></div>
                    <?php while( $treatment->have_posts() ) : $treatment->the_post(); ?>
                        <div class="treatment-item">
                            <div class="treatment">									
                                <a href="<?php echo get_permalink($post->ID); ?>">
                                    <?php if ( has_post_thumbnail($post->ID) ) {
                                        echo get_the_post_thumbnail($post->ID, 'full');
                                    }
                                    if( !empty( get_the_title() ) ) { ?>
                                        <h4 class="name"><?php echo get_the_title(); ?></h4>
                                    <?php } ?>
                                </a>
                            </div>
                        </div>	
                    <?php endwhile; ?>
                 </div>
                  <div class="col-xs-12 navigation clearfix">
                    <?php physio_paging_nav(); ?>
                  </div>
            </div>
        </div>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
	</div>
</div>
<?php get_footer(); ?>