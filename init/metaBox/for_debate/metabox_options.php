<?php
$tvs_wp_debate_themeName = 'tvsDebate';//for include data
$tvs_wp_debate_prefix_debate = $tvs_wp_debate_themeName . "MB_";
$tvs_wp_debate_OptionsPageSetting = array(
	'name' => $tvs_wp_debate_prefix_debate . 'meta-box-page',
	'nonce' => 'st_studio_debate',
	'title' => __('EK Bilgiler', 'debateLang'),
	'page' => 'debate',
	//'context' => 'side',
	'context' => 'normal',
	'priority' => 'default',
	'class' => '',
	'style' => '',
	'title_h2' => true,
	'fields' => array(

		array(
			'name' => $tvs_wp_debate_prefix_debate . 'name',
			'title' => __('Debate Name', 'debateLang'),
			'type' => 'text',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),

		array(
			'name' => $tvs_wp_debate_prefix_debate . 'code',
			'title' => __('Debate Code', 'debateLang'),
			'type' => 'text',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),

		array(
			'name' => $tvs_wp_debate_prefix_debate . 'phone',
			'title' => __('Phone', 'debateLang'),
			'type' => 'text',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),
	
		array(
			'name' => $tvs_wp_debate_prefix_debate . 'adress',
			'title' => __('Adress', 'debateLang'),
			'type' => 'textarea',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),

		array(
			'name' => $tvs_wp_debate_prefix_debate . 'google_map',
			'title' => __('Google Map', 'debateLang'),
			'type' => 'textarea',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),

		array(
			'name' => $tvs_wp_debate_prefix_debate . 'donate_form_shortcode',
			'title' => __('Donate Form Shortcode', 'debateLang'),
			'type' => 'textarea',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),

		array(
			'name' => $tvs_wp_debate_prefix_debate . 'wp_form_shortcode',
			'title' => __('Summer Camp Form Shortcode', 'debateLang'),
			'type' => 'textarea',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' => '',
		),


		// array(
		// 	'name' => $tvs_wp_debate_prefix_debate . 'color_code',
		// 	'title' => __('Color Code', 'debateLang'),
		// 	'type' => 'color',
		// 	'description' => '',
		// 	'style' => '',
		// 	'class' => '',
		// 	'class_li' => '',
		// ),

		// array(
		// 	'name' => $tvs_wp_debate_prefix_debate . 'media-gallery',
		// 	'title' => __('media-gallery', 'debateLang'),
		// 	'type' => 'media-gallery',
		// 	'button_text' => 'Video Yükle / Seç',
		// 	'description' => __("", 'debateLang'),
		// 	'style' => '',
		// 	'class' => '',
		// 	'class_li' => '',
		// ),


				// array(
		// 	'name' => $tvs_wp_debate_prefix_debate . 'debate_name',
		// 	'title' => __('upload', 'debateLang'),
		// 	'type' => 'upload',
		// 	'button_text' => 'uploadee',
		// 	'description' => '',
		// 	'style' => '',
		// 	'class' => '',
		// 	'class_li' => '',
		// ),
	

				// array(
		// 	'name' => 'page_header_type_info',
		// 	'title' => __('bla bla bl
		// 	. <br> bla bla bla', 'debateLang'),
		// 	'type' => 'info',
		// 	'description' => '',
		// 	'style' => '',
		// 	'class' => '',
		// 	'class_li' => '',
		// 	'extra' => '',
		// ),

		/////-----------------------------
		// array(
		// 	'name' => $tvs_wp_debate_prefix_debate . 'gender',
		// 	'title' => __('Gender of doctor', 'debateLang'),
		// 	'type' => 'select',
		// 	'description' => __("Select gender", 'debateLang'),
		// 	'style' => '',
		// 	'class' => '',
		// 	'class_li' => '',
		// 	'options' => array(
		// 		'male' => __('Male', 'debateLang'),
		// 		'female' => __('Female', 'debateLang'),
		// 	)
		// ),

	
		// array(
		// 	'name' => $tvs_wp_debate_prefix_debate . 'gal',
		// 	'title' => __('gal', 'debateLang'),
		// 	'button_text' => __('gal', 'debateLang'),
		// 	'type' => 'media-gallery',
		// 	'description' => '',
		// 	'style' => '',
		// 	'class' => '',
		// 	'class_li' => '',
		// ),
		
	)
);