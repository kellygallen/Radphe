<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);

	$_INTIN['Dump'][]=&$_INTIN['MOD']; //by reference [can change after you reference still linked]
	$_INTIN['Dump'][]=$_INTIN['KERNEL']; //new way by copy state.
//Show This but dont count it for seo keywords.
	@$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= 'Looks like $_INTIN["Dump"][]= is only for passing copies or by references for now.';
	$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= '<blockquote><pre><code>';
	$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= highlight_file(__FILE__,true);
	$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= '</code></pre></blockquote>';
	throw new Exception("Error Processing Request TESTING OUTSIDE ON-PURPOSE !");

?>
OK but you may need to click the >>> <a href="#DevDebugPreKurser">Hidden Footer</a> <<< or press Alt + Shift + K.
<hr>
<center><h2>This is a Module Block call :: <u>#<b>mod</b>:<sup>example/mJSterm</sup>;<sub>CMSInitiatorTest</sub>#</u></h2><br>#mod:example/mJSterm;CMSInitiatorTest#</center>
<hr>
<center><h2>This is a Module Block call with a mistake :: <u>#<b>mod</b>:<sup>example/mJSterm</sup>;<sub>CMSInitiatorTestMistake</sub>#</u></h2><br>#mod:example/mJSterm;CMSInitiatorTestMistake#</center>
