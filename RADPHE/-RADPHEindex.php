<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);

//Old way.
	$_INTIN['Dump'][]='GLOBALS'; //wont work
	$_INTIN['Dump'][]='_SESSION'; //wont work
//New Way.
	$_INTIN['Dump'][]=&$_INTIN['MOD']; //new way. by reference [can change after you reference still linked]
	$_INTIN['Dump'][]=$_INTIN['KERNEL']; //new way by copy state.
//Show This.
	@$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= 'Looks like $_INTIN["Dump"][]= is only for passing copies or by references for now.';
	$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= '<blockquote><pre><code>';
	$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= highlight_file(__FILE__,true);
	$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= '</code></pre></blockquote>';
?>
OK but you may need to click the >>> <a href="#DevDebugPreKurser">Hidden Footer</a> <<< or press Alt + Shift + K.