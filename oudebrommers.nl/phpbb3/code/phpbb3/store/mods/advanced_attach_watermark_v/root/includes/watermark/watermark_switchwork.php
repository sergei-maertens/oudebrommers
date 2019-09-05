<?php
/**
*
* @package watermark
* @version $Id: watermark_switchwork.php 2010-05-04 10:05:13Z 4seven $
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


                    // Switch resize, resize only, convert only, convert high only
       $r_ro_co_cho = (($config['watermark_resize'] == 0)
					&& ($config['watermark_resize_only'] == 0)
					&& ($config['watermark_convert_only'] == 0)
					&& ($config['watermark_convert_high_only'] == 0)) ? true : false;

                    // Switch convert, convert only, convert high, convert high only
        $c_co_ch_cho =(($config['watermark_convert'] == 0)
					&& ($config['watermark_convert_only'] == 0)
					&& ($config['watermark_convert_high'] == 0)
					&& ($config['watermark_convert_high_only'] == 0)) ? true : false;
					
					// echo $c_co_ch_cho;

					// PRIVAT AND USER MODE FIRST
					if((request_var('watermarkyes', '', true) == 'privat') 
					or (request_var('watermarkyes', '', true) == 'user')){
					include($phpbb_root_path . 'includes/watermark/watermark_message_text_user.' . $phpEx);}
					
					// ALL OTHER CASES

                    // IF ON_OFF = 1
					if ($config['watermark_on_off'] == 1){
					
					// IF TEXT
					if ($config['watermark_type'] == 'text'){	

					// BASIC TXT - USER
					/* guter alter platz ;)
					if(((request_var('watermarkyes', '', true) == 'privat') 
					or (request_var('watermarkyes', '', true) == 'user'))
					&& ($config['watermark_resize'] == 0)
					&& ($config['watermark_resize_only'] == 0)
					&& ($config['watermark_convert_only'] == 0)
					&& ($config['watermark_convert_high_only'] == 0)){
					include($phpbb_root_path . 'includes/watermark/watermark_message_text_user.' . $phpEx);}
                                                        */
					
					// BASIC TEXT - ACP - for [img] and [img_highslide]
					if($r_ro_co_cho){
					include($phpbb_root_path . 'includes/watermark/watermark_convert_text.' . $phpEx);}

					// BASIC TEXT - ACP - for [attachment]
					if (request_var('wmglobalattach', '', true) == 'attachyes'){
					//elseif ?
					if($r_ro_co_cho){
                    include($phpbb_root_path . 'includes/watermark/watermark_message_text_acp.' . $phpEx);}}
					
					} // END IF TEXT
					
					// ELSEIF IMAGE
	                elseif($config['watermark_type'] == 'image'){
 
					// [IMG] AND [HIGHSLIDE] CONVERT 1 
					if (($r_ro_co_cho
					&& (($config['watermark_convert'] == 1)
					|| ($config['watermark_convert_high'] == 1)))){
					include($phpbb_root_path . 'includes/watermark/watermark_convert.' . $phpEx);}
					
	                // BASIC IMG 1
					if (request_var('wmglobalattach', '', true) == 'attachyes'){
					if ($r_ro_co_cho){
                    include($phpbb_root_path . 'includes/watermark/watermark_message.' . $phpEx);}} 
					
					} // END ELSEIF IMAGE
					
					} // END IF ON_OFF = 1
					
                    // IF ON_OFF = 0
					if ($config['watermark_on_off'] == 0){
							
					// IF TEXT
					if ($config['watermark_type'] == 'text'){
					
					
					// BASIC TEXT - ACP - for [img] and [img_highslide]
					if($r_ro_co_cho){
					include($phpbb_root_path . 'includes/watermark/watermark_convert_text.' . $phpEx);}
								
					// RESIZE TXT // Neuer Switch in der neuen include Datei ;)
					if(($config['watermark_resize'] == 1)
					&& ($config['watermark_resize_only'] == 0)
					&& $c_co_ch_cho){
                    include($phpbb_root_path . 'includes/watermark/watermark_message_resize_text.' . $phpEx);}
					
					} // END IF TEXT
					
					// ELSEIF IMAGE
					elseif($config['watermark_type'] == 'image'){
					
					// [IMG] AND [HIGHSLIDE] CONVERT 2
					if (($r_ro_co_cho
					&& (($config['watermark_convert'] == 1)
					|| ($config['watermark_convert_high'] == 1)))){
					include($phpbb_root_path . 'includes/watermark/watermark_convert.' . $phpEx);}
					
					// RESIZE IMG // Neuer Switch in der include Datei ;)
					if(($config['watermark_resize'] == 1)
					&& ($config['watermark_resize_only'] == 0)
					&& $c_co_ch_cho){
                    include($phpbb_root_path . 'includes/watermark/watermark_message_resize.' . $phpEx);}

					} // END ELSEIF IMAGE
					
					// RESIZE ONLY
					if(($config['watermark_resize'] == 0)
					&& ($config['watermark_resize_only'] == 1)
					&& $c_co_ch_cho){
                    include($phpbb_root_path . 'includes/watermark/watermark_resize_only.' . $phpEx);}
	
					// [IMG] AND [HIGHSLIDE] CONVERT ONLY
					if((($config['watermark_resize'] == 0)
					&&  ($config['watermark_resize_only'] == 0)
					&&  ($config['watermark_convert'] == 0)
					&&  ($config['watermark_convert_high'] == 0)
					&& (($config['watermark_convert_only'] == 1)
					||  ($config['watermark_convert_high_only'] == 1)))){
					include($phpbb_root_path . 'includes/watermark/watermark_convert_only.' . $phpEx);}
					
					
					} // END IF ON_OFF = 0

?>