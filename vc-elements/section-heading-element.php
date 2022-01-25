<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if( !class_exists( 'PHYSIO_Section_Heading' ) ) {
    class PHYSIO_Section_Heading {
        private $shortcode;    
        function __construct() {
            /* shortcode base */
            $this->shortcode = 'physio_section_heading';
            add_action( 'vc_after_init', array( $this, 'physio_map_shortcode' ) );
            add_shortcode( $this->shortcode, array( $this, 'physio_create_shortcode' ) );	
		}
        function physio_map_shortcode( $atts, $content = NULL ) {
            if( function_exists( 'vc_map' ) ) {             
                vc_map(
                    array(
                        'name'            => esc_html__( 'Section Heading', 'physio_shortcodes' ),
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
								'type'          => 'textarea',
								'heading'       => esc_html__( 'Main Heading', 'physio_shortcodes' ),
								'param_name'    => 'main_heading',
								'group'         => 'General',
								'admin_label'   => true,
							),
							array(
								'type'              => 'dropdown',
								'heading'           => esc_html__( 'Element tag', 'physio_shortcodes' ),
								'param_name'        => 'element_tag',
								'group'             => 'General',
								'value'             => array(
									esc_html__( 'Select Element tag', 'physio_shortcodes' ) => '',
									esc_html__( 'h1', 'physio_shortcodes' ) => 'h1',
									esc_html__( 'h2'  , 'physio_shortcodes' ) => 'h2',
									esc_html__( 'h3'  , 'physio_shortcodes' ) => 'h3',
									esc_html__( 'h4'  , 'physio_shortcodes' ) => 'h4',
									esc_html__( 'h5'  , 'physio_shortcodes' ) => 'h5',
									esc_html__( 'h6'  , 'physio_shortcodes' ) => 'h6',
								),
							),
							array(
								'type'              => 'dropdown',
								'heading'           => esc_html__( 'Text align', 'physio_shortcodes' ),
								'param_name'        => 'text_align',
								'group'             => 'General',
								'value'             => array(
									esc_html__( 'Select Text align', 'physio_shortcodes' ) => '',
									esc_html__( 'left'  , 'physio_shortcodes' ) => 'left',
									esc_html__( 'center', 'physio_shortcodes' ) => 'center',
									esc_html__( 'right'  , 'physio_shortcodes' ) => 'right',
								),
							),
							array(
								'type'              => 'textfield',
								'heading'           => esc_html__( 'Title Font Size', 'physio_shortcodes' ),
								'description'       => esc_html__( '(optional) value in px or em, eg "20px" or "6em"' , 'ut_shortcodes' ),
								'param_name'        => 'font_size',
								'group'             => 'General'
							),
							array(
								'type'              => 'colorpicker',
								'heading'           => esc_html__( 'Title Color', 'ut_shortcodes' ),
								'param_name'        => 'title_color',
								'group'             => 'General'
							),
							array(
								'type'              => 'colorpicker',
								'heading'           => esc_html__( 'Title Background', 'ut_shortcodes' ),
								'param_name'        => 'title_background',
								'group'             => 'General'
							),
							array(
                            	'type'              => 'textfield',
								'heading'           => esc_html__( 'CSS Class', 'ut_shortcodes' ),
                                'description'       => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'ut_shortcodes' ),
								'param_name'        => 'class',
								'group'             => 'General'
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
                'main_heading'		=> '',
                'element_tag'   	=> '',
                'text_align'    	=> '',
				'font_size'     	=> '',
				'title_color'   	=> '',
				'title_background'  => '',
                'class'         	=> '',
				'css' => ''
            ), $atts ) ); 
            /* unique listz ID */
            $id = uniqid("physio_sh_");
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
			$classes = array();
			$classes[] = $class;
			if(!empty($text_align) && $text_align == "left"){
				$classes[] = 'left-heading';
			}
			else if(!empty($text_align) && $text_align == "center"){
				$classes[] = 'center-heading';
			}
			else if(!empty($text_align) && $text_align == "right"){
				$classes[] = 'right-heading';
			}
			else{
				$classes[] = 'left-heading';
			}
			if(!empty($font_size) || !empty($title_color)){
				$css_style = 'style=';
				if(!empty($font_size)) { $css_style .= 'font-size:' . $font_size . ';'; }
				if(!empty($title_color)) { $css_style .= 'color:' . $title_color . ';'; }
			}
			if(!empty($title_background)){
				$custom_css = '#'.esc_attr( $id ).'.section-heading span.heading-inner::after{background: ' . $title_background .';}';
			}
			$element_tag = ( !empty($element_tag) ) ? $element_tag : 'h2';
			/* start output */
            $output = '';
            $output .= '<div id="' . esc_attr( $id ) . '" class="section-heading '.esc_attr( $css_class ).' '. esc_attr( implode(' ', $classes ) ) . '">';   
			$output .= '<' . esc_attr( $element_tag ) . ' class="heading" ' . $css_style . '><span class="heading-inner">' . $main_heading . '</span></' . esc_attr( $element_tag ) . '>';
            $output .= '</div>';
			$output .= '<style type="text/css" data-type="vc_shortcodes-custom-css">';
    		$output .= $custom_css;
   			$output .= '</style>';
            return $output;
        }
	}
}
new PHYSIO_Section_Heading;		
?>