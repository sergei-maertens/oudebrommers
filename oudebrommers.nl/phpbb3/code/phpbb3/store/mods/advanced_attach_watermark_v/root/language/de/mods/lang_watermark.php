<?php
/**
*
* lang_watermark [Deutsch]
*
* @package Watermark
* @version $Id: lang_watermark.php 2010-05-18Z 23:32 4seven $
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
	'INSERT_AS_IMG'            => 'Als [img] einfügen',
	'INSERT_AS_SLIDE'          => 'Als [highslide] einfügen',
	'WITHOUT_WATERMARK_TITLE'  => 'Im [img]-, [img_higslide]- und Resize only Modus ohne Watermark',	
	'NO_DEL_TITLE'             => 'Dies löscht keine [img] oder [img_higslide] Pics',	
	'DEL_AFTER_INSERT_1_TITLE' => 'Für [img] ohne zusätzliches [attachment] klick nach dem einfügen auf [Datei löschen]',
	'DEL_AFTER_INSERT_2_TITLE' => 'Für [img_higslide] ohne zusätzliches [attachment] klick nach dem einfügen auf [Datei löschen]',	
	'MINUS_WM'                 => '(-wm)',
	'PLUS_WM'                  => '(+wm)',	
	'TO_BIG_FOR_WM_1'          => '<br />Eines der hochgeladenen Bilder hat die zulässige Größe zum Watermarking überschritten: ',
	'TO_BIG_FOR_WM_2'          => ' px<br />Verkleinere dein Bild lokal auf unter ', 
	'TO_BIG_FOR_WM_3'          => ' px, damit du es watermarken kannst.<br />Die Watermark Funktion ist bis dahin auch für [img] und [img_highslide] deaktiviert',
	'WM_NOTE_2'                => 'Hinweis: Für ein img oder img_higslide ohne zusätzliches Attachment klick  nach dem einfügen auf Datei löschen. Hinweise geben auch die Button Tooltips.',
	// Usermodes
	'AAW_USERNAME_MODE'		   => 'AAW Username Modus',
	'AAW_USERNAME_MODE_LABEL'  => 'Text Formatierungen mit dem Resultat: &copy; username, postdatum, zeit',
	'AAW_USERNAME_GL_MO_LABEL' => '&copy; username, postdatum, zeit',
	'AAW_ENABLE_MODE'		   => 'Aktiviere Modus:',
	'AAW_TEXT_SIZE'		       => 'Text Größe:',
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
	'AAW_TEXT_COLOR'		   => 'Text Farbe:',
	'AAW_TEXT_POSITION'		   => 'Text Position:',
	'AAW_TEXT_FONT'		       => 'Text Font:',
	'AAW_INFO'		           => 'Info:',
	'AAW_INFO_LABEL_U_M'	   => 'Der "AAW Username Modus" kann mit den "AAW Watermarking" Schaltern oder den unter "AAW Watermark Info" einsehbaren aktuellen Einstellungen kombiniert werden',
	'AAW_PRIVATE_MODE'		   => 'AAW Privat Modus',
	'AAW_PRIVATE_MODE_LABEL'   => 'Freie Text Formatierungen',
	'AAW_TEXT_DEGREE'		   => 'Text Grad:',
	'AAW_WATER_TEXT'	       => 'Watermark Text:',
	'AAW_WATER_TEXT_LABEL_1'   => 'Lässt Du den "Watermark Text" leer, wird der globale Watermark Text verwendet:',
	'AAW_WATER_TEXT_LABEL_2'   => 'Der "AAW Privat Modus" kann mit den "AAW Watermarking" Schaltern oder den unter "AAW Watermark Info" einsehbaren aktuellen Einstellungen kombiniert werden',
	// AAW Switch Modes
	'AAW_WATERMARKING'		   => 'AAW Watermarking:',
	// Watermark Infos
	'AAW_WATERMARK_INFO'       => 'AAW Watermark Info',
	'AAW_WATERMARK_INFO_LABEL' => 'Übersicht der aktuellen Modi und Einstellungen',
	// Watermark WM Mode
	'AAW_WATERMARK_MODE'	   => 'Watermark Modus:',
	// Watermark WM Modes
	'WM_GLOBAL_USER_ONOFF'     => 'Globaler AAW Username Modus:',
	'WM_ONOFF'				   => 'Attachment Watermark Funktion',
	'WM_RESIZE_ONLY'		   => 'Attachment Resize Funktion only',
	'WM_RESIZE'				   => 'Attachment Resize Funktion',
	'WM_CONVERT_ONLY'		   => 'Convert Funktion [img] only',
	'WM_CONVERT'			   => 'Convert Funktion [img]',
	'WM_CONVERT_HIGH_ONLY'	   => 'Convert Funktion [img_higslide] only',
	'WM_CONVERT_HIGH'	       => 'Convert Funktion [img_higslide]',
	// Watermark Infos Others
	'AAW_ACTIVE_FUNCTIONS'	   => 'Aktive Funktionen:',
	'AAW_RESIZE_WIDTH'		   => 'Resize Breite:',
	'AAW_MAX_WM_SIZE'		   => 'Max. Watermark Größe:',
	'AAW_MEMORY_LIMIT'		   => 'Memory Limit:',
	'AAW_MEMORY_USAGE'		   => 'Memory Usage:',
	// 4seven / Advanced Attach Watermark / 2010	

	));

?>