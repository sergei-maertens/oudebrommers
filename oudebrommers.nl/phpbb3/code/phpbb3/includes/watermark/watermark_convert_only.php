<?php
/**
*
* @package watermark
* @version $Id: watermark_convert_only.php 2356 2009-11-17 14:45:13Z 4seven $
* @copyright (c) 2009 4seven
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
					
					// let's start the convert procedure - check if it's a pic
					if (file_exists($phpbb_root_path . 'files/' . $filedata['physical_filename'])){
					
					 // oh yes, this must be
					include($phpbb_root_path . 'includes/watermark/watermark_resize_2.' . $phpEx);

                    // home path
					$user_home_path_1 = $phpbb_root_path . 'images/files/';
					
					// how big is the pig?
					$convert_only_size  = getimagesize($phpbb_root_path . 'files/' . $filedata['physical_filename']);

					// it is smaller than acp width?
					if ($convert_only_size[0] > $config['watermark_resize_width']){

					// ok, let's do it
					if ($config['watermark_convert_only'] == 1){
					$image = new simpleresize2();
	                $image->load($phpbb_root_path . 'files/' . $filedata['physical_filename']);
	                $image->resizeToWidth($config['watermark_resize_width']); 
                    $image->save($user_home_path_1 . 'x_id_' . $user->data['user_id'] . '_' . $new_entry['attach_id'] . $filedat);}
					
					if ($config['watermark_convert_high_only'] == 1){

					$copy_from_high_path = $phpbb_root_path . 'files/' . $filedata['physical_filename'];
                    $copy_to_high_path   = $user_home_path_1 . 'x_id_high_' . $user->data['user_id'] . '_' . $new_entry['attach_id'] . $filedat;
				   
					copy($copy_from_high_path, $copy_to_high_path);

					$image = new simpleresize2();
	                $image->load($phpbb_root_path . 'files/' . $filedata['physical_filename']);
	                $image->resizeToWidth($config['watermark_resize_width']);
					$image->save($user_home_path_1 . 'x_id_high_thumb_' . $user->data['user_id'] . '_' . $new_entry['attach_id'] . $filedat);}

                    }

                    else {

                    if ($config['watermark_convert_only'] == 1){

					$copy_from_img_no_resize_path = $phpbb_root_path . 'files/' . $filedata['physical_filename'];

					$copy_to_img_no_resize_path   = $user_home_path_1 . 'x_id_' . $user->data['user_id'] . '_' . $new_entry['attach_id'] . $filedat;

					copy($copy_from_img_no_resize_path, $copy_to_img_no_resize_path);}

					if ($config['watermark_convert_high_only'] == 1){

					$copy_from_high_no_resize_path = $phpbb_root_path . 'files/' . $filedata['physical_filename'];
				
					$copy_to_high_no_resize_path   = $user_home_path_1 . 'x_id_high_' . $user->data['user_id'] . '_' . $new_entry['attach_id'] . $filedat;

					copy($copy_from_high_no_resize_path, $copy_to_high_no_resize_path);

					$copy_from_high_no_resize_thumb_path = $phpbb_root_path . 'files/' . $filedata['physical_filename'];
					
					$copy_to_high_no_resize_thumb_path = $user_home_path_1 . 'x_id_high_thumb_' . $user->data['user_id'] . '_' . $new_entry['attach_id'] . $filedat;

					copy($copy_from_high_no_resize_thumb_path, $copy_to_high_no_resize_thumb_path);}

	}
	
}

?>