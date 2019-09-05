<?php
/**
*
* @package watermark afterward
* @version $Id: watermark_afterward_1.php 2009-10-09 18:57:10Z 4seven $
* @copyright (c) 2009 4seven
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = '../../../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/lang_watermark_acp');


if ($auth->acl_get('a_'))
{

$backup_path_3 = $phpbb_root_path . 'files/convert/backup_' . $config['watermark_backup_microtime'];
	
if(file_exists($backup_path_3)){


function full_copy( $source, $target )
    {
        if ( is_dir( $source ) )
        {
            @mkdir( $target );
           
            $d = dir( $source );
           
            while ( FALSE !== ( $entry = $d->read() ) )
            {
                if ( $entry == '.' || $entry == '..' )
                {
                    continue;
                }
               
                $Entry = $source . '/' . $entry;           
                if ( is_dir( $Entry ) )
                {
							
					full_copy( $Entry, $target . '/' . $entry );
				
                    continue;
					
                }
				
				
				copy( $Entry, $target . '/' . $entry );
							
            }
           
            $d->close();
        }else
        {
            copy( $source, $target );
        }
    }

full_copy("$phpbb_root_path/files/convert/backup_" . $config['watermark_backup_microtime'], "$phpbb_root_path/files");


	 echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title></title>
</head>
<body style="background:#DDDFE3">
<hr />
' . utf8_decode($user->lang['STEP_4_FINISH']) . '
<hr />
' . utf8_decode($user->lang['STEP_5_START'])  . '
<hr />
' . utf8_decode($user->lang['AFTER_BACKUP_NOTICE'])  . '
<hr />
</body>
</html>';

}

else{
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title></title>
</head>
<body style="background:#DDDFE3">
<hr />
' . utf8_decode($user->lang['NO_BACKUP_DIR'])  . '
<hr />
</body>
</html>';
}

}

else{

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title></title>
</head>
<body style="background:#DDDFE3">
<hr />
<h2>' . utf8_decode($user->lang['ORPHANED_ACC_DEN'])  . '</h2>
<hr />
</body>
</html>';}

?>