<?php
/**
 *
 * Bbcode Demo Databas. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, Chris1278
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace chris1278\bbdb\controller;

class main
{
	protected $template;
	protected $helper;
	protected $language;

	public function __construct(
		\phpbb\template\template $template,
		\phpbb\controller\helper $helper,
		\phpbb\language\language $language
	)
	{
		$this->template			= $template;
		$this->helper 			= $helper;
		$this->language 		= $language;
	}

	public function base()
	{
		//hier der befehl das alles auf standard gesetzt wird.

		$this->template->assign_block_vars('navlinks', [
			'FORUM_NAME'		=> $this->language->lang('CB_BBDB_LIST'),
			'U_VIEW_FORUM'		=> $this->helper->route('chris1278_bbdb'),
		]);

		$page	= 'bbdb_body.html';
		return $this->helper->render($page);
	}

	public function redirect()
	{
		redirect($this->helper->route('chris1278_bbdb'));
	}
}
