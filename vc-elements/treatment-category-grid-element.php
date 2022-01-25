<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if( !class_exists( 'PHYSIO_treatment_category_grid' ) ) {
    class PHYSIO_treatment_category_grid {
        private $shortcode;
        function __construct() {
            /* shortcode base */
            $this->shortcode = 'physio_treatment_category_grid';
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
                        'name'            => esc_html__( 'Treatment Category Grid', 'physio' ),
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
								"type"        => "dropdown",
								"heading"     => esc_attr__("Layout Style"),
								"description" => esc_attr__("Select Treatment Style for Layout."),
								'group'         => esc_html__( 'Layout Styles', 'physio' ),
								"param_name"  => "layout_styles",
								"value"       => array(
									'Style 1' => 'style_1',
									'Style 2' => 'style_2',
								),
								'save_always' => true,
								'std'   => 'style_1',
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
            $id = uniqid("physio_tcg_");
			global $post;
            $output = '';
			if ($category != ''){
				$values = explode(",",$category);
				if( !empty( $values ) && is_array( $values ) ) {
					$count = 0;
					$output .= '<div class="treatment-grid">';
					  $output .= '<div class="treatment-sizer"></div>';
						foreach( $values as $value ) {
						$cat = get_term_by( 'slug', $value, 'treatment_cat');
						if($atts['layout_styles'] == 'style_1'):	
							if($count%3 < 1){
								$extra_class = 'width2 height2';
							}else{
								if ($count % 1 == 0){ $extra_class = ''; }else{ $extra_class = ''; }
							}
						$count++;
							$output .= '<div class="treatment-item '.$extra_class.'">';
						else:
							$output .= '<div class="treatment-item">';
						endif;
								$output .= '<div class="treatment">';
									$output .= '<a href="'.get_term_link($cat->slug, 'treatment_cat').'">';
										if(get_field('image','treatment_cat_'.$cat->term_id)) {
											$output .= wp_get_attachment_image(get_field('image','treatment_cat_'.$cat->term_id),'full');
										}
								  		$output .= '<h4 class="name">'.$cat->name.'</h4>';
								  	$output .= '</a>';
								$output .= '</div>';
							$output .= '</div>';
						}
					$output .= '</div>';
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
					$output .= '<div class="row treatment-grid-category">';
					foreach( $terms as $term ) {
						$term_link = get_term_link($term);
						$output .= '<div class="col-sm-12 col-md-6 treatment-grid-category-item">';
						$output .= '<a href="'.esc_url($term_link).'">';
						if(get_field('image','treatment_cat_'.$term->term_id)) {
							$output .= wp_get_attachment_image(get_field('image','treatment_cat_'.$term->term_id),'full');
						}
						$output .= '<h4 class="name">'.$term->name.'</h4>';
						$output .= '</a>';
						$output .= '</div>';
					}
					$output .= '</div>';
				}
			}
            return '<div class="wpb_content_element ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->shortcode, $atts ) . '">' . $output . '</div>'; 
        }     
    }
}
new PHYSIO_treatment_category_grid;		
?>