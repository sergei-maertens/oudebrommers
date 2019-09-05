<?php
/**
*
*acp_watermark info[Deutsch]
*
* @package language
* @version $Id: info_acp_watermark.php Z 2009-05-04 23:32 4seven $
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
	'WATERMARK_CONFIG'				   => 'Watermark',
	'WATERMARK_MAIN_CONFIG_TITLE'	   => 'Basics',
	'WATERMARKS_SPECIALS_CONFIG_TITLE' => 'Specials',
));

?>
