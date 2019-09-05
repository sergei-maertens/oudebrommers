<?php
/**
*
* @package watermark
* @version $Id: watermark_convert_text_user.php 2010-05-04 11:06:13Z 4seven $
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

                    // transform to lowercase and no whitespace
                    $filedat = substr(strtolower($filedata['real_filename']), -4);

					if ($config['watermark_convert'] == 1){

					// let's start the watermark procedure  - check if it's a pic
					if (file_exists($phpbb_root_path . 'files/' . $filedata['physical_filename'])){

					// new check - prevent double watermarking
					if ($config['watermark_on_off'] == 0){
					
					// oh yes, this must be
					include($phpbb_root_path . 'includes/watermark/watermark_convert_text_acp.' . $phpEx);	

					// Text transform and wordwrap	
					$raw_text =  htmlspecialchars_decode(utf8_normalize_nfc($config['watermark_text']));
					$new_text = wordwrap($raw_text, $config['watermark_text_cut'], "\n");
  
					//  No Thumbs Path Variables
					$uploaded_file_path  = $phpbb_root_path . 'files/' . $filedata['physical_filename'];
					$processed_file_path = $phpbb_root_path . 'images/files/' . 'x_id_' . $user->data['user_id'] . '_' . $new_entry['attach_id'] . $filedat;
					

					// Clear Anonymous Namespace
					if ($user->data['username']  == 'Anonymous'){
					$user->data['username'] = str_replace('Anonymous', $user->lang['GUEST'], $user->data['username']);}

					// IMG Dimensions
					$source_w            = getimagesize( $uploaded_file_path );
					$source_w            = $source_w[0];

					// WATERMARK 
					// SWITCH ACP MODE 
					if (($raw_text == 'user') && ($config['watermark_text_degree'] == 0)
					&& (($config['watermark_position'] !== 'CL') or ($config['watermark_position'] !== 'C') or ($config['watermark_position'] !== 'CR'))){

					// ACP USER MODE
					create_watermark_from_string( 
					$uploaded_file_path, $processed_file_path,
					'© ' . $user->data['username'] . ', submitted ' . date($config['default_dateformat'], 
					$filedata['filetime']),  
					$config['watermark_text_font'],   
					round($source_w / $config['watermark_text_ratio']), 
					$config['watermark_text_color'], 
					$config['watermark_text_transparency'],  
					$config['watermark_text_degree'], 
					$config['watermark_position'] ); 
					}

					// GLOBAL ACP MODE
					else{
					create_watermark_from_string(
					$uploaded_file_path, $processed_file_path,
					$new_text, 
					$config['watermark_text_font'], 
					round($source_w / $config['watermark_text_size']), 
					$config['watermark_text_color'], 
					$config['watermark_text_transparency'],  
					$config['watermark_text_degree'], 
					$config['watermark_position'] );
					} 

					}
					 
					else{
					   
					// Thumbs Path Variables
					$uploaded_file_path  = $phpbb_root_path . 'files/' . $filedata['physical_filename'];
					$processed_file_path = $phpbb_root_path . 'images/files/' . 'x_id_' . $user->data['user_id'] . '_' . $new_entry['attach_id'] . $filedat;
					
					copy($uploaded_file_path,$processed_file_path);}
					 				 
				    }
					 
					 // test
                     // clearstatcache();
                     // test

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

                    //----------------------------------

                    if ($config['watermark_convert_high'] == 1){

					// let's start the watermark procedure  - check if it's a pic
					if (file_exists($phpbb_root_path . 'files/' . $filedata['physical_filename'])){
					
					// new check - prevent double watermarking
				    if ($config['watermark_on_off'] == 0){
					
					// oh yes, this must be
					include($phpbb_root_path . 'includes/watermark/watermark_convert_text_acp.' . $phpEx);	

					// Text transform and wordwrap	
					$raw_text =  htmlspecialchars_decode(utf8_normalize_nfc($config['watermark_text']));
					$new_text = wordwrap($raw_text, $config['watermark_text_cut'], "\n");
  
					// Path Variables
					$uploaded_file_path  = $phpbb_root_path . 'files/' . $filedata['physical_filename'];
					$processed_file_path = $phpbb_root_path . 'images/files/' . 'x_id_high_' . $user->data['user_id'] . '_' . $new_entry['attach_id'] . $filedat;
					
					// Clear Anonymous Namespace
					if ($user->data['username']  == 'Anonymous'){
					$user->data['username'] = str_replace('Anonymous', $user->lang['GUEST'], $user->data['username']);}

					// IMG Dimensions
					$source_w            = getimagesize( $uploaded_file_path );
					$source_w            = $source_w[0];

					// WATERMARK 
					// SWITCH ACP MODE 
					if (($raw_text == 'user') && ($config['watermark_text_degree'] == 0)
					&& (($config['watermark_position'] !== 'CL') or ($config['watermark_position'] !== 'C') or ($config['watermark_position'] !== 'CR'))){

					// ACP USER MODE
					create_watermark_from_string( 
					$uploaded_file_path, $processed_file_path,
					'© ' . $user->data['username'] . ', submitted ' . date($config['default_dateformat'], 
					$filedata['filetime']),  
					$config['watermark_text_font'],   
					round($source_w / $config['watermark_text_ratio']), 
					$config['watermark_text_color'], 
					$config['watermark_text_transparency'],  
					$config['watermark_text_degree'], 
					$config['watermark_position'] ); 
					}

					// GLOBAL ACP MODE
					else{
					create_watermark_from_string(
					$uploaded_file_path, $processed_file_path,
					$new_text, 
					$config['watermark_text_font'], 
					round($source_w / $config['watermark_text_size']), 
					$config['watermark_text_color'], 
					$config['watermark_text_transparency'],  
					$config['watermark_text_degree'], 
					$config['watermark_position'] );
					} 
					
					}
					
					else{
					
					// Path Variables
					$uploaded_file_path  = $phpbb_root_path . 'files/' . $filedata['physical_filename'];
					$processed_file_path = $phpbb_root_path . 'images/files/' . 'x_id_high_' . $user->data['user_id'] . '_' . $new_entry['attach_id'] . $filedat;
					
					copy($uploaded_file_path,$processed_file_path);}

					}
	
					//----------------------------------

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

?>