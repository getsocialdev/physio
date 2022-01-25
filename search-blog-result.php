<?php get_header(); ?>
<?php $search_query = $_GET['s'] != '' ? $_GET['s'] : ''; ?>
<div class="main-content main-wrapper">
    <div class="container">
    <h3 class="hero-heading">Search Results: &quot;<?php echo $search_query; ?>&quot;</h3>
       <?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class( 'search-item' ); ?>>
              <div class="search-details">
                <h3 class="search-title"><a href="<?php the_permalink(); ?>">
                  <?php the_title(); ?>
                  </a></h3>
                <div class="search-excerpt">
                  <?php the_excerpt(); ?>
                </div>
                <div class="read-more"> <a href="<?php the_permalink(); ?>">Read More</a> </div>
              </div>
            </div>
            <?php endwhile; ?>
            <div class="col-xs-12 navigation clearfix">
              <?php physio_paging_nav(); ?>
            </div>
        <?php else: ?>
        	<h3>No Blog Posts Found.</h3>
        <?php endif; ?>
   </div>
</div>
<?php get_footer(); ?>