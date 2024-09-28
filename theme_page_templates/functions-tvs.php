<?php

function tvs_kama_paginate_links_data(array $args): array
{
	//https://wp-kama.com/function/paginate_links
	global $wp_query;

	$args += [
		'total' => 1,
		'current' => 0,
		'url_base' => '/{pagenum}',
		'first_url' => '',
		'mid_size' => 2,
		'end_size' => 1,
		'show_all' => false,
		'a_text_patt' => '%s',
		'is_prev_next' => false,
		'prev_text' => '« Previous',
		'next_text' => 'Next »',
	];

	$rg = (object) $args;

	$total_pages = max(1, (int) ($rg->total ?: $wp_query->max_num_pages));

	if ($total_pages === 1) {
		return [];
	}

	// fix working parameters

	$rg->total = $total_pages;
	$rg->current = max(1, abs($rg->current ?: get_query_var('paged', 1)));

	$rg->url_base = $rg->url_base ?: str_replace(PHP_INT_MAX, '{pagenum}', get_pagenum_link(PHP_INT_MAX));
	$rg->url_base = wp_normalize_path($rg->url_base);

	if (!$rg->first_url) {
		// /foo/page(d)/2 >>> /foo/ /foo?page(d)=2 >>> /foo/
		$rg->first_url = preg_replace('~/paged?/{pagenum}/?|[?]paged?={pagenum}|/{pagenum}/?~', '', $rg->url_base);
		$rg->first_url = user_trailingslashit($rg->first_url);
	}

	// core array

	if ($rg->show_all) {
		$active_nums = range(1, $rg->total);
	} else {

		if ($rg->end_size > 1) {
			$start_nums = range(1, $rg->end_size);
			$end_nums = range($rg->total - ($rg->end_size - 1), $rg->total);
		} else {
			$start_nums = [1];
			$end_nums = [$rg->total];
		}

		$from = $rg->current - $rg->mid_size;
		$to = $rg->current + $rg->mid_size;

		if ($from < 1) {
			$to = min($rg->total, $to + absint($from));
			$from = 1;

		}
		if ($to > $rg->total) {
			$from = max(1, $from - ($to - $rg->total));
			$to = $rg->total;
		}

		$active_nums = array_merge($start_nums, range($from, $to), $end_nums);
		$active_nums = array_unique($active_nums);
		$active_nums = array_values($active_nums); // reset keys
	}

	// fill by core array

	$pages = [];

	if (1 === count($active_nums)) {
		return $pages;
	}

	$item_data = static function ($num) use ($rg) {

		$data = [
			'is_current' => false,
			'page_num' => null,
			'url' => null,
			'link_text' => null,
			'is_prev_next' => false,
			'is_dots' => false,
		];

		if ('dots' === $num) {

			return (object) ([
				'is_dots' => true,
				'link_text' => '…',
			] + $data);
		}

		$is_prev = 'prev' === $num && ($num = max(1, $rg->current - 1));
		$is_next = 'next' === $num && ($num = min($rg->total, $rg->current + 1));

		$data = [
			'is_current' => !($is_prev || $is_next) && $num === $rg->current,
			'page_num' => $num,
			'url' => 1 === $num ? $rg->first_url : str_replace('{pagenum}', $num, $rg->url_base),
			'is_prev_next' => $is_prev || $is_next,
		] + $data;

		if ($is_prev) {
			$data['link_text'] = $rg->prev_text;
		} elseif ($is_next) {
			$data['link_text'] = $rg->next_text;
		} else {
			$data['link_text'] = sprintf($rg->a_text_patt, $num);
		}

		return (object) $data;
	};

	foreach ($active_nums as $indx => $num) {

		$pages[] = $item_data($num);

		// set dots
		$next = $active_nums[$indx + 1] ?? null;
		if ($next && ($num + 1) !== $next) {
			$pages[] = $item_data('dots');
		}
	}

	if ($rg->is_prev_next) {
		$rg->current !== 1 && array_unshift($pages, $item_data('prev'));
		$rg->current !== $rg->total && $pages[] = $item_data('next');
	}

	return $pages;
}


