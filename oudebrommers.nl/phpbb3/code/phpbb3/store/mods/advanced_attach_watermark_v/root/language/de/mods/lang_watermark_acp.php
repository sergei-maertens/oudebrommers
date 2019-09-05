<?php
/**
*
* lang_watermark_acp[Deutsch]
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
	'WATERMARK_MAIN_CONFIG_EXPLAIN'           => 'Grundeinstellungen',
	#
	'WATERMARK_MAIN_CONFIG_1'                 => 'Haupt Watermark Einstellungen',
	'ACP_WATERMARK_ON_OFF'                    => 'Attachment Watermark Funktion',
    'ACP_WATERMARK_ON_OFF_EXPLAIN'            => 'Einschalten der Watermark Funktion für Attachment Pics.<br />____________<br /><br />Zur Aktivierung müssen folgende Funktionen Off sein:<br /> "Attachment Resize Funktion only", "Attachment Resize Funktion", "Konvertier Funktion [img] only" und Konvertier Funktion [img_higslide] only".<br /><br />Kann mit folgenden Funktionen kombiniert werden:<br /> "Konvertier Funktion [img]" und "Konvertier Funktion [img_higslide]"',
	'ACP_WATERMARK_BACKUP_ON_OFF'             => 'Backup Funktion',	
	'ACP_WATERMARK_BACKUP_ON_OFF_EXPLAIN'     => 'Sicherung der Original Pics und Thumbs.<br />Gilt nur für Attachment Watermark Funktion.',
	'ACP_WATERMARK_TYPE'                      => 'Watermark Typ',
	'ACP_WATERMARK_TYPE_EXPLAIN'              => 'Optionen: <strong>text</strong> oder <strong>image</strong>',
	'ACP_WATERMARK_OUTPUT_QUALITY'            => 'JPG Ausgabe-Qualität',
	'ACP_WATERMARK_OUTPUT_QUALITY_EXPLAIN'    => 'In Prozent: 0 - 100 / Standard: 100',
	#
	'WATERMARK_MAIN_CONFIG_4'                 => 'Bild Watermark Einstellungen',
	//
	'ACP_WATERMARK_IMG_SZ_PROC'               => 'Watermark Verhältnisgröße',
	'ACP_WATERMARK_IMG_SZ_PROC_EXPLAIN'       => 'In Prozent: 20 - 90 / Standard: 50.<br />Das Verhältnis zwischen Original- und Watermarkgröße. Werte unter 20 oder über 90 sind nicht sinnvoll.',
	'ACP_WATERMARK_IMG_MAX_SIZE'              => 'Maximale Größe des Original Pics',
	'ACP_WATERMARK_IMG_MAX_SIZE_EXPLAIN'      => 'Den Wert wie folgt eintragen (Beispiel):  <strong>1800x1200</strong><br /><br />Über der angegebenen Größe ist ein Watermarking nicht möglich. In dem Falle erscheint eine Meldung, daß der User sein Pic verkleinern soll.<br /><br />Die maximale Größe des Original Pics muss manuell durch testen ermittelt werden. Wird die virtuelle Speicherzuweisung in der .htaccess angenommen, gelten folgende, ungefähren Max-Richtwerte: (memory_limit/Bildgröße: 24M/1200x1200 | 48M/2500x2500 | 128M/3500x3500 | 144M/4000x4000).<br /><br />Falls nicht, gilt das physikalische memory_limit.<br />Das augenblickliche memory_limit beträgt:<strong>' .  $memory_limit . '</strong><br />____________',		
	'ACP_WATERMARK_TRANSPARENCY'              => 'Watermark Image Transparenz',
	'ACP_WATERMARK_TRANSPARENCY_EXPLAIN'      => 'In Prozent: 0 - 100 / Standard: 50',
	#	
	'WATERMARK_MAIN_CONFIG_5'                 => 'Text Watermark Einstellungen',
	//
	'ACP_WATERMARK_TEXT'                      => 'Watermark Text',	
	'ACP_WATERMARK_TEXT_EXPLAIN'              => 'Trage einen kurzen Watermark Text ein.<br /><br />Note: Trägst Du <strong>user</strong> in das Feld ein,<br />ist der <strong>Globale AAW Username Modus</strong> aktiv:<br />"&copy; username, postdatum, zeit"<br />____________',	
	'ACP_WATERMARK_TEXT_SIZE'                 => 'Text Größe',
	'ACP_WATERMARK_TEXT_SIZE_EXPLAIN'         => 'Vernünftige Werte: ~ 30 - 60<br />Das Verhältnis zwischen Bild Breite und Text Größe.<br />Gilt für <strong>Watermark Text</strong>. Höhere Werte ergeben eine kleinere Textgröße',	
	'ACP_WATERMARK_TEXT_FONT'                 => 'Text Font',
	'ACP_WATERMARK_TEXT_FONT_EXPLAIN'         => 'zb. <strong>arial.ttf</strong> (nur klein-Schreibung).<br />Font-Datei in den Ordner "includes/watermark/fonts/" laden.<br /><br /><strong>Picker: </strong><a href="../includes/watermark/watermark_select_ttf.php" onclick="info_3(); return false;">Text Font wählen</a><br />____________',	
	'ACP_WATERMARK_TEXT_COLOR'                => 'Text Farbe',
	'ACP_WATERMARK_TEXT_COLOR_EXPLAIN'        => 'Hex: zb. <strong>000000</strong> (ohne <strong>#</strong>)<br />Dies ist die globale Text Farbe<br /><br /><strong>Picker: </strong><a href="style/acp_watermark_style_1.html" onclick="info_1(); return false;">Text Farbe wählen</a><br /><br />Aktiv: <span style="background-color:#' . $config['watermark_text_color'] . ';border:1px solid grey;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><br />____________',
	'ACP_WATERMARK_TEXT_TRANSPARENCY'         => 'Watermark Text Transparenz',
	'ACP_WATERMARK_TEXT_TRANSPARENCY_EXPLAIN' => 'In Werten: 0 - 100 / Standard: 50',
    'ACP_WATERMARK_TEXT_CUT'                  => 'Text Zeilenumbruch',
	'ACP_WATERMARK_TEXT_CUT_EXPLAIN'          => 'Zeilenumbruch nach <strong>x</strong> Zeichen. Leerzeichen werden mitgerechnet. Diese können auch zum formatieren benutzt werden.',
	'ACP_WATERMARK_TEXT_DEGREE'               => 'Text Grad (0&deg;-359&deg;)',
	'ACP_WATERMARK_TEXT_DEGREE_EXPLAIN'       => ' 0&deg; = Horizontal<br />45&deg; = Diagonal<br />90&deg; = Senkrecht<br /><br />Hinweis: Der <strong>Globale AAW Username Modus</strong> arbeitet nur mit <strong>0&deg;</strong>',
	#
	'WATERMARK_MAIN_CONFIG_6'                 => 'Globale AAW Username Modus Einstellungen',
	//	
	'ACP_WATERMARK_TEXT_RATIO'                => 'Textsize',
	'ACP_WATERMARK_TEXT_RATIO_EXPLAIN'        => 'Vernünftige Werte: ~ 36 - 50<br />Das Verhältnis zwischen Bild Breite und Text Größe im <strong>Globalen AAW Username Modus</strong>. Höhere Werte ergeben eine kleinere Textgröße. Gute Werte, um auch lange Usernamem korrekt darzustellen: 36-45', 
	'ACP_WATERMARK_SHA_TEXT_COLOR'            => 'Text Hintergrund Farbe',
	'ACP_WATERMARK_SHA_TEXT_COLOR_EXPLAIN'    => 'Hex: z.B. <strong>FFF000</strong> (ohne <strong>#</strong>)<br />Hinweis: Gilt nur für den <strong>Globalen AAW Username Modus</strong><br /><br /><strong>Picker: </strong><a href="style/acp_watermark_style_2.html" onclick="info_2(); return false;"> Text Hintergrund Farbe wählen</a><br /><br />Aktiv: <span style="background-color:#' . $config['watermark_text_sha_color'] . ';border:1px solid grey;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><br />____________',
	'ACP_WATERMARK_SHA_TEXT_POS'              => 'Text Hintergrund Farbe Transparenz',
	'ACP_WATERMARK_SHA_TEXT_POS_EXPLAIN'      => 'Werte: 0 - 100 / Standard: 75<br />Hinweis: Gilt nur für den <strong>Globalen AAW Username Modus</strong>',
	#
	'WATERMARK_MAIN_CONFIG_7'                 => 'AAW Username Modus und AAW Privat Modus Einstellungen',
	//
	'ACP_SPECIAL_ON_OFF'                      => 'AAW Username- and Private-Mode aktiv',
	'ACP_SPECIAL_ON_OFF_EXPLAIN'              => 'Schaltet "AAW Username Modus" und "AAW Private Modus" Ein/Aus',	
	'ACP_SPECIAL_GROUPS'                      => 'AAW Username- and Privat-Modus Gruppen',	
	'ACP_SPECIAL_GROUPS_EXPLAIN'              => 'Trage erlaubte Gruppen-Ids komma-getrennt ein: 12,18,23<br />Feld leer: Alle Gruppen erlaubt<br /><br /><strong>Picker: </strong><a href="../includes/watermark/watermark_select_group.php" onclick="info_4(); return false;">AAW Username- and Private-Modus Gruppen wählen</a>',	
	#
	'WATERMARK_MAIN_CONFIG_8'                 => 'Watermark Positionen',
	//
    'ACP_WATERMARK_POSITION'                  => 'Watermark Position',		
	'ACP_WATERMARK_POSITION_EXPLAIN'          => 'Optionen: <strong>TL</strong> - top left | <strong>TM</strong> - top middle | <strong>TR</strong> - top right | <strong>CL</strong> - center left | <strong>C</strong>  - center | <strong>CR</strong> - center right | <strong>BL</strong> - bottom left | <strong>BM</strong> - bottom middle | <strong>BR</strong> - bottom right<br /><br />Hinweis: Der <strong>Globale AAW Username Modus</strong> arbeitet nur mit TL, TM, TR, BL, BM und BR',
	#--
	'WATERMARK_SPECIALS_CONFIG'               => 'Specials',
	'WATERMARK_SPECIALS_CONFIG_EXPLAIN'       => 'Erweiterte Einstellungen',
	#
	'WATERMARK_SPECIALS_CONFIG_3'             => 'Resize only / Resize mit Watermark',
	//	
	'ACP_WATERMARK_RESIZE_ONLY'               => 'Attachment Resize Funktion only',	
	'ACP_WATERMARK_RESIZE_ONLY_EXPLAIN'       => 'Verkleinerung <strong>ohne</strong> Watermark Funktion.<br /><br />Die max. Bildgröße wird durch "Resize Breite (width)" bestimmt',
	'ACP_WATERMARK_RESIZE'                    => 'Attachment Resize Funktion',	
   'ACP_WATERMARK_RESIZE_EXPLAIN'             => 'Wie zuvor, nur <strong>mit</strong> Watermark Funktion.<br /><br />Die max. Bildgröße wird durch "Resize Breite (width)" bestimmt<br />____________<br /><br /><strong>Hinweis:</strong><br />Die Attachment Resize Funktionen schalten "Attachment Watermark Funktion", alle Konvertier Funktionen und Thumb Erstellung Off.',
	#
	'WATERMARK_SPECIALS_CONFIG_4'             => 'Konvertierung only / Konvertierung mit Watermark',
	//
	'ACP_WATERMARK_CONVERT_ONLY'              => 'Konvertier Funktion [img] only',
	'ACP_WATERMARK_CONVERT_ONLY_EXPLAIN'      => 'Das Bild wird in den Ordner "images/files/" kopiert und kann in das Posting mit [img]-Tags eingefügt werden.<br /><br />Die max. Bildgröße wird durch "Resize Breite (width)" bestimmt<br />',
	
	'ACP_WATERMARK_CONVERT'                   => 'Konvertier Funktion [img]',
	'ACP_WATERMARK_CONVERT_EXPLAIN'           => 'Wie zuvor, nur <strong>mit</strong> Watermark Funktion.',
	#	
	'WATERMARK_SPECIALS_CONFIG_5'             => 'Konvertierung High only / Konvertierung High mit Watermark',
	//
	'ACP_WATERMARK_CONVERT_HIGH_ONLY'         => 'Konvertier Funktion [img_higslide] only',
	'ACP_WATERMARK_CONVERT_HIGH_ONLY_EXPLAIN' => 'Wie "Konvertier Funktion [img] only" aber als Highslide-Generierung.<br /><br />Die max. Thumbgröße wird durch "Resize Breite (width)" bestimmt.',
	
	'ACP_WATERMARK_CONVERT_HIGH'              => 'Konvertier Funktion [img_higslide]',
	'ACP_WATERMARK_CONVERT_HIGH_EXPLAIN'      => 'Wie zuvor, nur <strong>mit</strong> Watermark Funktion.<br />____________<br /><br /><strong>Hinweis:</strong><br />Die "Konvertier Funktion [img] only" und "Konvertier Funktion [img_higslide] only" schaltet "Attachment Watermark Funktion" und "Attachment Resize Funktionen" Off.<br /><br />Die "Konvertier Funktion [img]" und "Konvertier Funktion [img_higslide]" kann mit der "Attachment Watermark Funktion" kombiniert werden.<br /><br />[img] und [img_highslide], sowie "[img] only" und "[img_highslide] only" können kombiniert werden; Nicht jedoch [img] und "[img_highslide] only" oder "[img] only" und [img_highslide].',
	#
	'WATERMARK_SPECIALS_CONFIG_6'             => 'Resize Breite',
	//
	'ACP_WATERMARK_RESIZE_WIDTH'              => 'Resize Breite (width)',	
	'ACP_WATERMARK_RESIZE_WIDTH_EXPLAIN'      => 'In <strong>px</strong>. Höhe (height) wird automatisch angepasst.<br />Im Konvertier Funktions Modus > Größe der Thumbs<br /><br />Stelle sicher, das folgende Einstellung aktiv ist: ACP > "Beiträge" > "Dateianhänge" > "Vorschaubild erstellen" [x] Ja [&nbsp;] Nein<br /><br />Tip: Wenn du die gleiche Breite unter ACP > "Beiträge" > "Dateianhänge" > "Maximale Größe der Vorschaubildern in Pixeln" einträgst, haben alle Bilder die gleiche Breite und das Forum sieht perfekt aus.',
	#
	'WATERMARK_SPECIALS_CONFIG_7'             => 'Afterward Watermark',
	//
	'ACP_WATERMARK_AFTERWARD_INITIAL'         => 'Nachträgliches Watermark einleiten',	
	'ACP_WATERMARK_AFTERWARD_INITIAL_EXPLAIN' => 'Beim aktivieren öffnet sich das Optionsfeld zum schrittweisen Watermarking Prozess',
	#--Orphaned
	'WATERMARK_SPECIALS_CONFIG_8'             => 'Verwaiste Datein Löschen: Die Funktion sollte wöchentlich ausgeführt werden.',
	//
	'ORPHANED_VIEW_AND_DELETE'                => 'Checken und löschen:',
	'ORPHANED_DELETE_DIRECT'                  => 'Direkt löschen:',		
	'ORPHANED_BACKUPS'                        => 'Backup Dateien',	
	'ORPHANED_CONVERTS'                       => 'Konvertier Dateien',
    'ORPHANED_POSTED'                         => 'Gepostete Dateien',	
	'ORPHANED_PHYSICAL'                       => 'Physikalische Dateien',	
	'ORPHANED_BACKUPED'                       => 'Backup Dateien',	
	'ORPHANED_MARKED'                         => 'Verwaiste Dateien (Zum löschen markiert)',	
	'ORPHANED_DO_DEL'                         => 'Verwaiste Dateien löschen',	
	'ORPHANED_DEL'                            => 'Verwaiste Dateien (gelöscht)',
	'ORPHANED_ACC_DEN'                        => 'ACCESS DENIED',
	
	#--Afterward Process
	
	'AFTERWARD_TITLE'              => 'Afterward Watermarking',
	'AFTERWARD_INITIAL_ACP_1'      => '<strong>Der Vorgang des nachträglichen Watermarking erfolgt in 3 Schritten:</strong><br />
	<br />1. Sicherung der Dateien nach files/convert/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<br />2. Watermarking der Dateien und kopieren nach files/convert/ready/&nbsp;
	<br />3. Kopieren der fertigen Dateien aus files/convert/ready/ nach files/<br /><br />',

	  'STEP_START_00'              => '<strong>Watermarking Vorbereitung</strong>',
	  'STEP_START_01'              => 'Klick auf <a href="main_1.php">weiter</a>...<hr /><strong>Hinweis:</strong><br /> Es wird bei einer großen Anzahl von Bilder empfohlen, diesen Vorgang local mit zB. xampp, MoWeS durchzuführen.',
	
	 'STEP_0_FINISH'               => 'Die <strong>Sicherung</strong> findet ihr im Verzeichnis: files/convert/backup_',
 
	 'NO_BACKUP_DIR'               => '<strong>Es existiert kein Backup-Verzeichnis!</strong><br />
	 Erstelle via FTP den Ordner <strong>files/convert/backup</strong> und gebe ihm chmod <strong>777</strong><br /><strong>Einstellungen:</strong> "Unterverzeichnisse" einbeziehen und "Auf alle Dateien und Verzeichnisse anwenden"',

	'AFTERWARD_INITIAL_ACP_2'      => 'Nachträgliches Watermarking beginnen',	

	'AFTERWARD_TOP_1'              => '<p><strong>Nachträgliches Watermarking</strong></p>Die Dauer bis zum Abschluß der Prozesse kann bei einer grossen Anzahl von Bildern sehr lange dauern.<br/>Wird ein Prozess durch die max_execution_time unterbrochen, kann er hier wieder aufgenommen werden.<br />Fortführen: <a href="watermark_afterward_1.php" target="mainFrame">Schritt 1</a>  | <a href="watermark_afterward_2_jpg.php" target="mainFrame">Schritt 2 [JPG]</a> | <a href="watermark_afterward_2_gif.php" target="mainFrame">Schritt 2 [GIF]</a> | <a href="watermark_afterward_2_png.php" target="mainFrame">Schritt 2 [PNG]</a> | <a href="watermark_afterward_3.php" target="mainFrame">Schritt 3</a><br />Zur&uuml;ck zur <a href="watermark_afterward.php" target="mainFrame">Vorbereitung<a/> | Letztes Backup <a href="watermark_afterward_4.php" target="mainFrame">zurückspielen</a>',
	
   'AFTERWARD_MAIN_1'              => '<strong>1. Sicherung der Dateien</strong>
   <p>Nach dem Klick auf <a href="watermark_afterward_1.php" target="mainFrame">Schritt 1</a> bitte warten... <img src="ld1.gif" width="80" height="10" alt="" /></p>',

    'AFTERWARD_SAVE_JPG'           => 'Sicherung der JPG Dateien',
	'AFTERWARD_SAVE_PNG'           => 'Sicherung der PNG Dateien',
	'AFTERWARD_SAVE_GIF'           => 'Sicherung der GIF Dateien',
	'AFTERWARD_FILE_SUCCESS'       => 'erfolgreich.',
   
   	'AFTERWARD_SAVE_ATTACH'        => '<strong>Sicherung der Dateien</strong> erfolgreich',
    'STEP_2_JPG_START'             => '<br />Weiter mit: <strong>2. Watermarking der Dateien [JPG]</strong><p>Nach dem Klick auf <a href="watermark_afterward_2_jpg.php">Schritt 2 [JPG]</a> bitte warten... <img src="ld1.gif" width="80" height="10" alt="" /></p>',
	
	 'STEP_2_JPG_FINISH'           => '<strong>Watermarking der [JPG] Dateien</strong> erfolgreich',
	 'STEP_2_GIF_START'            => '<br />Weiter mit: <strong>2. Watermarking der Dateien [GIF]</strong><p>Nach dem Klick auf <a href="watermark_afterward_2_gif.php">Schritt 2 [GIF]</a> bitte warten... <img src="ld1.gif" width="80" height="10" alt="" /></p>',
	 
	 'STEP_2_GIF_FINISH'           => '<strong>Watermarking der [GIF] Dateien</strong> erfolgreich',
	 'STEP_2_PNG_START'            => '<br />Weiter mit: <strong>2. Watermarking der Dateien [PNG]</strong><p>Nach dem Klick auf <a href="watermark_afterward_2_png.php">Schritt 2 [PNG]</a> bitte warten... <img src="ld1.gif" width="80" height="10" alt="" /></p>',
	 
	 'STEP_2_PNG_FINISH'           => '<strong>Watermarking der [PNG] Dateien</strong> erfolgreich',
	 'STEP_3_COPY_START'           => '<br />Weiter mit: <strong>3. Kopieren der fertigen Dateien</strong><p>Nach dem Klick auf <a href="watermark_afterward_3.php">Schritt 3</a> bitte warten... <img src="ld1.gif" width="80" height="10" alt="" /></p>', 
	 
	 'STEP_3_FINISH'               => '<strong>Kopieren der fertigen Dateien</strong> erfolgreich',
	 'STEP_4_START'                => '<br /><strong>Kontrolliere nun das Ergebnis</strong><p>Dazu m&uuml;ssen alle Board-und Browsercaches geleert werden</p><p>Wichtig: Lasse dieses Fenster in jedem Falle geöffnet.</p><p>Solltest Du nicht zufrieden sein, spiele das <a href="watermark_afterward_4.php">Backup</a> zurück</p>',
	 
	 'STEP_4_FINISH'               => '<strong>Einspielen des Backups</strong> erfolgreich',	 
	 'STEP_5_START'                => '<br /><strong>Kontrolliere nun nochmal das Ergebnis</strong><p>Dazu m&uuml;ssen wiederum alle Board-und Browsercaches geleert werden</p>',
	 
	 
	 'AFTER_BACKUP_NOTICE'         => '<strong>Hinweis:</strong> Nicht mehr benötigte Backups sollten via FTP gelöscht werden.<br /> Soll dieser Prozess wiederholt werden, muss der Ordner "backup" erneut erstellt werden',

	));

?>