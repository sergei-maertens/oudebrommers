<?
// $forum_locatie = '/oudebrommers/phpbb3/';
// include $forum_locatie . 'config.php';
// $connection = mysql_connect($dbhost, $dbuser, $dbpasswd) or die('Connection failed');
// mysql_select_db($dbname, $connection) or die('Selecting database failed');
if ($_GET['do'] == "contact") {
if ($_POST['verzenden']) {
$bericht = $_POST['bericht'];
$email = $_POST['email'];
$onderwerp = $_POST['onderwerp'];
mail('info@oudebrommers.nl', $onderwerp, $bericht, "From:$email");
echo '<table width="100%" border="0" cellpadding="1" cellspacing="0">';
echo '<tr>';
echo '<td height="25" background="cellpic1.gif" class="menu1"><b>Contact</b></td>';
echo '</tr>';
echo '<tr>';
echo '<td bgcolor="#ececec" class="menu2">';
echo 'Email verzonden'; 
echo '</td>';
echo '</tr>';
echo '</table>';
}
else
{
echo '<table width="100%" border="0" cellpadding="1" cellspacing="0">';
echo '<tr>';
echo '<td height="25" background="cellpic1.gif" class="menu1"><b>Contact</b></td>';
echo '</tr>';
echo '<tr>';
echo '<td bgcolor="#ececec" class="menu2">';
echo '<form method="post" action="">';
echo 'Email adres:<br><input type="text" name="email" class="post"><br><br>';
echo 'Onderwerp:<br><input type="text" name="onderwerp" class="post"><br><br>';
echo 'Bericht:<br><textarea name="bericht" cols="50" rows="5" class="post"></textarea><br><br>';
echo '<input type="submit" name="verzenden" value="Versturen" class="post">'; 
echo '</td>';
echo '</tr>';
echo '</table>';
}
}
elseif ($_GET['do'] == "nieuws") {
$sql = 'SELECT * FROM site_nieuws WHERE id = "'.$_GET['id'].'"';
$sqlquery = mysql_query($sql);
while ($show = mysql_fetch_assoc($sqlquery)) {
echo '<table width="100%" border="0" cellpadding="1" cellspacing="0">';
echo '<tr>';
echo '<td height="25" background="cellpic1.gif" class="menu1"><b>'.$show['titel'].'</b> door '.$show['door'].' op '.$show['datum'].'</td>';
echo '</tr>';
echo '<tr>';
echo '<td bgcolor="#ececec" class="menu2">';
$bericht = $show['bericht'];
$bericht = nl2br($bericht);
echo $bericht;
echo '</td>';
echo '</tr>';
echo '</table>';
}
}
elseif ($_GET['do'] == "evenementen") {
	if ($_GET['id']) {
		$sql = 'SELECT * FROM site_evenementen WHERE id = "'.$_GET['id'].'"';
		$sqlquery = mysql_query($sql);
		while ($show = mysql_fetch_assoc($sqlquery)) {
			echo '<table width="100%" border="0" cellpadding="1" cellspacing="0">';
			echo '<tr>';
			echo '<td height="25" background="cellpic1.gif" class="menu1"><b>'.$show['titel'].' / '.$show['plaats'].'</b> ('.$show['datum'].')</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td bgcolor="#ececec" class="menu2">';
			echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">';
			echo '<tr><td width="100"><b>Wat:</b></td><td><font size="1"> '.$show['wat'].'</td></tr>';
			echo '<tr><td><b>Waar:</b></td><td><font size="1"> '.$show['waar'].'</td></tr>';
			echo '<tr><td><b>Van:</b></td><td><font size="1"> '.$show['van'].'</td></tr>';
			echo '<tr><td><b>Tot:</b></td><td><font size="1"> '.$show['tot'].'</td></tr>';
			echo '<tr><td><b>Organisatie:</b></td><td><font size="1"> '.$show['organisatie'].'</td></tr>';
			echo '<tr><td><b>Website:</b></td><td><font size="1"> '.$show['website'].'</td></tr>';
			echo '<tr><td><b>Telefoon:</b></td><td><font size="1"> '.$show['telefoon'].'</td></tr>';
			echo '<tr><td><b>E-mail:</b></td><td><font size="1"> '.$show['email'].'</td></tr>';
			echo '</table>';
			echo '</td>';
			echo '</tr>';
			echo '</table>';
		}
	}
	else
{
$date = date("d-m-Y");
$sql = 'SELECT * FROM site_evenementen WHERE datum >= '.$date.' ORDER BY datumsort ASC, id DESC';
$sqlquery = mysql_query($sql);
$sqlnum = mysql_num_rows($sqlquery);
if ($sqlnum == "0") {
echo '<table width="100%" border="0" cellpadding="1" cellspacing="0">';
echo '<tr>';
echo '<td height="25" background="cellpic1.gif" class="menu1"><b>Evenementen</b></td>';
echo '</tr>';
echo '<tr>';
echo '<td bgcolor="#ececec" class="menu2">';
echo 'Geen evenementen momenteel';
echo '</td>';
echo '</tr>';
echo '</table>';
}
else
{
while ($show = mysql_fetch_assoc($sqlquery)) {
echo '<table width="100%" border="0" cellpadding="1" cellspacing="0">';
echo '<tr>';
echo '<td height="25" background="cellpic1.gif" class="menu1"><b>'.$show['titel'].' / '.$show['plaats'].'</b> ('.$show['datum'].')</td>';
echo '</tr>';
echo '<tr>';
echo '<td bgcolor="#ececec" class="menu2">';
echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">';
echo '<tr><td width="100"><b>Wat:</b></td><td><font size="1"> '.$show['wat'].'</td></tr>';
echo '<tr><td><b>Waar:</b></td><td><font size="1"> '.$show['waar'].'</td></tr>';
echo '<tr><td><b>Van:</b></td><td><font size="1"> '.$show['van'].'</td></tr>';
echo '<tr><td><b>Tot:</b></td><td><font size="1"> '.$show['tot'].'</td></tr>';
echo '<tr><td><b>Organisatie:</b></td><td><font size="1"> '.$show['organisatie'].'</td></tr>';
echo '<tr><td><b>Website:</b></td><td><font size="1"> '.$show['website'].'</td></tr>';
echo '<tr><td><b>Telefoon:</b></td><td><font size="1"> '.$show['telefoon'].'</td></tr>';
echo '<tr><td><b>E-mail:</b></td><td><font size="1"> '.$show['email'].'</td></tr>';
echo '</table>';
echo '</td>';
echo '</tr>';
echo '</table>';
echo '<div id="doline"></div>';
}
}
}
}
else
{
$sql = 'SELECT * FROM site_start';
$sqlquery = mysql_query($sql);
while ($show = mysql_fetch_assoc($sqlquery)) {
?>
<table width="100%" border="0" cellpadding="1" cellspacing="0">
<tr>
<td height="25" background="cellpic1.gif" class="menu1"><b>Start</b></td>
</tr>
<tr>
<td bgcolor="#ececec" class="menu2">
<? 
$bericht = $show['text']; 
$bericht = nl2br($bericht); 
$bericht = str_replace("[b]", "<b>", $bericht); 
$bericht = str_replace("[/b]", "</b>", $bericht);
$bericht = str_replace("[i]", "<i>", $bericht); 
$bericht = str_replace("[/i]", "</i>", $bericht);
$bericht = str_replace("[u]", "<u>", $bericht); 
$bericht = str_replace("[/u]", "</u>", $bericht);
echo $bericht; ?>
</td>
</tr>
</table>
<div id="doline"></div>
<table width="100%" border="0" cellpadding="1" cellspacing="0">
<tr>
<td height="25" background="cellpic1.gif" class="menu1"><b>Evenement in de spotlights.</b></td>
</tr>
<tr>
<td bgcolor="#ececec" class="menu2">
<table width="100%" border="0" cellpadding="1" cellspacing="0">
<tr>
<td width="150"><img src="toerritlogo.jpg" class="imgleft"></td>
<td valign="top">
<?
$sql = 'SELECT * FROM site_spotlights';
$sqlquery = mysql_query($sql);
while ($show = mysql_fetch_assoc($sqlquery)) {
$bericht = $show['text'];
$bericht = nl2br($bericht);
echo $bericht;
echo '<br><br>';
echo '<a href="phpbb3/viewtopic.php?f='.$show['f'].'&t='.$show['t'].'"><b>Klik hier om verder te lezen</b></a>';
}
?>
</td></tr></table>
</div>
</td>
</tr>
</table>
<div id="doline"></div>
<?
}
    $query = "SELECT t.topic_id, t.forum_id, t.topic_first_poster_name, p.post_subject, p.post_text, p.post_time
        FROM {$table_prefix}topics t,
            {$table_prefix}posts p
        WHERE t.topic_id = p.topic_id AND t.forum_id = '63' 
        ORDER BY p.post_id DESC
        LIMIT 1";
    $result = mysql_query($query, $connection) or die('Query failed');
    $aantal = mysql_num_rows($result);
    $topics = array();
    while ($data = mysql_fetch_assoc($result))
    {
        if (!in_array($data['topic_id'], $topics))
        {
            $topics[] = $data['topic_id'];
            
            $data['post_subject'] = str_replace('Re: ', '', $data['post_subject']);
$tijd = $data['post_time'];
$tijd = date("d-m-Y", $tijd);
echo '<table width="100%" border="0" cellpadding="1" cellspacing="0">';
echo '<tr>';
echo '<td height="25" background="cellpic1.gif" class="menu1"><b>'.$data['post_subject'].'</b> door '.$data['topic_first_poster_name'].' op '.$tijd.'</td>';
echo '</tr>';
echo '<tr>';
echo '<td bgcolor="#ececec" class="menu2">';
$bericht = $data['post_text'];
$bericht = nl2br($bericht);
echo $bericht;
echo '</td>';
echo '</tr>';
echo '</table>';
//            echo '<a href="phpbb3/viewtopic.php?f=' . $data['forum_id'] . '&amp;t=' . $data['topic_id'] . '">' . $data['post_subject'] . '</a><br>';
        }
    }
    mysql_free_result($result);
}
?>