<?php
global $_INTIN;

//now i am being silly... i am saying here... (if running in site engine) show this other file instead of the virtual that was called.
//$_INTIN['MOD']['ResourceFinder']['found']['ModuleRelativeLocation'] = dirname($_INTIN['MOD']['ResourceFinder']['found']['ModuleRelativeLocation']).'/Wiki-From-Heading-TOC.php';

require_once('Wiki-Single-Doc.php');
function WiKi_TOC(){
	global $_INTIN;
	$lines = file(dirname(__FILE__).'/Wiki-Single-Doc.php', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	foreach ($lines as $line_num => $line) {
		preg_match('/^[\t ]{0,5}(<(h1|h2|h3)\>)(.*?)(\<\/?(sub|sup|h1|h2|h3|h4|b|u|i)\>).*$/i',$line,$matches,);
	//    echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br />\n";
		if (!empty($matches[2])&&(!empty($matches[3]))) $TOC[]=array($matches[3],$matches[2]);
	}
	if (!empty($TOC)) {
		$_INTIN['MOD']['CMS']['Blocks']['PageTOC'] = '';
		$_INTIN['MOD']['CMS']['Blocks']['PageTOC'] .= '<ul style="">'."\n";
		foreach($TOC as $itemParts) {
			list($title,$tag) = $itemParts;
			$indents = substr($tag, 1,1);
			if (is_numeric($indents)) $indents--;
			$indented = '';
			for ($i = 1; $i <= $indents; $i++) {
				$indented .= "-&nbsp;-&nbsp;-&nbsp;-&nbsp;-&nbsp;-&nbsp;";
			}
			switch($title){
				case 'RADPhE':
				case 'Table Of Contents.':
				case '...':
					break;
				default:
					if (!empty($title)) $_INTIN['MOD']['CMS']['Blocks']['PageTOC'] .= '<li>'.$indented.$title.'</li>'."\n";
	//				$_INTIN['MOD']['CMS']['Blocks']['PageTOC'] .= '<'.$tag.'>'.$title.'</'.$tag.'>'."\n";
					break;
			}
		}
		$_INTIN['MOD']['CMS']['Blocks']['PageTOC'] .= '</ul>'."\n";
	}
	return $_INTIN['MOD']['CMS']['Blocks']['PageTOC'];
}
?>