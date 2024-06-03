<?php 
$ssDebate_post_themeName = 'tvs_post_event';//for include data
$ssDebate_prefix = $ssDebate_post_themeName . "_metabox_";
$ssDebate_OptionsPageSetting = array(
	'name' => $ssDebate_prefix . 'meta-box-page',
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
			'name' => $ssDebate_prefix . 'time',
			'title' => __('Event Time', 'debateLang'),
			'type' => 'text',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),

		array(
			'name' => $ssDebate_prefix . 'page_view',
			'title' => __('Page View', 'debateLang'),
			'type' => 'text',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),
	)
);