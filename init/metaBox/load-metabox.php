<?php 
//--------------debate-------------
function ssDebate_debate_options_()
{
	include('for_debate/metabox_options.php');
	$ssDebate_debate_options['0'] = $tvs_wp_debate_OptionsPageSetting;
	 new ssSytemMetaboxEngine($ssDebate_debate_options, 'tvs_wp_debate-Setting', true);
}


if (ssDebate_post_type()["get_type"] == 'debate' || ssDebate_post_type()["post_type"] == 'debate' ) {
	ssDebate_debate_options_();
}

include ("for_debate/sidebar-metabox.php");

//--------------Speaker-------------

function ssDebate_speaker_options_()
{
	include('for_speaker/metabox_options.php');
	$ssDebate_debate_options['0'] = $tvs_wp_speaker_OptionsPageSetting;
	new ssSytemMetaboxEngine($ssDebate_debate_options, 'tvs_wp_speaker-Setting', true);
}


if (ssDebate_post_type()["get_type"] ==   'tvs_speaker' || ssDebate_post_type()["post_type"] == 'tvs_speaker'  ) {
	ssDebate_speaker_options_();
}







//--------------post-------------  cancel 

// function tvs_wp_post_options_()
// {
// 	include('for-post/metabox_options.php');
// 	$ssDebate_debate_options['0'] = $ssDebate_OptionsPageSetting;
// 	 new tvs_wp_metabox_engine($ssDebate_debate_options, 'tvs_wp_post-Setting', true);
// }


// if (ssDebate_post_type()["get_type"] ==  'post' || ssDebate_post_type()["post_type"] == 'post' ) {
// 	tvs_wp_post_options_();
// }
