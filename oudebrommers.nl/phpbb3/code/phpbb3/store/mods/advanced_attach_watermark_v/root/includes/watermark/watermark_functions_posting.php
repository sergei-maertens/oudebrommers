<?php
/**
*
* @package Watermark
* @version $Id: watermark_functions_posting.php 2010-05-25 11:06:13Z 4seven $
* @copyright (c) 2010 / 4seven
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

	      // 4seven / Advanced Attach Watermark / 2010			
	      // let's start the watermark procedure  - check if it's a pic
	      if (((substr(strtolower($attach_row['real_filename']), -4)) == '.jpg')
	      ||  ((substr(strtolower($attach_row['real_filename']), -4)) == '.png')
	      ||  ((substr(strtolower($attach_row['real_filename']), -4)) == '.gif')){

	      // [img] and [highslide] convert's
	      if ($config['watermark_convert_only'] == 1){
	      $template->assign_vars(array('S_NO_INSERT_AS_IMG_BUTTON' => true));}
	      if ($config['watermark_convert'] == 1){
	      $template->assign_vars(array('S_NO_INSERT_AS_IMG_C_BUTTON' => true));}
	      if ($config['watermark_convert_high_only'] == 1) {
	      $template->assign_vars(array('S_NO_INSERT_AS_HIGHSLIDE_BUTTON' => true));}
	      if ($config['watermark_convert_high'] == 1){
	      $template->assign_vars(array('S_NO_INSERT_AS_HIGHSLIDE_C_BUTTON' => true));}

		  // insert present's check
		  if(($config['watermark_convert_only'] == 1)
		  || ($config['watermark_convert'] == 1)
		  || ($config['watermark_convert_high_only'] == 1)
		  || ($config['watermark_convert_high'] == 1)){
		  $template->assign_vars(array('S_NO_INSERT_AS' => true));}

		  // resize check
		  if($config['watermark_resize'] == 1){
		  $template->assign_vars(array('S_NO_INSERT_RESIZE' => true));}
		  if($config['watermark_resize_only'] == 1){
		  $template->assign_vars(array('S_NO_INSERT_RESIZE_ONLY' => true));}

		  // watermark on check
		  if($config['watermark_on_off'] == 1){
		  $template->assign_vars(array('S_WATERMARK_ON' => true));}

		  // build ext
		  $attach_pic_dat = substr(strtolower($attach_row['real_filename']), -4);

	      // build convert's scheme
	      $convert_img = addslashes($config['server_protocol'] . $config['server_name'] . $config['script_path'] . '/images/files/' . 'x_id_' . $user->data['user_id'] . '_' . $attach_row['attach_id'] . $attach_pic_dat);
		  $convert_img_high = addslashes($config['server_protocol'] . $config['server_name'] . $config['script_path'] . '/images/files/' . 'x_id_high_' . $user->data['user_id'] . '_' . $attach_row['attach_id'] . $attach_pic_dat);
		 $convert_img_high_thumb = addslashes($config['server_protocol'] . $config['server_name'] . $config['script_path'] . '/images/files/' . 'x_id_high_thumb_' . $user->data['user_id'] . '_' . $attach_row['attach_id'] . $attach_pic_dat);
		 $no_pic_data            = true;

		 // Get the attachment data, based on mimetype  jpg
         $attach_row_filename = $attach_row['real_filename'];
         $attach_row_id       = $attach_row['attach_id'];

         global $db;
         $sql = 'SELECT physical_filename
         FROM ' . ATTACHMENTS_TABLE . "
         WHERE real_filename = '$attach_row_filename'
         AND attach_id = '$attach_row_id'";
         $result_filename = $db->sql_query($sql);
         $rows_file = $db->sql_fetchrow($result_filename);

		 //  check if config exists
		 if (ereg("[0-9]x[0-9]", $config['watermark_img_max_size'])){
		 //  check if pic exists
		 if (file_exists($phpbb_root_path . 'files/' . $rows_file['physical_filename'])){
		 // check the size of given image
		 $new_water_size = getimagesize($phpbb_root_path . 'files/' . $rows_file['physical_filename']);
		 $img_max_parts  = explode("x", $config['watermark_img_max_size']);
		 $to_big_size    = $img_max_parts[0]*$img_max_parts[1];
		 if ($new_water_size[0]*$new_water_size[1] > $to_big_size){
		 $template->assign_vars(array('S_TO_BIG_FOR_WATERMARK' => true));}}}
		 }
		 else{
		 $attach_pic_dat         = false;
		 $convert_img            = '';
		 $convert_img_high       = '';
		 $convert_img_high_thumb = '';
		 $no_pic_data            = false;}
	     // 4seven / Advanced Attach Watermark / 2010

?>