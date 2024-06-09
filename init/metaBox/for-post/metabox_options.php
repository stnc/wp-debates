<?php 
$tvsDebate_post_themeName = 'tvs_post_event';//for include data
$tvsDebate_prefix = $tvsDebate_post_themeName . "_metabox_";
$tvsDebate_OptionsPageSetting = array(
	'name' => $tvsDebate_prefix . 'meta-box-page',
	'nonce' => 'st_studio_post',
	'title' => __('EK Bilgiler', 'debateLang'),
	'page' => 'post',
	//'context' => 'side',
	'context' => 'normal',
	'priority' => 'default',
	'class' => '',
	'style' => '',
	'title_h2' => true,
	'fields' => array(
		array(
			'name' => $tvsDebate_prefix . 'time',
			'title' => __('Event Time', 'debateLang'),
			'type' => 'text',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),

		array(
			'name' => $tvsDebate_prefix . 'page_view',
			'title' => __('Page View', 'debateLang'),
			'type' => 'text',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),
	)
);