function tvs_frontpage_metabox(int $id): string
{
	$transcriptUrl = "";
	$opinionUrl = "";
	$speaker = "";
	// $opinionPage = get_post_meta(get_the_ID(), 'tvsDebateMB_opinion', true);
	$opinionPage = get_post_meta($id, 'tvsDebateMB_opinion', true);
	$transcriptPage = get_post_meta($id, 'tvsDebateMB_transcript', true);

	$speaker_list = get_post_meta($id, 'tvsDebateMB_speakerList', true);
	$speaker_list_json = json_decode($speaker_list, true);
    if ($speaker_list_json) {
	if ($speaker_list_json[0]["speaker"] != "0" || $speaker_list_json[0]["speaker"] != 0)  {
		$speaker = '<li><a href="/speakers?list=' . $id . '">Speakers</a></li>';
	}
	}

	if ($transcriptPage != "0") {
		$transcriptUrl = '<li><a  href="' . get_permalink($transcriptPage) . '">Transcript</a></li>';
	}

	if ($opinionPage != "0") {
		$opinionUrl = '<li><a  href="' . get_permalink($opinionPage) . '">Opinion poll</a></li>';
	}

	return $transcriptUrl . $speaker . $opinionUrl;

}


function tvs_speakers_metabox():void
{
	$speaker_list_db = get_post_meta(get_the_ID(), 'tvsDebateMB_speakerList', true);
	$speaker_list_json = json_decode($speaker_list_db, true);
	// echo "<pre>";
	// print_r($speaker_list_json);
	if ($speaker_list_json) :
	if ($speaker_list_json[0]["speaker"] != "0" || $speaker_list_json[0]["speaker"] != 0) :
		echo ' <div class="form-1-box  fadeInUp animated" >
		<fieldset class="form-group border p-3--" style=" padding:5px ">
               					<legend style="margin:0;color:black" class="w-auto px-2">Speakers</legend>
		<ul style=" list-style-type: none; padding:5px ">';
		$spekerLink="";
		foreach ($speaker_list_json as $key => $json_speaker) {
			$spekerLink=get_the_permalink($json_speaker["speaker"]);
			$spekerLink='<a style="color:#777777;text-decoration: underline;" href="'.$spekerLink.'">'.get_the_title($json_speaker["speaker"]).'</a>';
			if (1 == $json_speaker["opinions"])
				$opinions = "FOR";

			if (2 == $json_speaker["opinions"])
				$opinions = "AGAINST";

			echo '<li><strong>' . $spekerLink . '</strong> ' . $json_speaker["introduction"] . ' <span style="color:red"> ' . $opinions . '  </span> </li>';

		}
		echo ' </ul></fieldset></div>';
	endif;
	endif;
}



function tvs_video_metabox($count):void
{

$video_list_db = get_post_meta(get_the_ID(), 'tvsDebateMB_videoList', true);
$json_video_list = json_decode($video_list_db, true);
if (!$json_video_list || $json_video_list[0]["title"] != "Later (Not Clear Yet)" ):
	?>
<div class="container">
<h4 class="fw-light">Videos</h4>
	<div class="row row-cols-2 row-cols-sm-4 row-cols-md-6 g-3">
		<?php
		foreach ($json_video_list as $key => $video):
			$src = wp_get_attachment_image_src($video["youtubePicture"], 'thumbnail', false, '');
			?>
			<div class="col">
				<div class="card- shadow-sm-">
					<a href="#inline-video<?php echo $count.$key ?>" class="debateBox"
						data-glightbox="width: 700; height: auto;">
						<?php if (!empty($src)): ?>
							<img src="<?php echo $src[0] ?>"
								style="max-width:none!important; height: 120px !important; width: 120px !important; padding:2px"
								 alt="<?php echo $video["title"] ?>" />
						<?php endif ?>
						<span class="w-100  float-left"> 	<?php echo $video["title"] ?>  </span>
					</a>

					<div id="inline-video<?php echo $count.$key ?>" style="display: none">
						<div class="inline-inner">
						<h4 class="text-center">	<?php echo $video["title"] ?> </h4>
							<div class="text-center">

								<iframe width="600" height="400"
									src="https://www.youtube.com/embed/<?php echo $video["youtube_link"] ?>?autoplay=0&mute=1  "
									title="YouTube video player" frameborder="0"
									allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
									referrerpolicy="strict-origin-when-cross-origin"
									allowfullscreen></iframe>
								<p>
									<?php echo $video["description"] ?>
								</p>
							</div>
							<a class="gtrigger-close inline-close-btn" href="#">Close</a>
						</div>
					</div>
				</div>

			</div>
		<?php endforeach; ?>
	</div>
</div> 
<?php endif; ?>


<?php
}






