<?
session_start(); 
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE); 
include("/home/oudebro/domains/oudebrommers.nl/public_html/phpbb3/config.php");
$forum_locatie = '/home/oudebro/domains/oudebrommers.nl/public_html/phpbb3/';
include $forum_locatie . 'config.php';
$connection = mysql_connect($dbhost, $dbuser, $dbpasswd) or die('Connection failed');
mysql_select_db($dbname, $connection) or die('Selecting database failed');
if ($_POST['inloggen']) {
if (isset($_POST['inloggen'])) {
$user = $_POST['gebruikersnaam'];
$ww = $_POST['wachtwoord'];
$wwmd5 = md5($ww);
$sql = 'SELECT * FROM admusers WHERE gebruikersnaam = "'.$user.'" AND wachtwoord = "'.$wwmd5.'"';
$sqlquery = mysql_query($sql);
$sqlnum = mysql_num_rows($sqlquery);
if ($sqlnum != "0") {
while ($show = mysql_fetch_array($sqlquery)) {
$_SESSION['obuserid'] = $show['id'];
}
$_SESSION['oblogon'] = "set";
}
} 
}
if ($_GET['do'] == "logoff") {
unset($_SESSION['oblogon']);
unset($_SESSION['obuserid']);
$site = $_SERVER["REQUEST_URI"];
echo "<script type=\"text/JavaScript\">window.location.href=\"index.php\"</script>";
}
?>
<html>
<head>
<title>Oude Brommers - www.oudebrommers.nl</title>
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
body,td,th { 
font-family: Verdana; 
font-size: 8pt; 
color: #006597;
}
.post {
background-color: white;
border-style: solid;
border-width: 1px;
border-color: #a9b8c2;
}
A:link {text-decoration: none; color: #006597}
A:visited {text-decoration: none; color: #006597}
A:active {text-decoration: none; color: #006597}
A:hover {text-decoration: underline; color: #006597}
</style>
<script type="text/javascript"> 
function addtext(veld,text) 
{ 
    document.addtextform.elements[veld].value += " "+text+" "; 
    document.addtextform.elements[veld].focus(); 
} 
</script>
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

<?
if (!isset($_SESSION['oblogon'])) {
echo '<table width="100%" border="0" cellpadding="1" cellspacing="0">';
echo '<tr>';
echo '<td height="25" background="cellpic1.gif" align="center" class="menu1"><b>Login</b></td>';
echo '</tr>';
echo '<tr>';
echo '<td bgcolor="#ececec" class="menu2" align="center">';
echo '<form method="post" action=""><br>';
echo 'Gebruikersnaam:<br><input type="text" name="gebruikersnaam" class="post"><br>';
echo 'Wachtwoord:<br><input type="password" name="wachtwoord" class="post"><br><br>';
echo '<input type="submit" name="inloggen" value="Login" class="post"></form>';
echo '</td>';
echo '</tr>';
echo '</table>';
}
else
{
include("incl/menulogin.php");
}
?>

</td>
<td valign="top">
<?
if (!isset($_SESSION['oblogon'])) {
?>
<table width="100%" border="0" cellpadding="1" cellspacing="0">
<tr>
<td height="25" background="cellpic1.gif" class="menu1"><b>Welkom</b></td>
</tr>
<tr>
<td bgcolor="#ececec" class="menu2">
Welkom! U moet eerst inloggen om gebruik te kunnen maken van de functies.
</td>
</tr>
</table>
<?
}
else
{
include("incl/main.php");
}
?>

</td>
</tr>
</table>
</td>
<td width="20">&nbsp;</td>
</tr>
</table>
<div align="center">
©2007 Oudebrommers.nl<br><font size="1">Design by Jeroen Izaks</font></div>
</body>
</html>