<?
define('IN_PHPBB', true);
$phpbb_root_path = 'phpbb3/';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
               
include($phpbb_root_path . 'common.' . $phpEx); 

ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE); 
// include("/home/oudebro/domains/oudebrommers.nl/public_html/phpbb3/styles/subsilver2/template/overall_header.html");

?>
<html>
<head>
<title>oudebrommers.nl &bull; 
<?
if ($_GET['do'] == "contact") {
echo 'Contact';
}
elseif ($_GET['do'] == "evenementen") {
echo 'Evenementen';
}
elseif ($_GET['do'] == "nieuws") {
echo 'Nieuws';
}
elseif ($_GET['do'] == "links") {
echo 'Links';
}
else
{
echo 'Start';
}
?></title>
<style>
#headerbottom {
	margin-bottom: 5px;
	padding: 3.5px 25px;
	border-bottom: 1px solid #4787A7;
}
#docenter {
	margin-left: 20px;
	margin-right: 20px;
}
#doline {
	margin-top: 5px;
}
#domoveleft {
	margin-right: 0px;
}
.menu1 {
border-left-style: solid;
border-right-style: solid;
border-top-style: solid;
border-left-width: 1px;
border-right-width: 1px;
border-top-width: 1px;
border-left-color: #a9b8c2;
border-right-color: #a9b8c2;
border-top-color: #a9b8c2;
}
.menu2 {
border-left-style: solid;
border-right-style: solid;
border-top-style: solid;
border-bottom-style: solid;
border-left-width: 1px;
border-right-width: 1px;
border-top-width: 1px;
border-bottom-width: 1px;
border-left-color: #a9b8c2;
border-right-color: #a9b8c2;
border-top-color: #a9b8c2;
border-bottom-color: #a9b8c2;
}
.imgleft {
border-right-style: solid;
border-right-width: 1px;
border-right-color: #a9b8c2;
}
.post {
background-color: white;
border-style: solid;
border-width: 1px;
border-color: #a9b8c2;
}
body,td,th { 
font-family: Verdana; 
font-size: 8pt; 
color: #006597;
}
A:link {text-decoration: none; color: #006597}
A:visited {text-decoration: none; color: #006597}
A:active {text-decoration: none; color: #006597}
A:hover {text-decoration: underline; color: #006597}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
</head>
<body topmargin="7" rightmargin="0" leftmargin="0">
<table width="100%" cellspacing="0">
<tr>
<div align="center"><div id="domoveleft"><img src="banner.gif"></div></div>
</tr>
</table>
<div id="headerbottom"></div>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="20">&nbsp;</td>
<td>
<table width="100%" border="0" cellpadding="0" cellspacing="5">
<tr>
<td width="224" valign="top">

<table width="100%" border="0" cellpadding="1" cellspacing="0">
<tr>
<td height="25" background="cellpic1.gif" align="center" class="menu1"><b>Menu</b></td>
</tr>
<tr>
<td bgcolor="#ececec" class="menu2">
<table width="100%" height="20" border="0" cellpadding="0" cellspacing="0"><tr><td width="20">
<img src="icon_start.gif"></td><td><a href="index.php">Start</a><br></td></tr></table>
<table width="100%" height="20" border="0" cellpadding="0" cellspacing="0"><tr><td width="20">
<img src="icon_forum.gif"></td><td><a href="phpbb3/">Forum</a><br></td></tr></table>
<table width="100%" height="20" border="0" cellpadding="0" cellspacing="0"><tr><td width="20">
<img src="icon_huisregels.gif"></td><td><a href="phpbb3/viewtopic.php?f=35&t=180">Huisregels</a><br></td></tr></table>
<table width="100%" height="20" border="0" cellpadding="0" cellspacing="0"><tr><td width="20">
<img src="icon_restauratie.gif"></td><td><a href="phpbb3/viewforum.php?f=58">Restauratie verslagen</a><br></td></tr></table>
<table width="100%" height="20" border="0" cellpadding="0" cellspacing="0"><tr><td width="20">
<img src="icon_techinfo.gif"></td><td><a href="phpbb3/viewforum.php?f=60">Technische informatie</a><br></td></tr></table>
<table width="100%" height="20" border="0" cellpadding="0" cellspacing="0"><tr><td width="20">
<img src="icon_evenementen.gif"></td><td><a href="?do=evenementen">Evenementen</a><br></td></tr></table>
<table width="100%" height="20" border="0" cellpadding="0" cellspacing="0"><tr><td width="20">
<img src="icon_links.gif"></td><td>Links<br></td></tr></table>
<table width="100%" height="20" border="0" cellpadding="0" cellspacing="0"><tr><td width="20">
<img src="icon_contact.gif"></td><td><a href="?do=contact">Contact</a></td></tr></table>
</td>
</tr>
</table>
<div id="doline"></div>
<table width="100%" border="0" cellpadding="1" cellspacing="0">
<tr>
<td height="25" background="cellpic1.gif" align="center" class="menu1"><b>Evenementen</b></td>
</tr>
<tr>
<td bgcolor="#ececec" class="menu2">
<?    
$forum_locatie = 'phpbb3/';
include $forum_locatie . 'config.php';
$connection = mysql_connect($dbhost, $dbuser, $dbpasswd) or die('Connection failed');
mysql_select_db($dbname, $connection) or die('Selecting database failed');

$date = date("Y-m-d");
$sql = "SELECT 
id, titel, datumsort, datum, plaats, CASE WHEN LENGTH(titel)>33 THEN 
CONCAT(SUBSTRING(titel,1,33), '...') 
ELSE 
titel 
END AS titel 
FROM site_evenementen 
WHERE datumsort >= '.$date.' 
ORDER BY datumsort ASC, id DESC LIMIT 4";
$sqlquery = mysql_query($sql);
$sqlnum = mysql_num_rows($sqlquery);
if ($sqlnum == "0") {
echo 'Geen evenementen momenteel';
}
while ($show = mysql_fetch_assoc($sqlquery)) {
echo '<a href="?do=evenementen&id='.$show['id'].'">';
echo $show['titel'];
echo '</a><br>';
echo '<font size="1">&nbsp;<i>'.$show['datum'].'/'.$show['plaats'].'</i></font><br>';
}
?>
</td>
</tr>
</table>
<div id="doline"></div>
<table width="100%" border="0" cellpadding="1" cellspacing="0">
<tr>
<td height="25" background="cellpic1.gif" align="center" class="menu1"><b>Het weer</b></td>
</tr>
<tr>
<td bgcolor="#d6e4e5" class="menu2">
<img src="http://www.knmi.nl/waarschuwingen_en_verwachtingen/
images/knmi_web_weersverwachting.png" alt="weersverwachting"
title="weersverwachting" border="0" width="220">
</td>
</tr>
</table>

</td>
<td valign="top">

<? include("incl/main.php"); ?>

</td>
<td width="224" valign="top">
<table width="100%" border="0" cellpadding="1" cellspacing="0">
<tr>
<td height="25" background="cellpic1.gif" align="center" class="menu1"><b>Forum statistieken</b></td>
</tr>
<tr>
<td bgcolor="#ececec" class="menu2">
<?php
define('IN_PHPBB', true);
$phpbb_root_path = 'phpbb3/';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
               
$total_posts      = $config['num_posts'];
$total_topics      = $config['num_topics'];
$total_reply	= $total_posts - $total_topics;
$total_users      = $config['num_users'];
$online_users	= $config['Online_users_total'];
$newest_user      = $config['newest_username'];

print 'Er zijn ' . $total_posts . ' berichten waarvan ' . $total_topics . ' topics en ' . $total_reply . ' antwoorden. Wij hebben ' . $total_users . ' leden. Het nieuwste lid is ' . $newest_user .'.<br><br>';

$tijd = time();
$tijdminus = $tijd - 300;
$sql = 'SELECT * FROM phpbb_sessions WHERE session_time >= "'.$tijdminus.'" AND session_user_id != "1" GROUP BY session_user_id';
$sqlquery = mysql_query($sql);
$sqlnum = mysql_num_rows($sqlquery);
$sql2 = 'SELECT * FROM phpbb_sessions WHERE session_time >= "'.$tijdminus.'" AND session_user_id = "1" GROUP BY session_ip';
$sql2query = mysql_query($sql2);
$sql2num = mysql_num_rows($sql2query);
if ($sqlnum == "1") {
echo 'Er is 1 lid online:<br>';
}
elseif ($sqlnum == "0") {
echo 'Er zijn 0 leden online.';
}
else
{
echo 'Er zijn '.$sqlnum.' leden online:<br>';
}

while ($show = mysql_fetch_assoc($sqlquery)) {
$userid = $show['session_user_id'];
$sql2 = 'SELECT * FROM phpbb_users WHERE user_id = "'.$userid.'"';
$sql2query = mysql_query($sql2);
while ($row = mysql_fetch_assoc($sql2query)) {
$gebruiker[] = $row['username'];
$gebruikers = implode (', ', $gebruiker);
}
}
echo $gebruikers;
if ($gebruikers == "" AND $sqlnum != "0") {
echo 'Geen leden online.';
}
?>

</td>
</tr>
</table>
<div id="doline"></div>
<table width="100%" border="0" cellpadding="1" cellspacing="0">
<tr>
<td height="25" background="cellpic1.gif" align="center" class="menu1"><b>Laatste forum berichten</b></td>
</tr>
<tr>
<td bgcolor="#ececec" class="menu2">
    <?php
    $forum_locatie = 'phpbb3/';

    include $forum_locatie . 'config.php';
    $connection = mysql_connect($dbhost, $dbuser, $dbpasswd) or die('Connection failed');
    mysql_select_db($dbname, $connection) or die('Selecting database failed');
    unset($dbpasswd); // Just to be safe

//    $query = "SELECT t.topic_id, t.forum_id, t.topic_last_poster_name, t.topic_last_post_time, p.post_subject
//        FROM {$table_prefix}topics t,
//            {$table_prefix}posts p
//        WHERE t.topic_id = p.topic_id AND t.forum_id != '57'
//        ORDER BY p.post_id DESC
//        LIMIT 10";
    $query = "SELECT topic_id, forum_id, topic_last_poster_name, topic_last_post_time, topic_title
    FROM {$table_prefix}topics
    WHERE forum_id != '57'
    ORDER BY topic_last_post_time DESC
    LIMIT 5";
    $result = mysql_query($query, $connection) or die('Query failed');
    $topics = array();
    while ($data = mysql_fetch_assoc($result))
    {
        if (!in_array($data['topic_id'], $topics))
        {
            $topics[] = $data['topic_id'];
	    $tijddatum = $data['topic_last_post_time'];
            $datum = date("d-m-Y", $tijddatum);
	    $tijd = date("H:i:s", $tijddatum);
            $data['post_subject'] = str_replace('Re: ', '', $data['post_subject']);
            echo '<a href="phpbb3/viewtopic.php?f=' . $data['forum_id'] . '&amp;t=' . $data['topic_id'] . '">' . $data['topic_title'] . '</a><br>';
	    echo '<font size="1">&nbsp;<i>'.$data['topic_last_poster_name'].'/'.$datum.' '.$tijd.'</i></font><br>';
        }
    }
    mysql_free_result($result);
    ?>
</td>
</tr>
</table>
<div id="doline"></div>
<table width="100%" border="0" cellpadding="1" cellspacing="0">
<tr>
<td height="25" background="cellpic1.gif" align="center" class="menu1"><b>Te koop</b></td>
</tr>
<tr>
<td bgcolor="#ececec" class="menu2">
    <?php
    $forum_locatie = 'phpbb3/';

    include $forum_locatie . 'config.php';
    $connection = mysql_connect($dbhost, $dbuser, $dbpasswd) or die('Connection failed');
    mysql_select_db($dbname, $connection) or die('Selecting database failed');
    unset($dbpasswd); // Just to be safe

//    $query = "SELECT t.topic_id, t.forum_id, t.topic_last_poster_name, t.topic_last_post_time, p.post_subject
//        FROM {$table_prefix}topics t,
//            {$table_prefix}posts p
//        WHERE t.topic_id = p.topic_id AND t.forum_id != '57'
//        ORDER BY p.post_id DESC
//        LIMIT 10";
    $query = "SELECT topic_id, forum_id, topic_last_poster_name, topic_last_post_time, topic_title
    FROM {$table_prefix}topics
    WHERE forum_id = '21'
    ORDER BY topic_last_post_time DESC
    LIMIT 3";
    $result = mysql_query($query, $connection) or die('Query failed');
    $aantal = mysql_num_rows($result);
    $topics = array();
    while ($data = mysql_fetch_assoc($result))
    {
        if (!in_array($data['topic_id'], $topics))
        {
            $topics[] = $data['topic_id'];
	    $tijddatum = $data['topic_last_post_time'];
            $datum = date("d-m-Y", $tijddatum);
	    $tijd = date("H:i:s", $tijddatum);
            $data['post_subject'] = str_replace('Re: ', '', $data['post_subject']);
            echo '<a href="phpbb3/viewtopic.php?f=' . $data['forum_id'] . '&amp;t=' . $data['topic_id'] . '">' . $data['topic_title'] . '</a><br>';
	    echo '<font size="1">&nbsp;<i>'.$data['topic_last_poster_name'].'/'.$datum.' '.$tijd.'</i></font><br>';
        }
    }
    mysql_free_result($result);
if ($aantal == "0") {
echo 'Geen';
}
    ?>
</td>
</tr>
</table>
<div id="doline"></div>
<table width="100%" border="0" cellpadding="1" cellspacing="0">
<tr>
<td height="25" background="cellpic1.gif" align="center" class="menu1"><b>Gevraagd</b></td>
</tr>
<tr>
<td bgcolor="#ececec" class="menu2">
    <?php
    $forum_locatie = 'phpbb3/';

    include $forum_locatie . 'config.php';
    $connection = mysql_connect($dbhost, $dbuser, $dbpasswd) or die('Connection failed');
    mysql_select_db($dbname, $connection) or die('Selecting database failed');
    unset($dbpasswd); // Just to be safe

//    $query = "SELECT t.topic_id, t.forum_id, t.topic_last_poster_name, t.topic_last_post_time, p.post_subject
//        FROM {$table_prefix}topics t,
//            {$table_prefix}posts p
//        WHERE t.topic_id = p.topic_id AND t.forum_id != '57'
//        ORDER BY p.post_id DESC
//        LIMIT 10";
    $query = "SELECT topic_id, forum_id, topic_last_poster_name, topic_last_post_time, topic_title
    FROM {$table_prefix}topics
    WHERE forum_id = '22'
    ORDER BY topic_last_post_time DESC
    LIMIT 3";
    $result = mysql_query($query, $connection) or die('Query failed');
    $topics = array();
    while ($data = mysql_fetch_assoc($result))
    {
        if (!in_array($data['topic_id'], $topics))
        {
            $topics[] = $data['topic_id'];
	    $tijddatum = $data['topic_last_post_time'];
            $datum = date("d-m-Y", $tijddatum);
	    $tijd = date("H:i:s", $tijddatum);
            $data['post_subject'] = str_replace('Re: ', '', $data['post_subject']);
            echo '<a href="phpbb3/viewtopic.php?f=' . $data['forum_id'] . '&amp;t=' . $data['topic_id'] . '">' . $data['topic_title'] . '</a><br>';
	    echo '<font size="1">&nbsp;<i>'.$data['topic_last_poster_name'].'/'.$datum.' '.$tijd.'</i></font><br>';
        }
    }
    mysql_free_result($result);
    ?>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
<td width="20">&nbsp;</td>
</tr>
</table>
<? // <div id="headerbottom"></div> ?>
<div align="center">
<table width="100%" borer="1" cellpadding="0" cellspacing="0"><tr><td align="center">
<a href="beheren/">&copy; 2007 Oudebrommers.nl</a><br>Design by Jeroen Izaks
</td></tr></table>
<br>
 <!--CheckStat Free 4.2 Begin-->
<!--LET OP: De teller zal worden verwijderd indien-->
<!--aanpassingen zijn gemaakt aan deze code of-->
<!--wanneer het icoon niet zichtbaar is op de site.-->
<script type="text/javascript" language="javascript">
function checkstat(a,v){var set=new Array();if(typeof v=="string")
{set[0]=parseInt(v.substring(0,1))}else{set[0]=(v==3||v==4)?0:1}
var jv,sz,sc,i;js="";var td=new Date();var tm=td.getTime();
var s=screen;var d=document;var l="http://checkstat.nl/cgi-bin/";
var lo=d.URL;var n=navigator;var re=typeof(top.document)=="object"?
top.document.referrer:d.referrer;for(i=0;i<=5;i++)
{d.write('<script language="javascript1.'+i+'">js="'+i+'"<\/script>')}
if(js>=1){jv=n.javaEnabled()?"y":"n"}if(js>=2){sz=s.width+"*"+s.height;
sc=n.appName.substring(0,9)=="Microsoft"?s.colorDepth:s.pixelDepth;}
var ar="&location="+escape(lo)+"&screensize="+sz+"&screencolors="+sc+
"&javascript=1."+js+"&java="+jv+"&referrer="+escape(re)+"&time="+tm;
if(set[0]){d.write('<a target=_blank href="'+l+'show.cgi?'+a+
'"><img nosave name=icon width=19 height=19 border=0 alt="CheckStat" '+
'src="'+l+'count.cgi?'+a+ar+'"><\/a>')}else{d.write('<img width=1 '+
'height=1 src="'+l+'count.cgi?'+a+ar+'">')}}checkstat('brommersite','110')
</script><noscript>
<a href="http://checkstat.nl/cgi-bin/show.cgi?brommersite"
target=_blank><img name=icon width=19 height=19
src="http://checkstat.nl/cgi-bin/count.cgi?brommersite"
border=0 alt=CheckStat></a>
</noscript>
<!--CheckStat Free 4.2 End-->
</div>
<?php

// if ($user->data['is_registered']) {

// }
?>
</body>
</html>