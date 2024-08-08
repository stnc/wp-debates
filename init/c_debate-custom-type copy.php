<?php
function tvsDebate_register_debate_type()
{
    $singular = 'debate';
    $plural = __('Debates', 'debateLang');
    $slug = str_replace(' ', '_', strtolower($singular));
    $labels = array(
        'name' => $plural,
        'singular_name' =>  __('Debates', 'debateLang'),
        'add_new' =>  __( 'New Debate Add', 'debateLang' ) ,
        'add_new_item' =>  __( 'New Debate Add', 'debateLang' ) ,
        'edit' =>  __( 'Edit Debate', 'debateLang' ) ,
        'edit_item' =>__( 'Edit Debate', 'debateLang' ) ,
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
        // 'show_in_nav_menus' => true, //is it show menu ? 
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

add_action('init', 'tvsDebate_register_debate_type');



///depent categories for donate 
function tvsDebate_create_cat_taxonomies()
{
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => __( 'Topics', 'debateLang' ) ,
        'singular_name' => __('Topics', 'debateLang'),
        'add_new_item' =>  __('Add New Topic', 'debateLang'),
        'search_items' =>__('Search Topic', 'debateLang'),
        'popular_items' => __('Popular Topics', 'debateLang'),
        'all_items' => __('All Topics', 'debateLang'),
        'parent_item' => __('Sub Topics', 'debateLang'),
        'parent_item_colon' => __('Sub Topics', 'debateLang'),
        'edit_item' => __('Edit Topic', 'debateLang'),
        'update_item' => __('Edit Topic', 'debateLang'),
        'new_item_name' => __('New Topic', 'debateLang'),
    );
    
    register_taxonomy('topics', array("debate"), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'with_front' => true,
        'show_in_menu' => "edit.php?post_type=debate",
        'rewrite' => array('slug' => 'topics'),
    ));
}

add_action('init', 'tvsDebate_create_cat_taxonomies', 0);










// REGISTER TERM META
//edit_topics, create_topics , manage_edit-topics_columns  = mesela  burada dikkat edilmesi gereken dosya isimlerindeki   "topics" kelimesinin register taxomideki isimle ayni olmasi 
////edit_topics, create_topics, manage_edit-topics_columns = for example, the word "topics" in the file names must be the same as the name in the record taxonomy. 

add_action( 'init', 'tvs_register_tvsPressMBSidebarMenuSelect' );

function tvs_register_tvsPressMBSidebarMenuSelect() {

    register_meta( 'term', 'tvsPressMB_SidebarMenu', 'tvs_sanitize_tvsPressMBSidebarMenuSelect' );
}

// SANITIZE DATA

function tvs_sanitize_tvsPressMBSidebarMenuSelect ( $value ) {
    return sanitize_text_field ($value);
}

// GETTER (will be sanitized)

function tvs_get_tvsPressMBSidebarMenuSelect( $term_id ) {
  $value = get_term_meta( $term_id, 'tvsPressMB_SidebarMenu', true );
  $value = tvs_sanitize_tvsPressMBSidebarMenuSelect( $value );
  return $value;
}

// ADD FIELD TO CATEGORY TERM PAGE

add_action( 'topics_add_form_fields', 'tvs_add_form_field_tvsPressMBSidebarMenuSelect' );

function tvs_add_form_field_tvsPressMBSidebarMenuSelect() { ?>
    <?php wp_nonce_field( basename( __FILE__ ), 'tvsPressMB_SidebarMenu_nonce' ); ?>
    <div class="form-field term-meta-text-wrap"> 
        <label for="term-meta-text"><?php _e( 'Sidebar Menu', 'debateLang' ); ?></label>
        <select  type="text" name="tvsPressMBSidebarMenuSelect" id="term-meta-text" name="tvsDebateMB_opinion" id="tvsDebateMB_opinion">

        <?php
    $menus = get_terms( 'nav_menu' );
      $menus = array_combine( wp_list_pluck( $menus, 'term_id' ), wp_list_pluck( $menus, 'name' ) );
        if ($menus) {
            echo '<option  value="0">Select Opinion</option>';
            foreach ( $menus as $location => $description ) {
                    echo '<option  value="'.  $location. '">' .$description.'</option>';
                }
            }
            
?>
       </select>
    </div>
<?php }


