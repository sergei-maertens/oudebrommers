<?php
/**
*
* @package watermark orphan
* @version $Id: orphans_convert.php 2009-09-02 17:27:10Z 4seven $
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

// geek  thang 1
$sql = 'SELECT post_text
from ' . POSTS_TABLE . '
WHERE post_text LIKE "%x@_id@_%jpg%" escape "@"
OR post_text LIKE "%x@_id@_%png%" escape "@"
OR post_text LIKE "%x@_id@_%gif%" escape "@"';
$result = $db->sql_query($sql);

// geek  thang 2
while ($row = $db->sql_fetchrow($result)){

if (isset($row['post_text'])){

$posted_files = preg_replace('/&amp;\#46;/', '.', htmlentities($row['post_text']));

preg_match_all('/x\_id\_(.*?)\.(jpg|png|gif)/', $posted_files, $current_posted);
 
unset($current_posted[1]);

foreach ($current_posted[0] as $current_file_1){

$current_posted_1[]= $current_file_1;

}}}

// free sql
$db->sql_freeresult($result);

// sort and make unique
array_unique($current_posted_1);
array_map('trim', $current_posted_1);
sort($current_posted_1);

// physicals
$handle2 = opendir($phpbb_root_path . 'images/files'); 
$files2  = array();
while ($file2 = readdir ($handle2)){ 
if ($file2 != "." && $file2 != ".." 
&& $file2 != ".htaccess" 
&& $file2 != "index.htm"
&& $file2 != "orphan"){
$files2[] = $file2;}}
closedir($handle2); 

// sort and make unique
array_unique($files2);
array_map('trim', $files2);
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

foreach ($current_posted_1 as $file_1){
echo $file_1 . '<br />';}

echo '<br /><hr><br />';

echo '<strong>' . $user->lang['ORPHANED_PHYSICAL'] . '</strong><br /><br />';

foreach ($files2 as $file_2){
echo $file_2 . '<br />';}

echo '<br /><hr><br />';

// compare the babys
$result12 = array_diff($files2, $current_posted_1);

echo '<strong>' . $user->lang['ORPHANED_MARKED'] . '</strong><br /><br />';

// unlink  display
foreach ($result12 as $del_file){
echo $del_file . '<br />';
}

echo '<br /><strong><a href="orphans_convert_del.php">' . $user->lang['ORPHANED_DO_DEL'] . '</a></strong><br />';

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