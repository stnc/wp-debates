<?php 
//custom URL routes 

// https://wpmudev.com/blog/building-customized-urls-wordpress/

//https://anchor.host/wordpress-routing-hacks-for-single-page-applications/

//https://github.com/varunsridharan/wp-endpoint

//https://pexetothemes-com.translate.goog/wordpress-functions/add_query_arg/?_x_tr_sl=auto&_x_tr_tl=tr&_x_tr_hl=en-US

//https://www.daggerhartlab.com/wordpress-rewrite-api-examples/

//https://imranhsayed.medium.com/adding-rewrite-rules-in-wordpress-tutorial-b8603a37dcab


//https://wordpress.stackexchange.com/questions/390382/how-to-add-custom-rewrite-rules-and-point-to-specific-templates

// https://www.google.com/search?q=wordpress+rewrite+url&client=firefox-b-1-d&sca_esv=cfcd3706826e13a2&sca_upv=1&sxsrf=ADLYWIIdY7mgYKzr3Ld7pjb5bceaHobkLw%3A1719266978598&ei=ou55ZvmnJLvmkPIP-YyI8Ao&ved=0ahUKEwj5gKLMoPWGAxU7M0QIHXkGAq4Q4dUDCBA&uact=5&oq=wordpress+rewrite+url&gs_lp=Egxnd3Mtd2l6LXNlcnAiFXdvcmRwcmVzcyByZXdyaXRlIHVybDILEAAYgAQYkQIYigUyBRAAGIAEMgYQABgWGB4yBhAAGBYYHjIGEAAYFhgeMgYQABgWGB4yBhAAGBYYHjIGEAAYFhgeMgYQABgWGB4yBhAAGBYYHkjoPlD7BlijPXAAeAGQAQCYAVygAcwIqgECMTa4AQPIAQD4AQGYAhCgAr8IwgIEEAAYR8ICChAAGIAEGBQYhwLCAggQABgWGAoYHpgDAIgGAZAGCJIHAjE2oAfNYg&sclient=gws-wiz-serp#ip=1

//https://www.hongkiat.com/blog/wordpress-url-rewrite/   buna bak 

// https://wordpress.stackexchange.com/questions/58683/how-to-create-a-front-end-user-profile-with-a-friendly-permalink

// https://revelationconcept.com/wordpress-rename-default-posts-news-something-else/



// function sector_rewrite_rule() {
//     add_rewrite_rule(
//         // matches products/imports/filters, but not products/imports/filters/foo
//         '^products/imports/([^/]+)/?$',

//         // ensure pagename is in the form of <parent>/<child>
//         'index.php?pagename=products/imports&sector=$matches[1]',

//         'top'
//     );
// }

// add_filter( 'query_vars', 'sector_query_vars' );
// function sector_query_vars( $vars ) {
//     $vars[] = 'sector';

//     return $vars;
// }

// add_filter( 'page_template', 'my_sector_page_template' );
// function my_sector_page_template( $template ) {
//     if ( is_page( 'imports' ) && get_query_var( 'sector' ) ) {
//         // this assumes the template is in the active theme directory
//         // and just change the path if the template is somewhere else
//         $template = locate_template( 'sector.php' ); // use a full absolute path
//     }

//     return $template;
// }

//example link http://debates.test/job?job-name=ss
add_action('init', function(){
    add_rewrite_rule('job/([a-zA-Z0-9\-]+)/bewerben', 'index.php?pagename=jetzt-bewerben&job-name=$matches[1]','top');
});

// echo get_template_directory();
add_action( 'template_include', function( $template ) {
    if ( false == get_query_var( 'job-name' ) || '' == get_query_var( 'job-name' )) {
        return $template;
    }
 
    return get_template_directory() . '-child/page_rewrite_rule_example.php';
});


add_filter('query_vars', function($query_vars){
    $query_vars[] = 'job-name';
    return $query_vars;
});
