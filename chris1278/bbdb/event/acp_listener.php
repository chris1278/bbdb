<?php
/**
 *
 * Bbcode Demo Databas. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, Chris1278
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace chris1278\bbdb\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class acp_listener implements EventSubscriberInterface
{
	protected $template;
	protected $db;
	protected $request;
	protected $cb_bbcodelist;

	public function __construct(
		\phpbb\template\template $template,
		\phpbb\db\driver\driver_interface $db,
		\phpbb\request\request $request,
		$cb_bbcodelist
	)
	{
		$this->template			= $template;
		$this->db				= $db;
		$this->request 			= $request;
		$this->cb_bbcodelist	= $cb_bbcodelist;
	}

	public static function getSubscribedEvents()
	{
		return [
			'core.acp_bbcodes_modify_create'			=> 'bbcode_step_1',
			'core.acp_bbcodes_modify_create_after'		=> 'bbcode_step_2',
			'core.acp_bbcodes_edit_add'					=> 'read_info_for_edit',
		];
	}

	public function read_info_for_edit($event)
	{
		if ($event['action'] == 'edit')
		{
			$sql	= 'SELECT *
					   FROM ' . $this->cb_bbcodelist. '
					   WHERE ' . $this->db->sql_in_set('cb_bbcode_orig', $event['bbcode_id']);

			$result		= $this->db->sql_query($sql);
			$read_bbcode_info = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);

			if (!empty($read_bbcode_info['cb_bbcode_f_show']))
			{
				if ($read_bbcode_info['cb_bbcode_f_show'] == 1)
				{
					$show_bbcode	= true;
				}
				else
				{
					$show_bbcode	= false;
				}
			}
			else
			{
				$show_bbcode	= false;
			}

			$this->template->assign_vars([
				'CB_BBCODE_F_SHOW'			=> $show_bbcode,
				'CB_BBCODE_TITEL'			=> (!empty($read_bbcode_info['cb_bbcode_titel'])) ? $read_bbcode_info['cb_bbcode_titel'] : '',
				'CB_SHORT_DESC'				=> (!empty($read_bbcode_info['cb_bbcode_short_description'])) ? $read_bbcode_info['cb_bbcode_short_description'] : '',
				'CB_LONG_DESC'				=> (!empty($read_bbcode_info['cb_bbcode_long_description'])) ? $read_bbcode_info['cb_bbcode_long_description'] : '',
				'CB_BBCODE_DEMO'			=> (!empty($read_bbcode_info['cb_bbcode_demo'])) ? $read_bbcode_info['cb_bbcode_demo'] : '',
			]);
		}
	}

	public function bbcode_step_1($event)
	{
		$bbcode_input = [
			'bbcode_match'					=> $event['bbcode_match'],
			'bbcode_tpl'					=> htmlentities($event['bbcode_tpl'], ENT_QUOTES),
			'cb_bbcode_f_show'				=> $this->request->variable('cb_bbcode_f_show', '', true),
			'cb_bbcode_titel'				=> $this->request->variable('cb_bbcode_titel', '', true),
			'cb_bbcode_short_description'	=> $this->request->variable('cb_bbcode_short_description', '', true),
			'cb_bbcode_long_description'	=> $this->request->variable('cb_bbcode_long_description', '', true),
			'cb_bbcode_demo'				=> $this->request->variable('cb_bbcode_demo', '', true),
		];

		$this->bbcode_step_1 = $bbcode_input;
	}

	public function bbcode_step_2($event)
	{
		$bbcode_db_input	= [
			'cb_bbcode_orig'				=> $event['bbcode_id'],
			'cb_bbcode_match'				=> $this->bbcode_step_1['bbcode_match'],
			'cb_bbcode_tpl'					=> $this->bbcode_step_1['bbcode_tpl'],
			'cb_bbcode_f_aktiv'				=> 1,
			'cb_bbcode_titel'				=> $this->bbcode_step_1['cb_bbcode_titel'],
			'cb_bbcode_short_description'	=> $this->bbcode_step_1['cb_bbcode_short_description'],
			'cb_bbcode_long_description'	=> $this->bbcode_step_1['cb_bbcode_long_description'],
			'cb_bbcode_demo'				=> $this->bbcode_step_1['cb_bbcode_demo'],
			'cb_bbcode_f_show'				=> $this->bbcode_step_1['cb_bbcode_f_show'],
			'cb_bbcode_mode'				=> $event['action'],

		];

		$this->insert_demo_db($bbcode_db_input);
	}

	public function insert_demo_db($bbcode_db_input)
	{
		$sql	= 'SELECT *
				   FROM ' . $this->cb_bbcodelist. '
				   WHERE ' . $this->db->sql_in_set('cb_bbcode_orig', $bbcode_db_input['cb_bbcode_orig']);

		$result		= $this->db->sql_query($sql);

		$read_bbcode_info = $this->db->sql_fetchrow($result);

		$this->db->sql_freeresult($result);

		if (!$read_bbcode_info || $bbcode_db_input['cb_bbcode_mode'] == 'create')
		{
			$insert_sql = [
				'id'							=> 0,
				'cb_bbcode_orig'				=> $bbcode_db_input['cb_bbcode_orig'],
				'cb_bbcode_f_aktiv'				=> $bbcode_db_input['cb_bbcode_f_aktiv'],
				'cb_bbcode_f_show'				=> $bbcode_db_input['cb_bbcode_f_show'],
				'cb_bbcode_titel'				=> $bbcode_db_input['cb_bbcode_titel'],
				'cb_bbcode_match'				=> $bbcode_db_input['cb_bbcode_match'],
				'cb_bbcode_tpl'					=> $bbcode_db_input['cb_bbcode_tpl'],
				'cb_bbcode_short_description'	=> $bbcode_db_input['cb_bbcode_short_description'],
				'cb_bbcode_long_description'	=> $bbcode_db_input['cb_bbcode_long_description'],
				'cb_bbcode_demo'				=> $bbcode_db_input['cb_bbcode_demo'],
			];

			$this->db->sql_query('INSERT INTO ' . $this->cb_bbcodelist . ' ' . $this->db->sql_build_array('INSERT', $insert_sql));
		}
		else
		{
			$update_sql = [
				'cb_bbcode_orig'				=> $bbcode_db_input['cb_bbcode_orig'],
				'cb_bbcode_f_aktiv'				=> $bbcode_db_input['cb_bbcode_f_aktiv'],
				'cb_bbcode_f_show'				=> $bbcode_db_input['cb_bbcode_f_show'],
				'cb_bbcode_titel'				=> $bbcode_db_input['cb_bbcode_titel'],
				'cb_bbcode_match'				=> $bbcode_db_input['cb_bbcode_match'],
				'cb_bbcode_tpl'					=> html_entity_decode($bbcode_db_input['cb_bbcode_tpl'], ENT_QUOTES),
				'cb_bbcode_short_description'	=> $bbcode_db_input['cb_bbcode_short_description'],
				'cb_bbcode_long_description'	=> $bbcode_db_input['cb_bbcode_long_description'],
				'cb_bbcode_demo'				=> $bbcode_db_input['cb_bbcode_demo'],
			];

			$sql = 'UPDATE ' . $this->cb_bbcodelist . '
					SET ' . $this->db->sql_build_array('UPDATE', $update_sql) . '
					WHERE ' . $this->db->sql_in_set('cb_bbcode_orig', $bbcode_db_input['cb_bbcode_orig']);

			$sql	= $this->db->sql_query($sql);
		}

	}
}
