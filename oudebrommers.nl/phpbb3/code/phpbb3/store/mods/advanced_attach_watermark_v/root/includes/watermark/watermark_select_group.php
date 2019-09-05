<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>Text Special Display Groups</title>

<style type="text/css">
<!--
select, option{
background-color: #DDDFE3;
}


#option_group, #submit_clear, #submit_id, #submit_comma, #submit_close {
  	       width: auto !important;
background-image: url("images/bg_button.gif");
	      border: 1px solid #666666;
	       color: black;
	      cursor: pointer;
	      cursor: hand;
}
#option_group:hover, #submit_clear:hover, #submit_id:hover, #submit_comma:hover, #submit_close:hover{
	         border: 1px solid #BC294D;
background-position: 0 100%;
	          color: #BC294D;
}
-->
</style>

<script type="text/javascript">
// <![CDATA[
function insert(form,field,auswahltxt) {
var tarea = parent.opener.document.forms[form].elements[field];
var selEnd = tarea.selectionEnd;
var txtLen = tarea.value.length;
var txtbefore = tarea.value.substring(0,selEnd);
tarea.value = txtbefore + auswahltxt;
tarea.selectionStart = txtbefore.length + auswahltxt.length;
tarea.selectionEnd = txtbefore.length + auswahltxt.length;
}
// ]]>
</script>

<script type="text/javascript">
// <![CDATA[
function insert2(form,field,auswahltxt) {
var tarea = parent.opener.document.forms[form].elements[field];
var selEnd = tarea.selectionEnd;
var txtLen = tarea.value.length;
var txtbefore = tarea.value.substring(0,selEnd);
tarea.value = auswahltxt;
tarea.selectionStart = txtbefore.length + auswahltxt.length;
tarea.selectionEnd = txtbefore.length + auswahltxt.length;
}
// ]]>
</script>


<script type="text/javascript">
// <![CDATA[
function replaceButtonText(buttonId, text)
{
	if (document.getElementById)
	{
		var button=document.getElementById(buttonId);
		if (button)
		{
			if (button.childNodes[0])
			{
				//alert("ch");		
				button.childNodes[0].nodeValue=text;
			}
			else if (button.value)
			{
				//alert("val");		
				button.value=text;
			}
			else //if (button.innerHTML)
			{
				//alert("inner");
				button.innerHTML=text;
			}		
		}
	}
}
// ]]> 
</script>

<script type="text/javascript">
// <![CDATA[
document.trigger.ttfselect.focus();
// ]]> 
</script>

</head>
<body style="background:#F3F3F3">
<fieldset style="border:none;">
<div>
<select name="ttfselect">
<?php
/**
*
* @package Watermark
* @version $Id: watermark_select_ttf.php Z 2010-05-15 12:13:38 4seven $
* @copyright (c) 2010 / 4seven
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/

define('IN_PHPBB', true);
$phpbb_root_path = '../../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

// Start session management
$user->session_begin();
$user->setup();
$auth->acl($user->data);

// Advanced Attach Watermark / 4seven / 2010

$res=$db->sql_query('SELECT group_id, group_name FROM ' . GROUPS_TABLE . ' ORDER BY group_id ASC');

while ($row = $db->sql_fetchrow($res))
{
   echo '<option value="' . $row['group_id'] . '">' . $row['group_id'] . '&nbsp;-&nbsp;' . $row['group_name'] . '</option>';
}

$db->sql_freeresult($res);

// Advanced Attach Watermark / 4seven / 2010

?>
</select>
<br /><br />
<input type="submit" value="Clear" id="submit_clear" onclick="insert2('acp_watermark','config[watermark_special_groups]', '')" />
&nbsp;
<input type="submit" value="Group ID" id="submit_id"  onmouseover="javascript:replaceButtonText('submit_id', document.getElementsByName('ttfselect')[0].value + ' >>')" onclick="insert('acp_watermark','config[watermark_special_groups]', document.getElementsByName('ttfselect')[0].value );focus()" />
&nbsp;
<input type="submit" value="Comma" id="submit_comma" onmouseover="javascript:replaceButtonText('submit_comma', ', >>')" onclick="insert('acp_watermark','config[watermark_special_groups]', ',');focus();" />
<br /><br />
<input type="submit" value="Close" id="submit_close" onclick="window.close()" />
</div>
</fieldset>
</body>
</html>