<?php
if (!empty($_POST)) {
	if (isset($_POST['LoginType'])) {
		require_once($_SERVER['DOCUMENT_ROOT'].'/_system/function/_Login.php');//?
	} else {
	}
	bench('POSTED');
} else bench('Posted');
?>