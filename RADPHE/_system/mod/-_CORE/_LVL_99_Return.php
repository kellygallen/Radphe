<?php
if (!isset($_GET['ShowLongestRoute'])) {

	//this is only to prove it's there... in dev for now.
	echo '<h2>From The TOP!</h2><pre>';
	var_export(get_included_files());
	echo '</pre>';
	new dBugM($GLOBALS);

	//from here out it is error log in ssh only with tail -f
	die();//this is for the kernel before next apache run level of request...
	//things should proceed into request... or i will have to make kernal it self return on certain return structure for any script.
}
?>