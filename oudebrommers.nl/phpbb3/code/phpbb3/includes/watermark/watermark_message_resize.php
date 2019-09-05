<?php
/**
*
* @package watermark
* @version $Id: watermark_message_resize.php 2010-05-06 11:06:13Z 4seven $
* @copyright (c) 2010 4seven
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

					// let's start the watermark procedure - check if it's a pic
					if (file_exists($phpbb_root_path . 'files/' . $filedata['physical_filename'])){

	                // oh yes, this must be
					if ((request_var('wmglobalattach', '', true) == 'attachyes') 
					or (($config['watermark_resize'] == 1) && ($config['watermark_resize_only'] == 0) && $c_co_ch_cho))
					// New Check
					{
					include($phpbb_root_path . 'includes/watermark/watermark.' . $phpEx);
				    include($phpbb_root_path . 'includes/watermark/watermark_resize_1.' . $phpEx);

					// old school watermark
					$wm = new watermark($phpbb_root_path . 'files/' . $filedata['physical_filename']);
					$wm->setPosition($config['watermark_position']);
					} // New Check

					// check size of given image
					$new_water_size  = getimagesize($phpbb_root_path . 'files/' . $filedata['physical_filename']);

					if ((request_var('wmglobalattach', '', true) == 'attachyes') 
					or (($config['watermark_resize'] == 1) && ($config['watermark_resize_only'] == 0) && $c_co_ch_cho))
					// New Check
					{
					// is it a 4:3 or a 3:4 fullsize image?
					if ($new_water_size[0] < $new_water_size[1]){
					$new_water_width  = round(($new_water_size[0]/110)*$config['watermark_img_sz_proc']);}
					else{
					$new_water_width  = round(($new_water_size[1]/90)*$config['watermark_img_sz_proc']);}

					// name of fullsize watermark (must be *.png)
					$watermark['img'] = $phpbb_root_path . 'includes/watermark/images/watermark_resize.png';

					// watermark friendly fullsize image sizing
	                $image = new simpleresize();
					$image->load($phpbb_root_path . 'includes/watermark/images/watermark.png');
	                $image->resizeToWidth($new_water_width);
	                $image->save($phpbb_root_path . 'includes/watermark/images/watermark_resize.png');

					// old school watermark
					$wm->addWatermark($watermark['img'], "IMAGE");

					$im = $wm->getMarkedImage();

					imagejpeg($im, $phpbb_root_path . 'files/' . $filedata['physical_filename'], $config['watermark_output_quality']);
					
					imagedestroy($im);
					} // New Check

					// is the size tiny enough to be a resized one?
					if ($new_water_size[0] > $config['watermark_resize_width']){

					include($phpbb_root_path . 'includes/watermark/watermark_resize_2.' . $phpEx);

					// ok, let's do it
					$image = new simpleresize2();
	                $image->load($phpbb_root_path . 'files/' . $filedata['physical_filename']);
	                $image->resizeToWidth($config['watermark_resize_width']);
	                $image->save($phpbb_root_path . 'files/' . $filedata['physical_filename']);}}

?>