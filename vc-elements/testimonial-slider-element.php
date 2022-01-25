<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if( !class_exists( 'PHYSIO_testimonial_slider' ) ) {
    class PHYSIO_testimonial_slider {
        private $shortcode;
        function __construct() {
            /* shortcode base */
            $this->shortcode = 'physio_testimonial_slider';
            add_action( 'vc_after_init', array( $this, 'physio_map_shortcode' ) );
            add_shortcode( $this->shortcode, array( $this, 'physio_create_shortcode' ) );	
		}
        function physio_map_shortcode( $atts, $content = NULL ) {   
            if( function_exists( 'vc_map' ) ) {
                vc_map(
                    array(
                        'name'            => esc_html__( 'Testimonial Slider', 'physio' ),
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
                                'type'          => 'param_group',
                                'heading'       => esc_html__( 'Testimonial Items', 'physio' ),
                                'param_name'    => 'values',
                                'params' => array(
                                    array(
                                        'type'          => 'textfield',
                                        'heading'       => esc_html__( 'Name', 'physio' ),
                                        'param_name'    => 'name',
										'admin_label'   => true,                                                                               
                                    ),
									array(
										'type'           => 'textarea',
										'heading'        => esc_html__( 'Quote Text', 'physio' ),
										'param_name'     => 'quote_text',
									),
                                ),
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
                'values'           => '',
                'css'              => ''
            ), $atts ) ); 
            /* extract list items */
            if( function_exists('vc_param_group_parse_atts') && !empty( $values ) ) {
                $values = vc_param_group_parse_atts( $values );                
            }
            /* unique listz ID */
            $id = uniqid("physio_ts_");
            $output = '';
            if( !empty( $values ) && is_array( $values ) ) {
				$output .= '<div id="' . esc_attr( $id) . '" class="testimonial-slider">';
				$output .= '<div class="testimonial-block tes-style1">';
                	$output .= '<div class="testimonial-slick">';
						foreach( $values as $value ) {
								$output .= '<div class="tes-item">';
									if( !empty( $value['quote_text'] ) ) {
										$output .= '<div class="tes-text">'.$value['quote_text'].'</div>';
									}
									if( !empty( $value['name'] ) ) {
										$output .= '<h3 class="tes-author">'.$value['name'].'</h3>';
									}
								$output .= '</div>';
						}
                	$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
            }
            return '<div class="wpb_content_element ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->shortcode, $atts ) . '">' . $output . '</div>'; 
        }     
    }
}
new PHYSIO_testimonial_slider;		
?>