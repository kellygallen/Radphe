<?php
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php');//Fallback Hook.

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
$_INTIN['Domains'][0] = 'kellygallen.com';
$_INTIN['Webs'][$_INTIN['Domains'][0]]['root']['path'] = '';
$_INTIN['Webs'][$_INTIN['Domains'][0]]['GoogleAnaliticsCode'] = 'UA-#######-1';
$_INTIN['Webs'][$_INTIN['Domains'][0]]['GoogleAnaliticsProfile'] = '';
$_INTIN['Webs'][$_INTIN['Domains'][0]]['GoogleAnaliticsProfileUser'] = 'analytics@com';
$_INTIN['Webs'][$_INTIN['Domains'][0]]['GoogleAnaliticsProfilePWD'] = '';

$_INTIN['Domains'][1] = 'dev.kellygallen.com';
$_INTIN['Webs'][$_INTIN['Domains'][1]]['GoogleAnaliticsCode'] = 'UA-#######-2';
$_INTIN['Webs'][$_INTIN['Domains'][1]]['root']['path'] = 'com';
$_INTIN['Webs'][$_INTIN['Domains'][1]]['GoogleAnaliticsProfile'] = 'com';
$_INTIN['Webs'][$_INTIN['Domains'][1]]['GoogleAnaliticsProfileUser'] = 'analytics@com';
$_INTIN['Webs'][$_INTIN['Domains'][1]]['GoogleAnaliticsProfilePWD'] = '';

$_INTIN['Domains'][2] = 'dev.com';
$_INTIN['Webs'][$_INTIN['Domains'][2]] = $_INTIN['Webs'][$_INTIN['Domains'][1]];
$_INTIN['Webs'][$_INTIN['Domains'][2]]['GoogleAnaliticsProfile'] = 'dev.com';

$_INTIN['Domains'][3] = 'dev.com:2080';
$_INTIN['Webs'][$_INTIN['Domains'][3]] = &$_INTIN['Webs'][$_INTIN['Domains'][2]];

////	Defualt Config

////	Internal Config
////			Site Wide Config
$_INTIN['MainConfig']['Office']['Phone'] = '###-###-####';
$_INTIN['MainConfig']['Office']['Fax'] = '';
$_INTIN['MainConfig']['Office']['GMT']['N'] = -8;
$_INTIN['MainConfig']['Office']['GMT']['S'] = 'Pacific Time';

$_INTIN['MainConfig']['Admin'] = $_INTIN['MainConfig']['Office'];
$_INTIN['MainConfig']['Admin']['Name'] = 'Kelly G Allen';
$_INTIN['MainConfig']['Admin']['Email'] = 'Kelly@com';

$_INTIN['MainConfig']['Owner'] = $_INTIN['MainConfig']['Admin'];

$_INTIN['MainConfig']['Contact'] = $_INTIN['MainConfig']['Admin'];
$_INTIN['MainConfig']['Contact']['Email'] = 'info@com';

$_INTIN['MainConfig']['Manager'] = $_INTIN['MainConfig']['Admin'];

$_INTIN['MainConfig']['Marketing'] = $_INTIN['MainConfig']['Admin'];


$_INTIN['MainConfig']['Support']['Level 0'] = &$_INTIN['MainConfig']['Contact'];
$_INTIN['MainConfig']['Support']['Level 1'] = &$_INTIN['MainConfig']['Manager'];
$_INTIN['MainConfig']['Support']['Level 2'] = &$_INTIN['MainConfig']['Admin'];


//$_INTIN['DevConfig']['RestrictAccess']['Mode'] = 'IP List';
//Used to limit an access to a trusted list.
$_INTIN['DevConfig']['RestrictAccess']['IP List'][] = '127.0.0.1';
$_INTIN['DevConfig']['RestrictAccess']['IP List'][] = 'Localhost';

$_INTIN['MOD']['CMS']['Blocks']['SEOKeywords'] = '
website
';

$_INTIN['MOD']['CMS']['Blocks']['SEODescription'] = 'Config Level Default SEO Descrition';
//$_INTIN['MOD']['SEO']['Defaults']['Keywords'] = explode(',',$_INTIN['MOD']['CMS']['Blocks']['SEOKeywords']);
$_INTIN['MOD']['SEO']['Defaults']['Keywords'] = $_INTIN['MOD']['CMS']['Blocks']['SEOKeywords'];
$_INTIN['MOD']['SEO']['Defaults']['ForcedKeywords'] = 'Kelly,Allen';//NOT USED YET
$_INTIN['MOD']['SEO']['Defaults']['Description'] = $_INTIN['MOD']['CMS']['Blocks']['SEODescription'];
$_INTIN['MOD']['SEO']['Defaults']['Meta'] = <<<EOLongString
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