<?php 
$tvs_press_themeName = 'tvsPress';
$tvs_press_prefix_press = $tvs_press_themeName . "MB_";//imporntant -- becase this is database name 
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
			'type' => 'text',
			'name' => $tvs_press_prefix_press . 'pressUrl',
			'title' => __('URL', 'debateLang'),
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),


		array(
			'type' => 'text',
			'name' => $tvs_press_prefix_press . 'pressPublication',
			'title' => __('Press Publication', 'debateLang'),
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),

		array(
			'type' => 'date',
			'name' => $tvs_press_prefix_press . 'pressDate',
			'title' => __('Press Date', 'debateLang'),
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),

		

		// array(
		// 	'type' => 'info',
		// 	'name' => $tvs_press_prefix_press . 'link',
		// 	// 'title' => __('Categories Link', 'debateLang'),
		// 	'title' => "",
		// 	'description' => '  <a href=" /wp-admin/edit-tags.php?taxonomy=presslist&post_type=press">Categories Link</a>  ',
		// 	'style' => '',
		// 	'class' => '',
		// 	'class_li' => '',
		// ),

	)
);