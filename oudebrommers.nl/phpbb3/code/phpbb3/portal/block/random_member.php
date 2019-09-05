<?php
/*
*
* @package phpBB3 Portal  a.k.a canverPortal  ( www.phpbb3portal.com )
* @version $Id: random_member.php,v 1.4 2008/02/09 08:18:14 angelside Exp $
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
$sql = 'SELECT *
	FROM ' . USERS_TABLE . '
	WHERE user_type <> ' . USER_IGNORE . '
		AND user_inactive_time = 0
	ORDER BY RAND() 
	LIMIT 0,1';
$result = $db->sql_query($sql);
$row = $db->sql_fetchrow($result);

$avatar_img = get_user_avatar($row['user_avatar'], $row['user_avatar_type'], $row['user_avatar_width'], $row['user_avatar_height']);

$rank_title = $rank_img = '';
get_user_rank($row['user_rank'], $row['user_posts'], $rank_title, $rank_img, $rank_img_src);
		
$username = $row['username'];
$user_id = (int) $row['user_id'];
$colour = $row['user_colour'];

$template->assign_block_vars('random_member', array(
	//'USERNAME_FULL'		=> get_username_string('full', $user_id, $username, $colour),
	'USERNAME'			=> get_username_string('username', $user_id, $username, $colour),
	'USER_COLOR'		=> get_username_string('colour', $user_id, $username, $colour),
	'U_VIEW_PROFILE'	=> get_username_string('profile', $user_id, $username, $colour),

	'RANK_TITLE'	=> $rank_title,
	'RANK_IMG'		=> $rank_img,
	'RANK_IMG_SRC'	=> $rank_img_src,

	'USER_POSTS'	=> (int) $row['user_posts'],
	'AVATAR_IMG'	=> $avatar_img,
	'JOINED'		=> $user->format_date($row['user_regdate'], $format = 'd.n.Y'),
	'USER_OCC'		=> censor_text($row['user_occ']),
	'USER_FROM'		=> censor_text($row['user_from']),
	'U_WWW'			=> censor_text($row['user_website']),
));
$db->sql_freeresult($result);

$template->assign_vars(array(
	'S_DISPLAY_RANDOM_MEMBER' => true,
));

?>