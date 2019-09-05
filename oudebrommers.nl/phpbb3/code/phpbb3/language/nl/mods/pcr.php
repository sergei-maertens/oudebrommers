<?php
/**
*
* @package Post Count Requirements
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
**/

/**
* DO NOT CHANGE
**/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'POSTREQ_POST'				=>	'bericht',
	'POSTREQ_POSTS'				=>	'berichten',
	'POSTREQ_NOACCESS_VIEW'		=>	'U hebt niet het vereiste aantal berichten om dit forum te bekijken. <br /> Om dit forum te bekijken moet u %1$d %2$s hebben.',
	'POSTREQ_NOACCESS_POST'		=>	'Uw profiel voldoet niet aan de eisen om berichten te plaatsen in dit forum .<br />Om hier een bericht te kunnen plaatsen moet u eerst %1$d %2$s in onze andere forums plaatsen.',
	'POSTREQ_NOACCESS_MORE'		=>	'',

	'POSTREQ_VIEW_TITLE'		=>	'View Forum Post Requirement',
	'POSTREQ_VIEW_EXPLAIN'		=>	'By setting this value to 0, this post count requirement will be disabled.',
	'POSTREQ_POST_TITLE'		=>	'New Topic/Reply Post Requirement',
	'POSTREQ_POST_EXPLAIN'		=>	'By setting this value to 0, this post count requirement will be disabled.',

	'POSTREQ_BYPASS'			=>	'Bypass Post Count Requirements',
	'POSTREQ_BYPASS_EXPLAIN'	=>	'This group and its members can access forums even if they do not have the required post count.',

));

?>
