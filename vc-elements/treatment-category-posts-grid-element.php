<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if( !class_exists( 'PHYSIO_treatment_posts_category_grid' ) ) {
    class PHYSIO_treatment_posts_category_grid {
        private $shortcode;
        function __construct() {
            /* shortcode base */
            $this->shortcode = 'physio_treatment_posts_category_grid';
            add_action( 'vc_after_init', array( $this, 'physio_map_shortcode' ) );
            add_shortcode( $this->shortcode, array( $this, 'physio_create_shortcode' ) );	
		}
        function physio_map_shortcode( $atts, $content = NULL ) {
			$treatmentCatList = array();
			if( taxonomy_exists('treatment_cat') ){
				$treatmentCatList_data = get_terms( 'treatment_cat', array( 'hide_empty' => true ) );
				$treatmentCatList      = array();
				foreach($treatmentCatList_data as $cat){
					$treatmentCatList[ esc_attr($cat->name) . ' (' . esc_attr($cat->count) . ')' ] = esc_attr($cat->slug);
				}
			}  
            if( function_exists( 'vc_map' ) ) {
                vc_map(
                    array(
                        'name'            => esc_html__( 'Treatment Category Posts Grid', 'physio' ),
                        'icon'            => get_template_directory_uri(). '/images/rws-icon.png',
                        'base'            => $this->shortcode,
                        'category'        => 'RWS',
                        'class'           => 'physio-vc-icon-module physio-structual-module',
                        'content_element' => true,
                        'params'          => array(
                            array(
                                'type'              => 'textfield',
                                'heading'           => esc_html__( 'Description', 'physio' ),
                                'description'       => esc_html__( 'Only for internal use. This adds a label to Visual Composer for an easier element identification.', 'physio' ),
                                'param_name'        => 'list_description',
                                'admin_label'       => true,
                            ),
                            array(
								  "type"        => "checkbox",
								  "heading"     => __("Select Treatment Category"),
								  "param_name"  => "category",
								  "value"       => $treatmentCatList,
								  'admin_label'       => true,
								  "std"         => " ",
								  "description" => __("display all the filter.")
							),
							array(
								"type"        => "dropdown",
								"heading"     => esc_attr__("Order by"),
								"description" => esc_attr__("Sort retrieved portfolio by parameter."),
								"param_name"  => "orderby",
								"value"       => array(
									esc_attr__('No order (none)')           => 'none',
									esc_attr__('Order by title (title)')    => 'title',
									esc_attr__('Order by slug (name)')      => 'name',
									esc_attr__('Order by date (date)')      => 'date',
									esc_attr__('Random order (rand)')       => 'rand',
									
								),
								"std"         => " ",
								'edit_field_class' => 'vc_col-sm-6 vc_column',
							),
							array(
								"type"        => "dropdown",
								"heading"     => esc_attr__("Order"),
								"description" => esc_attr__("Designates the ascending or descending order of the 'orderby' parameter."),
								"param_name"  => "order",
								"value"       => array(
									esc_attr__('Ascending (1, 2, 3; a, b, c)')  => 'ASC',
									esc_attr__('Descending (3, 2, 1; c, b, a)') => 'DESC',
								),
								"std"         => "DESC",
								'edit_field_class' => 'vc_col-sm-6 vc_column',
							),
							array(
                                'type'          => 'css_editor',
                                'param_name'    => 'css',
                                'group'         => esc_html__( 'Design Options', 'physio' ),
                            ),
                        )                        
                    )
                ); /* end mapping */
            }
        }
        function physio_create_shortcode( $atts, $content = NULL ) {
            /*extract( vc_map_get_attributes( array (
                'category'           => '',
				'orderby'           => '',
				'order'           => '',
				'layout_styles'   => '',
				'css'           => '',
            ), $atts ) ); */
			$atts = vc_map_get_attributes($this->shortcode,$atts);
			extract($atts);
            /* unique listz ID */
            $id = uniqid("physio_tcpg_");
			global $post;
            $output = '';
			if ($category != ''){
				$values = explode(",",$category);
				if( !empty( $values ) && is_array( $values ) ) {
					 $args = array(
						'post_type' => 'treatment',
						'orderby' => $orderby,
						'order' => $order,
						'tax_query' => array(
							'relation' => 'AND',
							array(
								'taxonomy' => 'treatment_cat',
								'field'    => 'slug',
								'terms'    => $values,
							),
						),
					);
					$query = new WP_Query($args); 
					if($query->have_posts()) :
					$output .= '<div id="' . esc_attr( $id) . '" class="treatment-grid style-3">';
					$output .= '<div class="treatment-sizer"></div>';
					while( $query->have_posts() ) : $query->the_post();
						$output .= '<div class="treatment-item">';
							$output .= '<div class="treatment">';									
								$output .= '<a href="'.get_permalink($post->ID).'">';
									if (has_post_thumbnail($post->ID)) {
										$output .= get_the_post_thumbnail($post->ID, 'full');
									}
									if( !empty(get_the_title())){
										$output .= '<h4 class="name">'.get_the_title().'</h4>';
									}
								$output .= '</a>';
							$output .= '</div>';
						$output .= '</div>';
					endwhile; wp_reset_postdata();
					$output .= '</div>';
					endif;
					wp_reset_query();
				}
			}else{
				$terms = get_terms( array( 
					'taxonomy' => 'treatment_cat',
					'parent'   => 0,
					'orderby' => $orderby,
					'order' => $order,
					'hide_empty' => true
				) );
				if( !empty( $terms ) && is_array( $terms ) ) {
					$args = array(
						'post_type' => 'treatment',
						'orderby' => $orderby,
						'order' => $order,
					);
					$query = new WP_Query( $args ); 
					if( $query->have_posts() ) :
					$output .= '<div id="' . esc_attr( $id) . '" class="treatment-grid style-3">';
					$output .= '<div class="treatment-sizer"></div>';
					while( $query->have_posts() ) : $query->the_post();
						$output .= '<div class="treatment-item">';
							$output .= '<div class="treatment">';									
								$output .= '<a href="'.get_permalink($post->ID).'">';
									if (has_post_thumbnail($post->ID)) {
										$output .= get_the_post_thumbnail($post->ID, 'full');
									}
									if( !empty(get_the_title())){
										$output .= '<h4 class="name">'.get_the_title().'</h4>';
									}
								$output .= '</a>';
							$output .= '</div>';
						$output .= '</div>';
					endwhile; wp_reset_postdata();
					$output .= '</div>';
					endif;
					wp_reset_query();
				}
			}
            return '<div class="wpb_content_element ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->shortcode, $atts ) . '">' . $output . '</div>'; 
        }     
    }
}
new PHYSIO_treatment_posts_category_grid;		
?>