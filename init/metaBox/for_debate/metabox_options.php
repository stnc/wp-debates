<?php
$tvs_debate_themeName = 'tvsDebate';//for include data
$tvs_debate_prefix_debate = $tvs_debate_themeName . "MB_";
$tvs_debate_OptionsPageSetting = array(
	'name' => $tvs_debate_prefix_debate . 'meta-box-page',
	'nonce' => 'st_studio_debate',
	'title' => __('Information ', 'debateLang'),
	'page' => 'debate',
	'context' => 'side',
	// 'context' => 'normal',
	'priority' => 'default',
	'class' => 'ss-metabox-form',
	'style' => '',
	'title_h2' => true,
	'fields' => array(

		array(
			'name' => $tvs_debate_prefix_debate . 'date',
			'title' => __('Date', 'debateLang'),
			'type' => 'date',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),

		array(
			'name' => $tvs_debate_prefix_debate . 'broadcast_date',
			'title' => __('Broadcast Date', 'debateLang'),
			'type' => 'text',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),

		array(
			'name' => $tvs_debate_prefix_debate . 'motionPassed',
			'title' => __('Motion Passed', 'debateLang'),
			'type' => 'text',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),

		array(
			'name' => $tvs_debate_prefix_debate . 'venue',
			'title' => __('Venue', 'debateLang'),
			'type' => 'text',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		)
	)
);