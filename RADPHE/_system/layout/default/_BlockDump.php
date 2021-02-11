<?php
CMS_Blocks::startTangentBlock('PageHeader');
	require($_SERVER['DOCUMENT_ROOT'].'/_system/layout/'.CMS_Skinner::$Selected.'/'.CMS_Skinner::$Page['HeaderFile'].'.php');
CMS_Blocks::endTangentBlock();
CMS_Blocks::startTangentBlock('PageFooter');
	require($_SERVER['DOCUMENT_ROOT'].'/_system/layout/'.CMS_Skinner::$Selected.'/'.CMS_Skinner::$Page['FooterFile'].'.php');
CMS_Blocks::endTangentBlock();

CMS_Blocks::startTangentBlock('PageSideBar');
?>
				<div class="box box_small">
					<h3>SideNav</h3>
					<ul>
						<li><a href="/">Home</a>
							<ul>
							<li><a href="/About.php">About</a></li>
							</ul>
						</li>
					</ul>
				</div><!--end box-->
				<div class="box box_small">
					<h3>Latest News</h3>
					<ul>
						<li><a href=".html"></a></li>
						<li><a href=".html"></a></li>
						<li><a href=".html"></a></li>
						<li><a href=".html"></a></li>
					</ul>
				</div>
<?php
CMS_Blocks::endTangentBlock();
?>