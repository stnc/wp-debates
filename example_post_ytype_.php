<?php 

add_action('init',  'create_taxonomy_related_post_type__premium_only');
add_action('wp_loaded',  'add_meta_boxes_rfe_taxonomy_related__premium_only');
add_action('admin_init',  'rename_taxonomy_meta_boxes_on_rfe_taxonomy_related__premium_only');
add_action('admin_menu', 'remove_taxonomy_menu_from_rfe_taxonomy_related__premium_only');

 function create_taxonomy_related_post_type__premium_only()
{
    register_post_type('rfe_taxonomy_related',
        array(
            'labels' => array(
                'name' => 'Taxonomy Related',
                'singular_name' => 'Taxonomy Related',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Layout',
                'edit' => 'Edit',
                'edit_item' => 'Edit Layout',
                'new_item' => 'New Layout',
                'view' => 'View',
                'view_item' => 'View Layout',
                'search_items' => 'Search Layouts',
                'not_found' => 'No Layouts found',
                'not_found_in_trash' => 'No Layouts found in Trash',
            ),
            'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'supports' => array('title', 'editor'),
            'taxonomies' => array('rfe_taxonomy_related_category'),
            'menu_icon' => 'dashicons-format-aside',
            'has_archive' => false,
        )
    );

    register_taxonomy(
        'rfe_taxonomy_related_category',
        array('rfe_taxonomy_related'),
        array(
            'hierarchical' => true,
            'labels' => array(
                'name' => __('Categories', 'jt-revolution-for-elementor'),
                'singular_name' => __('Category', 'jt-revolution-for-elementor'),
                'search_items' => __('Search Category', 'jt-revolution-for-elementor'),
                'all_items' => __('All Categories', 'jt-revolution-for-elementor'),
                'parent_item' => __('Parent Category', 'jt-revolution-for-elementor'),
                'parent_item_colon' => __('Parent Category:', 'jt-revolution-for-elementor'),
                'edit_item' => __('Edit Category', 'jt-revolution-for-elementor'),
                'update_item' => __('Update Category', 'jt-revolution-for-elementor'),
                'add_new_item' => __('Add New Category', 'jt-revolution-for-elementor'),
                'new_item_name' => __('New Category Name', 'jt-revolution-for-elementor'),
                'menu_name' => __('Categories', 'jt-revolution-for-elementor'),
            ),
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
        )
    );
}


 function add_meta_boxes_rfe_taxonomy_related__premium_only($post)
{
    $args = array('public' => true);
    $output = 'objects';
    $taxonomies = get_taxonomies($args, $output);
    foreach ($taxonomies as $taxonomy) {
        if ('rfe_taxonomy_related_category' === $taxonomy->name) {
            continue;
        }
        register_taxonomy_for_object_type($taxonomy->name, 'rfe_taxonomy_related');
    }
}

 function rename_taxonomy_meta_boxes_on_rfe_taxonomy_related__premium_only()
{
    //Stores display names of post types so we can cache them
    $post_type_names = [];

    $taxonomies = get_taxonomies(['public' => true], 'objects');

    foreach ($taxonomies as $taxonomy) {

        //Skip our own taxonomy
        if ('rfe_taxonomy_related_category' === $taxonomy->name) {
            continue;
        }

        $taxonomy_name = $taxonomy->labels->name;
        $taxonomy_slug = $taxonomy->name;
        $taxonomy_post_types = [];

        $object_type = $taxonomy->object_type;
        foreach ($object_type as $post_type) {

            //Skip our own post type
            if ('rfe_taxonomy_related' === $post_type) {
                continue;
            }

            $post_type_name = isset($post_type_names[$post_type]) ? $post_type_names[$post_type] : false;

            if (!$post_type_name) {
                $post_type_name = get_post_type_object($post_type)->label;
                $post_type_names[$post_type] = $post_type_name;
            }

            $taxonomy_post_types[] = $post_type_name;
        }

        if ($taxonomy->hierarchical) {
            $meta_box_id = $taxonomy_slug . 'div';
            $meta_box_callback = 'post_categories_meta_box';
        } else {
            $meta_box_id = 'tagsdiv-' . $taxonomy_slug;
            $meta_box_callback = 'post_tags_meta_box';
        }

        remove_meta_box($meta_box_id, 'rfe_taxonomy_related', 'side');

        add_meta_box(
            $meta_box_id,
            $taxonomy_name . ' (' . implode(', ', $taxonomy_post_types) . ')',
            $meta_box_callback,
            'rfe_taxonomy_related',
            'normal',
            'low',
            ['taxonomy' => $taxonomy_slug]
        );

    }

}

 function remove_taxonomy_menu_from_rfe_taxonomy_related__premium_only()
{
    global $submenu;

    //Get all the taxonomies of which we need to remove the submenu
    $taxonomies = [];
    foreach (get_taxonomies(['public' => true], 'objects') as $taxonomy) {
        if ('rfe_taxonomy_related_category' === $taxonomy->name) {
            continue;
        }

        $taxonomies[] = $taxonomy->name;
    }

    $post_type = 'rfe_taxonomy_related';
    if (isset($submenu['edit.php?post_type=' . $post_type])) {
        foreach ($submenu['edit.php?post_type=' . $post_type] as $k => $sub) {
            $should_remove = false;
            foreach ($taxonomies as $taxonomy) {
                if (strpos($sub[2], 'taxonomy=' . $taxonomy)) {
                    $should_remove = true;
                    break;
                }
            }
            if ($should_remove) {
                unset($submenu['edit.php?post_type=' . $post_type][$k]);
            }
        }
    }
}