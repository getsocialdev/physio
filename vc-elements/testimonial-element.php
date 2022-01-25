<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if( !class_exists( 'PHYSIO_Testimonials' ) ) {
    class PHYSIO_Testimonials {
        private $shortcode;    
        function __construct() {
            /* shortcode base */
            $this->shortcode = 'physio_testimonials';
            add_action( 'vc_after_init', array( $this, 'physio_map_shortcode' ) );
            add_shortcode( $this->shortcode, array( $this, 'physio_create_shortcode' ) );	
		}
        function physio_map_shortcode( $atts, $content = NULL ) {
            if( function_exists( 'vc_map' ) ) {             
                vc_map( array(
					"name"                    => __( "Testimonials", "physio_shortcodes" ),
					'icon'            => get_template_directory_uri(). '/images/rws-icon.png',
					'base'            => $this->shortcode,
					'category'        => 'RWS',
					'class'           => 'physio-vc-icon-module physio-structual-module',
                        'content_element' => true,
					"params"                  => array(
						array(
							"type"       => "dropdown",
							"heading"    => __( "Testimonials Style Type", "physio_shortcodes" ),
							"param_name" => 'testimonials_style_type',
							"value"      => array(
								'Style Type 1' => 'style_type_1',
								'Style Type 2'  => 'style_type_2',
								'Style Type 3'  => 'style_type_3',
							),
						),
						array(
							'type'        => 'attach_image',
							'heading'     => esc_html__( 'Image', 'physio_shortcodes' ),
							'param_name'  => 'style_1_image',
							'group'       => 'General',
							'dependency' => array(
									'element' => 'testimonials_style_type',
									'value' => 'style_type_1',
								),
						),
						array(
							'type'        => 'attach_image',
							'heading'     => esc_html__( 'Image', 'physio_shortcodes' ),
							'param_name'  => 'style_2_image',
							'group'       => 'General',
							'dependency' => array(
								'element' => 'testimonials_style_type',
								'value' => 'style_type_2',
							),
						),
						array(
							'type'          => 'textfield',
							'heading'       => esc_html__( 'Name', 'physio_shortcodes' ),
							'param_name'    => 'name',
							'admin_label'   => true,                                                                               
						),
						array(
							'type'           => 'textarea',
							'heading'        => esc_html__( 'Quote Text', 'physio_shortcodes' ),
							'param_name'     => 'quote_text',
						),
					),
				));
            }
        }
        function physio_create_shortcode( $atts, $content = NULL ) {
			 extract( shortcode_atts( array (
					"testimonials_style_type" => '',
					"style_1_image" => '',
					"style_2_image" => '',
					"name" => '',
					"quote_text" => '',
				), $atts ) ); 
			/* unique listz ID */
            $id = uniqid("physio_sst_");
			$output = '';
			$types = array();
			if(!empty($testimonials_style_type) && $testimonials_style_type == "style_type_1"){
				$types[] = 'tes-style1';
			}
			else if(!empty($testimonials_style_type) && $testimonials_style_type == "style_type_2"){
				$types[] = 'tes-style2';
			}
			else if(!empty($testimonials_style_type) && $testimonials_style_type == "style_type_3"){
				$types[] = 'tes-style3';
			}
			else{
				$types[] = 'tes-style1';
			}
            $output = '';
				$output .= '<div id="' . esc_attr( $id) . '" class="testimonial-block ' . esc_attr( implode(' ', $types ) ) . '">';
					  $output .= '<div class="tes-item">';
						if(! empty($quote_text)) {
							$output .= '<div class="tes-text">'.$quote_text.'</div>';
						}
						if(! empty($name)) {
							$output .= '<h5 class="tes-author">'.$name.'</h5>';
						}
					  $output .= '</div>';
					$output .= '</div>';
			return '<div class="wpb_content_element ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->shortcode, $atts ) . '">' . $output . '</div>'; 
        }
	}
}
new PHYSIO_Testimonials;		
?>