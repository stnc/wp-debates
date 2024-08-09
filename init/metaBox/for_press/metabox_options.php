<?php
$tvs_press_themeName = 'tvs_press';
$tvs_press_prefix_press = $tvs_press_themeName . "_Metabox_";//imporntant -- becase this is database name 
$tvs_press_OptionsPageSetting = array(
	'name' => $tvs_press_prefix_press . 'meta-box-page',
	'nonce' => 'tvs_studio_press',
	'title' => __('Speaker Information', 'debateLang'),
	'page' => 'press',
	//'context' => 'side',
	'context' => 'normal',
	'priority' => 'default',
	'class' => '',
	'style' => '',
	'title_h2' => true,
	'fields' => array(


		array(
			'name' => $tvs_press_prefix_press . 'press_url',
			'title' => __('URL', 'debateLang'),
			'type' => 'text',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),


		array(
			'name' => $tvs_press_prefix_press . 'press_publication',
			'title' => __('Press Publication', 'debateLang'),
			'type' => 'text',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),

		array(
			'name' => $tvs_press_prefix_press . 'press_date',
			'title' => __('Press Date', 'debateLang'),
			'type' => 'text',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),



		array(
			'name' => $tvs_press_prefix_press . 'press_dates',
			// 'title' => __('Categories Link', 'debateLang'),
			'title' => "",
			'type' => 'info',
			'description' => '  <a href=" /wp-admin/edit-tags.php?taxonomy=presslist&post_type=press">Categories Link</a>  ',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),

	)
);