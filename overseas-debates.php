<?php 

//https://wordpress.stackexchange.com/questions/245894/how-can-i-remove-just-the-title-tag-from-wp-head-function

//https://wordpress.stackexchange.com/questions/33101/how-do-i-set-the-page-title-dynamically

//https://wordpress.stackexchange.com/questions/245894/how-can-i-remove-just-the-title-tag-from-wp-head-function




remove_action( 'wp_head', '_wp_render_title_tag', 1 );


add_filter( 'pre_get_document_title' , 'render_title' );
function render_title($title){
    return 'New title ';
}
add_filter(  'document_title_parts' , 'render_title' );





get_header();





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
echo get_query_var( 'list' );
/// ozel bir page yap 
// // speaker page init icin ornek birak 
// function wpse309151_title_update( $title, $id = null ) {
//     if ( ! is_admin() && ! is_null( $id ) ) {
//         $post = get_post( $id );
//         if ( $post instanceof WP_Post && ( $post->post_type == 'post' || $post->post_type == 'page' ) ) {
//             $new_titile = get_post_meta( $id, 'pp_new_title', true );
//             if( ! empty( $new_titile ) ) {
//                 return $new_titile;
//             }
//         } else {
// 			return "dsdsd";
// 		}
//     }
//     return $title;
// }
// add_filter( 'the_title', 'wpse309151_title_update', 10, 2 );

// function wpse309151_remove_title_filter_nav_menu( $nav_menu, $args ) {
//     // we are working with menu, so remove the title filter
//     remove_filter( 'the_title', 'wpse309151_title_update', 10, 2 );
//     return $nav_menu;
// }
// // this filter fires just before the nav menu item creation process
// add_filter( 'pre_wp_nav_menu', 'wpse309151_remove_title_filter_nav_menu', 10, 2 );

// function wpse309151_add_title_filter_non_menu( $items, $args ) {
//     // we are done working with menu, so add the title filter back
//     add_filter( 'the_title', 'wpse309151_title_update', 10, 2 );
//     return $items;
// }
// // this filter fires after nav menu item creation is done
// add_filter( 'wp_nav_menu_items', 'wpse309151_add_title_filter_non_menu', 10, 2 );




?>
<div class="row">
	<div class="col-lg-3">
		<?php dynamic_sidebar('tvs-overseas-debates'); ?>
	</div>


	<div class="col-lg-9">

		<div id="content" role="main">

			<?php
			$the_query = new WP_Query(
				array(
					// 'post_type'   => get_post_type(),
					// 'posts_per_page' => 4,
					'post_type' => 'debate',
					'post_status' => 'publish',
					'orderby' => 'id',
					'paged' => get_query_var('paged') ? get_query_var('paged') : 1, 
					'tax_query' => array(
					
							'taxonomy' => 'topics',
							'field'    => 'id',
							'term'     =>  '61'
						
					)
				)
			);
			?>
			<?php if ($the_query->have_posts()): ?>
				<div class="page-debates clearfix">
					<div class="row debate-row archive-debate-row">
						<?php
						$event_count = 0;
						while ($the_query->have_posts()):
							$event_count++;
							$the_query->the_post();
							?>
							<div class="col-lg-12  col-md-12 offset-lg-0 offset-md-2 custom-sm-margin-bottom-1 p-b-lg single-debate">

								<?php
								$opinionPage = get_post_meta(get_the_ID(), 'tvsDebateMB_opinion', true);
								$transcriptPage = get_post_meta(get_the_ID(), 'tvsDebateMB_transcript', true);
								global $porto_settings;

								$post_layout = 'medium';
								$featured_images = porto_get_featured_images();

								$post_class = array();
								$post_class[] = 'post post-' . $post_layout;
								if (isset($porto_settings['post-title-style']) && 'without-icon' == $porto_settings['post-title-style']) {
									$post_class[] = 'post-title-simple';
								}
								$post_meta = '';
								$post_meta .= '<div class="post-meta ' . (empty($porto_settings['post-metas']) ? ' d-none' : '') . '">';

								$post_meta .= '<ul class="buttons">';
								$post_meta .= '<li><a  href="' . get_permalink() . '">Details</a></li>';
								$post_meta .= '<li><a  href="' . get_permalink($transcriptPage) . '">Transcript</a></li>';
								$post_meta .= '<li><a href="/speakers?list='.get_the_ID().'">Speakers</a></li>';
								$post_meta .= '<li><a  href="' . get_permalink($opinionPage) . '">Opinion poll</a></li>';
								$post_meta .= '<li style="float:right"><span class="d-block float-sm-end mt-3 mt-sm-0"><a class="btn btn-xs btn-default text-xs text-uppercase" href="' . esc_url(apply_filters('the_permalink', get_permalink())) . '">' . esc_html__('Read more...', 'porto') . '</a></span></li>';
								$post_meta .= '</ul>';
								$post_meta .= '</div>';

								?>
								<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
									<!-- Post meta before content -->
									<?php
									if (isset($porto_settings['post-meta-position']) && 'before' === $porto_settings['post-meta-position']) {
										echo '<div class="row"><div class="col-12">' . porto_filter_output($post_meta) . '</div></div>';
									}
									?>
									<div class="row">
										<?php if (count($featured_images)): ?>
											<div class="col-lg-5">
												<?php
												// Post Slideshow
												$slideshow_type = get_post_meta(get_the_ID(), 'slideshow_type', true);

												if (!$slideshow_type) {
													$slideshow_type = 'images';
												}
												porto_get_template_part(
													'views/posts/post-media/' . sanitize_file_name($slideshow_type),
													null,
													('images' == $slideshow_type ? array(
														'image_size' => 'blog-medium',
													) : false)
												);
												?>
											</div>
											<div class="col-lg-7">
											<?php else: ?>
												<div class="col-lg-12">
												<?php endif; ?>

												<div class="post-content">


													<?php

													// gerek yok ??? 
													if (is_sticky() && is_home() && !is_paged()) {
														printf('<span class="sticky-post">%s</span>', esc_html__('Featured', 'porto'));
													}
													?>

													<h2 class="entry-title"><a
															href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>


													<?php
													porto_render_rich_snippets(false);
													if (!empty($porto_settings['blog-excerpt'])) {
														echo porto_get_excerpt($porto_settings['blog-excerpt-length'], false);
														tvs_speacial_meta();
													} else {

														echo '<div class="entry-content">';
														echo porto_the_content();
														tvs_speacial_meta();
														wp_link_pages(
															array(
																'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'porto') . '</span>',
																'after' => '</div>',
																'link_before' => '<span>',
																'link_after' => '</span>',
																'pagelink' => '<span class="screen-reader-text">' . esc_html__('Page', 'porto') . ' </span>%',
																'separator' => '<span class="screen-reader-text">, </span>',
															)
														);
														echo '</div>';
													}
													?>
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
						<?php endwhile ?>

					</div>
					<?php
					$links_data = tvs_kama_paginate_links_data([
						'total' => $the_query->max_num_pages,
						'current' => max(1, get_query_var('paged')),
						'url_base' => 'http://debates.test/topics/overseas-debates/page/{pagenum}',
					]);
					?>
					<?php if ($links_data): ?>
						<?php tvs_pagination_options($links_data, "topics") ?>
					<?php endif; ?>
					<?php // tvs_wp_pagination($the_query);	 ?>
				</div>
				<?php wp_reset_postdata(); ?>
			<?php else: ?>
				<p><?php esc_html_e('Apologies, but no results were found for the requested archive.', 'porto'); ?></p>
			<?php endif; ?>

		</div>
	</div>
</div>
<?php
get_footer();