<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if( !class_exists( 'PHYSIO_Title' ) ) {
    class PHYSIO_Title {
        private $shortcode;    
        function __construct() {
            /* shortcode base */
            $this->shortcode = 'physio_title';
            add_action( 'vc_after_init', array( $this, 'physio_map_shortcode' ) );
            add_shortcode( $this->shortcode, array( $this, 'physio_create_shortcode' ) );	
		}
        function physio_map_shortcode( $atts, $content = NULL ) {
            if( function_exists( 'vc_map' ) ) {             
                vc_map(
                    array(
                        'name'            => esc_html__( 'Title', 'physio' ),
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
								'type'          => 'textarea',
								'heading'       => esc_html__( 'Main Heading', 'physio' ),
								'param_name'    => 'main_heading',
								'group'         => 'General',
								'admin_label'   => true,
							),
							array(
								'type'              => 'dropdown',
								'heading'           => esc_html__( 'Element tag', 'physio' ),
								'param_name'        => 'element_tag',
								'group'             => 'General',
								'value'             => array(
									esc_html__( 'Select Element tag', 'physio' ) => '',
									esc_html__( 'h1', 'physio' ) => 'h1',
									esc_html__( 'h2'  , 'physio' ) => 'h2',
									esc_html__( 'h3'  , 'physio' ) => 'h3',
									esc_html__( 'h4'  , 'physio' ) => 'h4',
									esc_html__( 'h5'  , 'physio' ) => 'h5',
									esc_html__( 'h6'  , 'physio' ) => 'h6',
								),
							),
							array(
								'type'              => 'dropdown',
								'heading'           => esc_html__( 'Text align', 'physio' ),
								'param_name'        => 'text_align',
								'group'             => 'General',
								'value'             => array(
									esc_html__( 'Select Text align', 'physio' ) => '',
									esc_html__( 'left'  , 'physio' ) => 'left',
									esc_html__( 'center', 'physio' ) => 'center',
									esc_html__( 'right'  , 'physio' ) => 'right',
								),
							),
							array(
								'type'              => 'textfield',
								'heading'           => esc_html__( 'Title Font Size', 'physio' ),
								'description'       => esc_html__( '(optional) value in px or em, eg "20px" or "6em"' , 'ut_shortcodes' ),
								'param_name'        => 'font_size',
								'group'             => 'General'
							),
							array(
								'type'              => 'colorpicker',
								'heading'           => esc_html__( 'Title Color', 'physio' ),
								'param_name'        => 'title_color',
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
                                'group'         => esc_html__( 'Design Options', 'physio' ),
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
                'class'         	=> ''
            ), $atts ) ); 
            /* unique listz ID */
            $id = uniqid("physio_sh_");
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
			$element_tag = ( !empty($element_tag) ) ? $element_tag : 'h3';
			/* start output */
            $output = '';
            $output .= '<div id="' . esc_attr( $id ) . '" class="h-heading ' . esc_attr( implode(' ', $classes ) ) . '">';   
			$output .= '<' . esc_attr( $element_tag ) . ' class="h-title" ' . $css_style . '><span class="heading-inner" ' . $title_style . '>' . $main_heading . '</span></' . esc_attr( $element_tag ) . '>';
            $output .= '</div>';
            return $output;
        }
	}
}
new PHYSIO_Title;		
?>