<?php 


//example link http://debates.test/debateModal?debateid=12
add_action('init', function(): void{
    add_rewrite_rule('debateModal/([a-zA-Z0-9\-]+)/ajax-debate', 'index.php?pagename=ajax-debate&debateid=$matches[1]','top');
});


add_action( 'template_include', function( $template ): mixed {
    if ( false == get_query_var( 'debateid' ) || '' == get_query_var( 'debateid' )) {
        status_header(200);
        return $template;
    }
    return get_template_directory() . '-child/ajax-single-debate.php';
});


add_filter('query_vars', function($query_vars): mixed{
    $query_vars[] = 'debateid';
    return $query_vars;
});


//example link http://debates.test/transcriptModal?transcriptid=12
add_action('init', function(): void{
    add_rewrite_rule('transcriptModal/([a-zA-Z0-9\-]+)/ajax-debate', 'index.php?pagename=ajax-debate&transcriptid=$matches[1]','top');
});


add_action( 'template_include', function( $template ): mixed {
    if ( false == get_query_var( 'transcriptid' ) || '' == get_query_var( 'transcriptid' )) {
        status_header(200);
        return $template;
    }
    return get_template_directory() . '-child/ajax-single-transcript.php';
});


add_filter('query_vars', function($query_vars): mixed{
    $query_vars[] = 'transcriptid';
    return $query_vars;
});







//example link http://debates.test/opinionModal?opinionid=12
add_action('init', function(): void{
    add_rewrite_rule('opinionModal/([a-zA-Z0-9\-]+)/ajax-debate', 'index.php?pagename=ajax-debate&opinionid=$matches[1]','top');
});


add_action( 'template_include', function( $template ): mixed {
    if ( false == get_query_var( 'opinionid' ) || '' == get_query_var( 'opinionid' )) {
        status_header(200);
        return $template;
    }
    return get_template_directory() . '-child/ajax-single-opinion.php';
});


add_filter('query_vars', function($query_vars): mixed{
    $query_vars[] = 'opinionid';
    return $query_vars;
});



//example link http://debates.test/speakersModal?list=12
add_action('init', function(): void{
    add_rewrite_rule('speakersModal/([a-zA-Z0-9\-]+)/ajax-debate', 'index.php?pagename=ajax-debate&list=$matches[1]','top');
});


add_action( 'template_include', function( $template ): mixed {
    if ( false == get_query_var( 'list' ) || '' == get_query_var( 'list' )) {
        status_header(200);
        return $template;
    }
    return get_template_directory() . '-child/ajax-speakers.php';
});


add_filter('query_vars', function($query_vars): mixed{
    $query_vars[] = 'list';
    return $query_vars;
});


/* CANCEL-speakers
//REGULAR PAGE - example link http://debates.test/speakers?list=4774
add_action('init', function(): void{
    add_rewrite_rule('speakers/([a-zA-Z0-9\-]+)/ajax-debate', 'index.php?pagename=regularPage-debate&list=$matches[1]','top');
});


add_action( 'template_include', function( $template ): mixed {
    if ( false == get_query_var( 'list' ) || '' == get_query_var( 'list' )) {
        status_header(200);
        return $template;
    }
    return get_template_directory() . '-child/0CANCEL-speakers.php';
});


add_filter('query_vars', function($query_vars): mixed{
    $query_vars[] = 'list';
    return $query_vars;
});
*/

