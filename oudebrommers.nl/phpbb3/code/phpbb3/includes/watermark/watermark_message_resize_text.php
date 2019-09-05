<?php
/**
*
* @package watermark
* @version $Id: watermark_message_resize_text.php 2010-05-02 11:06:13Z 4seven $
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
					
				    include($phpbb_root_path . 'includes/watermark/watermark_resize_1.' . $phpEx);

					if ((request_var('wmglobalattach', '', true) == 'attachyes') 
					or (($config['watermark_resize'] == 1) && ($config['watermark_resize_only'] == 0) && $c_co_ch_cho))
					// New Check
					{
                    // Neu
					include($phpbb_root_path . 'includes/watermark/watermark_message_text_acp.' . $phpEx);
					// Neu
					} // New Check
					
					// check size of given image / doppelt nun ? checken
					$new_water_size  = getimagesize($phpbb_root_path . 'files/' . $filedata['physical_filename']);
					
					// is the size tiny enough to be a resized one?
					if ($new_water_size[0] > $config['watermark_resize_width']){

					include($phpbb_root_path . 'includes/watermark/watermark_resize_2.' . $phpEx);

					// ok, let's do it
					$image = new simpleresize2();
	                $image->load($phpbb_root_path . 'files/' . $filedata['physical_filename']);
	                $image->resizeToWidth($config['watermark_resize_width']);
	                $image->save($phpbb_root_path . 'files/' . $filedata['physical_filename']);}
					
					}

?>