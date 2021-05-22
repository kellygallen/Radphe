<h1>RADPhE</h1>
	<h2>About</h2>
		<h3>The Bad Demo</h3>
			<p>Currently this is a bad demo to show you the basics of how radphe works and what it does.
				Soon the download release will not have the demo, it will be completely transparent and minimalist as it should be.
				Since your new to it I have to make it sand out clumsily for you to see it is there.<hr>
				The real demo is when you realise how these pages differ and you use it to application firewall your web service or actually use it to run your domain.
				You may decide to go with the event driven stages of the request/response OR use the bench command to see where you app is loosing efficiency OR you may use it in your development to make and debug apps rapidly.
				<h3>When you understand it and the parts you need, you can strip away the rest; and that is your demo: <u>Your Solution</u> vs it's RADPhE version or <u>itself in RADPhE</u>.</h3>
				Apache + MOD_PHP is what you want. It's the only way it is real php... thats right FastCGI; I said it.
			</p>
		<h3>Install</h3>
		<h3>www Where is it?</h3>
			<p>
				If not in WWWroot, then each module and event level will have a chance to provide a just in time replacement for the response from their _Resources sub folder before it fails.
			</p>
		<h3></h3>
<h1>Features</h1>
	<h2>Output Buffer Blocking</h2>
		<h3>OBB HASH-URL Markup Language: <sup>#type#uri:param;command;...#</sup></h3>
		<h3>Stateless Recursive Output Blocks <sup>and alternate format conversion</sup></h3>
		<h3>HTTP Output Channeling <sup>http3 and prior</sub></h3>
		<h3>Resource Alternates and Extensions <sup>per session and public</sup></h3>
		<h3>Templates and Layouts in html php and tpl if you want.</h3>
		<h3></h3>
	<h2>Forced Kernel Mode PHP</h2>
		<h3>Making PHP Right <sup>and Kernel Optimization Wrong</sup></h3>
	<h2>Event Levels<h3>
		<h3>Event 
			<sup>Process</sup>
			<sub>Oriented</sub>
			<sup>Object</sup>
			<sub>Programming</sub>
		</h3>
		<h3>Request Response Result Production</h3>
		<h3>Tracks changes between events <sup>Saves Work</sup></h3>
	<h2>SEO</h2>
		<h3>Used/Missing/Forced Keywords</h3>
		Response without template boiled down user text content.
		dynamic and seo file per request customization.
		.seo.php files may be in an isolated ftp or user folder.
		the application may programmatically add and remove seo response metadata.
	<h2>Debug and Persistent Recursive Dump</h2>
	<h2>Minified! <sup>after your merge</sup><h2>
	<h2>PHP Language <sup>Is what you get</sup></h2>
	<h2>Application Firewall</h2>
		It likely runs way before your request, calls it, dies... and the stage your request would be called is never reached unless you explore the long route that transcends pre-THING-post boundaries. Yes it can have 3 lives with resume skip or retry in the way you code it; and maybe do garbage clean up after the connection terminates after a non permissive app firewall stage.
		<h3>Pre Process <sup>$_POST, _GET, practically ALL</sup></h3>
		<h3>Example.</h3>
		<p><pre>
			$_GET = array($_GET['WHAT'],$_GET['U'],$_GET['want']);
			if (!empty($_SESSION)) { $_POST = array($_POST['FORMname]') } else $_POST = NULL;
			//$GLOBALS = array();///////?
		</pre></p>
		<h3>Offend to FailToBan <sup>parallel implementation</sup></h3>
			<p>Independent IP ban list with wild cards and subnet size. And maybe a 3rd party sandbox for spiders to fill burn their quota and jack up their price until they bust their hosting budget with garbage on a 304 header.</P>
			<p>Gateway Firewall and Syslog Spider Service for perimeter attack awareness with a above standard sticky identiprint some day.. ;-)</p>
		<h3>Request History</h3>
		<h3>Support Submitting</h3>
		<h3>Self Check sanity and standard enforcement audits and checks.</h3>
	<h2>Server Side Terminal Rendering <sup>In high JPEG fps as a stream</sup></h2>
	<h2>Light Bench Performance Report <sup>with its own secondary application firewall<sup> </h2>	
<?php //FallBackHook alone hook will fail in this way.
	@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);
	@$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= '';
	$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= '<blockquote>Contents of this file:'.__FILE__.'<hr><pre><code>';
	$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= highlight_file(__FILE__,true);
	$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= '</code></pre></blockquote>';
?>