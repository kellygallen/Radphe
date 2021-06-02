<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);

	$_INTIN['Dump'][]=&$_INTIN['MOD']; //by reference [can change after you reference, still linked... may also be read/write difference to function parameters.]
	$_INTIN['Dump'][]=&$_INTIN['KERNEL']; //new way by copy state.
	$_INTIN['Dump'][__FILE__]=$GLOBALS; //new way by copy state.
	//	$_INTIN['Dump'][]=&$_INTIN['KERNEL']; //new way by copy state.
	// by referance = as it is later. array diff a now and a &$later.
?>
This is the only real file RADPHE has in the site root for expendable example files. You need at least 1 real one This file is optional.<br>
The ERROR file at site root is NOT OPTIONAL; it is used as a auto alternate path to RADPhE virtual files.<br>
<center>
Click the hidden footer toggle link below as linked to Alt + Shift + K key combo.
<h1>>>> <a href="#DevDebugPreKurser">Hidden Footer</a> <<<</h1>
<hr></center>
<center><h2>This is a Module Block call :: <u>#<b>mod</b>:<sup>example/mJSterm</sup>;<sub>CMSInitiatorTest</sub>#</u></h2><br>#mod:example/mJSterm;CMSInitiatorTest#</center>
<hr>
<center><h2>This is a Module Block call with a mistake :: <u>#<b>mod</b>:<sup>example/mJSterm</sup>;<sub>CMSInitiatorTestMistake</sub>#</u></h2><br>#mod:example/mJSterm;CMSInitiatorTestMistake#</center>
<?php
	throw new Exception("Error Processing Request TESTING OUTSIDE ON-PURPOSE !");
?>
