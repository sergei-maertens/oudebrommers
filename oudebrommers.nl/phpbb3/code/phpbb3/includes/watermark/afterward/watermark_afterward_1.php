<?php
/**
*
* @package watermark afterward
* @version $Id: watermark_afterward_1.php 2009-09-02 17:27:10Z 4seven $
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

$backup_path_1 = $phpbb_root_path . 'files/convert/backup';
	
if(file_exists($backup_path_1)){

function full_copy( $source, $target )
    {
        if ( is_dir( $source ) )
        {
            @mkdir( $target );
           
            $d = dir( $source );
           
            while ( FALSE !== ( $entry = $d->read() ) )
            {
                if ( $entry == '.' || $entry == '..' )
                {
                    continue;
                }
               
                $Entry = $source . '/' . $entry;           
                if ( is_dir( $Entry ) )
                {
                    full_copy( $Entry, $target . '/' . $entry );
                    continue;
                }
                copy( $Entry, $target . '/' . $entry );
            }
           
            $d->close();
        }else
        {
            copy( $source, $target );
        }
    }

full_copy("$phpbb_root_path/files/convert/fakes", "$phpbb_root_path/files/convert");


/*
                    $backup_path_1 = $phpbb_root_path . 'files/convert/backup';
                    if (!is_dir($backup_path_1)){
					mkdir ($backup_path_1, 0755);}
*/
	

// Get the attachment data, based on mimetype  jpg
$sql = 'SELECT physical_filename, real_filename
FROM ' . ATTACHMENTS_TABLE . "
WHERE mimetype = 'image/jpeg'";
$result = $db->sql_query($sql);

while ($row = $db->sql_fetchrow($result)){
if (!file_exists($phpbb_root_path. '/files/convert/' . $row['physical_filename'] . '.jpg')){
if (file_exists($phpbb_root_path . 'files/' . $row['physical_filename'])){
copy($phpbb_root_path . 'files/' . $row['physical_filename'], $phpbb_root_path . 'files/convert/' . $row['physical_filename'] . '.jpg');
copy($phpbb_root_path . 'files/' . $row['physical_filename'], $phpbb_root_path . 'files/convert/backup/' . $row['physical_filename']);}}

if (!file_exists($phpbb_root_path . 'files/convert/' . 'thumb_' . $row['physical_filename'] . '.jpg')){
if (file_exists($phpbb_root_path . 'files/' . 'thumb_' . $row['physical_filename'])){
copy($phpbb_root_path . 'files/' . 'thumb_' . $row['physical_filename'], $phpbb_root_path . 'files/convert/' . 'thumb_' . $row['physical_filename'] . '.jpg');
copy($phpbb_root_path . 'files/' . 'thumb_' . $row['physical_filename'], $phpbb_root_path . 'files/convert/backup/' . 'thumb_' . $row['physical_filename']);}}

}

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title></title>
</head>
<body style="background:#DDDFE3">
<hr />
' . utf8_decode($user->lang['AFTERWARD_SAVE_ATTACH']) . '
<hr />
' . utf8_decode($user->lang['STEP_2_JPG_START'])  . '
<hr />
<p style="font-size: 12px">
<strong>' . utf8_decode($user->lang['AFTERWARD_SAVE_JPG']) . '</strong><br /><br />';

$folder = $phpbb_root_path . 'files/convert/';
foreach (glob($folder."{*.jpg,*.JPG,*.jpeg,*.JPEG}", GLOB_BRACE) as $filename) { 
echo $filename . '<br />';} 

echo '<br /><strong>' . utf8_decode($user->lang['AFTERWARD_FILE_SUCCESS']) . '</strong></p><hr />';


// Get the attachment data, based on mimetype  png
$sql = 'SELECT physical_filename, real_filename
FROM ' . ATTACHMENTS_TABLE . "
WHERE mimetype = 'image/png'";
$result = $db->sql_query($sql);

