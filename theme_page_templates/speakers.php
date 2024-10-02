<?php
//https://blacksaildivision.com/how-to-clean-up-wordpress-head-tag
//https://wordpress.stackexchange.com/questions/245894/how-can-i-remove-just-the-title-tag-from-wp-head-function

//https://wordpress.stackexchange.com/questions/33101/how-do-i-set-the-page-title-dynamically

//https://wordpress.stackexchange.com/questions/245894/how-can-i-remove-just-the-title-tag-from-wp-head-function

/*  // not working but backup 
function render_title($title){
	return 'New title ';
}
add_filter(  'document_title_parts' , 'render_title' );
add_filter( 'pre_get_document_title' , 'render_title' );
*/

//working but backup 
// function mycustom_enqueue() {     
//     echo "<script type='text/javascript'>alert('1');</script>";
// }
// add_action( 'wp_head', 'mycustom_enqueue',100 ); //here 100 is prioriry


/*  // not working but backup 
some_callback("ddd");
add_filter('the_title','some_callback');
function some_callback($data){
	global $post;
	return 'Book Order #' . $post->ID;
}
$name = "SAM-----SAM-------";
apply_filters("porto_portfolio_sub_title", $name);
apply_filters( 'porto_page_title', $name );
apply_filters( 'porto_breadcrumbs', $name );
*/


//https://wordpress.stackexchange.com/questions/245894/how-can-i-remove-just-the-title-tag-from-wp-head-function
remove_action('wp_head', '_wp_render_title_tag', 1);


get_header();

function tvs_meta_tags($title)
{
	echo '  <title>' . $title . '</title>      <meta name="description" content="' . $title . 'php">';
}
add_action('wp_head', 'tvs_meta_tags');










require_once("functions-tvs.php");
global $porto_mobile_toggle;
$sticky_sidebar = porto_meta_sticky_sidebar();
$sticky = "";
if ($sticky_sidebar) {
	$sticky = "data-plugin-sticky";
}

$mobile_sidebar = porto_get_meta_value('mobile_sidebar');
if ('yes' == $mobile_sidebar) {
	$mobile_sidebar = true;
} elseif ('no' == $mobile_sidebar) {
	$mobile_sidebar = false;
} else {
	$mobile_sidebar = !empty($porto_settings['show-mobile-sidebar']) ? true : false;
}


$id = get_query_var('list');
?>





