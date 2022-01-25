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
  	if(get_field('banner_image','team_cat_'.$cat_id)) {
		echo wp_get_attachment_image(get_field('banner_image','team_cat_'.$cat_id),'full',"",array("class"=>"banner-img"));
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
        <div class="term-content"><?php echo term_description($cat_id,'team_cat'); ?></div>
        <?php
            if ( get_query_var('paged') ) $paged = get_query_var('paged');  
            if ( get_query_var('page') ) $paged = get_query_var('page'); ?>
		<?php
        $team_args = array(
            'post_type' => 'team',
            'post_status' => 'publish', 
            'paged' => $paged,
            'orderby'  => 'title',
            'order'    => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'team_cat',
                    'field' => 'id',
                    'terms' => $cat_id
                )
            ),
        );
        $team = new WP_Query( $team_args );
        if( $team->have_posts() ) : ?>
         <div class="main-content">
            <div class="container">
                <div class="teams-grid archive-grig"> 
                    <?php while( $team->have_posts() ) : $team->the_post(); ?>
                        <article class="team-item"> 
                            <a href="javascript:void(0)" data-orderby="<?php echo $orderby; ?>" data-order="<?php echo $order; ?>" data-title="<?php echo get_the_title(); ?>" data-id="<?php echo get_the_ID(); ?>" class="ajax-team">
                            <div class="team-image"> 
                                    <?php echo get_the_post_thumbnail($post->ID, 'team-thumbnails'); ?>
                            </div> 
                            <div class="team-text"> 
                            	<h6 class="team-type"><?php echo get_the_term_list( $post->ID, 'team_cat', '', ', ' ); ?></h6>
                           		<h4 class="team-title"><?php echo get_the_title(); ?></h4>
                            </div> 
                            </a>
                        </article>	
                    <?php endwhile; ?>
                 </div>
                 <div class="col-xs-12 navigation m-t-50 clearfix">
                    <?php physio_paging_nav(); ?>
                  </div>
            </div>
        </div>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
	</div>
</div>
<?php get_footer(); ?>