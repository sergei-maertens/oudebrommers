<?php
/*
Designed to work with Wordpress Plugin "Cleverwise PHPBB Stats"
API Version: 1.5
*/

//	Load variable file
require('wpapi.config.php');

##########################################################
######	 ^^STOP! END OF VARIABLE SETUP^^
##########################################################

//	Security key check
$s='fail';
if (isset($_REQUEST['s'])) {
	$s=trim(urldecode($_REQUEST['s']));
}
if ($s != $securitykey) {
	die();
}

//	Set information variables
$phpbb_root_path='../../';

//	Load settings and functions
require($phpbb_root_path.'config.php');

//	Load database class and connector
if (isset($dbport) and $dbport > '0') {
	$dbhost .=':'.$dbport;
}
$dblink=mysqli_connect("$dbhost","$dbuser","$dbpasswd","$dbname") or die("Error " . mysqli_error($db)); 

//	We do not need this any longer, unset for security
unset($dbpasswd);

//	Define variables
isset($table);
isset($user_cnt);
isset($user_id);
isset($username);
isset($topic_cnt);
isset($post_cnt);
isset($post_id);
isset($post_subject);

////////////////////////////////////////////////////
//	Users Table
////////////////////////////////////////////////////
$table=$table_prefix.'users';

//	Total users
$sql="select count(user_id) as user_cnt from $table where user_type not like '2' and user_type not like '1'";
$result = mysqli_query($dblink,$sql);
while ($row = mysqli_fetch_array($result)) {
	$user_cnt=$row['user_cnt'];
}

//	Lastest user
$sql="select user_id,username from $table where user_type not like '2' and user_type not like '1' order by user_id desc limit 0,1";
$result = mysqli_query($dblink,$sql);
while ($row = mysqli_fetch_array($result)) {
	$user_id=$row['user_id'];
	$username=$row['username'];
}

////////////////////////////////////////////////////
//	Topic Table
////////////////////////////////////////////////////
$table=$table_prefix.'topics';

//	Total topics
$sql="select count(topic_id) as topic_cnt from $table";
$result = mysqli_query($dblink,$sql);
while ($row = mysqli_fetch_array($result)) {
	$topic_cnt=$row['topic_cnt'];
}

////////////////////////////////////////////////////
//	Posts Table
////////////////////////////////////////////////////
$table=$table_prefix.'posts';

//	Total posts
$sql="select count(post_id) as post_cnt from $table";
$result = mysqli_query($dblink,$sql);
while ($row = mysqli_fetch_array($result)) {
	$post_cnt=$row['post_cnt'];
}

//	Lastest post
isset($post_cnt_start);
isset($order_sql);

	//	Build SQL to omit forums
	$omitforumlist=preg_replace('/[^0-9,]/','',$omitforumlist);
	if ($omitforumlist) {
		$omitforumwhere='';
		$omitforums=explode(',',$omitforumlist);
		foreach ($omitforums as $omitforum) {
			if (is_numeric($omitforum) and $omitforum > '0') {
				if ($omitforumwhere) {
					$omitforumwhere .=' and ';
				}
				$omitforumwhere .="forum_id not like '$omitforum'";
			}
		}
		if ($omitforumwhere) {
			$table .=' where '.$omitforumwhere;
			$order_sql=' desc limit 0,5';
		}
	} else {
		$post_cnt_start=$post_cnt-5;
		$order_sql=' limit '.$post_cnt_start.',5';
	}

$sql="select post_id,poster_id,topic_id,forum_id,post_subject from $table order by post_id $order_sql";
$result = mysqli_query($dblink,$sql);
$forum_posts=array();
$i='0';
$table=$table_prefix.'users';
while ($row = mysqli_fetch_array($result)) {
	$post_id=$row['post_id'];
	$poster_id=$row['poster_id'];
	$topic_id=$row['topic_id'];
	$forum_id=$row['forum_id'];
	$post_subject=$row['post_subject'];
	
	$sqla="select username_clean from $table where user_id='$poster_id'";
	$resulta = mysqli_query($dblink,$sqla);
	while ($rowa = mysqli_fetch_array($resulta)) {
		$poster_id=$rowa['username_clean'];
	}
	
	$forum_posts[$i]="$forum_id|$poster_id|$topic_id|$post_id|$post_subject";
	$i++;
}
unset($post_cnt_start);
unset($order_sql);

////////////////////////////////////////////////////
//////	Prepare and send data
////////////////////////////////////////////////////
$wpdata=array();
$wpdata['user_cnt']=$user_cnt;
$wpdata['topic_cnt']=$topic_cnt;
$wpdata['post_cnt']=$post_cnt;
$wpdata['last_mem']="$user_id|$username";
$wpdata['last_post']=$forum_posts;

$wpdata=serialize($wpdata);
print $wpdata;


