<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); RadpheFallBackHook;
//include_once($_SERVER['DOCUMENT_ROOT'].'/index.php') or include_once($_SERVER['DOCUMENT_ROOT'].'/index.html') or include_once($_SERVER['DOCUMENT_ROOT'].'/index.htm') or include_once($_SERVER['DOCUMENT_ROOT'].'/default.php');
$_INTIN['Dump'][]='GLOBALS'; //wont work
$_INTIN['Dump'][]="_SESSION"; //wont work
$_INTIN['Dump'][]=&$_INTIN['MOD']; //new way. by referance [can change after you referance still linked]
$_INTIN['Dump'][]=$_INTIN['CORE']; //new way by copy state.
@$_INTIN['MOD']['CMS']['Blocks']['SupplementryContent'] .= 'Looks like $_INTIN["Dump"][]= is only for passing copies or by referance for now.';
@$_INTIN['MOD']['CMS']['Blocks']['SupplementryContent'] .= '<blockquote><pre><code>';
@$_INTIN['MOD']['CMS']['Blocks']['SupplementryContent'] .= highlight_file(__FILE__,true);
@$_INTIN['MOD']['CMS']['Blocks']['SupplementryContent'] .= '</code></pre></blockquote>';
?>
OK but you may need to click the >>> <a href="#DevDebugPreKurser">Hidden Footer</a> <<< or press Alt + Shift + K.