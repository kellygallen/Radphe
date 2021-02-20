<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); RadpheFallBackHook;
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_StatelessOutputBuffer/CMS.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
#mem:SEOMeta;#
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>#mem:SEOPageTitle;#</title>
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

#mem:PageHead;#
		<script type="text/javascript">
#mem:PagePreRunJS;#
		</script>
	</head>
	<body #mem:OnLoad;# >
		<div class='wrapper'>
			<div id="top">
				<div id="head">
#mem:PageHeader;#
				</div>	<!-- end #head -->
				<div id="main">
					<div id="content">
						<div class='entry'>
#mem:Request;#

<hr />
<h3>Optional Suplimental Content</h3>
#mem:SupplementryContent;#
<hr />
<h3>Optional SEO Content</h3>
#mem:SEOSupplementryContent;#
						<!--end entry-->
						</div>
					</div><!-- end content -->
				</div><!--end main-->
			</div><!-- end #top -->
		</div><!-- end #wrapper -->
		<div class='wrapper' id='footerwrap'>
			<div id='footer'>
#mem:PageFooter;#
			</div><!--end footer-->
		</div>
	</body>
	<script type="text/javascript">
#mem:PageRunJS;#
	</script>
</html>