<?php
/**
*
* @package acp
* @version $Id: acp_watermark.php Z 2010-05-26 12:13:38 4seven $
* @copyright (c) 2010 / 4seven
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package acp
*/
class acp_watermark
{
	var $u_action;
	var $new_config = array();

	function main($id, $mode)
	{
		global $db, $user, $auth, $template;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		$user->add_lang('mods/lang_watermark_acp');
		$this->tpl_name = 'acp_watermark';

		$action	= request_var('action', '');
		$submit = (isset($_POST['submit'])) ? true : false;

		$form_key = 'acp_watermark';
		add_form_key($form_key);

		/**
		*	Validation types are:
		*		string, int, bool,
		*		script_path (absolute path in url - beginning with / and no trailing slash),
		*		rpath (relative), rwpath (realtive, writable), path (relative path, but able to escape the root), wpath (writable)
		*/
		switch ($mode)
		{
			case 'watermark_main_config':		
                $display_vars =  array(
				
					'title'	  => 'WATERMARK_MAIN_CONFIG',
					'vars'	  => array(
					
					'legend1' => 'WATERMARK_MAIN_CONFIG_1',
					'watermark_on_off'	      => array('lang' => 'ACP_WATERMARK_ON_OFF', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true),
					'legend2' => '',	
					'watermark_backup_on_off'	  => array('lang' => 'ACP_WATERMARK_BACKUP_ON_OFF', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true),
			
					'legend3' => '',
					'watermark_type'	  => array('lang' => 'ACP_WATERMARK_TYPE', 'validate' => 'string',	'type' => 'text:50:255', 'explain' => true),
					'watermark_output_quality'	  => array('lang' => 'ACP_WATERMARK_OUTPUT_QUALITY', 'validate' => 'string',	'type' => 'text:50:255', 'explain' => true),
					'legend4' => 'WATERMARK_MAIN_CONFIG_4',
					'watermark_img_sz_proc'	  => array('lang' => 'ACP_WATERMARK_IMG_SZ_PROC', 'validate' => 'string',	'type' => 'text:50:255', 'explain' => true),
					'watermark_img_max_size'	  => array('lang' => 'ACP_WATERMARK_IMG_MAX_SIZE', 'validate' => 'string',	'type' => 'text:50:255', 'explain' => true),
					'watermark_transparency'	  => array('lang' => 'ACP_WATERMARK_TRANSPARENCY', 'validate' => 'string',	'type' => 'text:50:255', 'explain' => true),
					
                    'legend5' => 'WATERMARK_MAIN_CONFIG_5',
					'watermark_text'	  => array('lang' => 'ACP_WATERMARK_TEXT', 'validate' => 'string',	'type' => 'text:50:255', 'explain' => true),
					'watermark_text_size'	  => array('lang' => 'ACP_WATERMARK_TEXT_SIZE', 'validate' => 'string',	'type' => 'text:50:255', 'explain' => true),
					'watermark_text_font'	  => array('lang' => 'ACP_WATERMARK_TEXT_FONT', 'validate' => 'string',	'type' => 'text:50:255', 'explain' => true),
					'watermark_text_color'	  => array('lang' => 'ACP_WATERMARK_TEXT_COLOR', 'validate' => 'string',	'type' => 'text:50:255', 'explain' => true),
					'watermark_text_transparency'	  => array('lang' => 'ACP_WATERMARK_TEXT_TRANSPARENCY', 'validate' => 'string',	'type' => 'text:50:255', 'explain' => true),					
					'watermark_text_cut'	  => array('lang' => 'ACP_WATERMARK_TEXT_CUT', 'validate' => 'string',	'type' => 'text:50:255', 'explain' => true),
					'watermark_text_degree'	  => array('lang' => 'ACP_WATERMARK_TEXT_DEGREE', 'validate' => 'string',	'type' => 'text:50:255', 'explain' => true),
					'legend6' => 'WATERMARK_MAIN_CONFIG_6',
					'watermark_text_ratio'	  => array('lang' => 'ACP_WATERMARK_TEXT_RATIO', 'validate' => 'string',	'type' => 'text:50:255', 'explain' => true),
					'watermark_text_sha_color'	  => array('lang' => 'ACP_WATERMARK_SHA_TEXT_COLOR', 'validate' => 'string',	'type' => 'text:50:255', 'explain' => true),
					'watermark_sha_text_pos'	  => array('lang' => 'ACP_WATERMARK_SHA_TEXT_POS', 'validate' => 'string',	'type' => 'text:50:255', 'explain' => true),
					'legend7' => 'WATERMARK_MAIN_CONFIG_7',
					'watermark_special_on_off'	 => array('lang' => 'ACP_SPECIAL_ON_OFF', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true),
					'watermark_special_groups'	  => array('lang' => 'ACP_SPECIAL_GROUPS', 'validate' => 'string',	'type' => 'text:50:255', 'explain' => true),
					'legend8' => 'WATERMARK_MAIN_CONFIG_8',
					
					'watermark_position'  => array('lang' => 'ACP_WATERMARK_POSITION', 'validate' => 'string',	'type' => 'text:50:255', 'explain' => true)
			
                       ));
					   
				break;	
				
			case 'watermark_specials_config':		
                $display_vars =  array(
				
					'title'	  => 'WATERMARK_SPECIALS_CONFIG',
					'vars'	  => array(
					
					'legend1' => 'WATERMARK_MAIN_CONFIG_1',
					'watermark_on_off'	      => array('lang' => 'ACP_WATERMARK_ON_OFF', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true),
					'legend2' => '',
					'watermark_backup_on_off'	  => array('lang' => 'ACP_WATERMARK_BACKUP_ON_OFF', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true),
					'legend3' => 'WATERMARK_SPECIALS_CONFIG_3',
					'watermark_resize_only'	  => array('lang' => 'ACP_WATERMARK_RESIZE_ONLY', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true),
					'watermark_resize'	  => array('lang' => 'ACP_WATERMARK_RESIZE', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true),
					'legend4' => 'WATERMARK_SPECIALS_CONFIG_4',					
					'watermark_convert_only'	  => array('lang' => 'ACP_WATERMARK_CONVERT_ONLY', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true),
					'watermark_convert'	  => array('lang' => 'ACP_WATERMARK_CONVERT', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true),
					'legend5' => 'WATERMARK_SPECIALS_CONFIG_5',					
					'watermark_convert_high_only'	  => array('lang' => 'ACP_WATERMARK_CONVERT_HIGH_ONLY', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true),
				   'watermark_convert_high'	  => array('lang' => 'ACP_WATERMARK_CONVERT_HIGH', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true),
					'legend6' => 'WATERMARK_SPECIALS_CONFIG_6',						
					'watermark_resize_width'	  => array('lang' => 'ACP_WATERMARK_RESIZE_WIDTH', 'validate' => 'string',	'type' => 'text:50:255', 'explain' => true),
					'legend7' => 'WATERMARK_SPECIALS_CONFIG_7',						
				   'watermark_afterward_initial'	  => array('lang' => 'ACP_WATERMARK_AFTERWARD_INITIAL', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true),	
					'legend8' => 'WATERMARK_SPECIALS_CONFIG_8'				   
			
                       )); 					   
			
			     break;
			
			// End Case
	
			default:
				trigger_error('NO_MODE', E_USER_ERROR);
			break;
		}
		
		  if ($mode == 'watermark_specials_config') {
		  
          $template->assign_var('S_WATERMARK_SPECIALS_TRUE', true);
		  
          }

 
		if (isset($display_vars['lang']))
		{
			$user->add_lang($display_vars['lang']);
		}

		$this->new_config = $config;
		$cfg_array = (isset($_REQUEST['config'])) ? utf8_normalize_nfc(request_var('config', array('' => ''), true)) : $this->new_config;
		$error = array();

		// We validate the complete config if whished
		validate_config_vars($display_vars['vars'], $cfg_array, $error);

		if ($submit && !check_form_key($form_key))
		{
			$error[] = $user->lang['FORM_INVALID'];
		}
		// Do not write values if there is an error
		if (sizeof($error))
		{
			$submit = false;
		}

		// We go through the display_vars to make sure no one is trying to set variables he/she is not allowed to...
		foreach ($display_vars['vars'] as $config_name => $null)
		{
			if (!isset($cfg_array[$config_name]) || strpos($config_name, 'legend') !== false)
			{
				continue;
			}

			if ($config_name == 'auth_method')
			{
				continue;
			}

			$this->new_config[$config_name] = $config_value = $cfg_array[$config_name];
	
			if ($submit)
			{

        set_config($config_name, $config_value);

		
		// Watermark resize without Watermark
		if($config['watermark_resize'] == 1){
        set_config('watermark_on_off', 0);
		set_config('watermark_resize_only', 0);
		set_config('watermark_convert', 0);
		set_config('watermark_convert_only', 0);
		set_config('watermark_convert_high', 0);
		set_config('watermark_convert_high_only', 0);}
		
		// Watermark resize  with Watermark		
		if($config['watermark_resize_only'] == 1){
        set_config('watermark_on_off', 0);
		set_config('watermark_resize', 0);
		set_config('watermark_convert', 0);
		set_config('watermark_convert_only', 0);
		set_config('watermark_convert_high', 0);
		set_config('watermark_convert_high_only', 0);}

        // [img] and [highslide] without Watermark	
		if(($config['watermark_convert_only'] == 1)
		|| ($config['watermark_convert_high_only'] == 1)){
        set_config('watermark_on_off', 0);
		set_config('watermark_resize', 0);
		set_config('watermark_resize_only', 0);
		set_config('watermark_convert', 0);
		set_config('watermark_convert_high', 0);}
	
        // [img] and [highslide] with Watermark		
		if(($config['watermark_convert'] == 1)
		|| ($config['watermark_convert_high'] == 1)){
	    // set_config('watermark_on_off', 0);  // test
		set_config('watermark_resize', 0);
		set_config('watermark_resize_only', 0);
		set_config('watermark_convert_only', 0);
		set_config('watermark_convert_high_only', 0);}
		
		// afterward initial mode	
		if($config['watermark_afterward_initial'] == 1){
		set_config('watermark_resize', 0);
		set_config('watermark_resize_only', 0);
		set_config('watermark_convert', 0);
		set_config('watermark_convert_only', 0);
		set_config('watermark_convert_high', 0);
		set_config('watermark_convert_high_only', 0);
		set_config('watermark_on_off', 1);
		set_config('watermark_backup_on_off', 1);}	
		
	
		}
   }

		// Back 2 Admin (+ Admin Log)
		
		if ($submit)
		{
			add_log('admin', 'LOG_CONFIG_' . strtoupper($mode));

			trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
	
		}
	
		$this->tpl_name = 'acp_watermark';
		$this->page_title = $display_vars['title'];

		$template->assign_vars(array(
		
		
        'S_AFTERWARD_INITIAL'	=> $config['watermark_afterward_initial'] ? true : false,

		

	
           	'L_TITLE'			=> $user->lang[$display_vars['title']],
			'L_TITLE_EXPLAIN'	=> $user->lang[$display_vars['title'] . '_EXPLAIN'],

			'S_ERROR'			=> (sizeof($error)) ? true : false,
			'ERROR_MSG'			=> implode('<br />', $error),

			'U_ACTION'			=> $this->u_action)
		);
	
		// Output relevant page
		
		
		foreach ($display_vars['vars'] as $config_key => $vars)
		{
			if (!is_array($vars) && strpos($config_key, 'legend') === false)
			{
				continue;
			}

			if (strpos($config_key, 'legend') !== false)
			{
				$template->assign_block_vars('options', array(
					'S_LEGEND'		=> true,
					'LEGEND'		=> (isset($user->lang[$vars])) ? $user->lang[$vars] : $vars)
				);

				continue;
			}

			$type = explode(':', $vars['type']);

			$l_explain = '';
			if ($vars['explain'] && isset($vars['lang_explain']))
			{
				$l_explain = (isset($user->lang[$vars['lang_explain']])) ? $user->lang[$vars['lang_explain']] : $vars['lang_explain'];
			}
			else if ($vars['explain'])
			{
				$l_explain = (isset($user->lang[$vars['lang'] . '_EXPLAIN'])) ? $user->lang[$vars['lang'] . '_EXPLAIN'] : '';
			}
			
			$content = build_cfg_template($type, $config_key, $this->new_config, $config_key, $vars);
			
			if (empty($content))
			{
				continue;
			}
			
			$template->assign_block_vars('options', array(
			
				'KEY'			        => $config_key,
				'TITLE'			        => (isset($user->lang[$vars['lang']])) ? $user->lang[$vars['lang']] : $vars['lang'],
				'S_EXPLAIN'		        => $vars['explain'],
				'TITLE_EXPLAIN'	        => $l_explain,
				'CONTENT'		        => build_cfg_template($type, $config_key, $this->new_config, $config_key, $vars),
				
				)
			);

			unset($display_vars['vars'][$config_key]);
		}
		
	}
	
}

?>