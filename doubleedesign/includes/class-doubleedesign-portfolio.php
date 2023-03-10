<?php

/**
 * This class defines custom post types and taxonomies for the Portfolio.
 *
 * @since      1.0.0
 * @package    Doubleedesign
 * @subpackage Doubleedesign/includes
 * @author     Leesa Ward <leesa@doubleedesign.com.au>
 */
class Doublee_Portfolio {

    /**
     * Define custom post type for porfolio options
     * @wp-hook
     * @return void
     */
    function create_portfolio_item_cpt(): void {

        $labels = array(
            'name' => _x('Portfolio items', 'Post Type General Name', 'doubleedesign'),
            'singular_name' => _x('Portfolio item', 'Post Type Singular Name', 'doubleedesign'),
            'menu_name' => __('Portfolio', 'doubleedesign'),
            'name_admin_bar' => __('Portfolio item', 'doubleedesign'),
            'archives' => __('Item Archives', 'doubleedesign'),
            'attributes' => __('Item Attributes', 'doubleedesign'),
            'parent_item_colon' => __('Parent Item:', 'doubleedesign'),
            'all_items' => __('All Items', 'doubleedesign'),
            'add_new_item' => __('Add New Item', 'doubleedesign'),
            'add_new' => __('Add New', 'doubleedesign'),
            'new_item' => __('New Item', 'doubleedesign'),
            'edit_item' => __('Edit Item', 'doubleedesign'),
            'update_item' => __('Update Item', 'doubleedesign'),
            'view_item' => __('View Item', 'doubleedesign'),
            'view_items' => __('View Items', 'doubleedesign'),
            'search_items' => __('Search Item', 'doubleedesign'),
            'not_found' => __('Not found', 'doubleedesign'),
            'not_found_in_trash' => __('Not found in Trash', 'doubleedesign'),
            'featured_image' => __('Featured Image', 'doubleedesign'),
            'set_featured_image' => __('Set featured image', 'doubleedesign'),
            'remove_featured_image' => __('Remove featured image', 'doubleedesign'),
            'use_featured_image' => __('Use as featured image', 'doubleedesign'),
            'insert_into_item' => __('Insert into item', 'doubleedesign'),
            'uploaded_to_this_item' => __('Uploaded to this item', 'doubleedesign'),
            'items_list' => __('Items list', 'doubleedesign'),
            'items_list_navigation' => __('Items list navigation', 'doubleedesign'),
            'filter_items_list' => __('Filter items list', 'doubleedesign'),
        );
        $rewrite = array(
            'slug' => 'item',
            'with_front' => true,
            'pages' => true,
            'feeds' => true,
        );
        $args = array(
            'label' => __('Portfolio item', 'doubleedesign'),
            'description' => __('Post Type Description', 'doubleedesign'),
            'labels' => $labels,
            'supports' => array('title', 'editor', 'thumbnail', 'revisions'),
            'taxonomies' => array('work_type'),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-format-gallery',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'rewrite' => $rewrite,
            'capability_type' => 'page',
            'show_in_rest' => true,
            'rest_base' => 'item',
        );

        register_post_type('portfolio_item', $args);
    }


    /**
     * Define custom taxonomy for portfolio work types
     * @wp-hook
     * @return void
     */
    function create_work_type_taxonomy(): void {

        $labels = array(
            'name' => _x('Work types', 'Taxonomy General Name', 'doubleedesign'),
            'singular_name' => _x('Work type', 'Taxonomy Singular Name', 'doubleedesign'),
            'menu_name' => __('Work types', 'doubleedesign'),
            'all_items' => __('All types', 'doubleedesign'),
            'parent_item' => __('Parent type', 'doubleedesign'),
            'parent_item_colon' => __('Parent type:', 'doubleedesign'),
            'new_item_name' => __('New work type', 'doubleedesign'),
            'add_new_item' => __('Add new type', 'doubleedesign'),
            'edit_item' => __('Edit type', 'doubleedesign'),
            'update_item' => __('Update type', 'doubleedesign'),
            'view_item' => __('View type', 'doubleedesign'),
            'separate_items_with_commas' => __('Separate items with commas', 'doubleedesign'),
            'add_or_remove_items' => __('Add or remove items', 'doubleedesign'),
            'choose_from_most_used' => __('Choose from the most used', 'doubleedesign'),
            'popular_items' => __('Popular Items', 'doubleedesign'),
            'search_items' => __('Search Items', 'doubleedesign'),
            'not_found' => __('Not Found', 'doubleedesign'),
            'no_terms' => __('No items', 'doubleedesign'),
            'items_list' => __('Items list', 'doubleedesign'),
            'items_list_navigation' => __('Items list navigation', 'doubleedesign'),
        );
        $args = array(
            'labels' => $labels,
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud' => false,
            'show_in_rest' => true,
            'rest_base' => 'type',
        );

        register_taxonomy('work_type', array('portfolio_item'), $args);
    }
}
