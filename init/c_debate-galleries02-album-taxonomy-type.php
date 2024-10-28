<?php
function tvsDebate_galleries_type_RegisterTaxonomies()
{
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => __( 'Gallery Album ', 'debateLang' ) ,
        'singular_name' => __('Gallery Album', 'debateLang'),
        'add_new_item' =>  __('Add New Press Album', 'debateLang'),
        'search_items' =>__('Search Press Album', 'debateLang'),
        'popular_items' => __('Popular Album List', 'debateLang'),
        'all_items' => __('All Album List', 'debateLang'),
        'parent_item' => __('Sub Album List', 'debateLang'),
        'parent_item_colon' => __('Sub Album List', 'debateLang'),
        'edit_item' => __('Edit Album', 'debateLang'),
        'update_item' => __('Edit Album', 'debateLang'),
        'new_item_name' => __('New Album', 'debateLang'),
    );
    
    register_taxonomy('album', array("galleries"), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'with_front' => true,       
         'show_in_nav_menus' => true,
        'show_in_menu' => "edit.php?post_type=galleries",
        'rewrite' => array(   "with_front" => true, 'slug' => 'album'),
    ));
}

add_action('init', 'tvsDebate_galleries_type_RegisterTaxonomies', 0);