<?php

function tvsDebate_register_galleries_type()
{
    $singular = 'galleries';
     $plural = __('Galleries ', 'debateLang');
     $slug = str_replace(' ', '_', strtolower($singular));
    $labels = array(
        'name' => $plural,
        'singular_name' => __('Gallery', 'debateLang'),
        'add_new' =>__('New Gallery Add', 'debateLang'),
        'add_new_item' => __('New Gallery Add', 'debateLang'),
        'edit' => __('Edit', 'debateLang'),
        'edit_item' => __('Edit', 'debateLang'),
        'new_item' => __('New Gallery', 'debateLang'),
        'view' => __('Show Gallery', 'debateLang'),
        'view_item' => __('Show Gallery', 'debateLang'),
        'search_term' =>  __('Search Gallery', 'debateLang'),
        'parent' =>  __('Sub Gallery', 'debateLang'),
        'not_found' => __('There are no Gallery added', 'debateLang'),
        'not_found_in_trash' => __('Trash can empty', 'debateLang'),
    );
    $args = array(
        'label' => 'Galleries',
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'show_ui' => true,
     
        'show_in_menu' => "edit.php?post_type=press",
        'show_in_admin_bar' => true,
        'menu_position' => 40,
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
add_action('init', 'tvsDebate_register_galleries_type');