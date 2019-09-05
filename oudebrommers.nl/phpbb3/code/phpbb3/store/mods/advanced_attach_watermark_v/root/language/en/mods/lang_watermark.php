<?php
/**
*
* lang_watermark [English]
*
* @package Watermark
* @version $Id: lang_watermark.php 2010-05-15Z 23:32 4seven $
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
**/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

    $lang = array_merge($lang, array(

	// 4seven / Advanced Attach Watermark / 2010
	// Basics
	'INSERT_AS_IMG'            => 'Insert as [img]',
	'INSERT_AS_SLIDE'          => 'Insert as [highslide]',
	'WITHOUT_WATERMARK_TITLE'  => 'In [img]-, [img_higslide]- and Resize only Mode without Watermark',	
	'NO_DEL_TITLE'             => 'This action deletes no [img] or [img_higslide] Pics',	
	'DEL_AFTER_INSERT_1_TITLE' => 'For [img] without additional [attachment] click [Delete File] after insert',	
	'DEL_AFTER_INSERT_2_TITLE' => 'For [img_higslide] without additional [attachment] click [Delete File] after insert',
	'MINUS_WM'                 => '(-wm)',
	'PLUS_WM'                  => '(+wm)',	
	'TO_BIG_FOR_WM_1'          => 'This picture exceeded permissible watermark size: ',
	'TO_BIG_FOR_WM_2'          => ' px. The Watermark Function, as well as [img] and [img_highslide]is temporarily deactivated . Resize your Picture below permissible size of ', 
	'TO_BIG_FOR_WM_3'          => ' px, so you can watermark it. Delete this Pic or insert without Watermark. Allready uploaded pictures will insert with Watermark.',
    'WM_NOTE_2'                => 'Note: For img or img_higslide without additional Attachment click Delete File after insert. Infos also given by Button Tooltips.',
	// Usermodes
	'AAW_USERNAME_MODE'		   => 'AAW Username Mode',
	'AAW_USERNAME_MODE_LABEL'  => 'Text Formattings with Output: &copy; username, submitted date, time',
	'AAW_USERNAME_GL_MO_LABEL' => '&copy; username, submitted date, time',
	'AAW_ENABLE_MODE'		   => 'Enable Mode:',
	'AAW_TEXT_SIZE'		       => 'Text Size:',
	'AAW_MINI'		           => 'mini',
	'AAW_MIDI'		           => 'midi',
	'AAW_MEDIUM'		       => 'medium',
	'AAW_MAXI'		           => 'maxi',
	'AAW_HEAVY'		           => 'heavy',
	'AAW_TOP'		           => 'top',
	'AAW_CENTER'		       => 'center',
	'AAW_BOTTOM'		       => 'bottom',
	'AAW_000'		           => '000&deg;',
	'AAW_045'		           => '045&deg;',
	'AAW_090'		           => '090&deg;',
	'AAW_135'		           => '135&deg;',
	'AAW_180'		           => '180&deg;',
	'AAW_225'		           => '225&deg;',
	'AAW_270'		           => '270&deg;',
	'AAW_315'		           => '315&deg;',
	'AAW_360'		           => '360&deg;',
	'AAW_TEXT_COLOR'		   => 'Text Color:',
	'AAW_TEXT_POSITION'		   => 'Text Position:',
	'AAW_TEXT_FONT'		       => 'Text Font:',
	'AAW_INFO'		           => 'Info:',
	'AAW_INFO_LABEL_U_M'	   => '"AAW Username Mode" can be mixed with "AAW Watermarking" Switches or Current Settings named under "AAW Watermark Info"',
	'AAW_PRIVATE_MODE'		   => 'AAW Private Mode',
	'AAW_PRIVATE_MODE_LABEL'   => 'Free Text Formattings',
	'AAW_TEXT_DEGREE'		   => 'Text Degree:',
	'AAW_WATER_TEXT'	       => 'Watermark Text:',
	'AAW_WATER_TEXT_LABEL_1'   => 'If u leave "Watermark Text" empty, the Global Watermark Text will be used:',
	'AAW_WATER_TEXT_LABEL_2'   => '"AAW Private Mode" can be mixed with "AAW Watermarking" Switches or Current Settings named under "AAW Watermark Info"',
	// AAW Switch Modes
	'AAW_WATERMARKING'		   => 'AAW Watermarking:',
	// Watermark Infos
	'AAW_WATERMARK_INFO'       => 'AAW Watermark Info',
	'AAW_WATERMARK_INFO_LABEL' => 'Overview of current Modes and Settings',
	// Watermark WM Mode
	'AAW_WATERMARK_MODE'	   => 'Watermark Mode:',
	// Watermark WM Modes
	'WM_GLOBAL_USER_ONOFF'     => 'Global AAW Username Mode:',
	'WM_ONOFF'				   => 'Attachment Watermark Function',
	'WM_RESIZE_ONLY'		   => 'Attachment Resize Function only',
	'WM_RESIZE'				   => 'Attachment Resize Function',
	'WM_CONVERT_ONLY'		   => 'Convert Function [img] only',
	'WM_CONVERT'			   => 'Convert Function [img]',
	'WM_CONVERT_HIGH_ONLY'	   => 'Convert Function [img_higslide] only',
	'WM_CONVERT_HIGH'	       => 'Convert Function [img_higslide]',
	// Watermark Infos Others
	'AAW_ACTIVE_FUNCTIONS'	   => 'Active Functions:',
	'AAW_RESIZE_WIDTH'		   => 'Resize Width:',
	'AAW_MAX_WM_SIZE'		   => 'Max. Watermark Size:',
	'AAW_MEMORY_LIMIT'		   => 'Memory Limit:',
	'AAW_MEMORY_USAGE'		   => 'Memory Usage:',
	// 4seven / Advanced Attach Watermark / 2010	

	));

?>