<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);

	$_INTIN['Dump'][__FILE__][__LINE__][]=&$_INTIN['MOD'];
	$_INTIN['Dump'][__FILE__][__LINE__][]=&$_INTIN['KERNEL'];
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
<hr>
<br><hr><h2>Let Me Show you globals.</h2>
<?php
	echo '<h1>Globals Dump Exception</h1><h2>Example of how to get your globals.</h2>Be Careful with this method becasue it will likely display on output unhidden<br>';
	include_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_DumpTHAT/_dBug_CMS_mini.php');
	echo '<h3>PreShrunk with dBugM($GLOBALS)</h3><hr>';
	echo 'CLICK TO EXPLORE MEMORY!';
	new dBugM($GLOBALS);//PreShrink
	echo '<h3>Expanded with dBug($GLOBALS)</h3><hr>';
	new dBug($GLOBALS);//PreExpand.
	echo '<hr>';
	throw new Exception("Error Processing Request TESTING OUTSIDE ON-PURPOSE !");
?>
