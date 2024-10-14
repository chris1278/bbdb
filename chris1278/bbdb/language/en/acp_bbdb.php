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
	'ACP_BBDB_TITLE_EXPLAIN'					=> 'This is where the BBcodes that are displayed on the BBcode demo page are created. These BBcodes are not used for text input. BBcodes that are also used for text input in the forum must be created on the administration page provided for this purpose. This can be found <a href="%1$s"><b>>>>HERE<<<</b></a><br><br>BBcodes that are displayed as being used in the forum on the associated page can only be edited there, even if they are listed here.',
	'CB_BBCODE_TITLE'							=> 'BBcode Titel',
	'CB_BBCODE_SHORT_DESC'						=> 'Bbcode short description',
	'CB_BBCB_NEW_ADD'							=> 'The entry of the new BBcode was successfully entered into the demo database!',
	'CB_BBCB_EDIT_ADD'							=> 'The BBcode changes have been successfully entered into the demo database!',
	'CB_ADD_BBCODE'								=> 'Add BBcode',
	'CB_ACP_BBCODE_TITEL'						=> 'BBcode Titel',
	'CB_ACP_BBCODE_TITEL_EXPLAIN'				=> 'Here you can enter a title or a description which will be displayed in the list on the <b>BBcode Demo Index Page</b>.',
	'CB_BBCODE_USAGE'							=> 'BBCode usage',
	'CB_BBCODE_USAGE_EXPLAIN'					=> 'This is where you set how the BBCode is used. Replace variable inputs with the corresponding tokens (<a href="#down">see below</a>).<br><br><b style="color: black">Example:</b> <br><br>[highlight={COLOR}]{TEXT}[/highlight]<br><br>[font={SIMPLETEXT1}]{SIMPLETEXT2}[/font]<br><br>',
	'CB_HTML_REPLACEMENT'						=> 'HTML replacement',
	'CB_HTML_REPLACEMENT_EXPLAIN'				=> 'Here you can enter the standard HTML replacement. Don´t forget to use the tokens used above here!<br><br><b style="color: black">Example:</b> <br><br>&lt;span style="background-color: {COLOR};">{TEXT}&lt;/span> <br><br>&lt;span style="font-family: {SIMPLETEXT1};">{SIMPLETEXT2}&lt;/span>',
	'CB_SHORT_DESCRIPTION'						=> 'Short Description',
	'CB_SHORT_DESC_EXPLAIN'						=> 'A short description can be inserted here, which provides a first brief explanation of the BBcode on the <b>BBcode Demo Index Page</b>.',
	'CB_LONG_DESCRIPTION'						=> 'Detailed description of the BBcode',
	'CB_LONG_DESC_EXPLAIN'						=> 'Here you can enter text to describe the functionality of the BBcode as precisely as possible.',
	'CB_ACP_BBCODE_DEMO'						=> 'Demonstrations-Code',
	'CB_ACP_BBCODE_DEMO_EXPLAIN'				=> 'Here you can enter a complete HTML code which is displayed as a demo in the view page of the respective BBcode. <br><br><b>Example: </b><br><br> As an example, let´s take the Bbcode for the bold font. <br><br>The following is used for <span style="font-weight: bold;"> BBCode usage</span>: <b>[b]{TEXT}[/b]</b><br><br>The following is used for <span style="font-weight: bold;"> HTML replacement </span>: <b>' . htmlentities(htmlspecialchars_decode('<b>{TEXT}</b>', ENT_QUOTES), ENT_QUOTES) . '</b><br><br>Then the demo code which was also used for the HTML replacement must be the same. Only instead of the token or placeholder, the correct content. <br><br><b>Example of bold font: </b> <span style="color: forestgreen; font-weight: bold;">' . htmlentities(htmlspecialchars_decode('<b>Here is the text that should be printed in bold!</b>', ENT_QUOTES), ENT_QUOTES) . '</span>',

	//token liste
	'CB_TOKEN'				=> 'Token',
	'CB_TOKENS'				=> 'Tokens',
	'CB_TOKENS_EXPLAIN'		=> 'Tokens are placeholders for user input. The input will be validated only if it matches the corresponding definition. If needed, you can number them by adding a number as the last character between the braces, e.g. {TEXT1}, {TEXT2}.<br><br>Within the HTML replacement you can also use any language string present in your language/ directory like this: {L_<em>&lt;STRINGNAME&gt;</em>} where <em>&lt;STRINGNAME&gt;</em> is the name of the translated string you want to add. For example, {L_WROTE} will be displayed as “wrote” or its translation according to user’s locale.<br><br><strong>Please note that only tokens listed below are able to be used within custom BBCodes.</strong>',
	'CB_TOKEN_DEFINITION'	=> 'What can it be?',

	'cb_tokens'		=>	[
		'TEXT'			=> 'Any text, including foreign characters, numbers, etc…',
		'SIMPLETEXT'	=> 'Characters from the latin alphabet (A-Z), numbers, spaces, commas, dots, minus, plus, hyphen and underscore',
		'INTTEXT'		=> 'Unicode letter characters, numbers, spaces, commas, dots, minus, plus, hyphen, underscore and whitespaces.',
		'IDENTIFIER'	=> 'Characters from the latin alphabet (A-Z), numbers, hyphen and underscore',
		'NUMBER'		=> 'Any series of digits',
		'EMAIL'			=> 'A valid email address',
		'URL'			=> 'A valid URL using any allowed protocol (http, ftp, etc… cannot be used for javascript exploits). If none is given, “http://” is prefixed to the string.',
		'LOCAL_URL'		=> 'A local URL. The URL must be relative to the topic page and cannot contain a server name or protocol, as links are prefixed with “%s”',
		'RELATIVE_URL'	=> 'A relative URL. You can use this to match parts of a URL, but be careful: a full URL is a valid relative URL. When you want to use relative URLs of your board, use the LOCAL_URL token.',
		'COLOR'			=> 'A HTML colour, can be either in the numeric form <samp>#FF1234</samp> or a <a href="http://www.w3.org/TR/CSS21/syndata.html#value-def-color">CSS colour keyword</a> such as <samp>fuchsia</samp> or <samp>InactiveBorder</samp>',
		'ALNUM'			=> 'Characters from the latin alphabet (A-Z) and numbers.',
		'CHOICE'		=> 'A choice of specified values, e.g. <samp>{CHOICE=spades,hearts,diamonds,clubs}</samp>. The values are treated as case-insensitive by default and can be treated case-sensitive by specifying the <samp>caseSensitive</samp> option: <samp>{CHOICE=Spades,Hearts,Diamonds,Clubs;caseSensitive}</samp>',
		'FLOAT'			=> 'A decimal value, e.g. <samp>0.5</samp>.',
		'HASHMAP'		=> 'Maps strings to their replacement in the form <samp>{HASHMAP=string1:replacement1,string2:replacement2}</samp>. Case-sensitive. Preserves unknown values by default.',
		'INT'			=> 'An integer value, e.g. <samp>2</samp>.',
		'IP'			=> 'A valid IPv4 or IPv6 address.',
		'IPPORT'		=> 'A valid IPv4 or IPv6 address with port number.',
		'IPV4'			=> 'A valid IPv4 address.',
		'IPV6'			=> 'A valid IPv6 address.',
		'MAP'			=> 'Maps strings to their replacement in the form <samp>{MAP=string1:replacement1,string2:replacement2}</samp>. Case-insensitive. Preserves unknown values by default.',
		'RANGE'			=> 'Accepts an integer in the given range, e.g. <samp>{RANGE=-10,42}</samp>.',
		'REGEXP'		=> 'Validates its value against a given regexp, e.g. <samp>{REGEXP=/^foo\w+bar$/}</samp>.',
		'TIMESTAMP'		=> 'A timestamp such as <samp>1h30m10s</samp> which will be converted to a number of seconds. Also accepts a number.',
		'UINT'			=> 'An unsigned integer value. Same as <samp>{INT}</samp>, but rejects values less than 0.',
	],

	//bbcode event
	'CP_BBCODE_ORG_INFO'						=> 'Additional information for the extension „Bbcode Demo Database“',
	'CP_BBCODE_ORG_INFO_EXPLAIN'				=> 'Additional information can be entered here, provided that this BBCode can be seen in the list of demo BBCodes in addition to the fact that it can be used in the forum. <br><b>This information is optional</b>',
	'CB_BBCODE_F_SHOW'							=> 'Show BBCode in „Bbcode Demo Database“',
	'CB_BBCODE_F_SHOW_EXPLAIN'					=> 'Here you can decide whether this Bbcode should be displayed on the <b>“Bbcode Demo Database”</b> page or not.',
]);
