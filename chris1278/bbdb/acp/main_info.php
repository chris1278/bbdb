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

class main_info
{
	public function module()
	{
		return [
			'filename'	=> '\chris1278\bbdb\acp\main_module',
			'title'		=> 'ACP_BBDB_TITLE',
			'modes'		=> [
				'settings'	=> [
					'title'	=> 'ACP_BBDB_SETTINGS',
					'auth'	=> 'ext_chris1278/bbdb',
					'cat'	=> ['ACP_BBDB_TITLE'],
				],
			],
		];
	}
}
