<?php

class Signature_Watermark {
	/**
	 * Signature Watermark version
	 *
	 * @var string
	 */
	public $version                 = '1.5.1';
	
	/**
	 * Array with default options
	 *
	 * @var array
	 */
	protected $_options             = array(
		'show_on_upload_screen' => true,
		'watermark_on'       => array(),
		'watermark_type' =>	'text-image',
		'watermark_text' => array(
			'text' => '&copy; Your Name Here',
			'font' => 'Rage.ttf',
			'width' => 50,
			'transparency' => 70,
			'color' => 'ffffff'
		),
		'watermark_image'	=> array(
			'url' => null,
			'width' => 50
		)
	);
	
	/**
	 * Plugin work path
	 *
	 * @var string
	 */
	protected $_plugin_dir          = null;
	
	/**
	 * Settings url
	 *
	 * @var string
	 */
	protected $_settings_url        = null;

	/**
	 * Path to dir containing fonts
	 *
	 * @var string
	 */
	protected $_fonts_dir           = 'fonts/';
	
	/**
	 * Get option by setting name with default value if option is unexistent
	 *
	 * @param string $setting
	 * @return mixed
	 */
	protected function get_option($setting) {
	    if(is_array($this->_options[$setting])) {
	        $options = array_merge($this->_options[$setting], get_option($setting));
	    } else {
	        $options = get_option($setting, $this->_options[$setting]);
	    }

	    return $options;
	}
	
	/**
	 * Get array with options
	 *
	 * @return array
	 */
	private function get_options() {
		$options = array();
		
		// loop through default options and get user defined options
		foreach($this->_options as $option => $value) {
			$options[$option] = $this->get_option($option);
		}
		
		return $options;
	}
	
	/**
	 * Merge configuration array with the default one
	 *
	 * @param array $default
	 * @param array $opt
	 * @return array
	 */
	private function mergeConfArray($default, $opt) {
		foreach($default as $option => $values)	{
			if(!empty($opt[$option])) {
				$default[$option] = is_array($values) ? array_merge($values, $opt[$option]) : $opt[$option];
				$default[$option] = is_array($values) ? array_intersect_key($default[$option], $values) : $opt[$option];
			}
		}

		return $default;
    }
	
	/**
	 * Plugin installation method
	 */
	public function activateWatermark() {
		// record install time
		add_option('watermark_installed', time(), null, 'no');
				
		// loop through default options and add them into DB
		foreach($this->_options as $option => $value) {
			add_option($option, $value, null, 'no');	
		}
	}
	
	
	
	/**
	 * Apply watermark to selected image sizes
	 *
	 * @param array $data
	 * @return array
	 */
	public function applyWatermark($data) {
		// get settings for watermarking
		$upload_dir   = wp_upload_dir();
		$watermark_on = $this->get_option('watermark_on');

		// loop through image sizes ...
		foreach($watermark_on as $image_size => $on) {
			if($on == true) {
				switch($image_size) {
					case 'fullsize':
						$filepath = $upload_dir['basedir'] . DIRECTORY_SEPARATOR . $data['file'];
						break;
					default:
						if(!empty($data['sizes']) && array_key_exists($image_size, $data['sizes'])) {
							$filepath = $upload_dir['basedir'] . DIRECTORY_SEPARATOR . dirname($data['file']) . DIRECTORY_SEPARATOR . $data['sizes'][$image_size]['file'];
						} else {
							// early getaway
							continue 2;
						}	
				}
				
				// ... and apply watermark
				$this->doWatermark($filepath);
			}
		}

		// pass forward attachment metadata
		return $data;
	}
	
	
	/**
	 * Apply watermark to certain image
	 *
	 * @param string $filepath
	 * @return boolean
	 */
	public function doWatermark($filepath) {
		// get image mime type
		$mime_type = wp_check_filetype($filepath);
		$mime_type = $mime_type['type'];
		
		// get watermark settings
		$options = $this->get_options();

		// get image resource
		$image = $this->getImageResource($filepath, $mime_type);

		// add watermark image to image
		if($options['watermark_type'] == "text-image"){
			
			$this->imageAddWatermarkImage($image, $options);
			$this->imageAddWatermarkText($image, $options);
			
		}elseif($options['watermark_type'] == "text-only"){
		
			$this->imageAddWatermarkText($image, $options);
			
		}elseif($options['watermark_type'] == "image-only"){
		
			$this->imageAddWatermarkImage($image, $options);
			
		}
		
		// save watermarked image
		return $this->saveImageFile($image, $mime_type, $filepath);
	}
	
	
	
	
	
	public function doWatermarkPreview(array $opt){
		$options = $this->get_options();
		$options = $this->mergeConfArray($options, $opt);
	
		$filepath = WP_PLUGIN_DIR . $this->_plugin_dir . "/example.jpg";
	
		$mime_type = wp_check_filetype($filepath);
		$mime_type = $mime_type['type'];
		
		// get watermark settings
		//$options = $this->get_options();

		// get image resource
		$image = $this->getImageResource($filepath, $mime_type);

		// add watermark image to image
		if($options['watermark_type'] == "text-image"){
			
			$this->imageAddWatermarkImage($image, $options);
			$this->imageAddWatermarkText($image, $options);
			
		}elseif($options['watermark_type'] == "text-only"){
		
			$this->imageAddWatermarkText($image, $options);
			
		}elseif($options['watermark_type'] == "image-only"){
		
			$this->imageAddWatermarkImage($image, $options);
			
		}

		
		// save watermarked image
		//return $this->saveImageFile($image, $mime_type, $filepath);
		// Set the content-type
		header('Content-type: image/jpg');

		// Output the image using imagepng()
		//imagejpeg($image);
		imagejpeg($image, null, 100);
		imagedestroy($image);
	
	}
	
	
	


