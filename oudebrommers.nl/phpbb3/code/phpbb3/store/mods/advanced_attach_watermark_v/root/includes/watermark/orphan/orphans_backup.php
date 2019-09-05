<?php
/**
*
* @package watermark orphan
* @version $Id: orphans_backup.php Z 2009-07-28 10:05:13Z 4seven $
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

$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/lang_watermark_acp');

if ($auth->acl_get('a_'))
{

// check files/* folder
$handle1 = opendir($phpbb_root_path . 'files'); 
$files1  = array();
while ($file1 = readdir ($handle1)){ 
if ($file1 != "." && $file1 != ".." 
&& $file1 != ".htaccess" && $file1 != "index.htm" 
&& $file1 != "backup" && $file1 != "convert" && $file1 != "testwise_save"){
$files1[] = $file1;}}
closedir($handle1);

// check files/backup/* folder
$handle2 = opendir($phpbb_root_path . 'files/backup'); 
$files2  = array();
while ($file2 = readdir ($handle2)){ 
if ($file2 != "." && $file2 != ".." 
&& $file2 != ".htaccess" && $file2 != "index.htm"){
$files2[] = $file2;}}
closedir($handle2); 

// sort them
sort($files1);
sort($files2);

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title></title>
</head>
<body style="background:#DDDFE3">
<hr><br />';

echo '<strong>' . $user->lang['ORPHANED_POSTED'] . '</strong><br /><br />';

foreach ($files1 as $file_1){
echo $file_1 . '<br />';}

echo '<br /><hr><br />';

echo '<strong>' . $user->lang['ORPHANED_BACKUPED'] . '</strong><br /><br />';

foreach ($files2 as $file_2){
echo $file_2 . '<br />';}

echo '<br /><hr><br />';

// compare the babys
$result1 = array_diff($files2, $files1);

echo '<strong>' . $user->lang['ORPHANED_MARKED'] . '</strong><br /><br />';

// unlink  display
foreach ($result1 as $del_file){
echo $del_file . '<br />';}

echo '<br /><strong><a href="orphans_backup_del.php">' . $user->lang['ORPHANED_DO_DEL'] . '</a></strong><br />';

echo '<br /><hr>
</body>
</html>';

}

else{

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title></title>
</head>
<body style="background:#DDDFE3">
<hr />
<h2>' . $user->lang['ORPHANED_ACC_DEN'] . '</h2>
<hr />
</body>
</html>';}

?>