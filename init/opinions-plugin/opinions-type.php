<?php

function tvsDebate_register_opinions_type()
{
    $singular = 'opinion';
     $plural = __('Opinions', 'debateLang');
     $slug = str_replace(' ', '_', strtolower($singular));
    $labels = array(
        'name' => $plural,
        'singular_name' => __('Opinion poll', 'debateLang'),
        'add_new' =>__('New Opinion Poll Add', 'debateLang'),
        'add_new_item' => __('New Opinion Poll Add', 'debateLang'),
        'edit' => __('Edit', 'debateLang'),
        'edit_item' => __('Edit', 'debateLang'),
        'new_item' => __('New Opinion Poll', 'debateLang'),
        'view' => __('Show Opinion Poll', 'debateLang'),
        'view_item' => __('Show Opinion Poll', 'debateLang'),
        'search_term' =>  __('Search Opinion Poll', 'debateLang'),
        'parent' =>  __('Sub Opinion Poll', 'debateLang'),
        'not_found' => __('There are no opinion poll added', 'debateLang'),
        'not_found_in_trash' => __('Trash can empty', 'debateLang'),
    );
    $args = array(
        'label' => 'Opinion poll',
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'show_ui' => true,
        'show_in_menu' => "edit.php?post_type=debate",
        'show_in_admin_bar' => true,
        'menu_position' => 30,
        'menu_icon' => 'dashicons-images-alt2',
        'can_export' => true,
        'delete_with_user' => true,
        'hierarchical' => true,
        'show_in_nav_menus' => true,
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
            // 'custom-fields'
        )
    );

    register_post_type($slug, $args);

}
add_action('init', 'tvsDebate_register_opinions_type');



/*
///depent categories for donate 
function tvsDebate_create_cat_taxonomies()
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

add_action('init', 'tvsDebate_create_cat_taxonomies', 0);




*/