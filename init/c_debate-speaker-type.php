<?php

function tvsDebate_register_speaker_type()
{
    $singular = 'speaker';
     $plural = __('Speakers', 'debateLang');
     $slug = str_replace(' ', '_', strtolower($singular));
    $labels = array(
        'name' => $plural,
        'singular_name' => __('Speaker', 'debateLang'),
        'add_new' =>__('New Speaker Add', 'debateLang'),
        'add_new_item' => __('New Speaker Add', 'debateLang'),
        'edit' => __('Edit', 'debateLang'),
        'edit_item' => __('Edit', 'debateLang'),
        'new_item' => __('New Speaker', 'debateLang'),
        'view' => __('Show Speaker', 'debateLang'),
        'view_item' => __('Show Speaker', 'debateLang'),
        'search_term' =>  __('Search Speaker', 'debateLang'),
        'parent' =>  __('Sub Speaker', 'debateLang'),
        'not_found' => __('There are no speaker added', 'debateLang'),
        'not_found_in_trash' => __('Trash can empty', 'debateLang'),
    );
    $args = array(
        'label' => 'Speakers',
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
add_action('init', 'tvsDebate_register_speaker_type');


