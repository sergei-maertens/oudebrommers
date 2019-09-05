<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>Text Font</title>

<style type="text/css">
<!--
select, option{
background-color: #DDDFE3;
}
#submit_id, #submit_close {
  	       width: auto !important;
background-image: url("images/bg_button.gif");
	      border: 1px solid #666666;
	       color: black;
	      cursor: pointer;
	      cursor: hand;
}
#submit_id:hover, #submit_close:hover{
	         border: 1px solid #BC294D;
background-position: 0 100%;
	          color: #BC294D;
}
-->
</style>

<script type="text/javascript">
// <![CDATA[
function insert(form,field,auswahltxt) {
if (parent.opener.document.forms[form].elements[field].createTextRange) {
parent.opener.document.forms[form].elements[field].focus();
parent.opener.document.forms[form].elements[field].select();
parent.opener.document.selection.createRange().duplicate().text = auswahltxt;
} else if ((typeof parent.opener.document.forms[form].elements[field].selectionStart) != 'undefined') { // fr Mozilla
var tarea = parent.opener.document.forms[form].elements[field];
tarea.focus();
tarea.select();
tarea.value = auswahltxt;
} else {
parent.opener.document.forms[form].elements[field].focus();
parent.opener.document.forms[form].elements[field].select();
parent.opener.document.forms[form].elements[field].value += auswahltxt;
}
window.close();
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
 function list_fonts($dir= 'fonts/',$type='ttf') {
    $x = 0;
    foreach (glob($dir."*.".$type) as $font_file)    {
        $fontfile[$x]['file'] = $font_file;
        $x++;
    } 
    
    return $fontfile;
}

$pic = list_fonts();

for($x=0;$x<count($pic);$x++) {
    
    $fontsfile = $pic[$x]['file']; 
    $fontsfile = str_replace('fonts/', '', $fontsfile);
	$fontsname = str_replace('.ttf', '', $fontsfile);

echo '<option value="' . $fontsfile . '">' . $fontsfile . '</option>';	

}



// Advanced Attach Watermark / 4seven / 2010

?>
</select>
&nbsp;
<input type="submit" id="submit_id" onmouseover="javascript:replaceButtonText('submit_id', document.getElementsByName('ttfselect')[0].value + ' >>')" onclick="insert('acp_watermark','config[watermark_text_font]', document.getElementsByName('ttfselect')[0].value )" value="Font >>" />
<br /><br />
<input type="submit" value="Close" id="submit_close" onclick="window.close()" />
</div>
</fieldset>
</body>
</html>