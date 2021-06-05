<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);

	$_INTIN['Dump'][__FILE__][__LINE__][]=&$_INTIN['MOD'];
	$_INTIN['Dump'][__FILE__][__LINE__][]=&$_INTIN['KERNEL'];
?>
THIS file <?php echo __FILE__; ?> may be deleted, but -RADPHError404.php may not be deleted or you will lose all virtual and module resources meaning the files must be installed at site root file system as real files.<br><br>
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
<br><hr><h2>Let Me Show you globals</h2> but it will use a lot of ram to pre buffer it if it was much bigger you would need to run it with Stateless Render Close Flattened or bypassed.<br>
Also if you don't run it through the debug event then you are responsible for what is being outputted and when and to whom. the debug event will apply a unset mask to certain areas of leak. You can do the same by including the dumpThat Public Mask php file after including the dbug class and before using it.
<?php
	echo '<h1>Globals Dump Exception</h1><h2>Example of how to get your globals.</h2>Be Careful with this method because it will likely display on output unhidden<br>';
	include_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_DumpTHAT/_dBug_CMS_mini.php');
	echo '<h3>PreShrunk with dBugM($GLOBALS)</h3><hr>';
	echo 'BELOW is intended to show to user on ths page; though present however <a href="#DevDebugPreKurser">This OTHER is not intended to show</a><br>CLICK TO EXPLORE MEMORY!';
	new dBugM($GLOBALS);//PreShrink
//Commented out bcasue it is big and ugly.
//	echo '<h3>Expanded with dBug($GLOBALS)</h3><hr>';
//	new dBug($GLOBALS);//PreExpand.
	echo '<hr>';
//	throw new Exception("Error Processing Request TESTING OUTSIDE ON-PURPOSE !");
?>
