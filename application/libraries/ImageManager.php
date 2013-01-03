<?php

/**
 * Created by Brad Walker on 9/3/12 at 5:24 PM
 */

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

require_once('application/libraries/Library.php');

class ImageManager extends Library {

	/**
	 * returns a blank true-color image with alpha transparency enabled
	 * @param int $width width in px of image to create
	 * @param int $height height in px of image to create
	 * @param bool $withAlphaChannel whether or not to create image with alpha channel
	 * @return resource
	 */
	public function createBlankImage($width, $height, $withAlphaChannel = TRUE) {  // create blank, transparent, true-color palette 
		$image = imagecreatetruecolor($width, $height);
		
		if ($withAlphaChannel) {
			$transparentColor = imagecolorallocatealpha($image, 0, 0, 0, 127);
			imagefill($image, 0, 0, $transparentColor);
			imagealphablending($image, true);
			imagesavealpha($image, true);
		}
		
		return $image;
	}

	/**
	 * returns a true-color image with alpha transparency enabled from specified filename
	 * @param string $path path to a PNG image on the filesystem
	 * @param bool $withAlphaChannel whether or not to create image with alpha channel
	 * @return resource
	 */
	public function createImageFromPNG($path, $withAlphaChannel = TRUE) {
		$image = imagecreatefrompng($path);
		
		if ($withAlphaChannel) {
			imagealphablending($image, true);
			imagesavealpha($image, true);
		}
		
		return $image;
	}

	/**
	 * returns an image created from the specified path
	 * @param string $path path to a PNG image on the filesystem
	 * @return resource
	 */
	public function createImageFromJPG($path) {
		$image = imagecreatefromjpeg($path);

		return $image;
	}
	
	
	public function createVIPSImageFromPNG($path) {
		
	}
}
