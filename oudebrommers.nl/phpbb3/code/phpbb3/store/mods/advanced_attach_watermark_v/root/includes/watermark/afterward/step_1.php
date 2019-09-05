<?php
/**
*
* @package watermark afterward
* @version $Id: step_1.php 9482 2009-09-01 11:18:10Z 4seven $
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

if ($auth->acl_get('a_'))
{

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>' . utf8_decode($user->lang['AFTERWARD_TITLE'])  . '</title>
</head>
<frameset rows="150,*" frameborder="no" border="0" framespacing="0" cols="*"> 
  <frame name="topFrame" scrolling="no" noresize src="top_1.php" >
  <frame name="mainFrame" src="watermark_afterward.php">
</frameset>
<noframes> 
<body>
</body>
</noframes> 
</html>';}

else{

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>Afterward Watermarking</title>
</head>
<body style="background:#DDDFE3">
<hr />
<h2>' . utf8_decode($user->lang['ORPHANED_ACC_DEN'])  . '</h2>
<hr />
</body>
</html>';}

?>