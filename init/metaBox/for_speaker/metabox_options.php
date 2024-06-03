<?php
$tvs_wp_speaker_themeName = 'tvs_wp_speaker';
$tvs_wp_speaker_prefix_speaker = $tvs_wp_speaker_themeName . "_Metabox_";//imporntant -- becase this is database name 
$tvs_wp_speaker_OptionsPageSetting = array(
	'name' => $tvs_wp_speaker_prefix_speaker . 'meta-box-page',
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
			'name' => $tvs_wp_speaker_prefix_speaker . 'name_lastname',
			'title' => __('Name Lastname', 'debateLang'),
			'type' => 'text',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),

		array(
			'name' => $tvs_wp_speaker_prefix_speaker . 'name',
			'title' => __('Name ', 'debateLang'),
			'type' => 'text',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),

		array(
			'name' => $tvs_wp_speaker_prefix_speaker . 'lastname',
			'title' => __(' Lastname', 'debateLang'),
			'type' => 'text',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),

		array(
			'name' => $tvs_wp_speaker_prefix_speaker . 'username',
			'title' => __('Username', 'debateLang'),
			'type' => 'text',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),


		array(
			'name' => $tvs_wp_speaker_prefix_speaker . 'email',
			'title' => __('Email Adress', 'debateLang'),
			'type' => 'text',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),


		
		array(
			'name' => $tvs_wp_speaker_prefix_speaker . 'phone1',
			'title' => __('Phone', 'debateLang'),
			'type' => 'text',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),


				
		array(
			'name' => $tvs_wp_speaker_prefix_speaker . 'website',
			'title' => __('Web Site', 'debateLang'),
			'type' => 'text',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),

		array(
			'name' => $tvs_wp_speaker_prefix_speaker . 'password',
			'title' => __('password', 'debateLang'),
			'type' => 'hidden',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),

	)
);