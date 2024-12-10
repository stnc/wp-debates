<?php 


/*

function sector_rewrite_rule() {
    add_rewrite_rule(
        // matches products/imports/filters, but not products/imports/filters/foo
        '^products/imports/([^/]+)/?$',

        // ensure pagename is in the form of <parent>/<child>
        'index.php?pagename=products/imports&sector=$matches[1]',

        'top'
    );
}
add_action('init','sector_rewrite_rule');

add_filter( 'query_vars', 'sector_query_vars' );
function sector_query_vars( $vars ) {
    $vars[] = 'sector';

    return $vars;
}

add_filter( 'page_template', 'my_sector_page_template' );
function my_sector_page_template( $template ): mixed {
    if ( is_page( 'imports' ) && get_query_var( 'sector' ) ) {
        // this assumes the template is in the active theme directory
        // and just change the path if the template is somewhere else
        $template = locate_template( 'sector.php' ); // use a full absolute path
      //  $template = get_template_directory() . '-child/ajax-debate.php';
    }

    return $template;
}


*/







// add_rewrite_rule('^brand/([^/]*)/([^/]*)/?','index.php?brand=$matches[1]&mtype=$matches[2]','top');

//example link http://debates.test/job?job-name=ss
add_action('init', function(): void{
    add_rewrite_rule('^job/([a-zA-Z]\w+)/?', 'index.php?job-name=$matches[1]','top');
});

// echo get_template_directory();
add_action( 'template_include', function( $template ): mixed {
    if ( false == get_query_var( 'job-name' ) || '' == get_query_var( 'job-name' )) {
      
          status_header(200);
         
        return $template;
    }
 
    return get_template_directory() . '-child/ajax-debate.php';
});


add_filter('query_vars', function($query_vars): mixed{
    $query_vars[] = 'job-name';
    return $query_vars;
});





//------  selman



