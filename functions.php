<?php
defined('ABSPATH') || exit;
define('TEMPLATEDIRECTORY', get_template_directory());
define('ASSETS_URL', get_template_directory_uri());
define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
require_once dirname( __FILE__ ) . '/inc/options-framework.php';
require_once dirname( __FILE__ ) . '/inc/class-tgm-plugin-activation.php';
include( TEMPLATEDIRECTORY . "/inc/custom-post.php" );
include( TEMPLATEDIRECTORY . "/inc/shortcode.php" );
include( TEMPLATEDIRECTORY . "/inc/metabox.php" );
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
add_action( 'tgmpa_register', 'physio_register_required_plugins' );
function physio_register_required_plugins() {
	$plugins = array(
		array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'           => true,
            'version'            => '',
            'external_url'       => '',
		),
		array(
			'name'      => 'WPBakery Page Builder',
			'slug'      => 'js_composer',
			'source'=> get_stylesheet_directory().'/inc/plugins/js_composer.zip',
			'version'            => '',
			'required'           => true,
		)
	);
	tgmpa( $plugins, $config );
}
register_nav_menus(array(
	'primary' => __('Primary Menu', 'physio'),
	'policy-menu' => __('Policy Menu', 'physio')
));
add_post_type_support('page', 'excerpt');
add_theme_support('menus');
add_filter('widget_text','do_shortcode');
add_theme_support( 'html5', array('search-form','comment-form','comment-list','gallery','caption'));
if (is_singular() && comments_open() && get_option('thread_comments')) { wp_enqueue_script( 'comment-reply' ); }
if(function_exists('add_theme_support')) {
    add_theme_support('automatic-feed-links');
}
if (!function_exists('physio_add_image_sizes')) {
	function physio_add_image_sizes(){
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'team-thumbnails', 600, 600, true);
	}
}
physio_add_image_sizes();
function des_ie_scripts() {
    echo '<!--[if lt IE 9]>';
    echo '<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>';
    echo '<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>';
    echo '<![endif]-->';
	 echo '<!--[if lt IE 9]>';
    echo '<script src="'.get_template_directory_uri().'js/ie8-responsive-file-warning.js"></script>';
    echo '<![endif]-->';
}
add_action('wp_head', 'des_ie_scripts');
if (is_singular() && comments_open() && get_option('thread_comments'))
        wp_enqueue_script('comment-reply');
