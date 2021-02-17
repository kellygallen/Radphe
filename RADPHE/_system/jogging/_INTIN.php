<?php
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php');//Fallback Hook.
global $_INTIN;

// array's of banned IP addresses
$_INTIN['bannedIP'] = array(
//	"70.180.218.*", BLOCK with wildcard
//	"70.180.218.23?", BLOCK with single digit wildcard
//	"70.180.218.123", BLOCK static ip
//	"",
	"94.127.144.*",
	"94.127.145.*"
//	"94.127.144.225" //Programer IP?
);


$_INTIN['Login']['IdleOut'] = '300';
$_INTIN['Design']['Tempalte'] = 'default';
$_INTIN['Design']['Layout'] = '__Layout.php';

##Enter Full Web Paths
$_INTIN['Domains'][0] = '192.168.1.26';
$_INTIN['Webs'][$_INTIN['Domains'][0]]['root']['path'] = '';
$_INTIN['Webs'][$_INTIN['Domains'][0]]['GoogleAnaliticsCode'] = 'UA-#######-1';
$_INTIN['Webs'][$_INTIN['Domains'][0]]['GoogleAnaliticsProfile'] = $_INTIN['Webs'][$_INTIN['Domains'][0]]['root']['path'];
$_INTIN['Webs'][$_INTIN['Domains'][0]]['GoogleAnaliticsProfileUser'] = 'analytics@com';
$_INTIN['Webs'][$_INTIN['Domains'][0]]['GoogleAnaliticsProfilePWD'] = '';

$_INTIN['Domains'][1] = 'KellyGAllen.LovesToBlog.COM';
$_INTIN['Webs'][$_INTIN['Domains'][1]]['root']['path'] = 'com';
$_INTIN['Webs'][$_INTIN['Domains'][1]]['GoogleAnaliticsCode'] = 'UA-#######-2';
$_INTIN['Webs'][$_INTIN['Domains'][1]]['GoogleAnaliticsProfile'] = $_INTIN['Webs'][$_INTIN['Domains'][1]]['root']['path'];
$_INTIN['Webs'][$_INTIN['Domains'][1]]['GoogleAnaliticsProfileUser'] = 'analytics@com';
$_INTIN['Webs'][$_INTIN['Domains'][1]]['GoogleAnaliticsProfilePWD'] = '';

$_INTIN['Domains'][2] = 'dev.com';
$_INTIN['Webs'][$_INTIN['Domains'][2]]['root']['path'] = 'com';
$_INTIN['Webs'][$_INTIN['Domains'][2]]['GoogleAnaliticsCode'] = 'UA-#######-3';
$_INTIN['Webs'][$_INTIN['Domains'][2]]['GoogleAnaliticsProfile'] = $_INTIN['Webs'][$_INTIN['Domains'][2]]['root']['path'];
$_INTIN['Webs'][$_INTIN['Domains'][2]]['GoogleAnaliticsProfileUser'] = 'analytics@com';
$_INTIN['Webs'][$_INTIN['Domains'][2]]['GoogleAnaliticsProfilePWD'] = '';

$_INTIN['Domains'][3] = 'dev.com:2080';
$_INTIN['Webs'][$_INTIN['Domains'][3]]['root']['path'] = 'com';
$_INTIN['Webs'][$_INTIN['Domains'][3]]['GoogleAnaliticsCode'] = 'UA-#######-4';
$_INTIN['Webs'][$_INTIN['Domains'][3]]['GoogleAnaliticsProfile'] = $_INTIN['Webs'][$_INTIN['Domains'][3]]['root']['path'];
$_INTIN['Webs'][$_INTIN['Domains'][3]]['GoogleAnaliticsProfileUser'] = 'analytics@com';
$_INTIN['Webs'][$_INTIN['Domains'][3]]['GoogleAnaliticsProfilePWD'] = '';

////	Defualt Config

////	Internal Config
////			Site Wide Config
$_INTIN['Config']['Office']['Phone'] = '702-900-5355';
$_INTIN['Config']['Office']['Fax'] = '';
$_INTIN['Config']['Office']['GMT']['N'] = -8;
$_INTIN['Config']['Office']['GMT']['S'] = 'Pacific Time';

$_INTIN['Config']['Admin'] = $_INTIN['Config']['Office'];
$_INTIN['Config']['Admin']['Name'] = 'Kelly G. Allen';
$_INTIN['Config']['Admin']['Email'] = 'KellyGAllen@Yahoo.com';

$_INTIN['Config']['Owner'] = $_INTIN['Config']['Admin'];

$_INTIN['Config']['Contact'] = $_INTIN['Config']['Admin'];
//$_INTIN['Config']['Contact']['Email'] = 'info@com';

$_INTIN['Config']['Manager'] = $_INTIN['Config']['Admin'];

$_INTIN['Config']['Marketing'] = $_INTIN['Config']['Admin'];

$_INTIN['Config']['Support']['Level 0'] = &$_INTIN['Config']['Contact'];
$_INTIN['Config']['Support']['Level 1'] = &$_INTIN['Config']['Manager'];
$_INTIN['Config']['Support']['Level 2'] = &$_INTIN['Config']['Admin'];


//$_INTIN['DevConfig']['RestrictAccess']['Mode'] = 'IP List';
//Used to limit an access to a trusted list.
$_INTIN['DevConfig']['RestrictAccess']['IP List'][] = '127.0.0.1';
$_INTIN['DevConfig']['RestrictAccess']['IP List'][] = 'Localhost';

$_INTIN['MOD']['CMS']['Blocks']['SEOKeywords'] = <<<'HereKeywords'
website
HereKeywords;

$_INTIN['MOD']['CMS']['Blocks']['SEODescription'] = 'Config Level Default SEO Descrition';
//$_INTIN['MOD']['SEO']['Defaults']['Keywords'] = explode(',',$_INTIN['MOD']['CMS']['Blocks']['SEOKeywords']);
$_INTIN['MOD']['SEO']['Defaults']['Keywords'] = $_INTIN['MOD']['CMS']['Blocks']['SEOKeywords'];
$_INTIN['MOD']['SEO']['Defaults']['ForcedKeywords'] = 'Kelly,Allen';//NOT USED YET
$_INTIN['MOD']['SEO']['Defaults']['Description'] = $_INTIN['MOD']['CMS']['Blocks']['SEODescription'];
$_INTIN['MOD']['SEO']['Defaults']['Meta'] = <<<'EOLongString'
		<meta name="keywords" content="#mem:SEOKeywords;#">
		<meta name="description" content="#mem:SEODescription;#">
		<meta name="robots" content="all">
		<meta name="googlebot" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="Content-Language" content="en-us">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="Rating" content="General">
		<meta name="revisit-after" content="7 Days">
		<meta name="doc-class" content="Living Document">
		<meta name="Distribution" content="Global">
		<meta name="robots" content="index, follow, archive">
EOLongString;
$_INTIN['MOD']['SEO']['Defaults']['ForcedKeywordsTxt'] = 'Forced';
$_INTIN['MOD']['CMS']['Blocks']['SEOMeta'] = $_INTIN['MOD']['SEO']['Defaults']['Meta'];
$_INTIN['MOD']['SEO']['Defaults']['PageTitle'] = 'KellyGAllen.blabla - #mem:SEOKeywords;#';
$_INTIN['MOD']['CMS']['Blocks']['SEOPageTitle'] = $_INTIN['MOD']['SEO']['Defaults']['PageTitle'];
$_INTIN['MOD']['SEO']['Defaults']['SupplementalContent'] = '';


?>