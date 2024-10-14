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

class acp_controller
{
	protected $language;
	protected $request;
	protected $template;
	protected $db;
	protected $cb_bbcodelist;
	protected $root_path;
	protected $php_ext;

	public function __construct(
		\phpbb\language\language $language,
		\phpbb\request\request $request,
		\phpbb\template\template $template,
		\phpbb\db\driver\driver_interface $db,
		$cb_bbcodelist,
		$root_path,
		$php_ext
	)
	{
		$this->language						= $language;
		$this->request						= $request;
		$this->template						= $template;
		$this->db							= $db;
		$this->cb_bbcodelist				= $cb_bbcodelist;
		$this->admin_path					= $root_path;
		$this->php_ext						= $php_ext;
	}

	public function display_option()
	{
		$formkey	= 'cb_bbcb';
		add_form_key($formkey);
		$modul_link	= append_sid("{$this->admin_path}adm/index.$this->php_ext", '&i=-chris1278-bbdb-acp-main_module');
		$if_cb_bbcb = false;
		foreach ($this->read_bbcb_row() as $row)
		{
			$this->template->assign_block_vars('cb_bbcodes', [
				'CB_BBCODE_TITEL'		=> $row['cb_bbcode_titel'],
				'CB_BBCODE_SHORT_DESC'	=> $row['cb_bbcode_short_description'],
				'CB_NO_EXT_EDIT'		=> $row['cb_bbcode_f_aktiv'],
				'CB_BBCODE_SHOW'		=> $row['cb_bbcode_f_show'],
				'U_NO_EXT_EDIT'			=> append_sid("{$this->admin_path}adm/index.$this->php_ext", '&i=acp_bbcodes&mode=bbcodes'),
				'U_CB_EDIT'				=> $modul_link . '&action=edit&bbcode=' . $row['id'],
				'U_CB_DELETE'			=> $modul_link . '&action=del&bbcode=' . $row['id'],
			]);
		}

		$mode = $this->request->variable('action', '');

		switch ($mode)
		{
			case 'add':
				$if_cb_bbcb = true;
				$errors = [];
				if ($this->request->is_set_post('submit'))
				{

					if (!check_form_key($formkey))
					{
						$errors[] = $this->language->lang('FORM_INVALID');
					}
					if (empty($errors))
					{
						$insert_sql = [
							'id'							=> 0,
							'cb_bbcode_f_aktiv'				=> 0,
							'cb_bbcode_orig'				=> 0,
							'cb_bbcode_f_show'				=> 1,
							'cb_bbcode_titel'				=> $this->request->variable('cb_bbcode_titel', '', true),
							'cb_bbcode_match'				=> $this->request->variable('cb_bbcode_match', '', true),
							'cb_bbcode_tpl'					=> html_entity_decode($this->request->variable('cb_bbcode_tpl', '', true), ENT_QUOTES),
							'cb_bbcode_short_description'	=> $this->request->variable('cb_bbcode_short_description', '', true),
							'cb_bbcode_long_description'	=> $this->request->variable('cb_bbcode_long_description', '', true),
							'cb_bbcode_demo'				=> $this->request->variable('cb_bbcode_demo', '', true),
						];

						$this->db->sql_query('INSERT INTO ' . $this->cb_bbcodelist . ' ' . $this->db->sql_build_array('INSERT', $insert_sql));
						trigger_error($this->language->lang('CB_BBCB_NEW_ADD')  . '<a href="' . $modul_link . '"><br><br>&laquo; ' . $this->language->lang('BACK_TO_PREV') . '</a>');
						$if_cb_bbcb = false;
					}
				}

				$s_errors = !empty($errors);

				$this->template->assign_vars([
					'BBCB_S_ERROR'								=> $s_errors,
					'BBCB_ERROR_MSG'							=> $s_errors ? implode('<br>', $errors) : '',
					'BBCODE_USAGE_EXPLAIN'						=> $this->language->lang('BBCODE_USAGE_EXPLAIN', '<a href="#down">', '</a>'),
				]);
			break;
			case 'edit':
				$if_cb_bbcb = true;
				$id	= $this->request->variable('bbcode', 0);
				$sql	= 'SELECT *
					FROM ' . $this->cb_bbcodelist. '
					WHERE ' . $this->db->sql_in_set('id', $id);

				$result		= $this->db->sql_query($sql);

				$cb_bbcodelist = $this->db->sql_fetchrow($result);

				$this->db->sql_freeresult($result);

				$errors = [];
				if ($this->request->is_set_post('submit'))
				{
					if (!check_form_key($formkey))
					{
						$errors[] = $this->language->lang('FORM_INVALID');
					}
					if (empty($errors))
					{
						$update_sql = [
							'cb_bbcode_titel'				=> $this->request->variable('cb_bbcode_titel', '', true),
							'cb_bbcode_match'				=> $this->request->variable('cb_bbcode_match', '', true),
							'cb_bbcode_tpl'					=> html_entity_decode($this->request->variable('cb_bbcode_tpl', '', true), ENT_QUOTES),
							'cb_bbcode_short_description'	=> $this->request->variable('cb_bbcode_short_description', '', true),
							'cb_bbcode_long_description'	=> $this->request->variable('cb_bbcode_long_description', '', true),
							'cb_bbcode_demo'				=> $this->request->variable('cb_bbcode_demo', '', true),
						];

						$sql = 'UPDATE ' . $this->cb_bbcodelist . '
								SET ' . $this->db->sql_build_array('UPDATE', $update_sql) . '
								WHERE ' . $this->db->sql_in_set('id', $id);

						$sql	= $this->db->sql_query($sql);
						trigger_error($this->language->lang('CB_BBCB_EDIT_ADD')  . '<a href="' . $modul_link . '"><br><br>&laquo; ' . $this->language->lang('BACK_TO_PREV') . '</a>');
						$if_cb_bbcb = false;
					}
				}

				$s_errors = !empty($errors);

				$this->template->assign_vars([
					'BBCB_S_ERROR'								=> $s_errors,
					'BBCB_ERROR_MSG'							=> $s_errors ? implode('<br>', $errors) : '',
					'BBCODE_USAGE_EXPLAIN'						=> $this->language->lang('BBCODE_USAGE_EXPLAIN', '<a href="#down">', '</a>'),
					'CB_BBCODE_TITEL'							=> $cb_bbcodelist['cb_bbcode_titel'],
					'CB_BBCODE_MATCH'							=> $cb_bbcodelist['cb_bbcode_match'],
					'CB_BBCODE_TPL'								=> $cb_bbcodelist['cb_bbcode_tpl'],
					'CB_SHORT_DESC'								=> $cb_bbcodelist['cb_bbcode_short_description'],
					'CB_LONG_DESC'								=> $cb_bbcodelist['cb_bbcode_long_description'],
					'CB_BBCODE_DEMO'							=> $cb_bbcodelist['cb_bbcode_demo'],
				]);
			break;
			case 'del':
				$id = $this->request->variable('bbcode', 0);
				$sql	= 'DELETE FROM ' . $this->cb_bbcodelist . '
						WHERE ' . $this->db->sql_in_set('id', $id);

				$sql	= $this->db->sql_query($sql);
			break;
		}

		$tokenrow 	= ['TEXT', 'SIMPLETEXT', 'INTTEXT', 'IDENTIFIER', 'NUMBER', 'EMAIL', 'URL', 'LOCAL_URL', 'RELATIVE_URL', 'COLOR', 'ALNUM', 'CHOICE', 'FLOAT', 'HASHMAP', 'INT', 'IP', 'IPPORT', 'IPV4', 'IPV6', 'MAP', 'RANGE', 'REGEXP', 'TIMESTAMP', 'UINT'];

		foreach ($tokenrow as $cb_token)
		{
			$this->template->assign_block_vars('cb_token', [
				'TOKEN'			=> '{' . $cb_token . '}',
				'EXPLAIN'	=> ($cb_token === 'LOCAL_URL') ? $this->language->lang(['cb_tokens', $cb_token], generate_board_url() . '/') : $this->language->lang(['cb_tokens', $cb_token]),
			]);
		}

		$this->template->assign_vars([
			'CB_BCBB'			=> $if_cb_bbcb,
			'BBCODE_ACP_LINK'	=> append_sid("{$this->admin_path}adm/index.$this->php_ext", '&i=acp_bbcodes&mode=bbcodes'),
			'U_CB_ADD'			=> $modul_link . '&action=add',
			'U_CB_BACK'			=> $modul_link,
		]);
	}

	public function read_bbcb_row()
	{
		$sql	= 'SELECT *
					FROM ' . $this->cb_bbcodelist . '
					ORDER BY id ASC;';

		$result	= $this->db->sql_query($sql);
		$read_bbcb_row = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		return $read_bbcb_row;
	}
}
