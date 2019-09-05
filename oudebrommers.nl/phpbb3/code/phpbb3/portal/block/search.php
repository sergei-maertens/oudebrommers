<?php
/*
*
* @package phpBB3 Portal  a.k.a canverPortal  ( www.phpbb3portal.com )
* @version $Id: search.php,v 1.4 2008/02/09 08:18:14 angelside Exp $
* @copyright (c) Canver Software - www.canversoft.net
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/
if (!defined('IN_PHPBB') or !defined('IN_PORTAL'))
{
	die('Hacking attempt');
	exit;
}

/**
*/

// Assign specific vars
$template->assign_vars(array(
	'S_DISPLAY_SEARCH'	=> true,
	'S_SEARCH_ACTION'	=> "{$phpbb_root_path}search.$phpEx",
));

?>