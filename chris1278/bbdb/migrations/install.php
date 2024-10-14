<?php
/**
 *
 * Bbcode Demo Databas. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, Chris1278
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace chris1278\bbdb\migrations;

class install extends \phpbb\db\migration\migration
{
	public static function depends_on()
	{
		return ['\phpbb\db\migration\data\v320\v320'];
		//return ['\phpbb\db\migration\data\v330\v330'];

	}

	public function update_schema()
	{
		return [
			'add_tables' => [
				$this->table_prefix . 'chris1278_bbdb ' => [
					'COLUMNS' => [
						'id'							=> ['UINT', null, 'auto_increment'],
						'cb_bbcode_orig'				=> ['USINT'			, 0],
						'cb_bbcode_f_aktiv'				=> ['UINT'			, 0],
						'cb_bbcode_f_show'				=> ['UINT'			, 0],
						'cb_bbcode_titel'				=> ['VCHAR'			, ''],
						'cb_bbcode_match'				=> ['TEXT'			, ''],
						'cb_bbcode_tpl'					=> ['MTEXT_UNI'		, ''],
						'cb_bbcode_short_description'	=> ['TEXT'			, ''],
						'cb_bbcode_long_description'	=> ['TEXT'			, ''],
						'cb_bbcode_demo'				=> ['TEXT'		, ''],
					],
					'PRIMARY_KEY' => [
						'id',
					],
				],
			],
		];
	}

	public function update_data()
	{
		return [
			['module.add', [
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_BBDB_TITLE'
			]],
			['module.add', [
				'acp',
				'ACP_BBDB_TITLE', [
					'module_basename'	=> '\chris1278\bbdb\acp\main_module',
					'modes'				=> ['settings'],
				],
			]],
			['permission.add', ['u_cb_bbcb_view', true, 'u_']],
		];
	}

	public function revert_schema()
	{
		return [
			'drop_tables'	=> [
				$this->table_prefix . 'chris1278_bbdb',
			],
		];
	}
}
