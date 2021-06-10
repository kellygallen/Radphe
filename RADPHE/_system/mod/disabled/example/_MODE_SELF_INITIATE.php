<?php
global $INTIN;
require_once('Wiki-From-Heading-TOC.php');
//WiKi_TOC(); //NOTICED THIS DOES NOT WORK AS EXPECTED. 2nddary include from virtual doesn't run till post debug or not at all. BUT IT WORKS HERE.
if (!empty($_INTIN['MOD']['CMS']['Blocks']['PageTOC'])) echo $_INTIN['MOD']['CMS']['Blocks']['PageTOC'];
?>