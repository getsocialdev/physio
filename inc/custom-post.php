<?php
if ( ! function_exists('treatment_post_type') ) {
function treatment_post_type() {
	$labels = array(
		'name'                  => _x( 'Treatments', 'Post Type General Name', 'physio' ),
		'singular_name'         => _x( 'Treatment', 'Post Type Singular Name', 'physio' ),
		'menu_name'             => __( 'Treatments', 'physio' ),
		'name_admin_bar'        => __( 'Treatment', 'physio' ),
		'archives'              => __( 'Item Archives', 'physio' ),
		'attributes'            => __( 'Item Attributes', 'physio' ),
		'parent_item_colon'     => __( 'Parent Item:', 'physio' ),
		'all_items'             => __( 'All Items', 'physio' ),
		'add_new_item'          => __( 'Add New Item', 'physio' ),
		'add_new'               => __( 'Add New', 'physio' ),
		'new_item'              => __( 'New Item', 'physio' ),
		'edit_item'             => __( 'Edit Item', 'physio' ),
		'update_item'           => __( 'Update Item', 'physio' ),
		'view_item'             => __( 'View Item', 'physio' ),
		'view_items'            => __( 'View Items', 'physio' ),
		'search_items'          => __( 'Search Item', 'physio' ),
		'not_found'             => __( 'Not found', 'physio' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'physio' ),
		'featured_image'        => __( 'Featured Image', 'physio' ),
		'set_featured_image'    => __( 'Set featured image', 'physio' ),
		'remove_featured_image' => __( 'Remove featured image', 'physio' ),
		'use_featured_image'    => __( 'Use as featured image', 'physio' ),
		'insert_into_item'      => __( 'Insert into item', 'physio' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'physio' ),
		'items_list'            => __( 'Items list', 'physio' ),
		'items_list_navigation' => __( 'Items list navigation', 'physio' ),
		'filter_items_list'     => __( 'Filter items list', 'physio' ),
	);
	$args = array(
		'label'                 => __( 'Treatment', 'physio' ),
		'description'           => __( 'Treatment Description', 'physio' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 10,
		'menu_icon'             => 'dashicons-welcome-widgets-menus',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'treatment', $args );
}
add_action( 'init', 'treatment_post_type', 0 );
}
if ( ! function_exists( 'treatment_taxonomy' ) ) {
function treatment_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Treatment Categories', 'Taxonomy General Name', 'physio' ),
		'singular_name'              => _x( 'Treatment Category', 'Taxonomy Singular Name', 'physio' ),
		'menu_name'                  => __( 'Treatment Categories', 'physio' ),
		'all_items'                  => __( 'All Items', 'physio' ),
		'parent_item'                => __( 'Parent Item', 'physio' ),
		'parent_item_colon'          => __( 'Parent Item:', 'physio' ),
		'new_item_name'              => __( 'New Item Name', 'physio' ),
		'add_new_item'               => __( 'Add New Item', 'physio' ),
		'edit_item'                  => __( 'Edit Item', 'physio' ),
		'update_item'                => __( 'Update Item', 'physio' ),
		'view_item'                  => __( 'View Item', 'physio' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'physio' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'physio' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'physio' ),
		'popular_items'              => __( 'Popular Items', 'physio' ),
		'search_items'               => __( 'Search Items', 'physio' ),
		'not_found'                  => __( 'Not Found', 'physio' ),
		'no_terms'                   => __( 'No items', 'physio' ),
		'items_list'                 => __( 'Items list', 'physio' ),
		'items_list_navigation'      => __( 'Items list navigation', 'physio' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'show_in_quick_edit'         => false,
		
	);
	register_taxonomy( 'treatment_cat', array( 'treatment' ), $args );
}
add_action( 'init', 'treatment_taxonomy', 0 );
}
if ( ! function_exists('group_exercise_post_type') ) {
function group_exercise_post_type() {
	$labels = array(
		'name'                  => _x( 'Group Exercises', 'Post Type General Name', 'physio' ),
		'singular_name'         => _x( 'Group Exercise', 'Post Type Singular Name', 'physio' ),
		'menu_name'             => __( 'Group Exercises', 'physio' ),
		'name_admin_bar'        => __( 'Group Exercise', 'physio' ),
		'archives'              => __( 'Item Archives', 'physio' ),
		'attributes'            => __( 'Item Attributes', 'physio' ),
		'parent_item_colon'     => __( 'Parent Item:', 'physio' ),
		'all_items'             => __( 'All Items', 'physio' ),
		'add_new_item'          => __( 'Add New Item', 'physio' ),
		'add_new'               => __( 'Add New', 'physio' ),
		'new_item'              => __( 'New Item', 'physio' ),
		'edit_item'             => __( 'Edit Item', 'physio' ),
		'update_item'           => __( 'Update Item', 'physio' ),
		'view_item'             => __( 'View Item', 'physio' ),
		'view_items'            => __( 'View Items', 'physio' ),
		'search_items'          => __( 'Search Item', 'physio' ),
		'not_found'             => __( 'Not found', 'physio' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'physio' ),
		'featured_image'        => __( 'Featured Image', 'physio' ),
		'set_featured_image'    => __( 'Set featured image', 'physio' ),
		'remove_featured_image' => __( 'Remove featured image', 'physio' ),
		'use_featured_image'    => __( 'Use as featured image', 'physio' ),
		'insert_into_item'      => __( 'Insert into item', 'physio' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'physio' ),
		'items_list'            => __( 'Items list', 'physio' ),
		'items_list_navigation' => __( 'Items list navigation', 'physio' ),
		'filter_items_list'     => __( 'Filter items list', 'physio' ),
	);
	$args = array(
		'label'                 => __( 'Group Exercise', 'physio' ),
		'description'           => __( 'Group Exercise Description', 'physio' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 10,
		'menu_icon'             => 'dashicons-welcome-widgets-menus',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'group_exercise', $args );
}
add_action( 'init', 'group_exercise_post_type', 0 );
}
if ( ! function_exists( 'group_exercise_taxonomy' ) ) {
function group_exercise_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Group Exercise Categories', 'Taxonomy General Name', 'physio' ),
		'singular_name'              => _x( 'Group Exercise Category', 'Taxonomy Singular Name', 'physio' ),
		'menu_name'                  => __( 'Group Exercise Categories', 'physio' ),
		'all_items'                  => __( 'All Items', 'physio' ),
		'parent_item'                => __( 'Parent Item', 'physio' ),
		'parent_item_colon'          => __( 'Parent Item:', 'physio' ),
		'new_item_name'              => __( 'New Item Name', 'physio' ),
		'add_new_item'               => __( 'Add New Item', 'physio' ),
		'edit_item'                  => __( 'Edit Item', 'physio' ),
		'update_item'                => __( 'Update Item', 'physio' ),
		'view_item'                  => __( 'View Item', 'physio' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'physio' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'physio' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'physio' ),
		'popular_items'              => __( 'Popular Items', 'physio' ),
		'search_items'               => __( 'Search Items', 'physio' ),
		'not_found'                  => __( 'Not Found', 'physio' ),
		'no_terms'                   => __( 'No items', 'physio' ),
		'items_list'                 => __( 'Items list', 'physio' ),
		'items_list_navigation'      => __( 'Items list navigation', 'physio' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'show_in_quick_edit'         => false,
		
	);
	register_taxonomy( 'group_exercise_cat', array( 'group_exercise' ), $args );
}
add_action( 'init', 'group_exercise_taxonomy', 0 );
}
if ( ! function_exists('team_post_type') ) {
function team_post_type() {
	$labels = array(
		'name'                  => _x( 'Teams', 'Post Type General Name', 'physio' ),
		'singular_name'         => _x( 'Team', 'Post Type Singular Name', 'physio' ),
		'menu_name'             => __( 'Teams', 'physio' ),
		'name_admin_bar'        => __( 'Team', 'physio' ),
		'archives'              => __( 'Item Archives', 'physio' ),
		'attributes'            => __( 'Item Attributes', 'physio' ),
		'parent_item_colon'     => __( 'Parent Item:', 'physio' ),
		'all_items'             => __( 'All Items', 'physio' ),
		'add_new_item'          => __( 'Add New Item', 'physio' ),
		'add_new'               => __( 'Add New', 'physio' ),
		'new_item'              => __( 'New Item', 'physio' ),
		'edit_item'             => __( 'Edit Item', 'physio' ),
		'update_item'           => __( 'Update Item', 'physio' ),
		'view_item'             => __( 'View Item', 'physio' ),
		'view_items'            => __( 'View Items', 'physio' ),
		'search_items'          => __( 'Search Item', 'physio' ),
		'not_found'             => __( 'Not found', 'physio' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'physio' ),
		'featured_image'        => __( 'Featured Image', 'physio' ),
		'set_featured_image'    => __( 'Set featured image', 'physio' ),
		'remove_featured_image' => __( 'Remove featured image', 'physio' ),
		'use_featured_image'    => __( 'Use as featured image', 'physio' ),
		'insert_into_item'      => __( 'Insert into item', 'physio' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'physio' ),
		'items_list'            => __( 'Items list', 'physio' ),
		'items_list_navigation' => __( 'Items list navigation', 'physio' ),
		'filter_items_list'     => __( 'Filter items list', 'physio' ),
	);
	$args = array(
		'label'                 => __( 'Team', 'physio' ),
		'description'           => __( 'Team Description', 'physio' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 10,
		'menu_icon'             => 'dashicons-welcome-widgets-menus',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'team', $args );
}
add_action( 'init', 'team_post_type', 0 );
}
if ( ! function_exists( 'team_taxonomy' ) ) {
function team_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Team Categories', 'Taxonomy General Name', 'physio' ),
		'singular_name'              => _x( 'Team Category', 'Taxonomy Singular Name', 'physio' ),
		'menu_name'                  => __( 'Team Categories', 'physio' ),
		'all_items'                  => __( 'All Items', 'physio' ),
		'parent_item'                => __( 'Parent Item', 'physio' ),
		'parent_item_colon'          => __( 'Parent Item:', 'physio' ),
		'new_item_name'              => __( 'New Item Name', 'physio' ),
		'add_new_item'               => __( 'Add New Item', 'physio' ),
		'edit_item'                  => __( 'Edit Item', 'physio' ),
		'update_item'                => __( 'Update Item', 'physio' ),
		'view_item'                  => __( 'View Item', 'physio' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'physio' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'physio' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'physio' ),
		'popular_items'              => __( 'Popular Items', 'physio' ),
		'search_items'               => __( 'Search Items', 'physio' ),
		'not_found'                  => __( 'Not Found', 'physio' ),
		'no_terms'                   => __( 'No items', 'physio' ),
		'items_list'                 => __( 'Items list', 'physio' ),
		'items_list_navigation'      => __( 'Items list navigation', 'physio' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'show_in_quick_edit'         => false,
		
	);
	register_taxonomy( 'team_cat', array( 'team' ), $args );
}
add_action( 'init', 'team_taxonomy', 0 );
}
?>
