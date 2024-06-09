<?php 
//--------------debate-------------
function tvsDebate_debate_options_()
{
	include('for_debate/metabox_options.php');
	$tvsDebate_debate_options['0'] = $tvs_debate_OptionsPageSetting;
	 new ssSytemMetaboxEngine($tvsDebate_debate_options, 'tvs_debate-setting', true);
}


if (tvsDebate_post_type()["get_type"] == 'debate' || tvsDebate_post_type()["post_type"] == 'debate' ) {
	tvsDebate_debate_options_();
}

include ("for_debate/sidebar-metabox.php");

//--------------Speaker-------------

function tvsDebate_speaker_options_()
{
	include('for_speaker/metabox_options.php');
	$tvsDebate_debate_options['0'] = $tvs_speaker_OptionsPageSetting;
	new ssSytemMetaboxEngine($tvsDebate_debate_options, 'tvs_speaker-setting', true);
}


if (tvsDebate_post_type()["get_type"] ==   'speaker' || tvsDebate_post_type()["post_type"] == 'speaker'  ) {
	tvsDebate_speaker_options_();
}







//--------------post-------------  cancel 

// function tvs_wp_post_options_()
// {
// 	include('for-post/metabox_options.php');
// 	$tvsDebate_debate_options['0'] = $tvsDebate_OptionsPageSetting;
// 	 new tvs_wp_metabox_engine($tvsDebate_debate_options, 'tvs_wp_post-Setting', true);
// }


// if (tvsDebate_post_type()["get_type"] ==  'post' || tvsDebate_post_type()["post_type"] == 'post' ) {
// 	tvs_wp_post_options_();
// }
