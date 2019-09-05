<?php
/*
*
* @package phpBB3 Portal  a.k.a canverPortal  ( www.phpbb3portal.com )
* @version $Id: friends.php,v 1.5 2008/02/09 08:18:14 angelside Exp $
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

$s_display_friends = false;

// Output listing of friends online
$update_time = $config['load_online_time'] * 60;

$sql = $db->sql_build_query('SELECT_DISTINCT', array(
	'SELECT'	=> 'u.user_id, u.username, u.user_colour, u.user_allow_viewonline, MAX(s.session_time) as online_time, MIN(s.session_viewonline) AS viewonline',
	'FROM'		=> array(
		USERS_TABLE	=> 'u',
		ZEBRA_TABLE	=> 'z'
	),

	'LEFT_JOIN'	=> array(
		array(
			'FROM'	=> array(SESSIONS_TABLE => 's'),
			'ON'	=> 's.session_user_id = z.zebra_id'
		)
	),

	'WHERE'		=> 'z.user_id = ' . $user->data['user_id'] . '
		AND z.friend = 1
		AND u.user_id = z.zebra_id',
	'GROUP_BY'	=> 'z.zebra_id, u.user_id, u.username, u.user_allow_viewonline, u.user_colour',
	'ORDER_BY'	=> 'u.username_clean ASC',
));

$result = $db->sql_query_limit($sql, $config['portal_max_online_friends']);

while ($row = $db->sql_fetchrow($result))
{
	$which = (time() - $update_time < $row['online_time'] && $row['viewonline'] && $row['user_allow_viewonline']) ? 'online' : 'offline';
	$s_display_friends = ($row['user_id']) ? true : false;
	
	$template->assign_block_vars("friends_{$which}", array(
		'USER_ID'		=> $row['user_id'],
		'U_PROFILE'		=> get_username_string('profile', $row['user_id'], $row['username'], $row['user_colour']),
		'USER_COLOUR'	=> get_username_string('colour', $row['user_id'], $row['username'], $row['user_colour']),
		'USERNAME'		=> get_username_string('username', $row['user_id'], $row['username'], $row['user_colour']),
		'USERNAME_FULL'	=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']))
	);
}
$db->sql_freeresult($result);

// Assign specific vars
$template->assign_vars(array(
	'S_DISPLAY_FRIENDS'	=> $s_display_friends,
	'S_ZEBRA_ENABLED'	=> true,
));

?>