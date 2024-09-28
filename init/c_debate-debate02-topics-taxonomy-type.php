<?php
///depent categories for donate 
function tvsDebate_create_cat_taxonomies()
{
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => __( 'Topics', 'debateLang' ) ,
        'singular_name' => __('Topics', 'debateLang'),
        'add_new_item' =>  __('Add New Topic', 'debateLang'),
        'search_items' =>__('Search Topic', 'debateLang'),
        'popular_items' => __('Popular Topics', 'debateLang'),
        'all_items' => __('All Topics', 'debateLang'),
        'parent_item' => __('Sub Topics', 'debateLang'),
        'parent_item_colon' => __('Sub Topics', 'debateLang'),
        'edit_item' => __('Edit Topic', 'debateLang'),
        'update_item' => __('Edit Topic', 'debateLang'),
        'new_item_name' => __('New Topic', 'debateLang'),
    );
    
    register_taxonomy('topics', array("debate"), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'with_front' => true,
        'show_in_nav_menus' => true,
        'show_in_menu' => "edit.php?post_type=debate",
        'rewrite' => array('slug' => 'topics'),
    ));
}

add_action('init', 'tvsDebate_create_cat_taxonomies', 0);