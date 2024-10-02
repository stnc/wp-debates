<?php
function tvsDebate_configuration_menu()
{
  

    add_submenu_page( "edit.php?post_type=debate",  __( 'Settings', 'debateLang' ), __( 'Settings', 'debateLang' ), 'manage_options', 'tvsDebateSetting', 'tvsDebate_configuration_content' ); 

    add_submenu_page( "edit.php?post_type=debate",   __( 'About', 'debateLang' ) ,   __( 'About', 'debateLang' ) , 'manage_options', 'tvsDebateAbout', 'tvsDebate_about_page' ); 



 //   add_submenu_page("edit.php?post_type=press", __("Locations", 'debateLang'), __("Galleries Album", 'debateLang'), "edit_posts", "edit-tags.php?taxonomy=album&post_type=press");//chfw condi


}
add_action('admin_menu', 'tvsDebate_configuration_menu');



add_filter('manage_debate_posts_columns', 'CHfw2_add_img_column');
add_action('manage_debate_posts_custom_column', 'CHfw2_manage_img_column', 10, 2);

/*
add custom_colum
@use http://bit.ly/2zKE0k4
*/
function CHfw2_add_img_column($columns)
{
    $columns['img'] = 'Featured Image';
    return $columns;
}

function CHfw2_manage_img_column($column_name, $post_id)
{
    if ($column_name == 'img') {
        echo get_the_post_thumbnail($post_id, 'thumbnail');
    }

    return $column_name;
}






add_filter('manage_post_posts_columns', 'ST4_columns_head');
add_action('manage_post_posts_custom_column', 'ST4_columns_content', 10, 2);


function ST4_columns_head($defaults) {

    $defaults['featured_image'] = 'Featured Image';

	return $defaults;

}

// SHOW THE FEATURED IMAGE

function ST4_columns_content($column_name, $post_ID) {

	if ($column_name == 'featured_image') {

		$post_featured_image = ST4_get_featured_image($post_ID);

		if ($post_featured_image) {

			echo '<img src="' . $post_featured_image . '" />';

		}

	}

}


function ST4_get_featured_image($post_ID) {

    $post_thumbnail_id = get_post_thumbnail_id($post_ID);

	if ($post_thumbnail_id) {

		$post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'thumbnail');

		return $post_thumbnail_img[0];

	}

}
