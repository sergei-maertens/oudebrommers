<?php
/*
* phpWatermark 0.4 (c) 2003 Mario Witte
* modified and bugfixed by 4seven / 2010 / <http://4seven.kilu.de/forum/phpbb3/index.php>
* @package watermark
* @version $Id: watermark.php 2010-05-05 11:06:13Z 4seven $
* @copyright (c) 2010 4seven
*/

if (!class_exists('Watermark')){

class Watermark {

	var $image;
	var $type;
	var $width;
	var $height;
	var $marked_image;
	var $sizes;
	var $position = "C";
	var $offset_x;
	var $offset_y;
	var $orientation;
	var $imageCreated = false;
	var $gd_version;
	var $fixedColor = ''; 

	var $version = 'phpWatermark 0.4';

	// Public Watermark
	// You need to specify either a filename or an image resource
	// when instatiating phpWatermark
	function Watermark($res) {
		list($this->type, $this->image) = $this->_getImage($res);

		if (!$this->image) {
			$this->_die_error("Your current PHP setup does not support ". $this->type ." images");
		}
	
		$this->width = imagesx($this->image);
		$this->height = imagesy($this->image);

		$gdinfo = gd_info();
		if (preg_match('/(\d)\.\d/', $gdinfo["GD Version"], $gdinfo))
			$this->gd_version = $gdinfo[1];
		else
			$this->gd_version = 0;
		unset($gdinfo);
	}

	// Public void setType(string)
	// Currently not used
	// TODO: Add functionality
	function setType($type) {
		$this->type = $type;
	}

	// Public void addWatermark(string)
	// Adds a watermark to the image
	function addWatermark($mark, $type = "IMAGE") {

    if ($type == "IMAGE") { // We are going to embed an image
			list($dummy, $mark) = $this->_getImage($mark);
			
			$this->sizes = $this->_getImageSizes($mark);
			$this->_getOffsets();
			
			$img_mark = $this->_createEmptyWatermark();
			
			$img_mark = $this->_addImageWatermark($mark, $img_mark);

			$this->_createMarkedImage($img_mark, $type, 30);
			
             // test	
             imagedestroy($mark);
             // test
			
			
	 }
	}

	// Public int getMarkedImage
	// Returns the final image
	function getMarkedImage() {
		if ($this->imageCreated == false) {
			$this->addWatermark($this->version);
		}
		
		return $this->marked_image;
		
               // test
               unset($this->marked_image);
               // test
			   
	}

	// Public bool setPosition
	// Set position of watermark on image
	// Return true on valid parameter, otherwise false
	function setPosition($newposition) {
		$valid_positions = array(
			"TL", "TM", "TR", "CL", "C", "CR", "BL", "BM", "BR", "RND"
		);

		$newposition = strtoupper($newposition);

		if (in_array($newposition, $valid_positions)) {
			if ($newposition == "RND") {
				$newposition = $valid_positions[rand(0, sizeof($valid_positions) - 2)];
			}
			$this->position = $newposition;
			return true;
		}
		return false;
	}
	
	// Private _die_error
	function _die_error($errmsg) {
		die($errmsg);
	}

	// Private _getImageSizes
	function _getImageSizes($res) {
		// Check if the overlay image is bigger than the main image
		
		if (@imagesx($res) > $this->width || @imagesy($res) > $this->height) {
			// Need to resize the overlay image
			$box_h = $box_w = 0;
			$box_spacer_h = $box_spacer_w = 0;
			if (imagesx($res) > imagesy($res)) {
				$box_w = $this->width;
				$box_h = intval((imagesy($res) / (imagesx($res) / $this->width)) + 0.5);
				$box_spacer_h = intval(($this->height - $box_h) / 2);
			} else {
				$box_h = $this->height;
				$box_w = intval((imagesx($res) / (imagesy($res) / $this->height)) + 0.5);
				$box_spacer_w = intval(($this->width - $box_w) / 2);
			}
		} else {
			$box_spacer_h = $box_spacer_w = 0;
			$box_h = imagesy($res);
			$box_w = imagesx($res);
		}
		return array(
				"box_w"		=> $box_w,
				"box_h"		=> $box_h,
				"spacer_w"	=> $box_spacer_w,
				"spacer_h"	=> $box_spacer_h
			);		
	}

	// Private _getChunk
	function _getChunk() {
		$chunk = imagecreatetruecolor($this->sizes["box_w"], $this->sizes["box_h"]);		
		imagealphablending($chunk, true);

		imagecopy(	$chunk,
				$this->image, 
				0, 
				0,
				$this->offset_x,
				$this->offset_y,
				$this->sizes["box_w"],
				$this->sizes["box_h"]
		);
		return $chunk;
		
       // test
       imagedestroy($chunk);
       // test
		
	}

	// Private _createEmptyWatermark
	function _createEmptyWatermark() {
		return imagecreatetruecolor($this->sizes["box_w"], $this->sizes["box_h"]);
		#return imagecreate($this->sizes["box_w"], $this->sizes["box_h"]);
	}


	// Private _addImageWatermark
	// 4seven  - Shrinking near zero, because most of them was unneeded
	function _addImageWatermark($mark, $img_mark) {
	// imagecopyresampled($img_resized_mark, $img_mark, 0, 0, 0, 0, $this->width, $this->height, $this->width /2, $this->height /2);
	imagecopy($img_mark, $mark, 0, 0, 0, 0, imagesx($mark), imagesy($mark));

	return $img_mark;
	
	// test
    imagedestroy($img_mark);
    // test
	
	}
	
	// Private _createMarkedImage
	function _createMarkedImage($img_mark, $type, $pct) {
		// Create marked image (original + watermark)
		$this->marked_image = imagecreatetruecolor($this->width, $this->height);
	
		// neu imagecopy instead of imagecopymerge
		imagecopy($this->marked_image, $this->image, 0, 0, 0, 0, $this->width, $this->height);
		
		if ($type == 'IMAGE') {
	
        // 4seven  - Shrinking,  but GD2+  Support needed ;)	
        global $config;
		
		@imagealphablending($img_mark, false);
        @imagesavealpha($img_mark, true);

		$trans_png_color = imagecolorexact($img_mark, 0, 0, 0);

        imagecolortransparent($img_mark, $trans_png_color);   
	
				imagecopymerge(
					$this->marked_image,
					$img_mark,
					$this->offset_x,
					$this->offset_y,
					0,
					0,
					$this->sizes["box_w"],
					$this->sizes["box_h"] ,
					(100 - $config['watermark_transparency'])				
			        // 4seven  - Shrinking,  but GD2+  Support needed ;)	
					 
				);
	
				// test
                imagedestroy($img_mark);
				// test

			$this->imageCreated = true;
        }
}

	// Private _getOffsets
	function _getOffsets() {

		$width_mark = $this->sizes["box_w"] + $this->sizes["spacer_w"];
		$height_mark = $this->sizes["box_h"] + $this->sizes["spacer_h"];
		$width_left = $this->width - $width_mark;
		$height_left = $this->height - $height_mark; 
	
		switch ($this->position) {
			case "TL": // Top Left
				$this->offset_x = $width_left >= 5 ? 5 : $width_left;
				$this->offset_y = $height_left >= 5 ? 5 : $height_left;
				break;
			case "TM": // Top middle 
				$this->offset_x = intval(($this->width - $width_mark) / 2);
				$this->offset_y = $height_left >= 5 ? 5 : $height_left;
				break;
			case "TR": // Top right
				$this->offset_x = $this->width - $width_mark;
				$this->offset_y = $height_left >= 5 ? 5 : $height_left;
				break;
			case "CL": // Center left
				$this->offset_x = $width_left >= 5 ? 5 : $width_left;
				$this->offset_y = intval(($this->height - $height_mark) / 2);
				break;
			default:
			case "C": // Center (the default)
				$this->offset_x = intval(($this->width - $width_mark) / 2);
				$this->offset_y = intval(($this->height - $height_mark) / 2);
				break;
			case "CR": // Center right
				$this->offset_x = $this->width - $width_mark;
				$this->offset_y = intval(($this->height - $height_mark) / 2);
				break;
			case "BL": // Bottom left
				$this->offset_x = $width_left >= 5 ? 5 : $width_left;
				$this->offset_y = $this->height - $height_mark;
				break;
			case "BM": // Bottom middle
				$this->offset_x = intval(($this->width - $width_mark) / 2);
				$this->offset_y = $this->height - $height_mark;
				break;
			case "BR": // Bottom right
				$this->offset_x = $this->width - $width_mark;
				$this->offset_y = $this->height - $height_mark;
				break;
		}
	}

	// private _getImage
	// Takes a path to an image or a php image resource as the only argument
	// Returns image type and the appropriate image resource
	function _getImage($res) {
		$img;
		$type;
	
		if (intval(@imagesx($res)) > 0) {
			$img = $res;
		} else {
			$imginfo = getimagesize($res);

			switch($imginfo[2]) { // Determine type
				case 1:
					$type = "GIF";
					if (function_exists("imagecreatefromgif")) {
						$img = imagecreatefromgif($res);
					} else {
						die("Unsupported image type: $type");
					}
					break;
				case 2:
					$type = "JPG";
					if (function_exists("imagecreatefromjpeg")) {
						$img = imagecreatefromjpeg($res);
					} else {
						die("Unsupported image type: $type");
					}
					break;
				case 3:
					$type = "PNG";
					if (function_exists("imagecreatefrompng")) {
						$img = imagecreatefrompng($res);
					} else {
						die("Unsupported image type: $type");
					}
					break;
			}
		}

		return array($type, $img);		
	}
  }
}
?>