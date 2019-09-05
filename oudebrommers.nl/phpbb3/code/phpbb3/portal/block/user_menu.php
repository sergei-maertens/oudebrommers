<?php
/*
*
* @package phpBB3 Portal  a.k.a canverPortal  ( www.phpbb3portal.com )
* @version $Id: user_menu.php,v 1.4 2008/02/09 08:18:14 angelside Exp $
* @copyright (c) Canver Software - www.canversoft.net
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
*/

//
// + new posts since last visit & you post number
//
if ($user->data['is_registered'])
{
	// new posts since last visit
	$sql = "SELECT COUNT(distinct post_id) as total
		FROM " . POSTS_TABLE . "
		WHERE post_time >= " . $user->data['session_last_visit'];
	$result = $db->sql_query($sql);
	$new_posts_count = (int) $db->sql_fetchfield('total');
		
	// your post number
	$sql = "SELECT user_posts
		FROM " . USERS_TABLE . "
		WHERE user_id = " . $user->data['user_id'];
	$result = $db->sql_query($sql);
	$you_posts_count = (int) $db->sql_fetchfield('user_posts');
}
//
// - new posts since last visit & you post number
//


// Get user...
$user_id = $user->data['user_id'];
$username = $user->data['username'];

$sql = 'SELECT *
	FROM ' . USERS_TABLE . '
	WHERE ' . (($username) ? "username_clean = '" . $db->sql_escape(utf8_clean_string($username)) . "'" : "user_id = $user_id");
$result = $db->sql_query($sql);
$member = $db->sql_fetchrow($result);
$db->sql_freeresult($result);
		
$avatar_img = get_user_avatar($member['user_avatar'], $member['user_avatar_type'], $member['user_avatar_width'], $member['user_avatar_height']);

$rank_title = $rank_img = '';
get_user_rank($member['user_rank'], $member['user_posts'], $rank_title, $rank_img, $rank_img_src);
		
$username = $member['username'];
$user_id = (int) $member['user_id'];
$colour = $member['user_colour'];

// Assign specific vars
$template->assign_vars(array(
	'L_NEW_POSTS'	=> $user->lang['SEARCH_NEW'] . '&nbsp;(' . $new_posts_count . ')',
	'L_SELF_POSTS'	=> $user->lang['SEARCH_SELF'] . '&nbsp;(' . $you_posts_count . ')',

	'AVATAR_IMG'	=> $avatar_img,
	
	'RANK_TITLE'	=> $rank_title,
	'RANK_IMG'		=> $rank_img,
	'RANK_IMG_SRC'	=> $rank_img_src,

	'USERNAME_FULL'		=> get_username_string('full', $user_id, $username, $colour),
	'USERNAME'			=> get_username_string('username', $user_id, $username, $colour),
	'USER_COLOR'		=> get_username_string('colour', $user_id, $username, $colour),
	'U_VIEW_PROFILE'	=> get_username_string('profile', $user_id, $username, $colour),

	'U_NEW_POSTS'			=> append_sid($phpbb_root_path . 'search.' . $phpEx . '?search_id=newposts'),
	'U_SELF_POSTS'			=> append_sid($phpbb_root_path . 'search.' . $phpEx . '?search_id=egosearch'),
	'U_UM_BOOKMARKS'		=> append_sid($phpbb_root_path . 'ucp.' . $phpEx . '?i=main&amp;mode=bookmarks'),
	'U_UM_MAIN_SUBSCRIBED'	=> append_sid($phpbb_root_path . 'ucp.' . $phpEx . '?i=main&amp;mode=subscribed'),
	'U_PRIVATE_MESSAGES'	=> append_sid($phpbb_root_path . 'ucp.' . $phpEx . '?i=pm&amp;folder=inbox'),
));

?>