<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if( !class_exists( 'PHYSIO_Custom_links' ) ) {
    class PHYSIO_Custom_links {
        private $shortcode;
        function __construct() {
            /* shortcode base */
            $this->shortcode = 'physio_custom_links';
            add_action( 'vc_after_init', array( $this, 'physio_map_shortcode' ) );
            add_shortcode( $this->shortcode, array( $this, 'physio_create_shortcode' ) );	
		}
        function physio_map_shortcode( $atts, $content = NULL ) {   
            if( function_exists( 'vc_map' ) ) {
                vc_map(
                    array(
                        'name'            => esc_html__( 'Custom Links', 'physio' ),
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
                                'group'             => 'General'
                            ),
                            array(
                                'type'          => 'param_group',
                                'heading'       => esc_html__( 'List Items', 'physio' ),
                                'group'         => 'General',
                                'param_name'    => 'values',
                                'params' => array(
									array(
                                        'type'          => 'textfield',
                                        'heading'       => esc_html__( 'Custom Label', 'physio' ),
                                        'param_name'    => 'custom_label',
										'admin_label'       => true,                                                                               
                                    ),
                                    array(
                                        'type'          => 'checkbox',
                                        'heading'       => esc_html__( 'Custom is a link?', 'physio' ),
                                        'param_name'    => 'is_link',
                                    ), 
                                    array(
                                        'type'          => 'vc_link',
                                        'heading'       => esc_html__( 'Custom Link', 'physio' ),
                                        'param_name'    => 'custom_link',
                                        'dependency'    => array(
                                            'element' => 'is_link',
                                            'value'   => array( 'true' ),
                                        )
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
            $id = uniqid("physio_cl_");
            $output = '';
            if( !empty( $values ) && is_array( $values ) ) {
                $output .= '<ul id="' . esc_attr( $id) . '" class="page-menu">';
                    foreach( $values as $value ) {
						if( isset( $value['is_link'] ) && $value['is_link'] && !empty( $value['custom_link'] ) ) {	
							$link = vc_build_link( $value['custom_link'] );
							$url    = !empty( $link['url'] )    ? $link['url'] : '';
							$target = !empty( $link['target'] ) ? $link['target'] : '_self';
							$title  = !empty( $link['title'] )  ? $link['title'] : '';
							$rel    = !empty( $link['rel'] )    ? 'rel="' . esc_attr( trim( $link['rel'] ) ) . '"' : '';
						}
						if( !empty( $value['custom_label'] ) ) { $custom_label = $value['custom_label']; }
						if( isset( $value['is_link'] ) && $value['is_link'] && !empty( $value['custom_label'] )) {            
							$output .= '<li><a  title="' . esc_attr( $title ) . '" href="' . esc_url( $url ) . '" target="' . esc_attr( $target ) . '" ' . $rel . ' class="line-link">'.$custom_label.'</a></li>';		
						}
                    }
                $output .= '</ul>';
            }
            return '<div class="wpb_content_element ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->shortcode, $atts ) . '">' . $output . '</div>'; 
        }     
    }
}
new PHYSIO_Custom_links;		
?>