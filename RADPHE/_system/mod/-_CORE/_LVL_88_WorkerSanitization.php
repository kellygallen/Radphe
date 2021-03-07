<?php
$GLOBALS = array(
//Keepers & NOTS in Globals.
//Example of how to do it.
		'_POST'=>array(),
		'_GET'=>array(),
		'_SESSION'=>array(),
/*		'_INTIN'=>array(
				'MOD'=>$_INTIN['MOD'],
				NULL=>NULL//leave me alone. I am ARRAY.
		),*/
		'_INTIN'=>$_INTIN, //to rebuild intin from MODE Cron or not? for now i leave it in.
		'_SESSIONthread'=>array(),
		'_QUERY'=>array(),
		'_SERVER'=>array(
				'DOCUMENT_ROOT'=>$_SERVER['DOCUMENT_ROOT'],
				null=>null
		),
		'_ENV'=>array(),
		'_COOKIE'=>'',
		'_FILES'=>$_FILES, //maybe could be that kind of worker on a unnecessary long run that should be an exemption hook n die.
		'_REQUEST'=>array(),
		NULL=>NULL//leave me alone. I am ARRAY.
);
?>