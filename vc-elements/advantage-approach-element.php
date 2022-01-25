<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if( !class_exists( 'PHYSIO_Advantage_Approach' ) ) {
    class PHYSIO_Advantage_Approach {
        private $shortcode;
        function __construct() {
            /* shortcode base */
            $this->shortcode = 'physio_advantage_approach';
            add_action( 'vc_after_init', array( $this, 'physio_map_shortcode' ) );
            add_shortcode( $this->shortcode, array( $this, 'physio_create_shortcode' ) );	
		}
        function physio_map_shortcode( $atts, $content = NULL ) {   
            if( function_exists( 'vc_map' ) ) {
                vc_map(
                    array(
                        'name'            => esc_html__( 'Advantage Approach', 'physio' ),
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
                                'heading'       => esc_html__( 'List Items', 'physio' ),
                                'param_name'    => 'values',
                                'params' => array(
                                    array(
                                        'type'          => 'textfield',
                                        'heading'       => esc_html__( 'Circle Title ', 'physio' ),
                                        'param_name'    => 'circle_title',
										'admin_label'       => true,                                                                               
                                    ),
									array(
										'type'              => 'colorpicker',
										'heading'           => esc_html__( 'Circle Title Color', 'physio' ),
										'param_name'        => 'circle_title_color',
									),
									array(
										'type'              => 'colorpicker',
										'heading'           => esc_html__( 'Circle Background Color', 'physio' ),
										'param_name'        => 'circle_background_color',
									),
									array(
										'type'          => 'textarea',
										'heading'       => esc_html__( 'Main Heading', 'physio' ),
										'param_name'    => 'main_heading',
									),
									array(
										'type'          => 'textarea',
										'heading'       => esc_html__( 'List Content', 'physio' ),
										'param_name'    => 'list_content',
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
            $id = uniqid("physio_aa_");
            $output = '';
            if( !empty( $values ) && is_array( $values ) ) {
                $output .= '<div id="' . esc_attr( $id) . '" class="approach-block">';
					$i = 1;
                    foreach( $values as $value ) {
						if(!empty($value['circle_background_color'])){
							$css_bg_style = 'style=';
							if(!empty($value['circle_background_color'])) { $css_bg_style .= 'background:' . $value['circle_background_color'] . ';'; }
						}
						if(!empty($value['circle_title_color'])){
							$css_text_style = 'style=';
							if(!empty($value['circle_title_color'])) { $css_text_style .= 'color:' . $value['circle_title_color'] . ';'; }
						}
						$output .= '<div class="approach-item">';
							if( !empty( $value['circle_title'] ) ) {
								$output .= '<div class="approach-circle" '.$css_bg_style.'><h3 class="circle-text" '.$css_text_style.'>'.$value['circle_title'].'</h3></div>';
							}
							$output .= '<div class="approach-desc">';
							$output .= '<div class="approach-no"><span>'.$i.'</span></div>';
							if( !empty( $value['main_heading'] ) ) {
								$output .= '<h4 class="approach-title">'.$value['main_heading'].'</h4>';
							}
							if( !empty( $value['list_content'] ) ) {
								$output .= '<div class="approach-text">'.$value['list_content'].'</div>';
							}
							$output .= '</div>';
							$i++;
						$output .= '</div>';
                    }
                $output .= '</div>';
            }
            return '<div class="wpb_content_element ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->shortcode, $atts ) . '">' . $output . '</div>'; 
        }     
    }
}
new PHYSIO_Advantage_Approach;		
?>