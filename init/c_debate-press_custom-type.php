<?php

function tvsDebate_register_press_type()
{
    $singular = 'press';
     $plural = __('Press', 'debateLang');
     $slug = str_replace(' ', '_', strtolower($singular));
    $labels = array(
        'name' => $plural,
        'singular_name' => __('Press', 'debateLang'),
        'add_new' =>__('New Press Add', 'debateLang'),
        'add_new_item' => __('New Press Add', 'debateLang'),
        'edit' => __('Edit', 'debateLang'),
        'edit_item' => __('Edit', 'debateLang'),
        'new_item' => __('New Press', 'debateLang'),
        'view' => __('Show Press', 'debateLang'),
        'view_item' => __('Show Press', 'debateLang'),
        'search_term' =>  __('Search Press', 'debateLang'),
        'parent' =>  __('Sub Press', 'debateLang'),
        'not_found' => __('There are no press added', 'debateLang'),
        'not_found_in_trash' => __('Trash can empty', 'debateLang'),
    );
    $args = array(
        'label' => 'Press',
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
            // 'editor',
            'thumbnail',
            // 'custom-fields'
        )
    );

    register_post_type($slug, $args);

}
add_action('init', 'tvsDebate_register_press_type');




///depent categories for donate 
function tvsDebate_create_index_taxonomies()
{
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => __( 'Index', 'debateLang' ) ,
        'singular_name' => __('Index', 'debateLang'),
        'add_new_item' =>  __('Add New Index', 'debateLang'),
        'search_items' =>__('Search Index', 'debateLang'),
        'popular_items' => __('Popular Index', 'debateLang'),
        'all_items' => __('All Index', 'debateLang'),
        'parent_item' => __('Sub Index', 'debateLang'),
        'parent_item_colon' => __('Sub Index', 'debateLang'),
        'edit_item' => __('Edit Index', 'debateLang'),
        'update_item' => __('Edit Index', 'debateLang'),
        'new_item_name' => __('New Index', 'debateLang'),
    );
    
    register_taxonomy('index', array("press"), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'with_front' => true,
        'show_in_menu' => "edit.php?post_type=press",
        'rewrite' => array('slug' => 'index'),
    ));
}

add_action('init', 'tvsDebate_create_index_taxonomies', 0);