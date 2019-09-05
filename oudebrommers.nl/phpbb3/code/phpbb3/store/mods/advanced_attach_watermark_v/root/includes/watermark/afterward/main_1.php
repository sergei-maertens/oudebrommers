<?php
/**
*
* @package watermark afterward
* @version $Id: main_1.php  2009-09-01 18:28:10Z 4seven $
* @copyright (c) 2009 4seven
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = '../../../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);


// Session auslesen und Benutzer-Informationen laden
$user->session_begin();  // Session auslesen
$auth->acl($user->data); // Benutzer-Informationen laden
$user->setup('mods/lang_watermark_acp');

if ($auth->acl_get('a_')){

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<hr />
<body style="background:#DDDFE3">' . utf8_decode($user->lang['AFTERWARD_MAIN_1']) . '</body>
<hr />
</html>';}

else{

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title></title>
</head>
<body style="background:#DDDFE3">
<hr />
<h2>' . utf8_decode($user->lang['ORPHANED_ACC_DEN'])  . '</h2>
<hr />
</body>
</html>';}

?>