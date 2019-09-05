<?php
/**
*
* @package watermark
* @version $Id: watermark_resize_only.php 2356 2009-07-17 14:06:52Z 4seven $
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

					// let's start the  procedure  - check if it's a pic
					if (file_exists($phpbb_root_path . 'files/' . $filedata['physical_filename'])){

	                // is resize function switch to on?
					if ($config['watermark_resize_only'] == 1){
					
                    // oh yes, this must be
				    include_once($phpbb_root_path . 'includes/watermark/watermark_resize_2.' . $phpEx);
					
					// check size of given image
					$new_water_resize_size  = getimagesize($phpbb_root_path . 'files/' . $filedata['physical_filename']);

					// is the size tiny enough to be a resized one?
					if ($new_water_resize_size[0] > $config['watermark_resize_width']){

					// ok, let's do it
					$image = new simpleresize2();
	                $image->load($phpbb_root_path . 'files/' . $filedata['physical_filename']);
	                $image->resizeToWidth($config['watermark_resize_width']);
	                $image->save($phpbb_root_path . 'files/' . $filedata['physical_filename']);}}}			

?>