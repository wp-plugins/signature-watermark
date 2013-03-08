=== Signature Watermark ===
Name: Signature Watermark
Contributors: MyWebsiteAdvisor, ChrisHurst
Tags: Watermark, Signature, Images, Image, Picture, Pictures, Photo, Photos, Upload, Post, Plugin, Page, Admin
Requires at least: 3.3
Tested up to: 3.5.1
Stable tag: 1.7.3
Donate link: http://MyWebsiteAdvisor.com/donations/

Automatically watermark images as they are uploaded to the WordPress Media Library.


== Description ==

This plugin allows you to watermark your uploaded images using a PNG image file with transparency as well as text signature.  
The user friendly settings page allows for control over the appearance of your watermark.  
You can set your watermarks to always be a specific percentage of the target image.  


<a href="http://mywebsiteadvisor.com/products-page/premium-wordpress-plugins/signature-watermark-ultra/">**Upgrade to Signature Watermark Ultra**</a> for advanced
watermark features including:

* Manually Apply Watermarks to Images Previously Uploaded
* Fully Adjustable Text and Image Watermark Positions
* Highest Quality Watermarks using Image Re-sampling rather than Re-sizing
* Lifetime Priority Support and Update License



Check out the [Signature Watermark Plugin for WordPress Video Tutorial](http://www.youtube.com/watch?v=pg3WvPBliM4&hd=1):

http://www.youtube.com/watch?v=pg3WvPBliM4&hd=1



Developer Website: http://MyWebsiteAdvisor.com/

Plugin Support: http://MyWebsiteAdvisor.com/support/

Plugin Page: http://MyWebsiteAdvisor.com/tools/wordpress-plugins/signature-watermark/

Video Tutorial: http://mywebsiteadvisor.com/learning/video-tutorials/signature-watermark-tutorial/



Requirements:

* PHP v5.0+
* WordPress v3.3+
* GD extension for PHP
* FreeType extension for PHP


To-do:




== Installation ==

1. Upload `signature-watermark/` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Go to Signature Watermark settings and enable Signature Watermark Plugin.



Check out the [Signature Watermark Plugin for WordPress Video Tutorial](http://www.youtube.com/watch?v=pg3WvPBliM4&hd=1):

http://www.youtube.com/watch?v=pg3WvPBliM4&hd=1

Video Tutorial: http://mywebsiteadvisor.com/learning/video-tutorials/signature-watermark-tutorial/




== Frequently Asked Questions ==


= Plugin doesn't work ... =

Please specify as much information as you can to help us debug the problem. 
Check in your error.log if you can. 
Please send screenshots as well as a detailed description of the problem.



= Error message says that I don't have GD or FreeType extension installed =

Contact your hosting provider and ask them to enable GD extension for your host,  
GD extension is required for watermarking.
FreeType extension is required for text watermarks.



= Error message says that I need to enable the allow_url_fopen option =

Contact your hosting provider and ask them to enable allow_url_fopen, most likely in your php.ini  
It may be necessary to create a php.ini file inside of the wp-admin directory to enable the allow_url_fopen option.



= How do I Remove Watermarks? =

This plugin permenantly alters the images to contain the watermarks, so the watermarks can not be removed. 
If you want to simply test this plugin, or think you may want to remove the watermarks, you need to make a backup of your images before you use the plugin to add watermarks.
<a href="http://wordpress.org/extend/plugins/simple-backup/">**Try Simple Backup Plugin**</a>



= How can I Add Watermarks to images that were uploaded before the plugin was installed? = 

We have a premium version of this plugin that adds the capability to manually add watermarks to images in the WordPress Media Library.

<a href="http://mywebsiteadvisor.com/products-page/premium-wordpress-plugins/signature-watermark-ultra/">**Upgrade to Signature Watermark Ultra**</a> for advanced
watermark features including:

* Manually Apply Watermarks to Images Previously Uploaded
* Fully Adjustable Text and Image Watermark Positions
* Highest Quality Watermarks using Image Re-sampling rather than Re-sizing
* Lifetime Priority Support and Update License



= How can I Adjust the Location of the Watermarks? = 

We have a premium version of this plugin that adds the capability to adjust the locations of the watermarks.
The positions can be adjusted both vertically and horizontally.

<a href="http://mywebsiteadvisor.com/products-page/premium-wordpress-plugins/signature-watermark-ultra/">**Upgrade to Signature Watermark Ultra**</a> for advanced
watermark features including:

* Manually Apply Watermarks to Images Previously Uploaded
* Fully Adjustable Text and Image Watermark Positions
* Highest Quality Watermarks using Image Re-sampling rather than Re-sizing
* Lifetime Priority Support and Update License



= How do I generate the Highest Quality Watermarks? = 

We recommend that your watermark image be roughly the same width as the largest images you plan to watermark.
That way the watermark image will be scaled down, which will work better than making the watermark image larger in order to fit.

We also have a premium version of this plugin that adds the capability to resample the watermark image, rather than simply resize it.
This results in significantly better looking watermarks.

<a href="http://mywebsiteadvisor.com/products-page/premium-wordpress-plugins/signature-watermark-ultra/">**Upgrade to Signature Watermark Ultra**</a> for advanced
watermark features including:

* Manually Apply Watermarks to Images Previously Uploaded
* Fully Adjustable Text and Image Watermark Positions
* Highest Quality Watermarks using Image Re-sampling rather than Re-sizing
* Lifetime Priority Support and Update License



Check out the [Signature Watermark Plugin for WordPress Video Tutorial](http://www.youtube.com/watch?v=pg3WvPBliM4&hd=1):

http://www.youtube.com/watch?v=pg3WvPBliM4&hd=1




Developer Website: http://MyWebsiteAdvisor.com/

Plugin Support: http://MyWebsiteAdvisor.com/support/

Plugin Page: http://MyWebsiteAdvisor.com/tools/wordpress-plugins/signature-watermark/

Video Tutorial: http://mywebsiteadvisor.com/learning/video-tutorials/signature-watermark-tutorial/



== Screenshots ==

1. Finished Example Image
2. Watermark Settings Page
3. Watermark Preview Page



== Changelog ==

= 1.7.3 =
* updated plugin FAQs
* updated readme file


= 1.7.2 =
* updated contextual help, removed deprecated filter and updated to preferred method
* added uninstall and deactivation functions to clear plugin settings
* updated plugin upgrades tab on plugin settings page
* update read me file



= 1.7.1 =
* updated readme file
* added plugin upgrades tab to plugin settings page


= 1.7 =
* updated plugin to use WordPress settings API
* added tabbed navigation on settings page
* updated watermark preview system (watermark preview tab)
* added plugin tutorial video (plugin tutorial video tab)
* updated screenshots
* updated readme, required WP version is 3.3



= 1.6.2 =
* added label elements around checkboxes to make the label text clickable.
* added function exists check for the sys_getloadavg function so it does not cause fatal errors on MS Windows Servers



= 1.6.1 =
* added option to select image type for auto watermarks
* updated image previews on upload screen
* fixed several issues causing warnings and notices in debug.log
* added plugin version to plugin diagnostic screen.




= 1.6 =
* added image preview/review screen to the edit media page
* added a control to show or hide the display the image review section on the edit media page
* resolved issues with images getting cached by browser and not displaying newly applied watermarks
* verified compatibility with WordPress v3.5



= 1.5.4 =
* fixed several incorrect opening php tags, requires <?php not <?


= 1.5.3 =
* resolved issues with deprecated function warnings
* added link to plugin row meta links on plugins page to rate and review this plugin on WordPress.org.
* added link to plugin row meta links on plugins page to upgrade this plugin.

= 1.5.2 =
* added link to rate and review this plugin on WordPress.org

= 1.5.1 =
* updated plugin activation php version check which was causing out of place errors.


= 1.5 =
* Added contextual help menu with faqs and support links
* Fixed broken links


= 1.4 =
* Updated plugin debug, minor cleanup, updated links


= 1.3 =
* Updated image size options to read image sizes from WordPress rather than a static list


= 1.2 =
* Updated several broken support links


= 1.1 =
* Minor Improvements and Bug Fixes


= 1.0 =
* Initial release

