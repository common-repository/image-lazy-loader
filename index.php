<?php
/*
Plugin Name: QazyWP - WordPress Lazy Image Loader
Plugin URI: https://github.com/liamstewart23/QazyWP
Description: Lazy Load Images in WordPress - Built off Narayan Prusty's <a href="https://github.com/narayanprusty/Qazy">Qazy library</a>
Version: 1.0.0
Author: Liam Stewart
Author URI: https://liamstewart.ca
*/

/**
 * adding Qazy to WordPress head
 */
add_action('wp_head', 'ls_qazy_head');
function ls_qazy_head() {
	echo '<!-- Start Lazy Load Images Script -->
<script type="text/javascript" src="'.plugins_url( 'js/vendor/qazy.js', __FILE__ ).'"></script>
<!-- End Lazy Load Images Script -->
';
}

/**
 * @param $content
 * @return mixed
 * edit content to apply data attribute for Qazy
 */
function ls_qazy_content($content) {
	//if the post has the data attribute on images remove it.
	if (strpos($content, '<img data-qazy=\"true\"') !== false) {
		$content = str_replace('<img data-qazy=\"true\"','<img', $content);
	}
	//apply data attribute for qazy
	return str_replace('<img','<img data-qazy=\"true\"', $content);
}
add_filter('content_save_pre','ls_qazy_content');
