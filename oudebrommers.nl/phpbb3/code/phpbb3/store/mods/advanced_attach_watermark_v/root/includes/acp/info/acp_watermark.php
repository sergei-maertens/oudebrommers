<?php
/**
* @package module_install
*/
class acp_watermark_info
{
	function module()
	{		
		return array(
			'filename'	=> 'acp_watermark',
			'title'		=> 'WATERMARK_CONFIG',
			'version'	=> '0.1.4',
			
			'modes'		=> array(

			'watermark_main_config'	  => array('title' => 'WATERMARK_MAIN_CONFIG_TITLE', 'auth' => 'acl_a_board', 'cat' => array('ACP_WATERMARK_CONFIGURATION')),
			'watermark_specials_config'	  => array('title' => 'WATERMARKS_SPECIALS_CONFIG_TITLE', 'auth' => 'acl_a_board', 'cat' => array('ACP_WATERMARK_CONFIGURATION')),
			

			),
		);
	}

	function install()
	{
	}

	function uninstall()
	{
	}
}
?>