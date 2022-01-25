<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if( !class_exists( 'PHYSIO_Counter_Box' ) ) {
    class PHYSIO_Counter_Box {
        private $shortcode;
        function __construct() {
            /* shortcode base */
            $this->shortcode = 'physio_counter_box';
            add_action( 'vc_after_init', array( $this, 'physio_map_shortcode' ) );
            add_shortcode( $this->shortcode, array( $this, 'physio_create_shortcode' ) );	
		}
        function physio_map_shortcode( $atts, $content = NULL ) {   
            if( function_exists( 'vc_map' ) ) {
                vc_map(
                    array(
                        'name'            => esc_html__( 'Counter Box', 'physio_shortcodes' ),
                        'icon'            => get_template_directory_uri(). '/images/rws-icon.png',
                        'base'            => $this->shortcode,
                        'category'        => 'RWS',
                        'class'           => 'physio-vc-counter-box-module physio-structual-module',
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
								'type'              => 'textfield',
								'heading'           => esc_html__( 'Counter Number', 'wdgs_shortcodes' ),
								'description'       => esc_html__( 'Eneter Counter Number' , 'physio_shortcodes' ),
								'param_name'        => 'counter_number',
								'group'             => 'General'
							),
							array(
								'type'              => 'textfield',
								'heading'           => esc_html__( 'Number Suffix', 'wdgs_shortcodes' ),
								'description'       => esc_html__( '(optional) Number Suffix as Plus Sign' , 'physio_shortcodes' ),
								'param_name'        => 'number_suffix',
								'group'             => 'General'
							),
							array(
								  "type" => "colorpicker",
								  "class" => "",
								  "heading" => __( "Number color", "physio_shortcodes" ),
								  "param_name" => "number_color",
								  "value" => '',
								  "description" => __( "Choose Number Color", "physio_shortcodes" ),
								  'group'         => 'General',
							 ),
							 array(
								'type'          => 'textarea',
								'heading'       => esc_html__( 'Title', 'physio_shortcodes' ),
								'param_name'    => 'title',
								'admin_label'       => true,
								'group'         => 'General',                                                                            
							),
							 array(
								  "type" => "colorpicker",
								  "class" => "",
								  "heading" => __( "Text color", "physio_shortcodes" ),
								  "param_name" => "text_color",
								  "value" => '',
								  "description" => __( "Choose Text Color", "physio_shortcodes" ),
								  'group'         => 'General',
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
				'counter_number'          	=> '',
				'number_suffix'          	=> '',
				'number_color'          	=> '',
				'title'          			=> '',
				'text_color'          		=> '',
            ), $atts ) ); 
            /* extract list items */
            if( function_exists('vc_param_group_parse_atts') && !empty( $values ) ) {
                $values = vc_param_group_parse_atts( $values );                
            }
            /* unique listz ID */
            $id = uniqid("physio_cb_");
            $output = '';
			if(!empty($number_color)){
				$css_number_style = 'style=';
				if(!empty($number_color)) { $css_number_style .= 'color:' . $number_color . ';'; }
			}
			if(!empty($text_color)){
				$css_text_style = 'style=';
				if(!empty($text_color)) { $css_text_style .= 'color:' . $text_color . ';'; }
			}
			$ftype = 'fontawesome';
			vc_icon_element_fonts_enqueue( $ftype );
			$output .= '<div class="number-counter">';
				if( !empty( $counter_number ) ) {
					$output .= '<h3 '.$css_number_style.'>';
						$output .= '<span class="count-number">'.$counter_number.'</span>';
						if( !empty( $number_suffix ) ) {
							$output .= '<span>'.$number_suffix.'</span>';
						}
					$output .= '</h3>';
				}
				if( !empty($title) ) {
					$output .= '<span class="count-text" '.$css_text_style.'>'.$title.'</span>';
				}
			$output .= '</div>';
            return '<div class="wpb_content_element number-box' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->shortcode, $atts ) . '">' . $output . '</div>'; 
        }     
    }
}
new PHYSIO_Counter_Box;		
?>