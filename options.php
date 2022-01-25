<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	$options = array();

	$options[] = array(
		'name' => __('Header Options', 'options_framework'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Logo', 'options_framework_theme'),
		'desc' => __('Upload Header Logo.', 'options_framework'),
		'id' => 'header_logo',
		'type' => 'upload');
	
	$options[] = array(
		'name' => __('Favicon', 'options_framework'),
		'desc' => __('Upload Favicon .ico file (width 16x16)', 'options_framework_theme'),
		'id' => 'favicon_logo',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Loading Image', 'options_framework_theme'),
		'desc' => __('Upload Loading Image.', 'options_framework'),
		'id' => 'loading_image',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Email', 'options_framework'),
		'desc' => __('Email Address', 'options_framework_theme'),
		'id' => 'email',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Phone', 'options_framework'),
		'desc' => __('Phone Number', 'options_framework_theme'),
		'id' => 'phone',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Social Media', 'options_framework'),
		'desc' => __('Social Media details', 'options_framework_theme'),
		'id' => 'social_media',
		'type' => 'textarea');
		
	$options[] = array(
		'name' => __('Footer Options', 'options_framework'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('Copyright', 'options_framework'),
		'desc' => __('Copyright details', 'options_framework_theme'),
		'id' => 'copyright',
		'type' => 'textarea');
		
	return $options;
	
}