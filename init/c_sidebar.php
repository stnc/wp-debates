
<?php

function tvs_special_debates_setup() {
    // register sidebar
    $rs_sidebar_opts = array(
        'name' => __('TVS Special Debates'),
        'id' => 'tvs-special-debates',
        'description' => __('TVS Special Debates'),
        'before_widget' => '',
        'after_widget' => ''
    );
    register_sidebar($rs_sidebar_opts);
}
add_action('widgets_init', 'tvs_special_debates_setup');

function tvs_overseas_debates_setup() {
    // register sidebar
    $rs_sidebar_opts = array(
        'name' => __('TVS Overseas Debates'),
        'id' => 'tvs-overseas-debates',
        'description' => __('TVS Overseas Debates'),
        'before_widget' => '',
        'after_widget' => ''
    );
    register_sidebar($rs_sidebar_opts);
}
add_action('widgets_init', 'tvs_overseas_debates_setup');

function tvs_past_debates_setup() {
    // register sidebar
    $rs_sidebar_opts = array(
        'name' => __('TVS Past Debates'),
        'id' => 'tvs-past-debates',
        'description' => __('TVS Past Debates'),
        'before_widget' => '',
        'after_widget' => ''
    );
    register_sidebar($rs_sidebar_opts);
}
add_action('widgets_init', 'tvs_past_debates_setup');