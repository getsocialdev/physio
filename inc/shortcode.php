<?php
//Social Media Shortcode
add_shortcode('social-links', 'social_medias');
function social_medias($atts=array()) {
    ob_start();
    social_medias_show($atts);
    $content = ob_get_clean();
    return $content;
}
function social_medias_show($atts=array()) {
	if ( of_get_option( 'social_media' ) ) { 
		echo '<div class="social-icons">'.of_get_option( 'social_media' ).'</div>'; 
	}
}
?>
<?php
//Blog Posts Search Shortcode
add_shortcode('blog-posts-search', 'blog_posts_search');
function blog_posts_search($atts=array()) {
    ob_start();
    blog_posts_search_show($atts);
    $content = ob_get_clean();
    return $content;
}
function blog_posts_search_show($atts=array()) { ?>
<?php /*?><?php
global $post;
$posts_data = array();
$args = array('post_type'=>'post','posts_per_page'=> -1,'orderby' => 'date','order' => 'desc');
$posts = new WP_Query($args);
if($posts->have_posts()): ?>
 <select class="ajax-post form-control" name="post">
	<option></option>
	<?php while($posts->have_posts()):$posts->the_post(); ?>
		<option value="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></option>
	<?php endwhile; wp_reset_query(); ?>
 </select>
<?php endif; ?><?php */?>
<form class="blog-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="input-group">
    <input type="text" name="s" class="form-control post-search-autocomplete" placeholder="Search Blog Posts">
    <input type="hidden" name="search" value="blog">
      <span class="input-group-btn">
      	<button type="submit" class="btn btn-black"><i class="fas fa-search"></i></button>
      </span>
</form>
<?php } ?>