	private function imageAddWatermarkText($image, array $opt) {
		
		$text  =  $opt['watermark_text']['text'];
		$text_size = $opt['watermark_text']['width'] / 100;
		$text_color  =  $opt['watermark_text']['color'];
		$text_transparency  =  $opt['watermark_text']['transparency'];
		
		//get size of image watermark will be applied to.
		$img_width = imagesx($image);
		$img_height = imagesy($image);
		
		//fix font path
		$opt    = $this->getFontFullpath($opt);
		
		//calculate font size as well as the size of the text
		$font_size = $this->calculateFontSize($opt, $img_width);
		$text_size = $this->calculateTextBBoxSize($opt, $font_size);

		//calculate where to position the text
		$txt_dest_x = ($img_width/2) - ($text_size['width']/2);
		$txt_dest_y = ($img_height/2) + ($text_size['height']/2);
		
		// allocate text color
		$text_transparency =  (int) (($text_transparency/100) * 127);
		$text_color  = $this->imageTransparentColorAllocateHex($image, $text_color, $text_transparency);
		//$text_color = ImageColorAllocateAlpha($image, 255, 255, 255, 96);
		
		// Add the text to image
		imagettftext($image, $font_size, 0, $txt_dest_x, $txt_dest_y, $text_color, $opt['watermark_text']['font'], html_entity_decode($text));

		return $image;
	}

	
	/**
	 * Add watermark image to image
	 *
	 * @param resource $image
	 * @param array $opt
	 * @return resource
	 */
	private function imageAddWatermarkImage($image, array $opt) {
		// get size and url of watermark
		$image_size  =  $opt['watermark_image']['width'] / 100;
		$url  =  $opt['watermark_image']['url'];
		
		$watermark = imagecreatefrompng("$url"); 
		$watermark_width = imagesx($watermark);
		$watermark_height = imagesy($watermark);
				
		$img_width = imagesx($image);
		$img_height = imagesy($image);

		$image_ratio = (($img_width * $image_size) / $watermark_width);
			
		$w =($watermark_width * $image_ratio);
		$h = ($watermark_height * $image_ratio);
		
		$img_dest_x = ($img_width*.9) - ($w);
		$img_dest_y = ($img_height*.9) - ($h);
		
		imagecopyresized($image, $watermark, $img_dest_x, $img_dest_y, 0, 0, $w, $h, $watermark_width, $watermark_height);
		
		return $image;
	}
	



	/**
	 * Get fullpath of font
	 *
	 * @param array $opt
	 * @return unknown
	 */
	private function getFontFullpath(array $opt) {
		$opt['watermark_text']['font'] = WP_PLUGIN_DIR . $this->_plugin_dir . $this->_fonts_dir . $opt['watermark_text']['font'];

		return $opt;
	}



	/**
	 * Allocate a color for an image from HEX code
	 *
	 * @param resource $image
	 * @param string $hexstr
	 * @return int
	 */
	private function imageTransparentColorAllocateHex($image, $hexstr, $transparency) {
		return imagecolorallocatealpha($image,
			hexdec(substr($hexstr,0,2)),
			hexdec(substr($hexstr,2,2)),
			hexdec(substr($hexstr,4,2)),
			$transparency
		);
	}
	


	/**
	 * Calculate text bounting box size
	 *
	 * @param array $opt
	 * @param int $font_size
	 * @return array $size
	 */
	private function calculateTextBBoxSize(array $opt, $font_size){
	
		$bbox = imagettfbbox(
			$font_size,
			0,
			$opt['watermark_text']['font'],
			html_entity_decode($opt['watermark_text']['text'])
		);

		//calculate height and width of text
		$size['width'] = $bbox[4] - $bbox[0];
		$size['height'] = $bbox[1] - $bbox[7];

		return $size;
	
	}
	
	
	
	

	/**
	 * Calculate font size
	 *
	 * @param array $opt
	 * @param int $width
	 * @return int $font_size
	 */
	private function calculateFontSize(array $opt, $width) {

		$font_size = 72;
		$size = $this->calculateTextBBoxSize($opt, $font_size);

		//calculate font size needed to fill the desired wwatermark text width, based on size of original image
		$font_size_ratio = (($opt['watermark_text']['width'] / 100) * $width)  / $size['width'];
		
		$font_size = $font_size * $font_size_ratio;
			
		
		return $font_size;
	}




	
	/**
	 * Get array with image size
	 *
	 * @param resource $image
	 * @return array
	 */
	private function getImageSize($image) {
		return array(
			'x' => imagesx($image),
			'y' => imagesy($image)
		);
	}
	

	
	/**
	 * Get image resource accordingly to mimetype
	 *
	 * @param string $filepath
	 * @param string $mime_type
	 * @return resource
	 */
	private function getImageResource($filepath, $mime_type) {
		switch ( $mime_type ) {
			case 'image/jpeg':
				return imagecreatefromjpeg($filepath);
			case 'image/png':
				return imagecreatefrompng($filepath);
			case 'image/gif':
				return imagecreatefromgif($filepath);
			default:
				return false;
		}
	}
	
	/**
	 * Save image from image resource
	 *
	 * @param resource $image
	 * @param string $mime_type
	 * @param string $filepath
	 * @return boolean
	 */
	private function saveImageFile($image, $mime_type, $filepath) {
		switch ( $mime_type ) {
			case 'image/jpeg':
				//return imagejpeg($image, $filepath, apply_filters( 'jpeg_quality', 100 ));
				return imagejpeg($image, $filepath, 100);
			case 'image/png':
				return imagepng($image, $filepath);
			case 'image/gif':
				return imagegif($image, $filepath);
			default:
				return false;
		}
	}
}

?>