while ($row = $db->sql_fetchrow($result)){
if (!file_exists($phpbb_root_path . 'files/convert/' . $row['physical_filename'] . '.png')){
if (file_exists($phpbb_root_path . 'files/' . $row['physical_filename'])){
copy($phpbb_root_path . 'files/' . $row['physical_filename'], $phpbb_root_path . 'files/convert/' . $row['physical_filename'] . '.png');
copy($phpbb_root_path . 'files/' . $row['physical_filename'], $phpbb_root_path . 'files/convert/backup/' . $row['physical_filename']);}}

if (!file_exists($phpbb_root_path . 'files/convert/' . 'thumb_' . $row['physical_filename'] . '.png')){
if (file_exists($phpbb_root_path . 'files/' . 'thumb_' . $row['physical_filename'])){
copy($phpbb_root_path . 'files/' . 'thumb_' . $row['physical_filename'], $phpbb_root_path . 'files/convert/' . 'thumb_' . $row['physical_filename'] . '.png');
copy($phpbb_root_path . 'files/' . 'thumb_' . $row['physical_filename'], $phpbb_root_path . 'files/convert/backup/' . 'thumb_' . $row['physical_filename']);}}

}

echo '<p style="font-size: 12px">
<strong>' . utf8_decode($user->lang['AFTERWARD_SAVE_PNG']) . '</strong>
<br /><br />';

$ordner = $phpbb_root_path . 'files/convert/';
foreach (glob($ordner."{*.png,*.PNG}", GLOB_BRACE) as $filename) {
echo $filename . '<br />';} 

echo '<br /><strong>' . utf8_decode($user->lang['AFTERWARD_FILE_SUCCESS']) . '</strong></p><hr />';

// Get the attachment data, based on mimetype  gif
$sql = 'SELECT physical_filename, real_filename
FROM ' . ATTACHMENTS_TABLE . "
WHERE mimetype = 'image/gif'";
$result = $db->sql_query($sql);

while ($row = $db->sql_fetchrow($result)){
if (!file_exists($phpbb_root_path . 'files/convert/' . $row['physical_filename'] . '.gif')){
if (file_exists($phpbb_root_path . 'files/' . $row['physical_filename'])){
copy($phpbb_root_path . 'files/' . $row['physical_filename'], $phpbb_root_path . 'files/convert/' . $row['physical_filename'] . '.gif');
copy($phpbb_root_path . 'files/' . $row['physical_filename'], $phpbb_root_path . 'files/convert/backup/' . $row['physical_filename']);}}

if (!file_exists($phpbb_root_path . 'files/convert/' . 'thumb_' . $row['physical_filename'] . '.gif')){
if (file_exists($phpbb_root_path . 'files/' . 'thumb_' . $row['physical_filename'])){
copy($phpbb_root_path . 'files/' . 'thumb_' . $row['physical_filename'], $phpbb_root_path . 'files/convert/' . 'thumb_' . $row['physical_filename'] . '.gif');
copy($phpbb_root_path . 'files/' . 'thumb_' . $row['physical_filename'], $phpbb_root_path . 'files/convert/backup/' . 'thumb_' . $row['physical_filename']);}}

}

echo '<p style="font-size: 12px">
<strong>' . utf8_decode($user->lang['AFTERWARD_SAVE_GIF']) . '</strong>
<br /><br />';

$ordner = $phpbb_root_path . 'files/convert/';
foreach (glob($ordner."{*.gif,*.GIF}", GLOB_BRACE) as $filename) {
echo $filename . '<br />';} 

echo '<br /><strong>' . utf8_decode($user->lang['AFTERWARD_FILE_SUCCESS']) . '</strong></p><hr />
</body>
</html>';

$db->sql_freeresult($result);


// rename("$phpbb_root_path/files/convert/backup","$phpbb_root_path/files/convert/backup_" . $config['watermark_backup_microtime']);

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
' . utf8_decode($user->lang['NO_BACKUP_DIR'])  . '
<hr />
</body>
</html>';
}
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
<h2>' . utf8_decode($user->lang['ORPHANED_ACC_DEN'])  . '</h2>
<hr />
</body>
</html>';}

?>