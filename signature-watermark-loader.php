<?php
/*
Plugin Name: Signature Watermark
Plugin URI: http://MyWebsiteAdvisor.com/tools/wordpress-plugins/signature-watermark/
Description: Add transparent PNG image and text signature watermark to your uploaded images.
Version: 1.7.7
Author: MyWebsiteAdvisor
Author URI: http://MyWebsiteAdvisor.com
*/

register_activation_hook(__FILE__, 'signature_watermark_activate');

register_uninstall_hook(__FILE__, "signature_watermark_uninstall");


function signature_watermark_uninstall(){
	delete_option('signature-watermark-settings');
}


function signature_watermark_activate() {

	// display error message to users
	if ($_GET['action'] == 'error_scrape') {                                                                                                   
		die("Sorry, Signature Watermark Plugin requires PHP 5.0 or higher. Please deactivate Signature Watermark Plugin.");                                 
	}

	if ( version_compare( phpversion(), '5.0', '<' ) ) {
		trigger_error('', E_USER_ERROR);
	}
}

// require Signature Watermark Plugin if PHP 5 installed
if ( version_compare( phpversion(), '5.0', '>=') ) {

	define('SW_LOADER', __FILE__);

	include_once(dirname(__FILE__) . '/signature-watermark-plugin-installer.php');
	
	require_once(dirname(__FILE__) . '/signature-watermark-settings-page.php');
	require_once(dirname(__FILE__) . '/signature-watermark-tools.php');
	require_once(dirname(__FILE__) . '/signature-watermark-plugin.php');

	$signature_watermark = new Signature_Watermark_Plugin();

}

?>