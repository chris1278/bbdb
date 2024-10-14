<?php
/**
 *
 * Bbcode Demo Databas. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, Chris1278
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

/**
* DO NOT CHANGE
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//  „ “

$lang = array_merge($lang, [
	'CB_BBDB_LINK'					=> 'BBcode Demo Datenbank.',
	'CB_BBDB_LIST'					=> 'Auflistung BBcodes aus der BBcode Demo Datenbank',
	'CB_BBCB_INDEX'					=> 'BBCode Übersicht',
	'CB_BBCB_INDEX_EXPLAIN'			=> 'BBCode ist eine spezielle HTML-Implementierung, die eine größere Kontrolle über das, was angezeigt wird, bietet.<br>Hier entsteht eine Sammlung von BBCodes',
	'CB_BBCODE_TITEL'				=> 'BBcode Titel',
	'CB_BBCODE_DESCRIPTION'			=> 'BBcode Kurzbeschreibung',
	'CB_BBCODE_SHOW'				=> 'Informationen zum BBcode öffnen',
	'CB_BBCB_LONG_DESC'				=> 'Beschreibung',
	'CB_BBCODE_MATCH_DESC'			=> 'BBcode Benutzung',
	'CB_BBCODE_TPL_DESC'			=> 'HTML-Ersetzung',
	'CB_BBCODE_DEMO'				=> 'Vorschau des BBcodes',
	'CB_NO_BBCODES'					=> 'Keine BBcodes eingetragen',
]);