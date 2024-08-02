<?php 


// Load plugin text-domain

$locale = apply_filters('plugin_locale', get_locale(), 'tvs_wp_debate-debate');

load_textdomain('tvs_wp_debate-debate', WP_LANG_DIR . 'tvs_wp_debate-debate/tvs_wp_debate-debate-' . $locale . '.mo');
load_plugin_textdomain('tvs_wp_debate-debate', false, plugin_basename(dirname(__FILE__)) . '/languages');







function tvsDebate_init_languages() {
	// Retrieve the directory for the internationalization files
    load_plugin_textdomain('debateLang', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}
add_action( 'plugins_loaded', 'tvsDebate_init_languages' );

