<?php 
//example link http://debates.test/speakers?list=ss
add_action('init', function(){
    add_rewrite_rule('speakers/([a-zA-Z0-9\-]+)', 'index.php?list=$matches[1]','top');
});

// echo get_template_directory();
add_action( 'template_include', function( $template ) {
    if ( false == get_query_var( 'list' ) || '' == get_query_var( 'list' )) {
        return $template;
    }
 
    return get_template_directory() . '-child/speakers.php';
});


add_filter('query_vars', function($query_vars){
    $query_vars[] = 'list';
    return $query_vars;
});
