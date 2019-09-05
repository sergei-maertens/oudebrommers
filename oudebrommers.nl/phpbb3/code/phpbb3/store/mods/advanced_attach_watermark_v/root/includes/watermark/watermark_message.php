<?php
/**
*
* @package watermark
* @version $Id: watermark_message.php 2356 2009-05-03 11:06:13Z 4seven $
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

					// let's start the watermark procedure  - check if it's a pic					
					if (file_exists($phpbb_root_path . 'files/' . $filedata['physical_filename'])){
					
					// oh yes, this must be
					// once weg
					include($phpbb_root_path . $phpbb_root_path . 'includes/watermark/watermark.' . $phpEx);
										
				    include($phpbb_root_path . $phpbb_root_path . 'includes/watermark/watermark_resize_1.' . $phpEx);
					
					// make a backup of un-watermarked fullsize images
					if ($config['watermark_backup_on_off'] == 1){
									
					// backup folder path
                    $backup_path = $phpbb_root_path . 'files/backup/';
		
					copy($phpbb_root_path . 'files/' . $filedata['physical_filename'], $phpbb_root_path . 'files/backup/' . $filedata['physical_filename']);}
					
					// old school watermark
					$wm = new watermark($phpbb_root_path . 'files/' . $filedata['physical_filename']);	
					$wm->setPosition($config['watermark_position']);
					
					// check the size of given fullsize image
	                $new_water_size   = getimagesize($phpbb_root_path . 'files/' . $filedata['physical_filename']);
					
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
					
					imagedestroy($im);}

					// let's start the watermark procedure for thumb images - check if it's a pic
					if (file_exists($phpbb_root_path . 'files/thumb_' .$filedata['physical_filename'])){
					
					// make a backup of un-watermarked thumb images
					if ($config['watermark_backup_on_off'] == 1){
					copy($phpbb_root_path . 'files/thumb_' . $filedata['physical_filename'], $phpbb_root_path . 'files/backup/thumb_' . $filedata['physical_filename']);}
					
					// old school watermark
					$wm = new watermark($phpbb_root_path . 'files/thumb_'.$filedata['physical_filename']);
					$wm->setPosition($config['watermark_position']);
						
					// check the size of given thumb image
	                $new_water_thumb_size  = getimagesize($phpbb_root_path . 'files/thumb_' . $filedata['physical_filename']);
				
					// is it a 4:3 or a 3:4 fullsize image?
					if ($new_water_thumb_size[0] < $new_water_thumb_size[1]){
					$new_water_thumb_width  = round(($new_water_thumb_size[0]/110)*$config['watermark_img_sz_proc']);}
					else{
					$new_water_thumb_width  = round(($new_water_thumb_size[1]/90)*$config['watermark_img_sz_proc']);}
										
					// watermark friendly fullsize image sizing
	                $image = new simpleresize();
					$image->load($phpbb_root_path . 'includes/watermark/images/watermark.png');
	                $image->resizeToWidth($new_water_thumb_width);
					$image->save($phpbb_root_path . 'includes/watermark/images/watermark_thumb_resize.png');
					
				    // name of fullsize watermark (must be *.png)
					$watermark['img_thumb'] = $phpbb_root_path . 'includes/watermark/images/watermark_thumb_resize.png';
	
					// old school watermark
					$wm->addWatermark($watermark['img_thumb'], "IMAGE");	
		
					$im = $wm->getMarkedImage();
					
					imagejpeg($im, $phpbb_root_path . 'files/thumb_' . $filedata['physical_filename'], $config['watermark_output_quality']);
					
					imagedestroy($im);}
				
?>