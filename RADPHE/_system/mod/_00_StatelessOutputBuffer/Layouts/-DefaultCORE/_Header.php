<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); RadpheFallBackHook;
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_StatelessOutputBuffer/CMS.php');?>
<style>
#top #nav li ul{
	top:30px;
}
</style>
		<div id="head">
			<h1 class="logo ie6fix">Heading Maybe Nav.
			</h1>
#mem:PageBreadCrumbLeft;#
			<ul id="nav">
#mem:PageNavigation1;#
				<br />
#mem:PageBreadCrumbRight;#
			</ul>
		</div>	<!-- end #head -->
<?php
//home page eye candy //happens inside cms_skinner
if ($_SERVER['PHP_SELF']=="/index.php") {
	//Cub3r html fallback. Becomes Cub3r.
//	self::$Page['LayoutFile'] = 'FrontPage';
?>
#mem:PageSlideShow;#
<?php
};
?>