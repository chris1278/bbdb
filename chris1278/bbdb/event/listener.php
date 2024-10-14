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

class listener implements EventSubscriberInterface
{
	protected $template;
	protected $db;
	protected $language;
	protected $request;
	protected $auth;
	protected $helper;
	protected $cb_bbcodelist;

	public function __construct(
		\phpbb\template\template $template,
		\phpbb\db\driver\driver_interface $db,
		\phpbb\language\language $language,
		\phpbb\request\request $request,
		\phpbb\auth\auth $auth,
		\phpbb\controller\helper $helper,
		$cb_bbcodelist
	)
	{
		$this->template			= $template;
		$this->db				= $db;
		$this->language			= $language;
		$this->request 			= $request;
		$this->auth				= $auth;
		$this->helper			= $helper;
		$this->cb_bbcodelist	= $cb_bbcodelist;
	}

	public static function getSubscribedEvents()
	{
		return [
			'core.permissions'						=> 'cb_bbcb_permissions',
			'core.user_setup'						=> 'load_language_on_setup',
			'core.page_header'						=> 'add_cb_bbcb_page_header_link',
			'core.page_header_after'				=> 'bbcode_demo_db',
		];
	}

	public function bbcode_demo_db()
	{
		$action		= $this->request->variable('action', '');
		$bbcode_id	=  $this->request->variable('bbcdodenr', '');
		$boardurl	= generate_board_url();

		if (empty($bbcode_id) && empty($action))
		{
			$bbcode_index	= true;
			$bbcode_info	= '';
		}
		else
		{
			$bbcode_index	= false;
			$bbcode_info	= $this->read_bbcode_info($bbcode_id);
			$this->template->assign_vars([
				'CB_BBCODE_ID'					=> $bbcode_info['id'],
				'CB_BBCODE_TITEL'				=> $bbcode_info['cb_bbcode_titel'],
				'CB_BBCODE_MATCH'				=> $bbcode_info['cb_bbcode_match'],
				'CB_BBCODE_TPL'					=> htmlentities(htmlspecialchars_decode($bbcode_info['cb_bbcode_tpl'],  ENT_QUOTES),  ENT_QUOTES),
				'CB_BBCODE_DEMO'				=> htmlspecialchars_decode($bbcode_info['cb_bbcode_demo'], ENT_QUOTES),
				'CB_BBCODE_SHORT_DESCRIPTION'	=> $bbcode_info['cb_bbcode_short_description'],
				'CB_BBCODE_LONG_DESCRIPTION'	=> $bbcode_info['cb_bbcode_long_description'],
			]);
		}

		foreach ($this->read_bbcb_row() as $row)
		{
			$this->template->assign_block_vars('cb_bbcodes_list', [
				'CB_BBCODE_TITEL'					=> $row['cb_bbcode_titel'],
				'CB_BBCODE_SHORT_DESCRIPTION'		=> $row['cb_bbcode_short_description'],
				'CB_BBCODE_SHOW'					=> $row['cb_bbcode_f_show'],
				'U_BBCODE_VIEW' 					=> $boardurl . '/app.php/bbdb?action=view&amp;bbcdodenr=' . $row['id'],
			]);
		}
		$this->template->assign_vars([
			'BBCB_AUTH'						=> ($this->auth->acl_get('u_cb_bbcb_view')) ? true : false,
			'BBCB_INDEX'					=> $bbcode_index,
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

	public function read_bbcode_info($id)
	{
		$sql	= 'SELECT *
				   FROM ' . $this->cb_bbcodelist. '
				   WHERE ' . $this->db->sql_in_set('id', $id);

		$result		= $this->db->sql_query($sql);

		$read_bbcode_info = $this->db->sql_fetchrow($result);

		$this->db->sql_freeresult($result);

		return $read_bbcode_info;

	}

	public function cb_bbcb_permissions($event)
	{
		$permissions = $event['permissions'];
		$permissions += [
			'u_cb_bbcb_view'	=> [
			'lang'				=> 'ACL_U_CB_BBCB_VIEW',
			'cat'				=> 'misc'
			],
		];
		$event['permissions'] = $permissions;
	}

	public function load_language_on_setup($event)
	{
		$lang_set_ext	= $event['lang_set_ext'];
		$lang_set_ext[]	= [
			'ext_name'	=> 'chris1278/bbdb',
			'lang_set'	=> ['bbdb', 'acp_bbdb'],
		];

		$event['lang_set_ext'] = $lang_set_ext;
	}

	public function add_cb_bbcb_page_header_link()
	{
		$this->template->assign_vars([
			'U_CB_BBDB_LINK'		=> $this->helper->route('chris1278_bbdb'),
		]);
	}
}
