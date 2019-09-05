<?php
/**
*
* @package phpBB3
* @version $Id$
* @copyright (c) 2008 Manchumahara(Sabuj Kundu)
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'language/en/common.' . $phpEx);

// Start session
$user->session_begin();
$auth->acl($user->data);
$user->setup();


function make_xml_compatible($text,$bbcode_uid, $bbcode_bitfield,$bbcode_options)
{
	 global $config, $base_url;
	 $text = html_entity_decode(generate_text_for_display($text, $bbcode_uid, $bbcode_bitfield, $bbcode_options));
	 $text = nl2br($text);
         $text = str_replace('&pound', '&amp;#163;', $text);
         $text = str_replace('&copy;', '(c)', $text);
         $text = htmlspecialchars($text);
	 return $text; 
}
//Get the board url address
$board_url = generate_board_url();

// Start RSS output
header('Content-type: application/rss+xml; charset=UTF-8');
$rss_result = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<rss version=\"2.0\"  xmlns:atom=\"http://www.w3.org/2005/Atom\">
<channel>
<atom:link href=\"".$board_url."/rss.$phpEx\" rel=\"self\" type=\"application/rss+xml\" /> 
  <title>".$config['sitename']."</title>
  <link>".$board_url."</link>
  <description>".$config['site_desc']."</description>
  <language>".$config['default_lang']."</language>
  <copyright>(c) Copyright by ".$config['sitename']."</copyright>     
  <managingEditor>".$config['board_email']." (".$config['sitename']." Admin)</managingEditor>  
   <generator>phpBB3 RSS2 Syndication Mod by Manchumahara(Sabuj Kundu)</generator>
  <ttl>1</ttl>  
";
        //
        // This SQL query selects the latest topics of all forum
        
        
        $sql = 'SELECT f.forum_id,f.forum_name, f.forum_desc_options, t.topic_title, t.topic_id,t.topic_last_post_id,t.topic_last_poster_name, p.post_time, p.post_text, 
        	p.bbcode_uid, p.bbcode_bitfield, u.username, u.user_id
                FROM  '. FORUMS_TABLE .'  f,'.TOPICS_TABLE.' t, '.POSTS_TABLE.' p,'.USERS_TABLE.' u
                WHERE t.forum_id = f.forum_id
		AND t.forum_id != 57
                AND t.topic_status != 1
                AND p.post_id = t.topic_last_post_id 
                AND u.user_id = p.poster_id
                ORDER BY t.topic_last_post_id DESC
                LIMIT 30 ';	
        if(!$result = $db->sql_query($sql))
        {
        		trigger_error($user->lang['RSS_FAILURE']);               
        }
        while($row = $db->sql_fetchrow($result))
        {
        	   $forumid=$row['forum_id'];
        	   $topicid=$row['topic_id'];
               if($auth->acl_get('f_read',$forumid))	   //getting authentication
               {
               	   $post_link    = $board_url."/viewtopic.".$phpEx."?f=".$forumid."&amp;t=".$topicid."#p".$row['topic_last_post_id'];
                   $topic_link   = $board_url."/viewtopic.".$phpEx."?f=".$forumid."&amp;t=".$topicid;
                   $description  = $user->lang['POST_BY_AUTHOR']." ".$row['topic_last_poster_name']." (".$user->lang['POSTED']." ".$user->format_date($row['post_time']).")<br/>".$row['post_text']."<br /><br /><a href=\"".$topic_link."\">".$user->lang['RSS_READ_TOPIC']."</a><hr />";                          
		           $rss_result .= "
                                  <item>
                                  <title>".$row['topic_title']."</title>
                                  <link>".$post_link."</link>
                                  <description>".make_xml_compatible($description, $row['bbcode_uid'], $row['bbcode_bitfield'], $row['forum_desc_options'])."</description>
                                        					    <pubDate>".$user->format_date($row['post_time'])."</pubDate>                                        
                            	    <guid isPermaLink=\"true\">".$post_link."</guid>		   					
                                      </item>";
                }
        }


$rss_result .= '</channel></rss>';
echo $rss_result;
$db->sql_freeresult($result);
?>
