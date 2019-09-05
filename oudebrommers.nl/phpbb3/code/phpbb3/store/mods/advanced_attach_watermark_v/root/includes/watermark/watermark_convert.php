<?php
/**
*
* @package watermark
* @version $Id: watermark_convert.php 2010-05-04 11:06:13Z 4seven $
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

                    // transform to lowercase
                    $filedat = substr(strtolower($filedata['real_filename']), -4);

					if ($config['watermark_convert'] == 1){

					// let's start the watermark procedure  - check if it's a pic
					if (file_exists($phpbb_root_path . 'files/' . $filedata['physical_filename'])){

					// new check - prevent double watermarking
                    if (request_var('wmglobalimg', '', true) == 'imgyes'){ // TESTSWITCH
					
					// oh yes, this must be
					include($phpbb_root_path . 'includes/watermark/watermark.' . $phpEx);
				    include($phpbb_root_path . 'includes/watermark/watermark_resize_1.' . $phpEx);	

                    // user folder path
					$user_home_path_1 = $phpbb_root_path . 'images/files/';

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

					imagejpeg($im, $phpbb_root_path . 'images/files/' . 'x_id_' . $user->data['user_id'] . '_' . $new_entry['attach_id'] . $filedat, $config['watermark_output_quality']);
					 
					 imagedestroy($im);
					 
					 } // TESTSWITCH
					 
					else{
					// Path Variables
					$uploaded_file_path  = $phpbb_root_path . 'files/' . $filedata['physical_filename'];
					$processed_file_path = $phpbb_root_path . 'images/files/' . 'x_id_' . $user->data['user_id'] . '_' . $new_entry['attach_id'] . $filedat;
					
					copy($uploaded_file_path,$processed_file_path);}
				 
					 }

					//afterward resizing process -> how big is the pig?
					$convert_thumb_size  = getimagesize($phpbb_root_path . 'images/files/' . 'x_id_' . $user->data['user_id'] . '_' . $new_entry['attach_id'] . $filedat);

					// it is smaller than acp width?
					if ($convert_thumb_size[0] > $config['watermark_resize_width']){

				    include($phpbb_root_path . 'includes/watermark/watermark_resize_2.' . $phpEx);

					// ok, let's do it
					$image = new simpleresize2();
					$image->load($phpbb_root_path . 'images/files/' . 'x_id_' . $user->data['user_id'] . '_' . $new_entry['attach_id'] . $filedat);
	                $image->resizeToWidth($config['watermark_resize_width']);
                    $image->save($phpbb_root_path . 'images/files/' . 'x_id_' . $user->data['user_id'] . '_' . $new_entry['attach_id'] . $filedat);}
					
					}

                    //----------------------------------------------

                    if ($config['watermark_convert_high'] == 1){

					// let's start the watermark procedure  - check if it's a pic
					if (file_exists($phpbb_root_path . 'files/' . $filedata['physical_filename'])){


					// new check - prevent double watermarking	// nochmal checken öhhm				
                    if (request_var('wmglobalimghigh', '', true) == 'imghighyes'){ // TESTSWITCH
					
					// oh yes, this must be
					include($phpbb_root_path . 'includes/watermark/watermark.' . $phpEx);
				    include($phpbb_root_path . 'includes/watermark/watermark_resize_1.' . $phpEx);

					// user folder path
                    $user_home_path_1 = $phpbb_root_path . 'images/files/';

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

					imagejpeg($im, $user_home_path_1 . 'x_id_high_' . $user->data['user_id'] . '_' . $new_entry['attach_id'] . $filedat, $config['watermark_output_quality']);
					
					imagedestroy($im);
					
					} // TESTSWITCH
					
					else{
					
					// Path Variables
					$uploaded_file_path  = $phpbb_root_path . 'files/' . $filedata['physical_filename'];
					$processed_file_path = $phpbb_root_path . 'images/files/' . 'x_id_high_' . $user->data['user_id'] . '_' . $new_entry['attach_id'] . $filedat;
					
					copy($uploaded_file_path,$processed_file_path);}
					


					//----------------------------------------------

					// let's start the watermark procedure check for thumb images - check if file exists and if it's a pic
					if (file_exists($phpbb_root_path . 'images/files/' . 'x_id_high_' . $user->data['user_id'] . '_' . $new_entry['attach_id'] . $filedat)){

					include($phpbb_root_path . 'includes/watermark/watermark_resize_2.' . $phpEx);

                    $user_home_path_1 = $phpbb_root_path . 'images/files/';

					// how big is the pig?
					$convert_only_size  = getimagesize($user_home_path_1 . 'x_id_high_' . $user->data['user_id'] . '_' . $new_entry['attach_id'] . $filedat);

					// it is smaller than acp width?
					if ($convert_only_size[0] > $config['watermark_resize_width']){

					// make it a thumb
					$image = new simpleresize2();
	                $image->load($user_home_path_1 . 'x_id_high_' . $user->data['user_id'] . '_' . $new_entry['attach_id'] . $filedat);
	                $image->resizeToWidth($config['watermark_resize_width']);
                    $image->save($user_home_path_1 . 'x_id_high_thumb_' . $user->data['user_id'] . '_' . $new_entry['attach_id'] . $filedat);}

					else{

					$copy_from_high_no_resize_thumb_path = $user_home_path_1 . 'x_id_high_' . $user->data['user_id'] . '_' . $new_entry['attach_id'] . $filedat;			
					$copy_to_high_no_resize_thumb_path = $user_home_path_1 . 'x_id_high_thumb_' . $user->data['user_id'] . '_' . $new_entry['attach_id'] . $filedat;

					copy($copy_from_high_no_resize_thumb_path, $copy_to_high_no_resize_thumb_path);}
					
	    }
    }
}
?>