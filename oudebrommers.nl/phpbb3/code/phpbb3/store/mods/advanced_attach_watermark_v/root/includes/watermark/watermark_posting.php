<?php
/**
*
* @package Watermark
* @version $Id: watermark_posting.php 2010-05-25 11:06:13Z 4seven $
* @copyright (c) 2010 / 4seven
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


// Special Mode Groups
if(!empty($config['watermark_special_groups'])){
if(!function_exists('group_memberships')){
include($phpbb_root_path . 'includes/functions_user.' . $phpEx);}
$group_wm           = explode(",", $config['watermark_special_groups']);
$user_wm            = $user->data['user_id'];
$is_in_group_wm     = group_memberships($group_wm, $user_wm , true);
if($is_in_group_wm == true){
	$template->assign_vars(array(
'S_HIDE_GROUP_WM'  => true)
);}}
else{
	$template->assign_vars(array(
'S_HIDE_GROUP_WM'  => true)
);}

// List Fonts
function list_fonts($dir='includes/watermark/fonts/',$type='ttf') {
    $x = 0;
    foreach (glob($dir."*.".$type) as $font_file)    {
        $fontfile[$x]['file'] = $font_file;
        $x++;
    } 
    
    return $fontfile;
}

$pic = list_fonts();
  
for($x=0;$x<count($pic);$x++) {
    
    $fontsfile = $pic[$x]['file']; 
    $fontsfile = str_replace('includes/watermark/fonts/', '', $fontsfile);
	$fontsname = str_replace('.ttf', '', $fontsfile);

	$template->assign_block_vars('fontfile', array(
		'FONTFILE'	=> $fontsfile,
		'FONTNAME'	=> $fontsname)
		);		
}

?>