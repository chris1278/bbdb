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
	'ACP_BBDB_TITLE_EXPLAIN'					=> 'Hier werden die BBcodes angelegt die auf der BBcode Demo Seite angezeigt werden. Diese BBcodes werden nicht bei in der Texteingabe verwendet. BBcodes die auch bei der Texteingabe im Forum genutzt werden sind bitte auf der dafür vorgesehenen Admininstrations Seite zu erstellen. Diese findet sich <a href="%1$s"><b>>>>HIER<<<</b></a><br><br>Bbcodes die welche als im Forum genutze über die dafür Zugehöhrige Seite angezeigt werden, können nur dort bearbeitet werden selbst wenn Sie hier aufgelistet sind.',
	'CB_BBCODE_TITLE'							=> 'BBcode Titel',
	'CB_BBCODE_SHORT_DESC'						=> 'Bbcode Kurzbeschreibung',
	'CB_BBCB_NEW_ADD'							=> 'Der Eintrag des neuen BBcode wurde erfolgreich in die Demo Datenbank eingetragen!',
	'CB_BBCB_EDIT_ADD'							=> 'Die Änderungen des BBcode wurde erfolgreich in die Demo Datenbank eingetragen!',
	'CB_ADD_BBCODE'								=> 'BBcode hinzufügen',
	'CB_ACP_BBCODE_TITEL'						=> 'BBcode Titel',
	'CB_ACP_BBCODE_TITEL_EXPLAIN'				=> 'Hier kann ein Titel oder eine Bezeichnung eingetragen werden welche auf der <b>BBcode Demo Index Seite</b> in der Liste angezeigt wird.',
	'CB_BBCODE_USAGE'							=> 'BBCode-Benutzung',
	'CB_BBCODE_USAGE_EXPLAIN'					=> 'Hier wird eingestellt, wie der BBCode benutzt wird. Ersetze variable Eingaben durch die entsprechenden Tokens (<a href="#down">siehe unten</a>).<br><br><b style="color: black">Beispiel:</b> <br><br>[highlight={COLOR}]{TEXT}[/highlight]<br><br>[font={SIMPLETEXT1}]{SIMPLETEXT2}[/font]<br><br>',
	'CB_HTML_REPLACEMENT'						=> 'HTML-Ersetzung',
	'CB_HTML_REPLACEMENT_EXPLAIN'				=> 'Hier kann man die Standard-HTML-Ersetzung eingeben. Vergiss nicht, die oben verwendeten Tokens hier einzusetzen!<br><br><b style="color: black">Beispiel:</b> <br><br>&lt;span style="background-color: {COLOR};">{TEXT}&lt;/span> <br><br>&lt;span style="font-family: {SIMPLETEXT1};">{SIMPLETEXT2}&lt;/span>',
	'CB_SHORT_DESCRIPTION'						=> 'Kurzbeschreibung',
	'CB_SHORT_DESC_EXPLAIN'						=> 'Hier kann eine kurze Beschreibung eingefügt werden, welche auf der <b>BBcode Demo Index Seite</b> eine erste kurze Erklärung zu dem BBcode liefert.',
	'CB_LONG_DESCRIPTION'						=> 'Ausführliche Beschreibung zu dem BBcode',
	'CB_LONG_DESC_EXPLAIN'						=> 'Hier kann ein Text eingegeben werden um die Funktionsweise des BBcodes so genau wie möglich zu Beschreiben.',
	'CB_ACP_BBCODE_DEMO'						=> 'Demonstrations-Code',
	'CB_ACP_BBCODE_DEMO_EXPLAIN'				=> 'Hier kann man einen Kompletten HTML Code eintragen was als Demo in der Ansichtsseite des jeweiligen BBcode´s angezeigt wird. <br><br><b>Beispiel: </b><br><br> Als Beispiel nehmen wir mal den Bbcode für die fettschrift. <br><br>Als <span style="font-weight: bold;"> BBCode-Benutzung</span> wird folgendes verwendet: <b>[b]{TEXT}[/b]</b><br><br> Als <span style="font-weight: bold;"> HTML-Ersetzung </span> wird folgendes verwendet: <b>' . htmlentities(htmlspecialchars_decode('<b>{TEXT}</b>',  ENT_QUOTES),  ENT_QUOTES) . '</b><br><br>Dann muss der Democode der Sein elcher auch bei der HTML-Ersetzung benutzt wurde. Nur anstelle des Tokens bzw. des Platzhalters dann der korrekte inhalt. <br><br><b>Beispiel für Fetschrift: </b> <span style="color: forestgreen; font-weight: bold;">' . htmlentities(htmlspecialchars_decode('<b>Hier dann der Text der in Fett ausgegeben werden soll!</b>',  ENT_QUOTES),  ENT_QUOTES) . '</span>',


	//token liste
	'CB_TOKENS'									=> 'TOKENS',
	'CB_TOKENS_EXPLAIN'							=> 'Tokens sind Platzhalter für Benutzereingaben. Die Eingabe wird nur überprüft, wenn sie der eingegebenen Definition entspricht. Wenn nötig, kannst du diese Platzhalter nummerieren, indem du eine Ziffer als letztes Zeichen zwischen den Klammern hinzufügst, z. B. {TEXT1}, {TEXT2}.<br><br>	Innerhalb der HTML-Ersetzung kannst du außerdem jede Sprachvariable, die im Verzeichnis language/ definiert ist, wie folgt benutzen: {L_<STRINGNAME>}, wobei <STRINGNAME> durch den Namen der Variablen mit dem übersetzten Text ersetzt wird. {L_WROTE} wird beispielsweise als „hat geschrieben“ oder dessen Entsprechung, je nach eingestellter Benutzersprache, angezeigt.<br><br><strong>Beachte, dass nur unten aufgelistete Tokens innerhalb benutzerdefinierter BBCodes verwendet werden können.</strong>',
	'CB_TOKEN'									=> 'TOKEN',
	'CB_TOKEN_DEFINITION'						=> 'Welche Werte sind möglich?',
	'cb_tokens'	=>	[
		'TEXT'			=> 'Jeder Text, einschließlich fremder Zeichen, Ziffern usw.',
		'SIMPLETEXT'	=> 'Zeichen des lateinischen Alphabets (A-Z), Ziffern, Leerzeichen, Komma, Punkt, Minus, Plus und Unterstrich',
		'INTTEXT'		=> 'Unicode-Buchstaben, Ziffern, Leerzeichen, Komma, Punkt, Minus, Plus, Bindestrich, Unterstrich und Leerräume.',
		'IDENTIFIER'	=> 'Zeichen des lateinischen Alphabets (A-Z), Ziffern, Bindestrich und Unterstrich',
		'NUMBER'		=> 'Ziffernfolgen',
		'EMAIL'			=> 'Eine gültige E-Mail-Adresse',
		'URL'			=> 'Eine gültige URL eines erlaubten Protokolls (http, ftp usw. — kann nicht für JavaScript-Exploits verwendet werden). Falls nicht angegeben, wird „http://“ vorangestellt.',
		'LOCAL_URL'		=> 'Eine lokale URL. Muss relativ zur Themenansicht angegeben werden. Protokoll und Domain darf nicht vorangestellt werden, da den Links „%s“ vorangestellt wird.',
		'RELATIVE_URL'	=> 'Eine relative URL. Kann verwendet werden, um Teile einer URL zu prüfen. Achtung: auch eine vollständige URL ist eine gültige relative URL. Wenn relative URLs zur Adresse des Boards verwendet werden sollen, sollte der LOCAL_URL-Token verwendet werden.',
		'COLOR'			=> 'Eine HTML-Farbe. Es kann entweder der hexadezimale Wert (z.&nbsp;B. <samp>#FF1234</samp>) oder ein <a href="http://www.w3.org/TR/CSS21/syndata.html#value-def-color">CSS-Farbwert</a> wie z.&nbsp;B. <samp>fuchsia</samp> oder <samp>InactiveBorder</samp> angegeben werden.',
		'ALNUM'			=> 'Lateinische Buchstaben (A-Z) und Ziffern.',
		'CHOICE'		=> 'Eine Auswahl von vorgegebenen Werten, z.B. <samp>{CHOICE=Pik,Herz,Karo,Kreuz}</samp>. Die Groß- und Kleinschreibung der Werte wird standardmäßig ignoriert. Die Groß- und Kleinschreibung kann beachtet werden, indem zusätzlich die Option <samp>caseSensitive</samp> angegeben wird: <samp>{CHOICE=Pik,Herz,Karo,Kreuz;caseSensitive}</samp>',
		'FLOAT'			=> 'Ein Dezimalwert, z.B. <samp>0.5</samp>.',
		'HASHMAP'		=> 'Verbindet Text mit seinem jeweiligen Ersatzwert in der Form <samp>{HASHMAP=Text1:Ersatzwert1,Text2:Ersatzwert2}</samp>. Groß- und Kleinschreibung wird beachtet. Unbekannte Werte werden standardmäßig beibehalten.',
		'INT'			=> 'Eine Ganzzahl, z.B. <samp>2</samp>.',
		'IP'			=> 'Eine gültige IPv4- oder IPv6-Adresse.',
		'IPPORT'		=> 'Eine gültige IPv4- oder IPv6-Adresse mit Port.',
		'IPV4'			=> 'Eine gültige IPv4-Adresse.',
		'IPV6'			=> 'Eine gültige IPv6-Adresse.',
		'MAP'			=> 'Verbindet Text mit seinem jeweiligen Ersatzwert in der Form <samp>{MAP=text1:ersatzwert1,text2:ersatzwert2}</samp>. Groß- und Kleinschreibung wird ignoriert. Unbekannte Werte werden standardmäßig beibehalten.',
		'RANGE'			=> 'Akzeptiert eine Ganzzahl im angegebenen Bereich, z.B. <samp>{RANGE=-10,42}</samp>.',
		'REGEXP'		=> 'Validiert den Wert mit dem angegebenen regulären Ausdruck, z.B. <samp>{REGEXP=/^foo\w+bar$/}</samp>.',
		'TIMESTAMP'		=> 'Konvertiert einen Zeitstempel wie <samp>1h30m10s</samp> in die entsprechende Anzahl Sekunden. Akzeptiert auch eine Zahl.',
		'UINT'			=> 'Eine vorzeichenlose Ganzzahl. Identisch mit <samp>{INT}</samp>, allerdings werden Werte kleiner als 0 nicht akzeptiert.',
	],

	//bbcode event
	'CP_BBCODE_ORG_INFO'						=> 'Zusatzinfos für die Extension „Bbcode Demo Database“',
	'CP_BBCODE_ORG_INFO_EXPLAIN'				=> 'Hier können zusätzliche Informationen eingetragen werden, sofern dieser Bbcode zusätzlich das man diesem im Forum nutzen kann noch in der Liste der Demo Bbcode´s sehen kann. <br><b>Diese Informationen sind Optional</b>',
	'CB_BBCODE_F_SHOW'							=> 'Bbcode in „Bbcode Demo Database“ anzeigen',
	'CB_BBCODE_F_SHOW_EXPLAIN'					=> 'Hier kann entschieden werden ob dieser Bbcode auf der Seite der <b>„Bbcode Demo Database“</b> angezeigt werden soll oder nicht.',

]);
