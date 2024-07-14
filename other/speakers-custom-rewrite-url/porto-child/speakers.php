<?php //https://wordpress.stackexchange.com/questions/245894/how-can-i-remove-just-the-title-tag-from-wp-head-function
remove_action( 'wp_head', '_wp_render_title_tag', 1 );


add_filter( 'pre_get_document_title' , 'render_title' );
function render_title($title){
    return 'New title ';
}
add_filter(  'document_title_parts' , 'render_title' );


$name = "SAM-----SAM-------";
apply_filters("porto_portfolio_sub_title", $name);

apply_filters( 'porto_page_title', $name );

apply_filters( 'porto_breadcrumbs', $name );






some_callback("ddd");
add_filter('the_title','some_callback');
function some_callback($data){
    global $post;
    // where $data would be string(#) "current title"
    // Example:
    // (you would want to change $post->ID to however you are getting the book order #,
    // but you can see how it works this way with global $post;)
    return 'Book Order #' . $post->ID;
}


get_header();

$name = "SAM-----SAM-------";
apply_filters("porto_portfolio_sub_title", $name);

apply_filters( 'porto_page_title', $name );

apply_filters( 'porto_breadcrumbs', $name );

tvs_meta_tags("selman");
function tvs_meta_tags($title) {

    echo '  <title>'.$title.'</title>      <meta name="description" content="Modifying page title using the_title filter in WordPress - modify-page-title.php">';
  
}

add_action('wp_head', 'tvs_meta_tags');




// function mycustom_enqueue() {     
//     echo "<script type='text/javascript'>alert('1');</script>";
// }
// add_action( 'wp_head', 'mycustom_enqueue',100 ); //here 100 is prioriry
require_once ("functions-tvs.php");

?>
<div class="row">
	<div class="col-lg-3">
		<?php dynamic_sidebar('tvs-special-debates'); ?>
	</div>


	<div class="col-lg-9">

		<div id="content" role="main">



			<div class="page-debates clearfix">
				<div class="row debate-row archive-debate-row">

					<div
						class="col-lg-12  col-md-12 offset-lg-0 offset-md-2 custom-sm-margin-bottom-1 p-b-lg single-debate">

						<?php
						$opinionPage = get_post_meta(get_the_ID(), 'tvsDebateMB_opinion', true);
						$transcriptPage = get_post_meta(get_the_ID(), 'tvsDebateMB_transcript', true);
						?>
						<article id="post-<?php the_ID(); ?>">
							<!-- Post meta before content -->

							<div class="row">
								<div class="col-lg-7">
									<div class="post-content">
										<h2 class="entry-title"><a
												href="<?php //the_permalink(); ?>"><?php //the_title(); ?></a></h2>
										tyututyu
									</div>
								</div>
							</div>
							<!-- Post meta after content -->
							<?php
							if (isset($porto_settings['post-meta-position']) && 'before' !== $porto_settings['post-meta-position']) {
								echo porto_filter_output($post_meta);
							}
							?>
						</article>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();