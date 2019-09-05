<?php
/**
* phpWatermark 0.3 (c) 2003 Mario Witte
* modified and bugfixed by 4seven - 2009 - <http://4seven.kilu.de/forum/phpbb3/index.php>
*
* @package watermark afterward
* @version $Id: watermark_afterward_2_jpg.php  2010-05-22 13:29:12Z 4seven $
* @copyright (c) 2010 / 4seven
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/

// Benötigte Dateien und Variablen von phpBB
define('IN_PHPBB', true);
$phpbb_root_path = '../../../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

// Session auslesen und Benutzer-Informationen laden
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/lang_watermark_acp');

if ($auth->acl_get('a_'))
{

$backup_path_1 = $phpbb_root_path . 'files/convert/backup';

if(file_exists($backup_path_1)){

if (file_exists("$phpbb_root_path/files/convert/011_jpg.jpg")){
unlink ("$phpbb_root_path/files/convert/011_jpg.jpg");}
if (file_exists("$phpbb_root_path/files/convert/012_JPG.JPG")){
unlink ("$phpbb_root_path/files/convert/012_JPG.JPG");}
if (file_exists("$phpbb_root_path/files/convert/021_jpeg.jpeg")){
unlink ("$phpbb_root_path/files/convert/021_jpeg.jpeg");}
if (file_exists("$phpbb_root_path/files/convert/022_JPEG.JPEG")){
unlink ("$phpbb_root_path/files/convert/022_JPEG.JPEG");}
if (file_exists("$phpbb_root_path/files/convert/031_png.png")){
unlink ("$phpbb_root_path/files/convert/031_png.png");}
if (file_exists("$phpbb_root_path/files/convert/032_PNG.PNG")){
unlink ("$phpbb_root_path/files/convert/032_PNG.PNG");}
if (file_exists("$phpbb_root_path/files/convert/041_gif.gif")){
unlink ("$phpbb_root_path/files/convert/041_gif.gif");}
if (file_exists("$phpbb_root_path/files/convert/042_GIF.GIF")){
unlink ("$phpbb_root_path/files/convert/042_GIF.GIF");}

if ($config['watermark_type'] == 'text'){

  include($phpbb_root_path . 'includes/watermark/afterward/watermark_afterward_text.' . $phpEx);

 $original_directory = "$phpbb_root_path/files/convert/";
 $watermarked_images = "$phpbb_root_path/files/convert/ready/";


 if ($handle = opendir($original_directory))
 {
    while (false !== ($file = readdir($handle)))
    {
      if(!is_file($original_directory.$file))

       continue;

	  if (function_exists("exif_imagetype")){

      if (exif_imagetype($original_directory.$file)== 2){

	  if (!file_exists($watermarked_images.$file)){

  // Text transform and wordwrap
  $raw_text =  htmlspecialchars_decode(utf8_normalize_nfc($config['watermark_text']));
  $new_text = wordwrap($raw_text, $config['watermark_text_cut'], "\n");

   // Thumbs Variables
  $source_w_th = getimagesize( $original_directory.$file );
  $source_w_th = $source_w_th[0];



  create_watermark_from_string(
  $original_directory.$file, $watermarked_images.$file,
  $new_text,
  $config['watermark_text_font'],
  round($source_w_th / $config['watermark_text_size']),
  $config['watermark_text_color'],
  $config['watermark_text_transparency'],
  $config['watermark_text_degree'],
  $config['watermark_position'] );

      }
   }
}
	  else{

	  $imginfo = getimagesize($original_directory.$file);

	  if ($imginfo[2] == 2){

	  if (!file_exists($watermarked_images.$file)){

   // Text transform and wordwrap
  $raw_text =  htmlspecialchars_decode(utf8_normalize_nfc($config['watermark_text']));
  $new_text = wordwrap($raw_text, $config['watermark_text_cut'], "\n");

  // Thumbs Variables
  $source_w_th = getimagesize( $original_directory.$file );
  $source_w_th = $source_w_th[0];

  create_watermark_from_string(
  $original_directory.$file, $watermarked_images.$file,
  $new_text,
  $config['watermark_text_font'],
  round($source_w_th / $config['watermark_text_size']),
  $config['watermark_text_color'],
  $config['watermark_text_transparency'],
  $config['watermark_text_degree'],
  $config['watermark_position'] );

         }
      }
   }
}

     closedir($handle);

	 echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title></title>
</head>
<body style="background:#DDDFE3">
<hr />
' . utf8_decode($user->lang['STEP_2_JPG_FINISH']) . '
<hr />
' . utf8_decode($user->lang['STEP_2_GIF_START'])  . '
<hr />
</body>
</html>';

    }
}

else if ($config['watermark_type'] == 'image'){

class Watermark {

	var $image;
	var $type;
	var $width;
	var $height;
	var $marked_image;
	var $sizes;
	var $position = "C";
	// var $position = "TL";
	var $offset_x;
	var $offset_y;
	var $orientation;
	var $imageCreated = false;
	var $gd_version;
	var $fixedColor = '';

	var $version = 'phpWatermark 0.3';

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
	// Type defaults to TEXT for backwards compatibility

	function addWatermark($mark){

			list($dummy, $mark) = $this->_getImage($mark);

			$this->sizes = $this->_getImageSizes($mark);
			$this->_getOffsets();

			$img_mark = $this->_createEmptyWatermark();

			$img_mark = $this->_addImageWatermark($mark, $img_mark);

			$this->_createMarkedImage($img_mark, 'image', 30);
	}

	// Public int getMarkedImage
	// Returns the final image
	function getMarkedImage() {
		if ($this->imageCreated == false) {
			$this->addWatermark($this->version);
		}
		return $this->marked_image;
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
	}

	// Private _createEmptyWatermark
	function _createEmptyWatermark() {
		return imagecreatetruecolor($this->sizes["box_w"], $this->sizes["box_h"]);
		#return imagecreate($this->sizes["box_w"], $this->sizes["box_h"]);
	}


	// Private _addImageWatermark
	// 4seven  - Shrinking near zero, because most of them was unneeded

	function _addImageWatermark($mark, $img_mark) {
	imagecopy($img_mark, $mark, 0, 0, 0, 0, imagesx($mark), imagesy($mark));
	return $img_mark;}

	// 4seven  - Shrinking near zero, because most of them was unneeded


	// Private _createMarkedImage
	function _createMarkedImage($img_mark, $type, $pct) {

		// Create marked image (original + watermark)
		$this->marked_image = imagecreatetruecolor($this->width, $this->height);
		imagecopy($this->marked_image, $this->image, 0, 0, 0, 0, $this->width, $this->height);

                // 4seven  - Shrinking,  but GD2+  Support needed ;)

				global $config;

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
					$this->sizes["box_h"],
					(100 - $config['watermark_transparency'])
			    // 4seven  - Shrinking,  but GD2+  Support needed ;)

				);

			$this->imageCreated = true;

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

			if (function_exists("exif_imagetype")){
			switch(exif_imagetype($res))

			{ // Determine type


				case 1:
					$type = 1;
					if (function_exists('imagecreatefromgif')) {
						$img = imagecreatefromgif($res);
					} else {
						die('Unsupported image type: GIF');
					}
					break;
				case 2:
					$type = 2;
					if (function_exists('imagecreatefromjpeg')) {
						$img = imagecreatefromjpeg($res);
					} else {
						die('Unsupported image type: JPEG');
					}
					break;
				case 3:
					$type = 3;
					if (function_exists('imagecreatefrompng')) {
						$img = imagecreatefrompng($res);
					} else {
						die('Unsupported image type: PNG');
					}
					break;
			}
		}

		 else{

		 $imginfo = getimagesize($res);
		 switch($imginfo[2])


		 { // Determine type


				case 1:
					$type = 1;
					if (function_exists('imagecreatefromgif')) {
						$img = imagecreatefromgif($res);
					} else {
						die('Unsupported image type: GIF');
					}
					break;
				case 2:
					$type = 2;
					if (function_exists('imagecreatefromjpeg')) {
						$img = imagecreatefromjpeg($res);
					} else {
						die('Unsupported image type: JPEG');
					}
					break;
				case 3:
					$type = 3;
					if (function_exists('imagecreatefrompng')) {
						$img = imagecreatefrompng($res);
					} else {
						die('Unsupported image type: PNG');
					}
					break;
			}
		}

		}


      return array($type, $img);

     }
}

include_once($phpbb_root_path . 'includes/watermark/watermark_resize_1.' . $phpEx);


 $original_directory = "$phpbb_root_path/files/convert/";
 $watermarked_images = "$phpbb_root_path/files/convert/ready/";

 if ($handle = opendir($original_directory))
 {
    while (false !== ($file = readdir($handle)))
    {

      if(!is_file($original_directory.$file))

       continue;


	  if (function_exists("exif_imagetype")){

      if(exif_imagetype($original_directory.$file)== 2){

     if (!file_exists($watermarked_images.$file)){

		// check the size of given fullsize image
	    $new_water_size   = getimagesize($original_directory.$file);
		// öhm $new_water_width  = $new_water_size[0];

		// is it a 4:3 or a 3:4 fullsize image?
		if ($new_water_size[0] < $new_water_size[1]){
		$new_water_width  = round(($new_water_size[0]/110)*$config['watermark_img_sz_proc']);}
		else{
		$new_water_width  = round(($new_water_size[1]/90)*$config['watermark_img_sz_proc']);}

  					// watermark friendly fullsize image sizing
	                $image = new simpleresize();
					$image->load($phpbb_root_path . 'includes/watermark/images/watermark.png');
	                $image->resizeToWidth($new_water_width);
	                $image->save($phpbb_root_path . 'includes/watermark/images/watermark_resize.png');

	$wm = new watermark($original_directory.$file);
	$wm->setPosition($config['watermark_position']);

	$wm->addWatermark($phpbb_root_path . 'includes/watermark/images/watermark_resize.png');
	$im = $wm->getMarkedImage();
	imagejpeg($im, $watermarked_images.$file, $config['watermark_output_quality']);

	  }
   }
}
      else{


	  $imginfo = getimagesize($original_directory.$file);

	  if ($imginfo[2] == 2){

       if (!file_exists($watermarked_images.$file)){

		// check the size of given fullsize image
	    $new_water_size   = getimagesize($original_directory.$file);
		// öhm $new_water_width  = $new_water_size[0];

		// is it a 4:3 or a 3:4 fullsize image?
		if ($new_water_size[0] < $new_water_size[1]){
		$new_water_width  = round(($new_water_size[0]/110)*$config['watermark_img_sz_proc']);}
		else{
		$new_water_width  = round(($new_water_size[1]/90)*$config['watermark_img_sz_proc']);}

  					// watermark friendly fullsize image sizing
	                $image = new simpleresize();
					$image->load($phpbb_root_path . 'includes/watermark/images/watermark.png');
	                $image->resizeToWidth($new_water_width);
	                $image->save($phpbb_root_path . 'includes/watermark/images/watermark_resize.png');

	$wm = new watermark($original_directory.$file);
	$wm->setPosition($config['watermark_position']);

	$wm->addWatermark($phpbb_root_path . 'includes/watermark/images/watermark_resize.png');
	$im = $wm->getMarkedImage();
	imagejpeg($im, $watermarked_images.$file, $config['watermark_output_quality']);

	     }
	  }
   }
}

      closedir($handle);

	 echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title></title>
</head>
<body style="background:#DDDFE3">
<hr />
' . utf8_decode($user->lang['STEP_2_JPG_FINISH']) . '
<hr />
' . utf8_decode($user->lang['STEP_2_GIF_START'])  . '
<hr />
</body>
</html>';

            }
        }
    }

else{
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title></title>
</head>
<body style="background:#DDDFE3">
<hr />
' . utf8_decode($user->lang['NO_BACKUP_DIR'])  . '
<hr />
</body>
</html>';
}

}

else{

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title></title>
</head>
<body style="background:#DDDFE3">
<hr />
<h2>' . utf8_decode($user->lang['ORPHANED_ACC_DEN'])  . '</h2>
<hr />
</body>
</html>';}

?>