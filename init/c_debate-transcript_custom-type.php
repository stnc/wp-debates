<?php

function ssDebate_register_transcript_type()
{
    $singular = 'transcript';
     $plural = __('Transcript', 'debateLang');
     $slug = str_replace(' ', '_', strtolower($singular));
    $labels = array(
        'name' => $plural,
        'singular_name' => __('Transcript', 'debateLang'),
        'add_new' =>__('New Transcript Add', 'debateLang'),
        'add_new_item' => __('New Transcript Add', 'debateLang'),
        'edit' => __('Edit', 'debateLang'),
        'edit_item' => __('Edit', 'debateLang'),
        'new_item' => __('New Transcript', 'debateLang'),
        'view' => __('Show Transcript', 'debateLang'),
        'view_item' => __('Show Transcript', 'debateLang'),
        'search_term' =>  __('Search Transcript', 'debateLang'),
        'parent' =>  __('Sub Transcript', 'debateLang'),
        'not_found' => __('There are no transcript added', 'debateLang'),
        'not_found_in_trash' => __('Trash can empty', 'debateLang'),
    );
    $args = array(
        'label' => 'Transcript',
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_ui' => true,
        'show_in_menu' => "edit.php?post_type=debate",
        'show_in_admin_bar' => true,
        'menu_position' => 30,
        'menu_icon' => 'dashicons-images-alt2',
        'can_export' => true,
        'delete_with_user' => false,
        'hierarchical' => true,
        'show_in_nav_menus' => false,
        'has_archive' => true,
        'query_var' => true,
        'map_meta_cap' => true,
        'show_in_rest'   => true,
        'rewrite' => array(
            'slug' =>  $slug,
            "with_front" => true
        ),

        'supports' => array(
            'title',
            'excerpt',
            'editor',
            'thumbnail',
            'custom-fields'
        )
    );

    register_post_type($slug, $args);

}
add_action('init', 'ssDebate_register_transcript_type');



/*
///depent categories for donate 
function ssDebate_create_cat_taxonomies()
{
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => __( 'Categories', 'debateLang' ) ,
        'singular_name' => __('Categories', 'debateLang'),
        'add_new_item' =>  __('Add New Category', 'debateLang'),
        'search_items' =>__('Search Category', 'debateLang'),
        'popular_items' => __('Popular Category', 'debateLang'),
        'all_items' => __('All Categories', 'debateLang'),
        'parent_item' => __('Sub Categories', 'debateLang'),
        'parent_item_colon' => __('Sub Categories', 'debateLang'),
        'edit_item' => __('Category Edit', 'debateLang'),
        'update_item' => __('Category Edit', 'debateLang'),
        'new_item_name' => __('New Category', 'debateLang'),
    );
    
    register_taxonomy('tvs_debate_cat', array("debate","speaker"), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'with_front' => true,
        'show_in_menu' => "edit.php?post_type=debate",
        'rewrite' => array('slug' => 'tvs_debate_cat'),
    ));
}

add_action('init', 'ssDebate_create_cat_taxonomies', 0);




*/