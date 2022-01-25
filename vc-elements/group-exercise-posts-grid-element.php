<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if( !class_exists( 'PHYSIO_GE_Posts' ) ) {
    class PHYSIO_GE_Posts {
        private $shortcode;    
        function __construct() {
            /* shortcode base */
            $this->shortcode = 'physio_ge_posts';
            add_action( 'vc_after_init', array( $this, 'physio_map_shortcode' ) );
            add_shortcode( $this->shortcode, array( $this, 'physio_create_shortcode' ) );	
		}
        function physio_map_shortcode( $atts, $content = NULL ) {
            if( function_exists( 'vc_map' ) ) {             
                vc_map( array(
					"name"            => __( "Group Exercise Posts Grid", "physio" ),
					'icon'            => get_template_directory_uri(). '/images/rws-icon.png',
					'base'            => $this->shortcode,
					'category'        => 'RWS',
					'class'           => 'physio-vc-icon-module physio-structual-module',
                    'content_element' => true,
					"params"                  => array(
						array(
							'type'              => 'textfield',
							"heading"    => __( "Enter Number of Posts items per view", "physio" ),
							'param_name'        => 'posts_items_per_view',
							"std"         => "-1",
						),
					),
				));
            }
        }
        function physio_create_shortcode( $atts, $content = NULL ) {
			/*$atts = shortcode_atts(
				array(
					"posts_items_per_view" => '-1',
				), $atts
			);*/
			$atts = vc_map_get_attributes($this->shortcode,$atts);
			extract($atts);
			/* unique listz ID */
            $id = uniqid("physio_gep_");
			$output = '';
				$args = array('post_type'=>'group_exercise','posts_per_page'=> $posts_items_per_view);
					$query = new WP_Query($args);
					if($query->have_posts()):
					$output .= '<div id="' . esc_attr( $id) . '" class="blog-grid style-2">';
					while( $query->have_posts() ) : $query->the_post();
					$term_obj_list = get_the_terms( $post->ID, 'group_exercise_cat' );
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
						$output .= '<span class="blog-type">'.get_the_term_list( $post->ID, 'group_exercise_cat', '', ', ' ).'</span>';
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
new PHYSIO_GE_Posts;		
?>