<div id="content" role="main">
	<div class="page-debates spearks clearfix">
		<div class="row debate-row archive-debate-row">

	<!-- col-lg-5 sidebar start  -->
			<div class="col-lg-4 sidebar porto-alternative-default left-sidebar <?php echo !$mobile_sidebar ? '' : ' mobile-sidebar'; ?>">

				<div class="pin-wrapper">
					<div <?php echo $sticky ?>
						data-plugin-options="<?php echo esc_attr('{"autoInit": true, "minWidth": 992, "containerSelector": ".main-content-wrap","autoFit":true, "paddingOffsetBottom": 10}'); ?>">
						<?php if ($mobile_sidebar && (!isset($porto_mobile_toggle) || false !== $porto_mobile_toggle)): ?>
							<div class="sidebar-toggle"><i class="fa"></i></div>
						<?php endif; ?>
						<div class="sidebar-content">

							<?php if ($id != "0"): ?>
								<div id="main-sidebar-menu" class="widget_sidebar_menu main-sidebar-menu">
									<?php
									$ssidebarMenu = get_post_meta($id, 'tvsDebateMB_sidebar', true);
									if ($ssidebarMenu) {
										wp_nav_menu(array("menu" => $ssidebarMenu, 'theme_location' => 'header-top-menu'));
									}
									//dynamic_sidebar('tvs-main-sidebar'); ?>
								</div>
							<?php endif; ?>

							<?php if ($id != "0"): ?>
								<?php
								$tvsDebateCommonSettings = get_option('tvsDebate_CommonSettings');
								$tvsDebate_usedAjax = $tvsDebateCommonSettings["tvsDebate_usedAjax"];
								?>
								<div class="post-meta ">
									<ul class="buttons">
										<li><a href=" <?php echo get_permalink($id) ?>">Debate Page</a></li>
										<?php echo tvs_frontpage_metabox_for_speakerPage($id, $tvsDebate_usedAjax); ?>
									</ul>
								</div>
							<?php endif; ?>


							<!-- featured-image starts-->
							<div class="featured-image" style="margin-bottom: 10px">
								<?php if (has_post_thumbnail()): ?>
									<?php
									the_post_thumbnail('large', array('class' => 'alignleft-'));
									?>
								<?php else: ?>
									<?php $url = wp_get_attachment_url(get_post_thumbnail_id($id), 'full'); ?>
									<img src="<?php echo $url ?>" />
								<?php endif ?>
							</div>
							<!-- featured-image ends-->



							<?php if ($id != "0"): ?>
								<?php
								$tvsDebateCommonSettings = get_option('tvsDebate_CommonSettings');
								$tvsDebateShowVideoSpeaker = $tvsDebateCommonSettings["ShowVideoSpeakerForTranscript"];
								if ($tvsDebateShowVideoSpeaker == "yes"):
									?>
									<!-- accordion starts-->
									<div class="accordion accordion-flush------" id="accordionSingleDebate">


										<?php if ($id != "0"): ?>
											<?php
											$video_list_db = get_post_meta($id, 'tvsDebateMB_videoList', true);
											$json_video_list = json_decode($video_list_db, true);
											if (!$json_video_list || $json_video_list[0]["title"] != "Later (Not Clear Yet)"):
												?>
												<div class="accordion-item">
													<h2 class="accordion-header" id="flush-headingTwo">
														<button class="accordion-button collapsed" type="button"
															data-bs-toggle="collapse" data-bs-target="#flush-collapseVideo"
															aria-expanded="false" aria-controls="flush-collapseVideo">
															Videos
														</button>
													</h2>
													<div id="flush-collapseVideo" class="accordion-collapse collapse"
														aria-labelledby="flush-headingTwo" data-bs-parent="#accordionSingleDebate">
														<div class="accordion-body">
															<div class="row row-cols-2 row-cols-sm-4 row-cols-md-3 g-3">
																<?php
																foreach ($json_video_list as $key => $video):
																	$src = wp_get_attachment_image_src($video["youtubePicture"], 'thumbnail', false, '');
																	?>
																	<div class="col">
																		<div class="card- shadow-sm-">
																			<a href="#inline-video<?php echo $key ?>" class="debateBox"
																				data-glightbox="width: 700; height: auto;">
																				<?php if (!empty($src)): ?>
																					<img src="<?php echo $src[0] ?>"
																						style="max-width:none!important; height: 120px !important; width: 120px !important; padding:2px"
																						alt="<?php echo $video["title"] ?>" />
																				<?php endif ?>
																				<span class="w-100  float-left">
																					<?php echo $video["title"] ?> </span>
																			</a>

																			<div id="inline-video<?php echo $key ?>" style="display: none">
																				<div class="inline-inner">
																					<h4 class="text-center"> <?php echo $video["title"] ?>
																					</h4>
																					<div class="text-center">

																						<iframe width="600" height="400"
																							src="https://www.youtube.com/embed/<?php echo $video["youtube_link"] ?>?autoplay=0&mute=1"
																							title="YouTube video player" frameborder="0"
																							allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
																							referrerpolicy="strict-origin-when-cross-origin"
																							allowfullscreen></iframe>
																						<p>
																							<?php echo $video["description"] ?>
																						</p>
																					</div>
																					<a class="gtrigger-close inline-close-btn"
																						href="#">Close</a>
																				</div>
																			</div>
																		</div>

																	</div>
																<?php endforeach;
																?>
															</div>


														</div>
													</div>
												</div>
											<?php endif; ?>
										</div>
										<!-- accordion ends-->
									<?php endif; ?>

								<?php endif; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
	<!-- col-lg-5 sidebar end  -->

	<!-- col-lg-7  col-md-7 start  -->
			<div class="col-lg-8  col-md-8  custom-sm-margin-bottom-1 p-b-lg single-debate">
				<article id="post-<?php echo $id; ?>">
					<!-- Post meta before content -->
					<div class="post-content">
					<?php
            $date = get_post_meta($id, 'tvsDebateMB_date', true);
            $WpDateFormat = get_option('date_format');
            $WpDateFormat = date($WpDateFormat, strtotime($date));
            ?>
            <div class="datetime"><strong><?php echo $WpDateFormat ?></strong></div>


            <?php
            $motionPassed = get_post_meta($id, 'tvsDebateMB_motionPassed', true);
            if ($motionPassed != ""): ?>
              <strong>MOTION PASSED : </strong><?php echo $motionPassed ?> <br>
            <?php endif ;

						$post = get_post($id);
						// print_r($post);
						$title = apply_filters('the_title', $post->post_title);
						echo '<h2 class="entry-title"> <a href="' . get_permalink($id) . '">' . $title . '  <strong style="color:black">- Speakers</strong></a> </h2>';
						tvs_meta_tags("Speakers List - " . $title);

						$speaker_list_db = get_post_meta($id, 'tvsDebateMB_speakerList', true);
						if ($speaker_list_db != '') {

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

													<?php
									if (is_user_logged_in() && current_user_can("edit_post", $id)) {
										edit_post_link("Edit","","",$speakerId);
									}
									?>
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
	<!-- col-lg-7  col-md-7 end  -->


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



<div class="modalbox-block mfp-fade mfp-hide"></div>
<script src="<?php echo get_stylesheet_directory_uri() ?>/assets/js/glightbox.min.js" id="jquery-glightbox-js"></script>
<script>
	var lightboxInlineIframe = GLightbox({
		selector: '.debateBox'
	});

	jQuery(document).ready(function () {


		jQuery('.ajax-popup').on("click", function (e) {
			e.preventDefault();
			jQuery.ajax({
				type: "POST",
				url: jQuery(this).data('url'),
				data: {
					action: 'ajax_action'
				},
				success: function (data) {
					jQuery.magnificPopup.open({
						type: 'inline',
						midClick: true,
						mainClass: 'mfp-fade',
						closeOnBgClick: false ,
						removalDelay: 500, //delay removal by X to allow out-animation
						items: {
							src: data
						}
					})
				}
			});
		});

		jQuery('body').on('click', '.closeModallBTN', function (e) {
			e.preventDefault();
			jQuery.magnificPopup.close();
		});


	});
</script>
<?php get_footer(); ?>