<?php
/**
 *
 * Bbcode Demo Databas. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, Chris1278
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace chris1278\bbdb\acp;

class main_module
{
	public $page_title;
	public $tpl_name;

	public function main($id, $mode)
	{
		global $phpbb_container;
		$acp_controller = $phpbb_container->get('chris1278.bbdb.controller.acp');
		$language = $phpbb_container->get('language');

		switch ($mode)
		{
			case 'settings':
				$this->page_title = $language->lang('ACP_BBDB_TITLE');
				$this->tpl_name = 'acp_bbdb';
				$acp_controller->display_option();
			break;
		}
	}
}
