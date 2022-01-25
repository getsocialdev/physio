<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if( !class_exists( 'PHYSIO_team_filter' ) ) {
    class PHYSIO_team_filter {
        private $shortcode;
        function __construct() {
            /* shortcode base */
            $this->shortcode = 'physio_team_filter';
            add_action( 'vc_after_init', array( $this, 'physio_map_shortcode' ) );
            add_shortcode( $this->shortcode, array( $this, 'physio_create_shortcode' ) );	
		}
        function physio_map_shortcode( $atts, $content = NULL ) {
			$teamCatList = array();
			if( taxonomy_exists('team_cat') ){
				$teamCatList_data = get_terms( 'team_cat', array( 'hide_empty' => true ) );
				$teamCatList      = array();
				foreach($teamCatList_data as $cat){
					$teamCatList[ esc_attr($cat->name) . ' (' . esc_attr($cat->count) . ')' ] = esc_attr($cat->slug);
				}
			}  
            if( function_exists( 'vc_map' ) ) {
                vc_map(
                    array(
                        'name'            => esc_html__( 'Team Filter', 'physio' ),
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
								  "heading"     => __("Select Team"),
								  "param_name"  => "category",
								  "value"       => $teamCatList,
								  'admin_label'       => true,
								  "std"         => " ",
								  "description" => __("display all the filter.")
							),
							array(
								"type"        => "dropdown",
								"heading"     => esc_attr__("Order by"),
								"description" => esc_attr__("Sort retrieved portfolio by parameter."),
								"param_name"  => "orderby",
								"std"         => " ",
								"value"       => array(
									esc_attr__('No order (none)')           => 'none',
									esc_attr__('Order by title (title)')    => 'title',
									esc_attr__('Order by slug (name)')      => 'name',
									esc_attr__('Order by date (date)')      => 'date',
									esc_attr__('Random order (rand)')       => 'rand',
									
								),
								'edit_field_class' => 'vc_col-sm-6 vc_column',
							),
							array(
								"type"        => "dropdown",
								"heading"     => esc_attr__("Order"),
								"description" => esc_attr__("Designates the ascending or descending order of the 'orderby' parameter."),
								"param_name"  => "order",
								"std"         => "DESC",
								"value"       => array(
									esc_attr__('Ascending (1, 2, 3; a, b, c)')  => 'ASC',
									esc_attr__('Descending (3, 2, 1; c, b, a)') => 'DESC',
								),
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
            extract( shortcode_atts( array (
                'category'           => '',
				'orderby'           => '',
				'order'           => '',
				'css'           => '',
            ), $atts ) ); 
            /* unique listz ID */
            $id = uniqid("physio_csf_");
			global $post;
            $output = '';
			if ($category != ''){
				$values = explode(",",$category);
// 				array(6) { [0]=> string(18) "athletic-therapist" [1]=> string(13) "kinesiologist" [2]=> string(15) "massage-therapy" [3]=> string(6) "office" [4]=> string(34) "pediatric-sport-medicine-physician" [5]=> string(15) "physiotherapist" } 
				$to_order = array("physiotherapist", "pediatric-sport-medicine-physician", "massage-therapy", "athletic-therapist", "kinesiologist", "office");
				$values = $to_order;
				if( !empty( $values ) && is_array( $values ) ) {
					$output .= '<div class="teams-filter teams-filter-group">';
					  $output .= '<ul>';
						foreach( $values as $value ) {
							$cat = get_term_by( 'slug', $value, 'team_cat');
							if ($value == "physiotherapist") {
								$output .= '<li>';
								  $output .= '<button class="btn-filter is-active" data-filter=".'.$value.'">'.$cat->name.'</button>';
								$output .= '</li>';
							} else {
								$output .= '<li>';
								  $output .= '<button class="btn-filter" data-filter=".'.$value.'">'.$cat->name.'</button>';
								$output .= '</li>';
							}
							
						}
						$output .= '<li>';
						  $output .= '<button class="btn-filter" data-filter="*">View all</button>';
						$output .= '</li>';
					  $output .= '</ul>';
					$output .= '</div>';
					$order = 'ASC';
					$args = array(
					'post_type' => 'team',
// 					'orderby' => $orderby,
					'orderby' => 'menu_order',
					'order' => $order,
					'posts_per_page' => -1,
					'tax_query' => array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'team_cat',
							'field'    => 'slug',
							'terms'    => $values,
						),
					),
				);
				$query = new WP_Query( $args );
				
// 				var_dump($args);
				if( $query->have_posts() ) :
				$output .= '<div id="' . esc_attr( $id) . '" class="teams-grid">';
					while( $query->have_posts() ) : $query->the_post();
					$term_obj_list = get_the_terms( $post->ID, 'team_cat' );
// 					var_dump($term_obj_list);
					if ( ! empty( $term_obj_list ) && ! is_wp_error( $term_obj_list ) ) {
						$terms_slug_string = join(' ', wp_list_pluck($term_obj_list, 'slug'));
					}
						$output .= '<article class="team-item '.$terms_slug_string.'">'; 
							$output .= '<a href="javascript:void(0)" data-orderby="'.$orderby.'" data-order="'.$order.'" data-title="'.get_the_title().'" data-id="'.get_the_ID().'" class="ajax-team">';
								$output .= '<div class="team-image">'; 
									
										$output .= get_the_post_thumbnail($post->ID, 'team-thumbnails'); 
									 
								$output .= '</div>'; 
								
								$output .= '<div class="team-text">'; 
								
								if ( ! empty( $term_obj_list ) && ! is_wp_error( $term_obj_list ) ) {
									$terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));
								}
								$output .= '<h6 class="team-type">'.$terms_string.'</h6>'; 
								/*$output .= '<h6 class="team-type">'.get_the_term_list( $post->ID, 'team_cat', '', ', ' ).'</h6>';*/ 
								$output .= '<h4 class="team-title">'.get_the_title().'</h4>';
								$output .= '</div>'; 
								$output .= '</a>';
							$output .= '</article>';  
					endwhile;
				$output .= '</div>';
				endif;
				wp_reset_query();
				$output .= '<div id="team-content"></div>';
				}
			}else{
				$terms = get_terms( array( 
					'taxonomy' => 'team_cat',
					'parent'   => 0,
					'orderby' => $orderby,
					'order' => $order,
					'hide_empty' => 1,
				) );
				if( !empty( $terms ) && is_array( $terms ) ) {
					$output .= '<div class="teams-filter teams-filter-group">';
					  $output .= '<ul>';
						foreach( $terms as $term ) {
							$output .= '<li>';
							  $output .= '<button class="btn-filter" data-filter=".'.$term->slug.'">'.$term->name.'</button>';
							$output .= '</li>';
						}
						$output .= '<li>';
						  $output .= '<button class="btn-filter is-active" data-filter="*">View all</button>';
						$output .= '</li>';
						$output .= '</ul>';
					$output .= '</div>';
						$args = array(
						'post_type' => 'team',
						'orderby' => $orderby,
						'order' => $order,
						'posts_per_page' => -1
					);
					$query = new WP_Query( $args );
					if( $query->have_posts() ) :
					$output .= '<div id="' . esc_attr( $id) . '" class="teams-grid">';
						while( $query->have_posts() ) : $query->the_post();
						$term_obj_list = get_the_terms( $post->ID, 'team_cat' );
						if ( ! empty( $term_obj_list ) && ! is_wp_error( $term_obj_list ) ) {
							$terms_slug_string = join(' ', wp_list_pluck($term_obj_list, 'slug'));
						}
							$output .= '<article class="team-item '.$terms_slug_string.'">'; 
							$output .= '<a href="javascript:void(0)" data-orderby="'.$orderby.'" data-order="'.$order.'" data-title="'.get_the_title().'" data-id="'.get_the_ID().'" class="ajax-team">';
								$output .= '<div class="team-image">'; 
									
										$output .= get_the_post_thumbnail($post->ID, 'team-thumbnails'); 
									 
								$output .= '</div>'; 
								
								$output .= '<div class="team-text">'; 
								
								if ( ! empty( $term_obj_list ) && ! is_wp_error( $term_obj_list ) ) {
									$terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));
								}
								$output .= '<h6 class="team-type">'.$terms_string.'</h6>'; 
								/*$output .= '<h6 class="team-type">'.get_the_term_list( $post->ID, 'team_cat', '', ', ' ).'</h6>';*/ 
								$output .= '<h4 class="team-title">'.get_the_title().'</h4>';
								$output .= '</div>'; 
								$output .= '</a>';
							$output .= '</article>'; 
						endwhile;
					$output .= '</div>';
					endif;
					wp_reset_query();
					$output .= '<div id="team-content"></div>';
				}
			}
            return '<div class="team_element ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->shortcode, $atts ) . '">' . $output . '</div>'; 
        }     
    }
}
new PHYSIO_team_filter;		
?>