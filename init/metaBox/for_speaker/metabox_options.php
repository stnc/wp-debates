<?php
$tvs_speaker_themeName = 'tvs_speaker';
$tvs_speaker_prefix_speaker = $tvs_speaker_themeName . "_Metabox_";//imporntant -- becase this is database name 
$tvs_speaker_OptionsPageSetting = array(
	'name' => $tvs_speaker_prefix_speaker . 'meta-box-page',
	'nonce' => 'tvs_studio_speaker',
	'title' => __('Speaker Information', 'debateLang'),
	'page' => 'speaker',
	//'context' => 'side',
	'context' => 'normal',
	'priority' => 'default',
	'class' => '',
	'style' => '',
	'title_h2' => true,
	'fields' => array(

		array(
			'name' => $tvs_speaker_prefix_speaker . 'name_lastname',
			'title' => __('Name Lastname', 'debateLang'),
			'type' => 'text',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),



	)
);