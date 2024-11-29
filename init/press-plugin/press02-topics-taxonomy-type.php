<?php
function tvsDebate_press_type_RegisterTaxonomies()
{
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => __( 'Press Categories ', 'debateLang' ) ,
        'singular_name' => __('Press Categories', 'debateLang'),
        'add_new_item' =>  __('Add New Press Categories', 'debateLang'),
        'search_items' =>__('Search Press Categories', 'debateLang'),
        'popular_items' => __('Popular Press List', 'debateLang'),
        'all_items' => __('All Press List', 'debateLang'),
        'parent_item' => __('Sub Press List', 'debateLang'),
        'parent_item_colon' => __('Sub Press List', 'debateLang'),
        'edit_item' => __('Edit Press Categorie', 'debateLang'),
        'update_item' => __('Edit Press Categorie', 'debateLang'),
        'new_item_name' => __('New Press Categorie', 'debateLang'),
    );
    
    register_taxonomy('presslist', array("press"), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'with_front' => true,       
         'show_in_nav_menus' => true,
        'show_in_menu' => "edit.php?post_type=press",
        'rewrite' => array(   "with_front" => true, 'slug' => 'presslist'),
    ));
}

add_action('init', 'tvsDebate_press_type_RegisterTaxonomies', 0);