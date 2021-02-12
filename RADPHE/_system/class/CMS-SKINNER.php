<?php
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php');//Fallback Hook.
class CMS_Skinner{
	public static
		$BaseFolder = '',
		$TemplateFolder = '',
		$Selected = 'default',
		$Page = array('Title'=>'CMS-Skinner Page Title','HeaderFile'=>'_Header','FooterFile'=>'_Footer','LayoutFile'=>'_Default');

	public static function __constructor(){
		self::init();
	}

//	Enable Nestable block replacement.
	public static function init(){
		global $_INTIN;
		self::$BaseFolder = $_SERVER['DOCUMENT_ROOT'].'/_system/layout/';
		if (!empty($_INTIN['MOD']['LAYOUT']['Selected']))
			self::$Selected = $_INTIN['MOD']['LAYOUT']['Selected'];
		if (!empty($_INTIN['MOD']['LAYOUT']['BaseFolder']))
			self::$BaseFolder = $_INTIN['MOD']['LAYOUT']['BaseFolder'];
		if (!empty($_INTIN['MOD']['LAYOUT']['Page']['Title']))
			self::$Page['Title'] = $_INTIN['MOD']['LAYOUT']['Page']['Title'];
		if (!empty($_INTIN['MOD']['LAYOUT']['Page']['HeaderFile']))
			self::$Page['HeaderFile'] = $_INTIN['MOD']['LAYOUT']['Page']['HeaderFile'];
		if (!empty($_INTIN['MOD']['LAYOUT']['Page']['FooterFile']))
			self::$Page['FooterFile'] = $_INTIN['MOD']['LAYOUT']['Page']['FooterFile'];
		if (!empty($_INTIN['MOD']['LAYOUT']['Page']['LayoutFile']))
			self::$Page['LayoutFile'] = $_INTIN['MOD']['LAYOUT']['Page']['LayoutFile'];

		$TargetLayout = self::$BaseFolder.self::$Selected.'/_BlockDump.php';
		if (file_exists($TargetLayout)) include($TargetLayout);
	}

	public static function compile() {
		CMS_Blocks::startBlock('Layout');
			$TargetLayout = self::$BaseFolder.self::$Selected.'/'.self::$Page['LayoutFile'].'.php';
			if (file_exists($TargetLayout)){
				include($TargetLayout);
			} else echo '
#mem:PageTitle;#
#mem:PageHead;#
#mem:PagePreRunJS;#
#mem:PageHeader;#
#mem:PageSideBar;#
#mem:Request;#
#mem:PageFooter;#
#mem:PageRunJS;#
';
		CMS_Blocks::endBlock();

		if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$_SERVER['PHP_SELF'].'.SEO.php')) {
			CMS_Blocks::startBlock('LayoutCommonSuppliment');
				include $_SERVER['DOCUMENT_ROOT'].'/'.'_LayoutCommon.php'.'.SEO.php';
			CMS_Blocks::endBlock();
		}
	}

	public static function __destructor(){
		self::compile();
	}

}
?>
