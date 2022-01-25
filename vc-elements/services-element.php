<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if( !class_exists( 'PHYSIO_Services' ) ) {
    class PHYSIO_Services {
        private $shortcode;
        function __construct() {
            /* shortcode base */
            $this->shortcode = 'physio_services';
            add_action( 'vc_after_init', array( $this, 'physio_map_shortcode' ) );
            add_shortcode( $this->shortcode, array( $this, 'physio_create_shortcode' ) );	
		}
        function physio_map_shortcode( $atts, $content = NULL ) {   
            if( function_exists( 'vc_map' ) ) {
                vc_map(
                    array(
                        'name'            => esc_html__( 'Services', 'physio_shortcodes' ),
                        'icon'            => get_template_directory_uri(). '/images/rws-icon.png',
                        'base'            => $this->shortcode,
                        'category'        => 'RWS',
                        'class'           => 'physio-vc-icon-module physio-structual-module',
                        'content_element' => true,
                        'params'          => array(
                            array(
                                'type'              => 'textfield',
                                'heading'           => esc_html__( 'Description', 'physio_shortcodes' ),
                                'description'       => esc_html__( 'Only for internal use. This adds a label to Visual Composer for an easier element identification.', 'physio_shortcodes' ),
                                'param_name'        => 'list_description',
                                'admin_label'       => true,
                                'group'             => 'General'
                            ),
                            array(
                                'type'          => 'param_group',
                                'heading'       => esc_html__( 'List Items', 'physio_shortcodes' ),
                                'group'         => 'General',
                                'param_name'    => 'values',
                                'params' => array(
									array(
										'type'        => 'attach_image',
										'heading'     => esc_html__( 'Service Image', 'physio_shortcodes' ),
										'param_name'  => 'service_image',
										'group'       => 'General'
									),
                                    array(
                                        'type'          => 'textfield',
                                        'heading'       => esc_html__( 'Service Title', 'physio_shortcodes' ),
                                        'param_name'    => 'service_title',
										'admin_label'       => true,                                                                               
                                    ),
									array(
									'type'              => 'dropdown',
									'heading'           => esc_html__( 'Text', 'physio_shortcodes' ),
									'param_name'        => 'extra_class',
									'group'             => 'General',
									'value'             => array(
										esc_html__( 'Select Class', 'physio_shortcodes' ) => '',
										esc_html__( 'Dark'  , 'physio_shortcodes' ) => 'bg-dark',
										esc_html__( 'Light', 'physio_shortcodes' ) => 'bg-light',
									),
								),
                                ),
                            ),
                            array(
                                'type'          => 'css_editor',
                                'param_name'    => 'css',
                                'group'         => esc_html__( 'Design Options', 'physio_shortcodes' ),
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
            $id = uniqid("physio_ss_");
            $output = '';
			echo $value['extra_class'];
            if( !empty( $values ) && is_array( $values ) ) {
                $output .= '<div id="' . esc_attr( $id) . '" class="home-services">';
                    foreach( $values as $value ) {
						if(!empty($value['extra_class'])){ $extra_class = $value['extra_class']; }
						$output .= '<article class="service-item ' . $extra_class .'">';
						$image    = !empty( $value['service_image'] )    ? wp_get_attachment_url( $value['service_image'] ) : '';
						$image_id = $value['service_image'];
						$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
						$image_title = get_the_title($image_id);
						if( !empty( $image ) ) {
							$output .= '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $image_alt ) . '" title="' . esc_attr( $image_title ) . '" class="service-img"/>'; 
						}
						if( !empty( $value['service_title'] ) ) {
							$output .= '<h3 class="service-title">'.$value['service_title'].'</h3>';
						}
					  $output .= '</article>';	
                    }
                $output .= '</div>';
            }
            return '<div class="wpb_content_element ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->shortcode, $atts ) . '">' . $output . '</div>'; 
        }     
    }
}
new PHYSIO_Services;		
?>