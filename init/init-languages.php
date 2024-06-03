<?php 


// Load plugin text-domain

$locale = apply_filters('plugin_locale', get_locale(), 'tvs_wp_debate-debate');

load_textdomain('tvs_wp_debate-debate', WP_LANG_DIR . 'tvs_wp_debate-debate/tvs_wp_debate-debate-' . $locale . '.mo');
load_plugin_textdomain('tvs_wp_debate-debate', false, plugin_basename(dirname(__FILE__)) . '/languages');