function physio_register_js() {
	global $wp_styles, $wp_scripts;
	$protocol = is_ssl() ? 'https' : 'http';
		wp_register_script('physio-ie-emulation-modes-warning-js', get_template_directory_uri() . '/js/ie-emulation-modes-warning.js', 'jquery', '20190709', FALSE);
		wp_register_script('physio-jquery-min-js', get_template_directory_uri() . '/js/jquery.min.js', 'jquery', '20190709', TRUE);
		wp_register_script('physio-bootstrap-min-js', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery', '20190709', TRUE);
		wp_register_script('physio-jqueryui-js', get_template_directory_uri() . '/js/jquery-ui.min.js', 'jquery', '20190709', TRUE);
		wp_register_script('physio-smoothscroll-js', get_template_directory_uri() . '/js/smoothscroll.min.js', 'jquery', '20190709', TRUE);
		wp_register_script('physio-imagesloaded-pkgd-js', get_template_directory_uri() . '/js/imagesloaded.pkgd.js', 'jquery', '20190316', TRUE);
		wp_register_script('physio-isotope-pkgd-min-js', get_template_directory_uri() . '/js/isotope.pkgd.min.js', 'jquery', '20190316', TRUE);
		wp_register_script('physio-slick-js', get_template_directory_uri() . '/js/slick.min.js', 'jquery', '20190709', TRUE);
		wp_register_script('physio-select2-min-js', get_template_directory_uri() . '/js/select2.min.js', 'jquery', '20190709', TRUE);
		wp_enqueue_script('physio-jquery-auto-complete-js', get_template_directory_uri() . '/js/jquery.auto-complete.min.js',array('jquery'),'1.0.7',TRUE);
		wp_register_script('physio-lightgallery-js', get_template_directory_uri() . '/js/lightgallery-all.min.js', 'jquery', '20190709', true);
		wp_register_script('physio-lg-thumbnail-js', get_template_directory_uri() . '/js/lg-thumbnail.min.js', 'jquery', '20190709', true);
		wp_register_script('physio-custom-js', get_template_directory_uri() . '/js/custom.js', 'jquery', '20220125', TRUE);
		wp_register_script('physio-ie10-viewport-bug-workaround-js', get_template_directory_uri() . '/js/ie10-viewport-bug-workaround.js', 'jquery', '20190709', TRUE);
		
		wp_enqueue_script('physio-ie-emulation-modes-warning-js');
		wp_enqueue_script('physio-jquery-min-js');
		wp_enqueue_script('physio-bootstrap-min-js');
		wp_enqueue_script('physio-jqueryui-js');
		wp_enqueue_script('physio-smoothscroll-js');
		wp_enqueue_script('physio-imagesloaded-pkgd-js');
		wp_enqueue_script('physio-isotope-pkgd-min-js');
		wp_enqueue_script('physio-slick-js');
		wp_enqueue_script('physio-select2-min-js');
		wp_enqueue_script('physio-lightgallery-js');
		wp_enqueue_script('physio-lg-thumbnail-js');
		wp_enqueue_script('physio-custom-js');
		wp_enqueue_script('physio-ie10-viewport-bug-workaround-js');
}
add_action('wp_enqueue_scripts', 'physio_register_js');
function physio_main_styles() {
	global $wp_styles, $wp_scripts;
	$protocol = is_ssl() ? 'https' : 'http';	 
		wp_register_style('physio-bootstrap-min', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '20190709');
		wp_register_style('physio-fontawesome-all-min', get_template_directory_uri() . '/css/fontawesome-all.min.css', array(), '20190709');
		wp_register_style('physio-ie10-viewport-bug-workaround', get_template_directory_uri() . '/css/ie10-viewport-bug-workaround.css', array(), '20190709');
		wp_register_style('physio-animate', get_template_directory_uri() . '/css/animate.css', array(), '20190709');
		wp_register_style('physio-jqueryui', get_template_directory_uri() . '/css/jquery-ui.min.css', array(), '20190709');
		wp_register_style('physio-slick', get_template_directory_uri() . '/css/slick.min.css', array(), '20190709');
		wp_register_style('physio-select2-min', get_template_directory_uri() . '/css/select2.min.css', array(), '20190709');
		wp_register_style('physio-lightgallery', get_template_directory_uri() . '/css/lightgallery.min.css', array(), '20190709');
		
		wp_register_style('physio-main-style', get_template_directory_uri() . '/style.css', array(), '2021208');
		wp_register_style('physio-style', get_template_directory_uri() . '/css/style.min.css', array(), '20220120');

		 wp_enqueue_style('physio-bootstrap-min');
		 wp_enqueue_style('physio-fontawesome-all-min'); 
		 wp_enqueue_style('physio-ie10-viewport-bug-workaround');
		 wp_enqueue_style('physio-animate');
		 wp_enqueue_style('physio-jqueryui');
		 wp_enqueue_style('physio-slick'); 
		 wp_enqueue_style('physio-select2-min'); 
		 wp_enqueue_style('physio-jquery-auto-complete'); 
		 wp_enqueue_style('physio-lightgallery');
		 wp_enqueue_style('physio-main-style');
		 wp_enqueue_style('physio-style'); 
		 wp_enqueue_style('cue8ghp', $protocol.'://use.typekit.net/cue8ghp.css');
}
add_action('wp_enqueue_scripts', 'physio_main_styles');

if (function_exists("register_sidebar")) {
        register_sidebar(array(
            'name' => __('Sidebar'),
            'id' => 'sidebar-1',
            'before_widget' => '<div id="%1$s" class="%2$s widget">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
            'description' => 'Sidebar Widget Area'
        ));
	register_sidebar(array(
            'name' => __('instagram Bottom Widget'),
            'id' => 'instagram-widget',
            'before_widget' => '<div id="%1$s" class="%2$s widget">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
            'description' => 'Bottom Instagram Widget Area'
        ));
	 register_sidebar(array(
            'name' => __('Page Bottom Widget'),
            'id' => 'bottom-widget',
            'before_widget' => '<div id="%1$s" class="%2$s widget">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
            'description' => 'Page Bottom Widget Area'
        ));
	 register_sidebar(array(
            'name' => __('Footer 1'),
            'id' => 'footer-1',
            'before_widget' => '<div id="%1$s" class="%2$s widget">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
            'description' => 'Footer 1 Widget Area'
        ));
	 register_sidebar(array(
            'name' => __('Footer 2 '),
            'id' => 'footer-2',
            'before_widget' => '<div id="%1$s" class="%2$s widget">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
            'description' => 'Footer 2 Widget Area'
        ));
 register_sidebar(array(
            'name' => __('Footer 3'),
            'id' => 'footer-3',
            'before_widget' => '<div id="%1$s" class="%2$s widget">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
            'description' => 'Footer 3 Widget Area'
        ));
}
function physio_paging_nav() {
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );
	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}
	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';
	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '<span class="meta-nav-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></span>', 'physio' ),
		'next_text' => __( '<span class="meta-nav-next"><i class="fa fa-angle-right" aria-hidden="true"></i></span>', 'physio' ),
		'type'      => 'list',
	) );
	if ( $links ) :
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<?php echo $links; ?>
	</nav>
	<?php
	endif;
}
function physio_post_nav() {
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '%title', 'Previous post link', 'physio' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title', 'Next post link',     'physio' ) );
			?>
		</div>
	</nav>
	<?php
}
add_filter('body_class', 'custom_body_class');
function custom_body_class($classes) {
        $classes[] = 'body-innerwrapper';
    return $classes;
}
add_filter('widget_text', 'do_shortcode');
function theme_current_year() {
	return date('Y');
}
add_shortcode('year', 'theme_current_year');
add_action( 'vc_before_init', 'vc_before_init_actions' );
function vc_before_init_actions() {
	require_once( get_template_directory().'/vc-elements/section-heading-element.php' );
	require_once( get_template_directory().'/vc-elements/counter-box-element.php' );
	require_once( get_template_directory().'/vc-elements/testimonial-element.php' );
	require_once( get_template_directory().'/vc-elements/services-element.php' );
	require_once( get_template_directory().'/vc-elements/title-element.php' );
	require_once( get_template_directory().'/vc-elements/testimonial-slider-element.php' );
	require_once( get_template_directory().'/vc-elements/blog-posts-grid-element.php' );
	require_once( get_template_directory().'/vc-elements/team-filter-element.php' );
	require_once( get_template_directory().'/vc-elements/treatment-category-grid-element.php' );
	require_once( get_template_directory().'/vc-elements/treatments-grid-element.php' );
	require_once( get_template_directory().'/vc-elements/custom-links-element.php' );
	require_once( get_template_directory().'/vc-elements/treatment-category-posts-grid-element.php' );
	require_once( get_template_directory().'/vc-elements/advantage-approach-element.php' );
	require_once( get_template_directory().'/vc-elements/group-exercise-posts-grid-element.php' );
}
if ( !function_exists( 'physio_minify_inline_css' ) ) {
    function physio_minify_inline_css( $buffer ) { 
        $buffer = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer );
        $buffer = str_replace( array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer );
        return $buffer;
    }    
}
if (!function_exists('physio_comment')) {
	function physio_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		<li>
			<div class="comment">
				<div class="image"> <?php echo get_avatar($comment, 75); ?> </div>
				<div class="text">
					<h5 class="name"><?php echo get_comment_author_link(); ?></h5>
					<span class="comment_date"><?php _e('Posted at', 'physio'); ?> <?php comment_date('H:i'); ?>h, <?php comment_date('d F'); ?></span>
					<?php comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']) ) ); ?>
					<div class="text_holder" id="comment-<?php echo comment_ID(); ?>">
						<?php comment_text(); ?>
					</div>
				</div>
			</div>                          
		</li>                
		<?php if ($comment->comment_approved == '0') : ?>
			<p><em><?php _e('Your comment is awaiting moderation.', 'physio'); ?></em></p>
		<?php endif; ?>
	<?php 
	}
}
function physio_responsive_img_caption_filter( $val, $attr, $content = null ) {
	extract( shortcode_atts( array(
		'id' => '',
		'align' => '',
		'width' => '',
		'caption' => ''
		), $attr
	) );
	if ( 1 > (int) $width || empty( $caption ) )
		return $val;
	$new_caption = sprintf( '<figure id="%1$s" class="wp-caption %2$s" style="max-width:%3$dpx;">%4$s<figcaption class="wp-caption-text">%5$s</figcaption></figure>',
		esc_attr( $id ),
		esc_attr( $align ),
		( 10 + (int) $width ),
		do_shortcode( $content ),
		$caption
	);
	return $new_caption;
}
add_filter( 'img_caption_shortcode', 'physio_responsive_img_caption_filter', 10, 3 );
function get_excerpt($limit, $source = null){
    if($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));
    $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
    $excerpt = $excerpt.'...';
    return $excerpt;
}
function archive_to_custom_archive() {
    if( is_post_type_archive( 'service' ) ) {
        wp_redirect( home_url(), 301 );
        exit();
    }
}
add_action( 'template_redirect', 'archive_to_custom_archive' );
#-----------------------------------------------------------------#
# Ajax Category Posts Filter with Previous & Next Pagination
#-----------------------------------------------------------------#
function assets() {
    wp_enqueue_script('ajax-filter-posts-js', get_template_directory_uri() . '/js/ajax_filter_posts.js', 'jquery', '20211203', true);
    wp_localize_script( 'ajax-filter-posts-js', 'rws', array('nonce'    => wp_create_nonce( 'rws' ),'ajax_url' => admin_url( 'admin-ajax.php' )));
	wp_enqueue_script( 'ajax-filter-posts-js' );
}
add_action('wp_enqueue_scripts', 'assets', 100);
function vb_filter_posts() {
    if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'rws' ) )
        die('Permission denied');
    $response = array(
        'status'  => 500,
        'message' => 'Something is wrong, please try again later ...',
        'content' => false,
        'found'   => 0
    );
    $tax  = sanitize_text_field($_POST['params']['tax']);
    $term = sanitize_text_field($_POST['params']['term']);
    $page = intval($_POST['params']['page']);
    $qty  = intval($_POST['params']['qty']);
    if (!term_exists( $term, $tax) && $term != 'all-terms') :
        $response = array(
            'status'  => 501,
            'message' => 'Term doesn\'t exist',
            'content' => 0
        );
        die(json_encode($response));
    endif;
    if ($term == 'all-terms') : 
        $tax_qry[] = array(
            'taxonomy' => $tax,
            'field'    => 'slug',
            'terms'    => $term,
            'operator' => 'NOT IN'
        );
    else :
        $tax_qry[] = array(
            'taxonomy' => $tax,
            'field'    => 'slug',
            'terms'    => $term,
        );
    endif;
    $args = array(
        'paged'          => $page,
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => $qty,
        'tax_query'      => $tax_qry
    );
    $qry = new WP_Query($args);
    ob_start();
        if ($qry->have_posts()) : ?>
			<div class="blog-grid style-1">
            <?php while ($qry->have_posts()) : $qry->the_post(); ?>
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
			</div>
            <?php vb_ajax_pager($qry,$page);
            $response = array(
                'status'=> 200,
                'found' => $qry->found_posts
            );            
        else :
            $response = array(
                'status'  => 201,
                'message' => 'No posts found'
            );
        endif;
    $response['content'] = ob_get_clean();
    die(json_encode($response));
}
add_action('wp_ajax_do_filter_posts', 'vb_filter_posts');
add_action('wp_ajax_nopriv_do_filter_posts', 'vb_filter_posts');
function vb_filter_posts_sc($atts) {
    $a = shortcode_atts( array(
        'tax'      => 'category',
        'terms'    => false,
        'active'   => false,
        'per_page' => -1
    ), $atts );
    $result = NULL;
    $terms  = get_terms($a['tax']);
	$terms = array($terms[6], $terms[0], $terms[5], $terms[2], $terms[4], $terms[3], $terms[1]);
    if (count($terms)) :
        ob_start(); ?>
            <div id="container-async" data-paged="<?php echo $a['per_page']; ?>" class="sc-ajax-filter">
                <ul class="nav-filter">
                    <?php foreach ($terms as $term) : ?>
                        <li<?php if ($term->term_id == $a['active']) :?> class="active"<?php endif; ?>>
                            <a href="<?php echo get_term_link( $term, $term->taxonomy ); ?>" data-filter="<?php echo $term->taxonomy; ?>" data-term="<?php echo $term->slug; ?>" data-page="1">
                                <?php echo $term->name; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
					<li>
                        <a href="#" data-filter="<?php echo $terms[0]->taxonomy; ?>" data-term="all-terms" data-page="1">
                            View All
                        </a>
                    </li>
                </ul>
                <div class="post-search"><?php echo do_shortcode('[blog-posts-search]'); ?></div>
                <div class="status"></div>
                <div class="content"></div>
            </div>
        <?php $result = ob_get_clean();
    endif;
    return $result;
}
add_shortcode( 'ajax_filter_posts', 'vb_filter_posts_sc');
function vb_ajax_pager( $query = null, $paged = 1 ) {
    if (!$query)
        return;
    $paginate = paginate_links(array(
        'base'      => '%_%',
        'type'      => 'array',
        'total'     => $query->max_num_pages,
        'format'    => '#page=%#%',
        'current'   => max( 1, $paged ),
        'prev_text' => 'Prev',
        'next_text' => 'Next'
    ));
    if ($query->max_num_pages > 1) : ?>
        <ul class="pagination">
            <?php foreach ( $paginate as $page ) :?>
                <li><?php echo $page; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif;
}
#-----------------------------------------------------------------#
# Ajax Team Data
#-----------------------------------------------------------------#
function add_scripts() {
	wp_register_script( 'team-ajax', get_template_directory_uri() . '/js/team-ajax.js', false );
	wp_localize_script( 'team-ajax', 'TeamAjax', array( 'url' => admin_url( 'admin-ajax.php' ) ),'jquery', '20190316', TRUE );
	wp_enqueue_script( 'team-ajax' );
}
add_action( 'wp_enqueue_scripts', 'add_scripts' );
function team_ajax() {
	$team_id = $_POST['id'];
	$team_title = $_POST['title'];
	$orderby = $_POST['orderby'];
	$order = $_POST['order'];
	$team_data = get_post($team_id);
	?>
	<div class="lightbox">
    
          <div class="ajax-team-data">
        <div class="lightbox-inner" >
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
              <div class="team-pagination">
              	<?php
				$teams_args = array(
				   'posts_per_page'  => -1,
				   'orderby'         => $orderby,
				   'order'           => $order,
				   'post_type'       => 'team',
				); 
				$teams = get_posts( $teams_args );
				$team_ids = array();
				foreach ($teams as $team) {
				   $team_ids[] = $team->ID;
				}
				$current_team = array_search($team_id,$team_ids);
				$previous_team_id = $team_ids[$current_team-1];
				$next_team_id = $team_ids[$current_team+1];
				if ( !empty($previous_team_id) ) {
					echo '<span class="previous"><a href="javascript:void(0)" data-orderby="'.$orderby.'" data-order="'.$order.'" data-title="'.get_the_title($previous_team_id).'" data-id="'.$previous_team_id.'" class="ajax-team">'; 
						echo '<i class="fas fa-angle-left"></i>';
					echo '</a></span>';
				}
				echo '<span class="view-all"><a href="javascript:void(0)" class="ajax-view_all-team team-close">';
					echo "View All Team Members";
				echo '</a></span>';
				if ( !empty($next_team_id) ) {
					echo '<span class="next"><a href="javascript:void(0)" data-orderby="'.$orderby.'" data-order="'.$order.'" data-title="'.get_the_title($next_team_id).'" data-id="'.$next_team_id.'" class="ajax-team">'; 
						echo '<i class="fas fa-angle-right"></i>';
					echo '</a></span>';
				}
				?>
              </div>
            </div>
        </div>
        </div>
      </div>
    </div>
    <?php
exit();
}
add_action( 'wp_ajax_team_ajax', 'team_ajax' );
add_action( 'wp_ajax_nopriv_team_ajax', 'team_ajax' );
#-----------------------------------------------------------------#
# Ajax Post Search
#-----------------------------------------------------------------#
function post_ajax_search_enqueues() {
	wp_register_script('global',get_template_directory_uri().'/js/post_ajax_search.js',array('jquery'),'1.0.1',false);
	wp_localize_script('global','global',array('ajax' => admin_url('admin-ajax.php')),'jquery', '20190318', TRUE);
	wp_enqueue_script('global');
}
add_action( 'wp_enqueue_scripts', 'post_ajax_search_enqueues' );
function post_ajax_search() {
	$search_qury_args = array(
		'post_type'     => 'post',
		'post_status'   => 'publish',
		'nopaging'      => true,
		'posts_per_page'=> 10,
		'search_prod_title' => $_POST['search'],
	);
	add_filter( 'posts_where', 'title_filter', 10, 2 );
	$results = new WP_Query($search_qury_args);
	remove_filter( 'posts_where', 'title_filter', 10, 2 );
	$items = array();
	if($results->have_posts()):
	while($results->have_posts()): $results->the_post();
			$items[] = get_the_title();
	endwhile;
	else:
			$items[] = "No Posts Found.";
	endif;
	wp_reset_query();
	wp_send_json_success( $items );
}
add_action( 'wp_ajax_post_search', 'post_ajax_search' );
add_action( 'wp_ajax_nopriv_post_search', 'post_ajax_search' );
function title_filter( $where, &$wp_query )
{
    global $wpdb;
    if ( $search_term = $wp_query->get( 'search_prod_title' ) ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( like_escape( $search_term ) ) . '%\'';
    }
    return $where;
}
add_action( 'pre_get_posts', 'blog_search_query' );
function blog_search_query( $query ) {
    if ( isset( $_REQUEST['search'] ) && $_REQUEST['search'] == 'blog' && ! is_admin() && $query->is_search && $query->is_main_query() ) {
        $query->set( 'post_type', 'post' );
    }
}
add_action('template_include', 'blog_search_template');
function blog_search_template( $template ) {
  if ( isset( $_REQUEST['search'] ) && $_REQUEST['search'] == 'blog' && is_search() ) {
     $t = locate_template('search-blog-result.php');
     if ( ! empty($t) ) {
         $template = $t;
     }
  }
  return $template;
}
remove_filter( 'pre_term_description', 'wp_filter_kses' );
