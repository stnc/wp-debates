<?php
function ssDebate_register_debate_type()
{
    $singular = 'debate';
    $plural = __('TVS Debate', 'debateLang');
    $slug = str_replace(' ', '_', strtolower($singular));
    $labels = array(
        'name' => $plural,
        'singular_name' =>  __('Debate', 'debateLang'),
        'add_new' =>  __( 'New Debate Add', 'debateLang' ) ,
        'add_new_item' =>  __( 'New Debate Add', 'debateLang' ) ,
        'edit' =>  __( 'Debate Edit', 'debateLang' ) ,
        'edit_item' =>__( 'Debate Edit', 'debateLang' ) ,
        'new_item' => __( 'New Debate', 'debateLang' ) ,
        'view' => __( 'Show Debate', 'debateLang' ) ,
        'view' => __( 'Show Debate', 'debateLang' ) ,
        'search_term' => __( 'Debate Search', 'debateLang' ) ,
        'parent' => __('Sub Debate', 'debateLang'),
        'not_found' =>  __('There are no debatees added', 'debateLang'),
        'not_found_in_trash' => __('Trash can empty', 'debateLang'),
    );
    $args = array(
        'label' => 'debate',
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_ui' => true,
        'show_in_menu' => true,
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

add_action('init', 'ssDebate_register_debate_type');