function tvs_pagination_options($links_data, $pageType,$pageName):void
{
	?>

	<?php if ("topics" == $pageType): ?>
		<div class="pagination-wrap">
			<div class="pagination" role="navigation">
				<a class="prev page-numbers" href="/topics/<?php echo $pageName?>/">
					<i class="fas fa-long-arrow-alt-left"></i>&nbsp;&nbsp;Prev </a>
				<?php foreach ($links_data as $link): ?>
					<?php if ($link->is_current) { ?>
						<span aria-current="page" class="page-numbers current"><?php _e($link->page_num) ?></span>
					<?php } else { ?>
						<a class="page-numbers"
							href="/topics/<?php echo $pageName?>/page/<?php _e($link->page_num) ?>"><?php _e($link->page_num) ?></a>
					<?php } ?>
				<?php endforeach ?>
				<a class="next page-numbers" href="/topics/<?php echo $pageName?>/page/2/">Next&nbsp;&nbsp;
					<i class="fas fa-long-arrow-alt-right"></i>
				</a>
			</div>
		</div>
	<?php else: ?>
		<div class="pagination-wrap">
			<div class="pagination" role="navigation">
				<a class="prev page-numbers" href="/<?php echo $pageName?>">
					<i class="fas fa-long-arrow-alt-left"></i>&nbsp;&nbsp;Prev </a>
				<?php foreach ($links_data as $link): ?>
					<?php if ($link->is_current) { ?>
						<span aria-current="page" class="page-numbers current"><?php _e($link->page_num) ?></span>
					<?php } else { ?>
						<a class="page-numbers"
							href="/<?php echo $pageName?>/page/<?php _e($link->page_num) ?>"><?php _e($link->page_num) ?></a>
					<?php } ?>
				<?php endforeach ?>
				<a class="next page-numbers" href="/<?php echo $pageName?>/page/2/">Next&nbsp;&nbsp;
					<i class="fas fa-long-arrow-alt-right"></i>
				</a>
			</div>
		</div>
	<?php endif; ?>
<?php
}


function tvs_wp_pagination(object $the_query):string{

		echo "<div> wordpress style   pagination </div>";
$big = 999999999; // need an unlikely integer
echo  paginate_links( array(
    'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
		
		    'format' => '?paged=%#%',
    'current' => max( 1, get_query_var('paged') ),
    'total' => $the_query->max_num_pages,
	'prev_text'    => __('← Previous'),
	'next_text'    => __('Next  →'),
	// 'type'  => 'list',
) );
}




function tvs_frontpage_metabox_for_speakerPage($id, $method)
{
	$transcriptUrl = "";
	$opinionUrl = "";

	$opinionPage = get_post_meta($id, 'tvsDebateMB_opinion', true);
	$transcriptPage = get_post_meta($id, 'tvsDebateMB_transcript', true);



	if ($transcriptPage != "0") {
		if ($method == "yes") {
			 $transcriptUrl = '<li><a class="ajax-popup" href="' . get_permalink($transcriptPage) . '#tvs-modal" data-url="'.  get_home_url().'/transcriptModal?transcriptid=' . $transcriptPage . '#tvs-modal">Transcript</a></li>';
		//	$transcriptUrl = '<li><a class="ajax-popup" href="/transcriptModal?transcriptid=' . $transcriptPage . '">Transcript</a></li>';

		} else {
			$transcriptUrl = '<li><a  href="' . get_permalink($transcriptPage) . '">Transcript</a></li>';

		}
	}

	if ($opinionPage != "0") {
		if ($method == "yes") {
			$opinionUrl = '<li><a class="ajax-popup"  href="' . get_permalink($opinionPage) . '#tvs-modal"  data-url="'.  get_home_url().'/OpinionModal?opinionid=' . $opinionPage . '#tvs-modal">Opinion Poll</a></li>';
			//$opinionUrl = '<li><a class="ajax-popup"  href="/OpinionModal?opinionid=' . $opinionPage . '">Transcript</a></li>';

		} else {
			$opinionUrl = '<li><a  href="' . get_permalink($opinionPage) . '">Opinion Poll</a></li>';

		}
	}

	return $transcriptUrl .  $opinionUrl;

}

