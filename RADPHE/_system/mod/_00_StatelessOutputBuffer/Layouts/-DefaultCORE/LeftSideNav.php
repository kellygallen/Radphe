<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_StatelessOutputBuffer/CMS.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
#mem:SEOMeta;#
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>#mem:SEOPageTitle;#</title>
#mem:PageHead;#
		<script type="text/javascript">
#mem:PagePreRunJS;#
		</script>
	</head>
	<body id='subpage' #mem:OnLoad;# >
		<div class='wrapper'>
			<div id="top">
#mem:PageHeader;#
				<div id="main">
					<div id='sidebar'>
#mem:PageSideBar;#
					</div>
					<div id="content">
						<div class='entry'>
#mem:Request;#
<hr />
<h3>Optional Supplemental Content</h3>
#mem:SupplementaryContent;#
<hr />
<h3>Optional SEO Content</h3>
#mem:SEOSupplementaryContent;#
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class='wrapper' id='footerwrap'>
			<div id='footer'>
#mem:PageFooter;#
			</div>
		</div>
	</body>
		<script type="text/javascript">
#mem:PageRunJS;#
		</script>
</html>