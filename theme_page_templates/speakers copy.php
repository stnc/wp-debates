<?php get_header();
require_once("functions-tvs.php");
?>
<?php
$builder_id = porto_check_builder_condition('single');
if ($builder_id) {
	echo do_shortcode('[porto_block id="' . esc_attr($builder_id) . '" tracking="layout-single-' . esc_attr($builder_id) . '"]');
} else {

	wp_reset_postdata();

	global $porto_settings, $porto_layout;
	?>

	<div id="content" role="main">


		<div class="page-debates clearfix">
			<div class="row debate-row archive-debate-row">
				<div class="col-lg-12  col-md-12  custom-sm-margin-bottom-1 p-b-lg single-debate">
					<?php
					$opinionPage = get_post_meta(get_the_ID(), 'tvsDebateMB_opinion', true);
					$transcriptPage = get_post_meta(get_the_ID(), 'tvsDebateMB_transcript', true);
					?>
					<article id="post-<?php the_ID(); ?>">
						<!-- Post meta before content -->
						<div class="post-content">
							<?php
							$id = get_query_var('list');
							$post = get_post($id);
							// print_r($post);
							$title = apply_filters('the_title', $post->post_title);
							echo '<h2 class="entry-title"> <a href="' . get_permalink($id) . '">' . $title . '  <strong style="color:black">- Speakers</strong></a> </h2>';
							tvs_meta_tags("Speakers List - " . $title);

							$speaker_list_db = get_post_meta($id, 'tvsDebateMB_speakerList', true);
							if ($speaker_list_db != '') {
								/*

																			// 										here you can use two different data
																			// 1- the data of the page with id 4672 of this page
																			// or
																			// 2- the data of the connected debate page, that is, the get_query_var('list') data

																														$post = get_post($id);
																														$content = apply_filters('the_content', $post->post_content);
																														echo $title = the_title();
																														echo $content;
																											  */
								$speaker_list_json = json_decode($speaker_list_db, true);

								if ($speaker_list_json):

									foreach ($speaker_list_json as $key => $json_speaker):

										if (1 == $json_speaker["opinions"])
											$opinions = "FOR";

										if (2 == $json_speaker["opinions"])
											$opinions = "AGAINST";
										$speakerId = $json_speaker["speaker"];

										$speakerName = '<strong>' . get_the_title($speakerId) . '</strong>';
										$speakerDesc = $json_speaker["introduction"] . ' <span style="color:red"> ' . $opinions . '  </span> </li>';
										$speaker_post = get_post($speakerId);
										$speaker_content = apply_filters('the_content', $speaker_post->post_content)
											?>
										<div class="row">
											<div class="col-md-12">
												<div
													class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
													<div class="col p-4 d-flex flex-column position-static">

														<h3 class="mb-0"> <a style="color:black"
																href="<?php echo get_permalink($speakerId) ?>"><?php echo $speakerName; ?>
															</a></h3>
														<strong
															class="d-inline-block mb-2 text-primary-emphasis"><?php echo $speakerDesc ?></strong>
														<div class="mb-1 text-body-secondary"></div>
														<p class="card-text mb-auto"><?php echo $speaker_content; ?></p>
														<!--	<a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
												  Continue reading
												  <svg class="bi"><use xlink:href="#chevron-right"></use></svg>
												</a> -->
													</div>
													<div class="col-auto d-none d-lg-block">
														<?php if (has_post_thumbnail($speakerId)):
															$image = wp_get_attachment_image_src(get_post_thumbnail_id($speakerId), 'medium');
															?>
															<img width="300" height="300" src="<?php echo $image[0]; ?>">
														<?php endif; ?>
													</div>
												</div>
											</div>
										</div>

										<hr>

									<?php endforeach;
								endif;
							} else {
								echo "Can't Display The Content";
								// wp_redirect("/", 301);
								//exit();
							}
							?>
						</div>
				</div>
			</div>
			<!-- Post meta after content -->
			<?php
			// if (isset($porto_settings['post-meta-position']) && 'before' !== $porto_settings['post-meta-position']) {
			// 	echo porto_filter_output($post_meta);
			// }
			?>
			</article>
		</div>

	</div>

	<?php
	// Show tooltip to build with Porto Template Builder
	porto_add_block_tooltip('single');
} ?>
<link rel='stylesheet' href='/wp-content/plugins/tvs-debate/assets/css/min/glightbox.min.css' media='all' />
<script src="/wp-content/plugins/tvs-debate/assets/js/glightbox.min.js" id="jquery-mag-js"></script>
<script>
	var lightboxInlineIframe = GLightbox({
		selector: '.debateBox'
	});
</script>
<?php
get_footer();

