<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if( !class_exists( 'PHYSIO_Posts' ) ) {
    class PHYSIO_Posts {
        private $shortcode;    
        function __construct() {
            /* shortcode base */
            $this->shortcode = 'physio_posts';
            add_action( 'vc_after_init', array( $this, 'physio_map_shortcode' ) );
            add_shortcode( $this->shortcode, array( $this, 'physio_create_shortcode' ) );	
		}
        function physio_map_shortcode( $atts, $content = NULL ) {
            if( function_exists( 'vc_map' ) ) {             
                vc_map( array(
					"name"            => __( "Blog Posts Grid", "physio" ),
					'icon'            => get_template_directory_uri(). '/images/rws-icon.png',
					'base'            => $this->shortcode,
					'category'        => 'RWS',
					'class'           => 'physio-vc-icon-module physio-structual-module',
                    'content_element' => true,
					"params"                  => array(
						array(
							"type"       => "dropdown",
							"heading"    => __( "Posts Style Type", "physio" ),
							"param_name" => 'posts_style_type',
							"value"      => array(
								'Style Type 1' => 'style_type_1',
								'Style Type 2'  => 'style_type_2',
							),
						),
						array(
							'type'              => 'textfield',
							"heading"    => __( "Enter Number of Posts items per view", "physio" ),
							'param_name'        => 'posts_items_per_view_t1',
							'dependency' => array(
								'element' => 'posts_style_type',
								'value' => 'style_type_1',
							),
						),
						array(
							'type'              => 'textfield',
							"heading"    => __( "Enter Number of Posts items per view", "physio" ),
							'param_name'        => 'posts_items_per_view_t2',
							'dependency' => array(
								'element' => 'posts_style_type',
								'value' => 'style_type_2',
							),
						),
					),
				));
            }
        }
        function physio_create_shortcode( $atts, $content = NULL ) {
			$atts = shortcode_atts(
				array(
					"posts_style_type" => 'style_type_1',
					"posts_items_per_view_t1" => '-1',
					"posts_items_per_view_t2" => '-1',
				), $atts
			);
			/* unique listz ID */
            $id = uniqid("physio_sst_");
			$output = '';
				if($atts['posts_style_type'] == 'style_type_1'):
					$pipvt = $atts['posts_items_per_view_t1'];
					$style_type = 'style-1';
				else:
					$pipvt = $atts['posts_items_per_view_t2'];
					$style_type = 'style-2';
				endif;
					$args = array('post_type'=>'post','posts_per_page'=> $pipvt);
					$posts = new WP_Query($args);
					if($posts->have_posts()):
						$output .= '<div id="' . esc_attr( $id) . '" class="blog-grid '.$style_type.'">';
						while($posts->have_posts()):$posts->the_post();
							$term_obj_list = get_the_terms( $post->ID, 'category' );
								if ( ! empty( $term_obj_list ) && ! is_wp_error( $term_obj_list ) ) {
									$terms_slug_string = join(' ', wp_list_pluck($term_obj_list, 'slug'));
								}
								$output .= '<article class="blog-item '.$terms_slug_string.'">'; 
									$output .= '<div class="blog-image">'; 
										$output .= '<a href="'.get_permalink($post->ID).'">'; 
											$output .= get_the_post_thumbnail($post->ID, 'full'); 
										$output .= '</a>'; 
									$output .= '</div>'; 
									
									if ( ! empty( $term_obj_list ) && ! is_wp_error( $term_obj_list ) ) {
										$terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));
									}
									$output .= '<div class="blog-header">';
									/*$output .= '<span class="studies-type">'.$terms_string.'</span>'; */
									$output .= '<span class="blog-type">'.get_the_term_list( $post->ID, 'category', '', ', ' ).'</span>';
									$output .= '<h4 class="blog-title"><a href="'.get_permalink($post->ID).'">'.get_the_title().'<i class="fas fa-chevron-right"></i></a></h4>';
									$output .= '</div>'; 
								$output .= '</article>';
						endwhile;
					$output .= '</div>';
					endif;
			return '<div class="wpb_content_element ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->shortcode, $atts ) . '">' . $output . '</div>'; 
        }
	}
}
new PHYSIO_Posts;		
?>