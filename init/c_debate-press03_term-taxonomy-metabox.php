<?php
// REGISTER TERM META  
//edit_presslist, create_presslist , manage_edit-presslist_columns  = mesela  burada dikkat edilmesi gereken dosya isimlerindeki   "presslist" kelimesinin register taxomideki isimle ayni olmasi 
////edit_presslist, create_presslist, manage_edit-presslist_columns = for example, the word "presslist" in the file names must be the same as the name in the record taxonomy. 

add_action( 'init', 'tvs_register_tvsPressMBSidebarMenuSelect' );

function tvs_register_tvsPressMBSidebarMenuSelect() {

    register_meta( 'term', 'tvsPressMB_SidebarMenu', 'sanitize_text_field' );
}



// GETTER (will be sanitized)

function tvs_get_tvsPressMBSidebarMenuSelect( $term_id ) {
  $value = get_term_meta( $term_id, 'tvsPressMB_SidebarMenu', true );
  $value = sanitize_text_field( $value );
  return $value;
}

// ADD FIELD TO CATEGORY TERM PAGE

add_action( 'presslist_add_form_fields', 'tvs_add_form_field_tvsPressMBSidebarMenuSelect' );

function tvs_add_form_field_tvsPressMBSidebarMenuSelect() { ?>
    <?php wp_nonce_field( basename( __FILE__ ), 'tvsPressMB_SidebarMenu_nonce' ); ?>
    <div class="form-field term-meta-text-wrap"> 
        <label for="term-meta-text"><?php _e( 'Sidebar Menu', 'debateLang' ); ?></label>
        <select  type="text"  id="term-meta-text" name="tvsDebateMB_opinion" id="tvsDebateMB_opinion">

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

add_action( 'presslist_edit_form_fields', 'tvs_edit_form_field_tvsPressMBSidebarMenuSelect' );

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
            <select  type="text" id="tvsPressMBSidebarMenuSelectID" name="tvsDebateMB_opinion" id="tvsDebateMB_opinion">
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

add_action( 'edit_presslist',   'tvs_save_tvsPressMBSidebarMenuSelect' );
add_action( 'create_presslist', 'tvs_save_tvsPressMBSidebarMenuSelect' );

function tvs_save_tvsPressMBSidebarMenuSelect( $term_id ) {

    // verify the nonce --- remove if you don't care
    if ( ! isset( $_POST['tvsPressMB_SidebarMenu_nonce'] ) || ! wp_verify_nonce( $_POST['tvsPressMB_SidebarMenu_nonce'], basename( __FILE__ ) ) )
        return;

    $old_value  = tvs_get_tvsPressMBSidebarMenuSelect( $term_id );
    $new_value = isset( $_POST['tvsPressMBSidebarMenuSelect'] ) ? sanitize_text_field ( $_POST['tvsPressMBSidebarMenuSelect'] ) : '';


    if ( $old_value && '' === $new_value )
        delete_term_meta( $term_id, 'tvsPressMB_SidebarMenu' );

    else if ( $old_value !== $new_value )
        update_term_meta( $term_id, 'tvsPressMB_SidebarMenu', $new_value );
}

// MODIFY COLUMNS (add our meta to the list)

add_filter( 'manage_edit-presslist_columns', 'tvs_edit_presslist_term_columns', 10, 3 );

function tvs_edit_presslist_term_columns( $columns ) {

    $columns['tvsPressMB_SidebarMenu'] = __( 'Sidebar Menu', 'debateLang' );

    return $columns;
}

// RENDER COLUMNS (render the meta data on a column)

add_filter( 'manage_presslist_custom_column', 'tvs_manage_presslist_term_custom_column', 10, 3 );

function tvs_manage_presslist_term_custom_column( $out, $column, $term_id ) {

    if ( 'tvsPressMB_SidebarMenu' === $column ) {

        $value  = tvs_get_tvsPressMBSidebarMenuSelect( $term_id );

        if ( ! $value )
            $value = '';

        $out = sprintf( '<span class="term-meta-text-block" style="" >%s</div>', esc_attr( $value ) );
    }

    return $out;
}
