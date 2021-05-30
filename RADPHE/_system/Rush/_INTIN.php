<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); RadpheFallBackHook;
$_INTIN['bannedIP'] = array(
);
$_INTIN['Login']['IdleOut'] = '300';
$_INTIN['Design']['Template'] = '-DefaultCORE'; //You would change this to the sibling folder of your installed layout in stateless mod.
$_INTIN['Design']['Layout'] = '__Layout'; //features a hook for index.php to have it's own layout.
//$_INTIN['Design']['Layout'] = 'Wide'; //Think of file ['Design']['Layout'] as how your Purchased Template has many >PAGES<.

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


$_INTIN['DevConfig']['RestrictAccess']['IP List'][] = '127.0.0.1';
$_INTIN['DevConfig']['RestrictAccess']['IP List'][] = 'Localhost';

$_INTIN['MOD']['CMS']['Blocks']['SEOKeywords'] = <<<'HereKeywords'
website
e.poop
oop
pop
php
apache
mod_php
Site Engine
PHP Kernel
Kernel Mode
Radphe
HereKeywords;

$_INTIN['MOD']['CMS']['Blocks']['SEODescription'] = 'Config Level Default SEO Description';
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
$_INTIN['MOD']['SEO']['Defaults']['ForcedKeywordsTxt'] = 'Forced SERP, kelly g. allen, radphe';
$_INTIN['MOD']['CMS']['Blocks']['SEOMeta'] = $_INTIN['MOD']['SEO']['Defaults']['Meta'];
$_INTIN['MOD']['SEO']['Defaults']['PageTitle'] = 'KellyGAllen.blabla - #mem:SEOKeywords;#';
$_INTIN['MOD']['CMS']['Blocks']['SEOPageTitle'] = $_INTIN['MOD']['SEO']['Defaults']['PageTitle'];
$_INTIN['MOD']['SEO']['Defaults']['SupplementalContent'] = '';

//menu items
@$_INTIN['MOD']['CMS']['Blocks']['PageNavigation1'] .= <<<'PageNavigation1'
| <a href="/">Front Page</a> <sup><a href="/index.php">php</a></sup> <sub><a href="/index.html">html</a></sub> <sup><a href="/style.css">virtual</a></sup>
| <a href="?DevInfo=phpinfo&Info=Info" title="Non Request">PHP Info</a> <sup><a href="/DevInfo.php?DevInfo=phpinfo&Info=Info" title="Virtually Routed and Non Request Content.">Virtual</a></sup>
| <a href="/mJSterm.php">mJPEG JS Terminal</a>
| <a href="#DevDebugPreKurser">Footer</a>
| <a href="/RADPHE.php">Simple Direct</a>
<hr>
| Local: <a href="/wordpress/">Wordpress</a> <sup><a href="/wordpress/wp-admin/">Admin</a></sup>
| <a href="http://kellygallen.lovestoblog.com/">Remote</a>: <a href="http://kellygallen.lovestoblog.com/WordPress/">Wordpress</a> <sup><a href="http://kellygallen.lovestoblog.com/WordPress/wp-admin/">Admin</a></sup> <sub><a href="http://192.168.1.26/wordpress/">local LAMP</a></sub>
| <a href="/-RADPHEindex.php">Debug Example.</a>
| <a href="/Wiki-Single-Doc.php">RADPhE Wiki.</a>
PageNavigation1;
@$_INTIN['MOD']['CMS']['Blocks']['PageNavigation3'] .= '#mem:PageNavigation1;#';

?>