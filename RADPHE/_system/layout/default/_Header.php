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
			<div style="margin-left:275px; position:absolute; margin-top:-103px;">
				<h3 align="left" style="color:#fff;">Something</h3>
			</div>
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