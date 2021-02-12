<?php
//CROSS SERVER COMPATIBILITY

/*	echo '<br><h1>Unmodified $_SERVER[\'DOCUMENT_ROOT\']  : '.$_SERVER['DOCUMENT_ROOT'].'</h1><br>';
	echo '<br><h1>Unmodified $_SERVER[\'SCRIPT_FILENAME\']: '.$_SERVER['SCRIPT_FILENAME'].'</h1><br>';
*/
	//Make Sure SCRIPT_FILENAME Report as expected.
	if ($_SERVER['SCRIPT_FILENAME'][0] != '/') {
		$_SERVER['SCRIPT_FILENAME'] = ltrim($_SERVER['SCRIPT_FILENAME'],'\/');
		$_INTIN['Load Status']['Notice']['Env Var Modified'][] = '$_SERVER[\'SCRIPT_FILENAME\']: Removed slash from start of path!';
	}

	//Make Sure DOCUMENT_ROOT Report as expected.
	if ($_SERVER['DOCUMENT_ROOT'][strlen($_SERVER['DOCUMENT_ROOT'])-1] != '/') {
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/';
		$_INTIN['Load Status']['Notice']['Env Var Modified'][] = '$_SERVER[\'DOCUMENT_ROOT\']: Added end slash to path!';
	}


/*	echo '<br><h1>Modified $_SERVER[\'DOCUMENT_ROOT\']    : '.$_SERVER['DOCUMENT_ROOT'].'</h1><br>';
	echo '<br><h1>Modified $_SERVER[\'SCRIPT_FILENAME\']  : '.$_SERVER['SCRIPT_FILENAME'].'</h1><br>';

	//Another way to ensure path is the same Assign Var Below to $_IntIn['Load Status']['Request']['URL'] and prevent it from being reassigned in MOST cases later.
	//echo '<br><h1>Modified Request URL                    : '.ltrim(strtr($_SERVER["SCRIPT_FILENAME"], array($_SERVER['DOCUMENT_ROOT'] => "")),'\/').'</h1><br>';
*/
?>