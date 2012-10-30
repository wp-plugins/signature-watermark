<?php
/*
Plugin Name: Signature Watermark
Plugin URI: http://MyWebsiteAdvisor.com/tools/wordpress-plugins/signature-watermark/
Description: Add transparent PNG image and text signature watermark to your uploaded images.
Version: 1.3
Author: MyWebsiteAdvisor
Author URI: http://MyWebsiteAdvisor.com
*/

register_activation_hook(__FILE__, 'signature_watermark_activate');

// display error message to users
if ($_GET['action'] == 'error_scrape') {                                                                                                   
    die("Sorry, Signature Watermark Plugin requires PHP 5.0 or higher. Please deactivate Signature Watermark Plugin.");                                 
}

function signature_watermark_activate() {
	if ( version_compare( phpversion(), '5.0', '<' ) ) {
		trigger_error('', E_USER_ERROR);
	}
}

// require Signature Watermark Plugin if PHP 5 installed
if ( version_compare( phpversion(), '5.0', '>=') ) {
	define('TW_LOADER', __FILE__);

	require_once(dirname(__FILE__) . '/signature-watermark.php');
	require_once(dirname(__FILE__) . '/plugin-admin.php');
	
	$watermark = new Signature_Watermark_Admin();

}
?>