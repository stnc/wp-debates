<!-- post altina yeni tag ekler -->
 <?php 
add_action( 'init', function() {
    $labels = array(
        'name'              => _x( 'Ospiti', 'taxonomy general name' ),
        'singular_name'     => _x( 'Ospite', 'taxonomy singular name' ),
    );
    register_taxonomy( 'numero_ospiti', array( 'post' ), array(
        'hierarchical'      => false,
        'labels'            => $labels,
'meta_box_cb'       => "post_categories_meta_box",
'show_admin_column'  => true,
 'public'            => true,
        
    ) );
} );

add_action( 'admin_head', function() {
    ?>
    <style type="text/css">
        #newtaxonomy_name_parent {
            display: none;
        }
    </style>
    <?php
});
add_action( 'admin_init', function() {
    if( isset( $_POST['tax_input'] ) && is_array( $_POST['tax_input'] ) ) {
        $new_tax_input = array();
        foreach( $_POST['tax_input'] as $tax => $terms) {
            if( is_array( $terms ) ) {
              $taxonomy = get_taxonomy( $tax );
              if( !$taxonomy->hierarchical ) {
                  $terms = array_map( 'intval', array_filter( $terms ) );
              }
            }
            $new_tax_input[$tax] = $terms;
        }
        $_POST['tax_input'] = $new_tax_input;
    }
});

function custom_meta_box_markup($object)
{

    ?>
        <div>
            <label for="meta-box-text">Text</label>
            <input name="meta-box-text" type="text" value="<?php echo get_post_meta($object->ID, "meta-box-text", true); ?>">

            <br>

            <label for="meta-box-dropdown">Numero Ospiti</label>
            <select name="meta-box-dropdown">
                <?php
                    $option_values = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10,);

                    foreach($option_values as $key => $value)
                    {
                        if($value == get_post_meta($object->ID, "meta-box-dropdown", true))
                        {
                            ?>
                                <option selected><?php echo $value; ?></option>
                            <?php    
                        }
                        else
                        {
                            ?>
                                <option><?php echo $value; ?></option>
                            <?php
                        }
                    }
                ?>
            </select>

            <br>

            <label for="meta-box-checkbox">Numero ospiti</label>
            <?php
                $checkbox_value = get_post_meta($object->ID, "meta-box-checkbox", true);

                if($checkbox_value == "")
                {
                    ?>
                        <input name="meta-box-checkbox" type="checkbox" value="true">
                    <?php
                }
                else if($checkbox_value == "true")
                {
                    ?>  
                        <input name="meta-box-checkbox" type="checkbox" value="true" checked>
                    <?php
                }
            ?>
        </div>
    <?php  
}


function add_custom_meta_box()
{
    add_meta_box("demo-meta-box", "Ospiti", "custom_meta_box_markup", "post", "side", "high", null);
}

add_action("add_meta_boxes", "add_custom_meta_box");
// post altina yeni tag ekler --end 