// ADD FIELD TO CATEGORY EDIT PAGE

add_action( 'topics_edit_form_fields', 'tvs_edit_form_field_tvsPressMBSidebarMenuSelect' );

function tvs_edit_form_field_tvsPressMBSidebarMenuSelect( $term ) {

    $value  = tvs_get_tvsPressMBSidebarMenuSelect( $term->term_id );

    if ( ! $value )
        $value = ""; 

        $menus = get_terms( 'nav_menu' );
        $menus = array_combine( wp_list_pluck( $menus, 'term_id' ), wp_list_pluck( $menus, 'name' ) );
    ?>

    <tr class="form-field term-meta-text-wrap">
        <th scope="row"><label for="term-meta-text"><?php _e( 'Sidebar Menu', 'debateLang' ); ?></label></th>
        <td>
            <?php wp_nonce_field( basename( __FILE__ ), 'tvsPressMB_SidebarMenu_nonce' ); ?>
            <!-- <input value="<?php echo esc_attr( $value ); ?>" class="term-meta-text-field"  /> -->
            <select  type="text" name="tvsPressMBSidebarMenuSelect" id="term-meta-text" name="tvsDebateMB_opinion" id="tvsDebateMB_opinion">
            <?php
            if ($menus) {
            echo '<option  value="0">Select Opinion</option>';
            foreach ( $menus as $location => $description ) {
                if ( $value ==  $location) {
                    $selected = "selected";
                    echo '<option ' . $selected . ' value="'.  $location. '">' .$description.'</option>';
                } else {
                    $selected = "";
                    echo '<option ' . $selected . ' value="'.  $location . '">' .$description .'</option>';
                }
            }
            } ?>
              </select>
        </td>
    </tr>
<?php }


// SAVE TERM META (on term edit & create)

add_action( 'edit_topics',   'tvs_save_tvsPressMBSidebarMenuSelect' );
add_action( 'create_topics', 'tvs_save_tvsPressMBSidebarMenuSelect' );

function tvs_save_tvsPressMBSidebarMenuSelect( $term_id ) {

    // verify the nonce --- remove if you don't care
    if ( ! isset( $_POST['tvsPressMB_SidebarMenu_nonce'] ) || ! wp_verify_nonce( $_POST['tvsPressMB_SidebarMenu_nonce'], basename( __FILE__ ) ) )
        return;

    $old_value  = tvs_get_tvsPressMBSidebarMenuSelect( $term_id );
    $new_value = isset( $_POST['tvsPressMBSidebarMenuSelect'] ) ? tvs_sanitize_tvsPressMBSidebarMenuSelect ( $_POST['tvsPressMBSidebarMenuSelect'] ) : '';


    if ( $old_value && '' === $new_value )
        delete_term_meta( $term_id, 'tvsPressMB_SidebarMenu' );

    else if ( $old_value !== $new_value )
        update_term_meta( $term_id, 'tvsPressMB_SidebarMenu', $new_value );
}

// MODIFY COLUMNS (add our meta to the list)

add_filter( 'manage_edit-topics_columns', 'tvs_edit_term_columns', 10, 3 );

function tvs_edit_term_columns( $columns ) {

    $columns['tvsPressMB_SidebarMenu'] = __( 'Sidebar Menu', 'debateLang' );

    return $columns;
}

// RENDER COLUMNS (render the meta data on a column)

add_filter( 'manage_topics_custom_column', 'tvs_manage_term_custom_column', 10, 3 );

function tvs_manage_term_custom_column( $out, $column, $term_id ) {

    if ( 'tvsPressMB_SidebarMenu' === $column ) {

        $value  = tvs_get_tvsPressMBSidebarMenuSelect( $term_id );

        if ( ! $value )
            $value = '';

        $out = sprintf( '<span class="term-meta-text-block" style="" >%s</div>', esc_attr( $value ) );
    }

    return $out;
}
