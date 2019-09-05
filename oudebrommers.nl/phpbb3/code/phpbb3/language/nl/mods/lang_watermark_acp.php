<?php
/**
*
* lang_watermark_acp[English]
*
* @package language
* @version $Id: lang_watermark_acp.php 2010-05-28Z 23:32 4seven $
* @copyright (c) 2010 / 4seven
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
**/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

	global $config;
	
	$memory_limit = ini_get('memory_limit');

    $lang = array_merge($lang, array(

	#--
	'WATERMARK_MAIN_CONFIG'                   => 'Basics',
	'WATERMARK_MAIN_CONFIG_EXPLAIN'           => 'Main Configuration',
	#	
	'WATERMARK_MAIN_CONFIG_1'                 => 'Main Watermark Settings',
	//
	'ACP_WATERMARK_ON_OFF'                    => 'Attachment Watermark Function',
    'ACP_WATERMARK_ON_OFF_EXPLAIN'            => 'Turning On the Watermark Function for Attachment Pics.<br />____________<br /><br />To Activate the following Functions must be set to Off:<br /> "Attachment Resize Function only", "Attachment Resize Funktion", "Convert Function [img] only" and Convert Function [img_higslide] only".<br /><br />Can be combined with following Functions:<br /> "Convert Function [img]" and "Convert Function [img_higslide]"',
	'ACP_WATERMARK_BACKUP_ON_OFF'             => 'Backup Funktion',	
	'ACP_WATERMARK_BACKUP_ON_OFF_EXPLAIN'     => 'Backup The Original Pictures and Thumbs.<br />Avaible only when Attachment Watermark Function is turned On.',
	'ACP_WATERMARK_TYPE'                      => 'Watermark Type',
	'ACP_WATERMARK_TYPE_EXPLAIN'              => 'Options: <strong>text</strong> oder <strong>image</strong>',
	'ACP_WATERMARK_OUTPUT_QUALITY'            => 'JPG Quality Output',
	'ACP_WATERMARK_OUTPUT_QUALITY_EXPLAIN'    => 'In Procent: 0 - 100 / Standard: 100',
	#
	'WATERMARK_MAIN_CONFIG_4'                 => 'Image Watermark Settings',
	//
	'ACP_WATERMARK_IMG_SZ_PROC'               => 'Watermark Relation size',
	'ACP_WATERMARK_IMG_SZ_PROC_EXPLAIN'       => 'In Procent: 20 - 90 / Standard: 50.<br />Relation between Original- and Watermark-Size. Values under 20 or over 90 are not sensibly.',
	'ACP_WATERMARK_IMG_MAX_SIZE'              => 'Maximal Size for Original Pics',
	'ACP_WATERMARK_IMG_MAX_SIZE_EXPLAIN'      => 'Set the Value as follows (Example):  <strong>1800x1200</strong><br /><br />For higher values no Watermarking will take place. The User will be asked to resize pic(s) if wants a watermark.<br /><br />The maximal size of Original Pictures have to be manually tested. If the virtual memory allocation in .htacces will accepted, the following, approximate Max Values counts: (memory_limit/Picture Size: 24M/1200x1200 | 48M/2500x2500 | 128M/3500x3500 | 144M/4000x4000).<br /><br />If not, then physical memory_limit counts.<br />Your current memory_limit is:<strong>' .  $memory_limit . '</strong><br />____________',
	'ACP_WATERMARK_TRANSPARENCY'              => 'Watermark Image Transparency',
	'ACP_WATERMARK_TRANSPARENCY_EXPLAIN'      => 'Value: 0 - 100 / Standard: 50',
	#	
	'WATERMARK_MAIN_CONFIG_5'                 => 'Text Watermark Settings',
	//
	'ACP_WATERMARK_TEXT'                      => 'Watermark Text',	
	'ACP_WATERMARK_TEXT_EXPLAIN'              => 'Enter a short Watermark Text.<br /><br />Note: If you enter <strong>user</strong> in this field,<br />the <strong>Global AAW Username Mode</strong> takes effect:<br />"&copy; username, submitted @ date"<br />____________',
	'ACP_WATERMARK_TEXT_SIZE'                 => 'Text Size',
	'ACP_WATERMARK_TEXT_SIZE_EXPLAIN'         => 'Reasonable Values: ~ 30 - 60<br />The Relation between Width of Image and Textsize.<br />Counts for <strong>Watermark Text</strong>. Higher values give smaller Textsize',
	'ACP_WATERMARK_TEXT_FONT'                 => 'Text Font',
	'ACP_WATERMARK_TEXT_FONT_EXPLAIN'         => 'e.g. <strong>arial.ttf</strong> (only small letters).<br />Leave Font-Data in the folder "includes/watermark/fonts/"<br /><br /><strong>Picker: </strong><a href="../includes/watermark/watermark_select_ttf.php" onclick="info_3(); return false;">Choose Text Font</a><br />____________',
	'ACP_WATERMARK_TEXT_COLOR'                => 'Text Color',
	'ACP_WATERMARK_TEXT_COLOR_EXPLAIN'        => 'Hex: e.g. <strong>000000</strong> (without <strong>#</strong>)<br />This is the global Text Color<br /><br /><strong>Picker: </strong><a href="style/acp_watermark_style_1.html" onclick="info_1(); return false;">Choose Text Color</a><br /><br />Active: <span style="background-color:#' . $config['watermark_text_color'] . ';border:1px solid grey;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><br />____________',
	'ACP_WATERMARK_TEXT_TRANSPARENCY'         => 'Watermark Text Transparency',
	'ACP_WATERMARK_TEXT_TRANSPARENCY_EXPLAIN' => 'Value: 0 - 100 / Standard: 50',
	'ACP_WATERMARK_TEXT_CUT'                  => 'Text Word wrap',
	'ACP_WATERMARK_TEXT_CUT_EXPLAIN'          => 'Make Word wrap after <strong>x</strong> characters. Blanks included. Blanks can also be used for formatting.',
	'ACP_WATERMARK_TEXT_DEGREE'               => 'Text Degree (0&deg;-359&deg;)',
	'ACP_WATERMARK_TEXT_DEGREE_EXPLAIN'       => ' 0&deg; = Horizontal<br />45&deg; = Diagonal<br />90&deg; = Vertically<br /><br />Note: <strong>Global AAW Username Mode</strong> works only with <strong>0&deg;</strong>',
	#
	'WATERMARK_MAIN_CONFIG_6'                 => 'Global AAW Username Mode Settings',
	//
	'ACP_WATERMARK_TEXT_RATIO'                => 'Textsize',
	'ACP_WATERMARK_TEXT_RATIO_EXPLAIN'        => 'Reasonable Values: ~ 36 - 50<br />The Relation between Width of Image and Textsize in <strong>Global AAW Username Mode</strong>. Higher values give smaller Textsize. A good range to display long Usernames correctly: 36-45', 
	'ACP_WATERMARK_SHA_TEXT_COLOR'            => 'Text Background Color',
	'ACP_WATERMARK_SHA_TEXT_COLOR_EXPLAIN'    => 'Hex: e.g. <strong>FFF000</strong> (without <strong>#</strong>)<br />Note: Only for <strong>Global AAW Username Mode</strong><br /><br /><strong>Picker: </strong><a href="style/acp_watermark_style_2.html" onclick="info_2(); return false;">Choose Text Background Color</a><br /><br />Active: <span style="background-color:#' . $config['watermark_text_sha_color'] . ';border:1px solid grey;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><br />____________',
	'ACP_WATERMARK_SHA_TEXT_POS'              => 'Text Background Color Transparancy',
	'ACP_WATERMARK_SHA_TEXT_POS_EXPLAIN'      => 'Value: 0 - 100 / Standard: 75<br />Note: Only for <strong>Global AAW Username Mode</strong>',
	#
	'WATERMARK_MAIN_CONFIG_7'                 => 'AAW Username Mode and AAW Private Mode Settings',
	//
	'ACP_SPECIAL_ON_OFF'                      => 'AAW Username- and Private-Mode Active',
	'ACP_SPECIAL_ON_OFF_EXPLAIN'              => 'Turns "AAW Username Mode" and "AAW Private Mode" On/Off',	
	'ACP_SPECIAL_GROUPS'                      => 'AAW Username- and Private-Mode Groups',	
	'ACP_SPECIAL_GROUPS_EXPLAIN'              => 'Enter allowed Group-Ids comma-separated: 12,18,23<br />Field empty: All groups allowed<br /><br /><strong>Picker: </strong><a href="../includes/watermark/watermark_select_group.php" onclick="info_4(); return false;">Choose AAW Username- and Private-Mode Groups</a>',	
	#
	'WATERMARK_MAIN_CONFIG_8'                 => 'Watermark Positions',
	//
	'ACP_WATERMARK_POSITION'                  => 'Watermark Position',		
	'ACP_WATERMARK_POSITION_EXPLAIN'          => 'Options: <strong>TL</strong> - top left | <strong>TM</strong> - top middle | <strong>TR</strong> - top right | <strong>CL</strong> - center left | <strong>C</strong>  - center | <strong>CR</strong> - center right | <strong>BL</strong> - bottom left | <strong>BM</strong> - bottom middle | <strong>BR</strong> - bottom right<br /><br />Note: <strong>Global AAW Username Mode</strong> works only with TL, TM, TR, BL, BM and BR',	
	#--
	'WATERMARK_SPECIALS_CONFIG'               => 'Specials',
	'WATERMARK_SPECIALS_CONFIG_EXPLAIN'       => 'Extended Configuration',
	#
	'WATERMARK_SPECIALS_CONFIG_3'             => 'Resize only / Resize with Watermark',
	//
	'ACP_WATERMARK_RESIZE_ONLY'               => 'Attachment Resize Function only',	
	'ACP_WATERMARK_RESIZE_ONLY_EXPLAIN'       => 'Resize <strong>without</strong> Watermark Funktion.<br /><br />Max. Picture dimensions controlled by "Resize Width"',
	'ACP_WATERMARK_RESIZE'                    => 'Attachment Resize Function',	
    'ACP_WATERMARK_RESIZE_EXPLAIN'            => 'Like previous, but <strong>with</strong> Watermark Function.<br /><br />Max. Picture dimensions controlled by "Resize Width"<br />____________<br /><br /><strong>Hint:</strong><br />The Attachment Resize Functions turns "Attachment Watermark Function", all Convert Functions and Thumb Creation Off.',
	#
	'WATERMARK_SPECIALS_CONFIG_4'             => 'Convert only / Convert with Watermark',
	//
	'ACP_WATERMARK_CONVERT_ONLY'              => 'Convert Function [img] only',
	'ACP_WATERMARK_CONVERT_ONLY_EXPLAIN'      => 'The Picture will copy to folder "images/files/" and can be added in Posting with [img]-Tags .<br /><br />Max. Picture dimensions controlled by "Resize width"<br />',
	'ACP_WATERMARK_CONVERT'                   => 'Convert Function [img]',
	'ACP_WATERMARK_CONVERT_EXPLAIN'           => 'Like previous, but <strong>with</strong> Watermark Function.',
	#	
	'WATERMARK_SPECIALS_CONFIG_5'             => 'Convert High only / Convert High with Watermark',
	//
	'ACP_WATERMARK_CONVERT_HIGH_ONLY'         => 'Convert Function [img_higslide] only',
	'ACP_WATERMARK_CONVERT_HIGH_ONLY_EXPLAIN' => 'Like "Convert Function [img] only" but with Highslide.<br /><br />Max. Thumbnail dimensions controlled by "Resize width"',	
	'ACP_WATERMARK_CONVERT_HIGH'              => 'Convert Function [img_higslide]',
	'ACP_WATERMARK_CONVERT_HIGH_EXPLAIN'      => 'Like previous, but <strong>with</strong> Watermark Function.<br />____________<br /><br /><strong>Hint:</strong><br />The "Convert Function [img] only" and "Convert Function [img_higslide] only" will switch "Attachment Watermark Function" and "Attachment Resize Function" Off.<br /><br />"Convert Function [img]" and "Convert Function [img_higslide]" can be combined with "Attachment Watermark Function".<br /><br />The combination [img] and [img_highslide], and also "[img] only" and "[img_highslide] only" is possible; But not [img] and "[img_highslide] only" or "[img] only" and [img_highslide]',
	#
	'WATERMARK_SPECIALS_CONFIG_6'             => 'Resize Width',
	//
	'ACP_WATERMARK_RESIZE_WIDTH'              => 'Resize Width',	
	'ACP_WATERMARK_RESIZE_WIDTH_EXPLAIN'      => 'In <strong>px</strong>. Height automatically adjusted.<br />In Convert Functions Mode > Size of Thumbs<br /><br />Make shure u have following setting: Under ACP > "Posting" > "Attachment Settings" > "Create thumbnail" [x] Yes [&nbsp;] No<br /><br />Tip: When u enter the same width under ACP > "Posting" > "Attachment Settings" > "Maximum thumbnail width in pixel" then all images have the same fit and all looks perfect',
	#
	'WATERMARK_SPECIALS_CONFIG_7'             => 'Afterward Watermark',
	//
	'ACP_WATERMARK_AFTERWARD_INITIAL'         => 'Additional Watermark initiate',	
	'ACP_WATERMARK_AFTERWARD_INITIAL_EXPLAIN' => 'If activated, an Options field with gradual Watermarking Process opens',
	#--Orphaned
	'WATERMARK_SPECIALS_CONFIG_8'             => 'Delete Orphaned Files: You should execute this Function once a week',
	//
	'ORPHANED_VIEW_AND_DELETE'                => 'View and Delete:',
	'ORPHANED_DELETE_DIRECT'                  => 'Delete Directly:',
	'ORPHANED_BACKUPS'                        => 'Backup Files',	
	'ORPHANED_CONVERTS'                       => 'Convert Files',	
	
    'ORPHANED_POSTED'                         => 'Posted Files',	
	'ORPHANED_PHYSICAL'                       => 'Physikal Files',	
	'ORPHANED_BACKUPED'                       => 'Backup Files',	
	'ORPHANED_MARKED'                         => 'Orphaned Files (marked for deleting)',	
	'ORPHANED_DO_DEL'                         => 'Delete Orphaned Files',	
	'ORPHANED_DEL'                            => 'Orphaned Files (deleted)',	
	'ORPHANED_ACC_DEN'                        => 'ACCESS DENIED',
	
	#--Afterward Process
	
	'AFTERWARD_TITLE'              => 'Afterward Watermarking',
	'AFTERWARD_INITIAL_ACP_1'      => '<strong>The process of adding additional Watermark in 3 Steps:</strong><br />
	<br />1. Protection of Attachments to files/convert/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<br />2. Watermark the Attachments and copy to files/convert/ready/&nbsp;
	<br />3. Copy the Attachments from files/convert/ready/ to files/<br /><br />',

	  'STEP_START_00'              => '<strong>Watermarking Preparation</strong>',
	  'STEP_START_01'              => 'Click <a href="main_1.php">continue</a>...<hr /><strong>Hint:</strong><br />If your Board has a lot of huge pictures, it is highly recommended to use this local with e.g. xampp, MoWeS.',
	
	 'STEP_0_FINISH'               => 'The <strong>Protection</strong> list is placed in: files/convert/backup_',
 
	 'NO_BACKUP_DIR'               => '<strong>No Backup-Folder exist!</strong><br />
	  Create the following Folder via FTP: <strong>files/convert/backup</strong> and set chmod to: <strong>777</strong><br /><strong>Settings:</strong> "Subdirectories" included and "Used on all Data and Lists"',

	'AFTERWARD_INITIAL_ACP_2'      => 'The additional Watermarking begin',	

	'AFTERWARD_TOP_1'              => '<p><strong>Additional Watermarking</strong></p>If large number of pictures are processed, it will take some time.<br/>If Process stops during max_execution_time, it can be restarted here.<br />Continue: <a href="watermark_afterward_1.php" target="mainFrame">Step 1</a>  | <a href="watermark_afterward_2_jpg.php" target="mainFrame">Step 2 [JPG]</a> | <a href="watermark_afterward_2_gif.php" target="mainFrame">Step 2 [GIF]</a> | <a href="watermark_afterward_2_png.php" target="mainFrame">Step 2 [PNG]</a> | <a href="watermark_afterward_3.php" target="mainFrame">Step 3</a><br />Back to <a href="watermark_afterward.php" target="mainFrame">Preparation<a/> | Last Backup <a href="watermark_afterward_4.php" target="mainFrame">play back</a>',
	
   'AFTERWARD_MAIN_1'              => '<strong>1. Protection of Attachments</strong>
   <p>After Click on <a href="watermark_afterward_1.php" target="mainFrame">Step 1</a> please wait... <img src="ld1.gif" width="80" height="10" alt="" /></p>',

    'AFTERWARD_SAVE_JPG'           => 'Protection of JPG attachments',
	'AFTERWARD_SAVE_PNG'           => 'Protection of PNG attachments',
	'AFTERWARD_SAVE_GIF'           => 'Protection of GIF attachments',
	'AFTERWARD_FILE_SUCCESS'       => 'successfully.',
   
   	'AFTERWARD_SAVE_ATTACH'        => '<strong>Protection of Attachments</strong> successfully',
    'STEP_2_JPG_START'             => '<br />Continue: <strong>2. Watermarking Attachments [JPG]</strong><p>After Click on <a href="watermark_afterward_2_jpg.php">Step 2 [JPG]</a> please wait... <img src="ld1.gif" width="80" height="10" alt="" /></p>',
	
	 'STEP_2_JPG_FINISH'           => '<strong>Watermarking of [JPG] Attachments</strong> successfully',
	 'STEP_2_GIF_START'            => '<br />Continue: <strong>2. Watermarking Attachments [GIF]</strong><p>After Click on <a href="watermark_afterward_2_gif.php">Step 2 [GIF]</a> please wait... <img src="ld1.gif" width="80" height="10" alt="" /></p>',
	 
	 'STEP_2_GIF_FINISH'           => '<strong>Watermarking of [GIF] Attachments</strong> successfully',
	 'STEP_2_PNG_START'            => '<br />Continue: <strong>2. Watermarking Attachments [PNG]</strong><p>After Click on <a href="watermark_afterward_2_png.php">Step 2 [PNG]</a> please wait... <img src="ld1.gif" width="80" height="10" alt="" /></p>',
	 
	 'STEP_2_PNG_FINISH'           => '<strong>Watermarking of [PNG] Attachments</strong> successfully',
	 'STEP_3_COPY_START'           => '<br />Continue: <strong>3. Copy of done Attachments</strong><p>After Click on <a href="watermark_afterward_3.php">Step 3</a> please wait... <img src="ld1.gif" width="80" height="10" alt="" /></p>', 
	 
	 'STEP_3_FINISH'               => '<strong>Copy of done Attachments</strong> successfully',
	 'STEP_4_START'                => '<br /><strong>Check the Result</strong><p>All Board- and Browser-Caches must be purged before</p><p>Important: Let this window stay open.</p><p>If not satisfied, bring in
the <a href="watermark_afterward_4.php">Backup</a></p>',
	 
	 'STEP_4_FINISH'               => '<strong>Bring in the Backup</strong> successfully',	 
	 'STEP_5_START'                => '<br /><strong>Check the Result</strong><p>All Board- and Browser-Caches must be purged before</p>',
	 	 
	 'AFTER_BACKUP_NOTICE'         => '<strong>Hint:</strong> Unnecessary Backups should be deleted via FTP.<br /> If the process must repeated, then create the folder "backup" again',

	));

?>
