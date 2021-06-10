<?php
global $INTIN;
//$_INTIN['Dump']=$GLOBALS;
//now i am being silly... i am saying here... show this other file instead of the virtual that was called.
if (empty($_INTIN['MOD']['ResourceFinder']['found']['ModuleRelativeLocation']))
	$_INTIN['MOD']['ResourceFinder']['found']['ModuleRelativeLocation'] = dirname($_INTIN['MOD']['ResourceFinder']['found']['ModuleRelativeLocation']).'/Wiki-From-Heading-TOC.php';
?>
<center><h1>RADPhE</h1></center><hr>
	<h1>Table Of Contents.</h1>
<!-- e.poop #\mem:PageTOC;#
								 Added slash to mem so you could see it without replacement. -->
<!-- e.poop #mem\:PageTOC;# BEGIN
		 Replacement Needle BEGIN
			 the following UnOrdered Table Of Contents List
			 is generated and replaces the fragment/block handle i leave behind here
			 which looks something like this "# mem : PageTOC ;  # without the spaces."-->
#mod:example;WiKi_TOC#
<!-- e.poop #mem:\PageTOC;# END
		 Replacement Needle END
			 the previous is not actually there
			 there is only a memory block e.poop or hashpipe there...
					 I haven't decided the name yet but I might have a use for both. -->
	<hr>
	<h1>About</h1>
		<h3>The Bad Demo</h3>
			<p>Currently this is a bad demo to show you the basics of how radphe works and what it does.
				Soon the download release will not have the demo, it will be completely transparent and minimalist as it should be.
				Since your new to it I have to make it sand out clumsily for you to see it is there.<hr>
				The real demo is when you realise how these pages differ and you use it to application firewall your web service or actually use it to run your domain.
				You may decide to go with the event driven stages of the request/response OR use the bench command to see where you app is loosing efficiency OR you may use it in your development to make and debug apps rapidly.
				<h3>When you understand it and the parts you need, you can strip away the rest; and that is your demo: <u>Your Solution</u> vs it's RADPhE version or <u>itself in RADPhE</u>. Try on your <u>DEV Server</u> till you understand it.</h3>
				Apache + MOD_PHP is what you want. It's the only way it is real php... thats right FastCGI; I said it.
			</p>
		<h3>Install</h3>
			<p>
				Install 1 or many of the Site Engine hooking methods in /_system/_EngineHooks to their corresponding pipes.
				You will be able to tell later which one is the Request's root caller. It could be different.
				<hr>
				For example ResourceFinder is the root for 404 and other errors by default and it may search the modules for virtual replacements.
				The WWWroot folder will take precedence over any virtual files from modules and only the first replacement file by a module is provided as a permanent cached file for the browser; it will rely on the ETAG for the need to update but it also an update for everyone could be triggered by touching the timestamp of the virtual request.
				So you update the Virtual File or execute touch on the file and all clients will update it on next request.
				<hr>
				The site engine would wrap around what ever work you have done without migration or integration of features and facilities.
				Your script should die/exit if you want it to have authority over the site engine process but otherwise it could end at EOF or Return a value for an Access Control Layer.
				If you dont want layout and template and debug in your ajax response you should abort all output buffering and terminate after your done.
				<hr>
				As per allowed by each example name menu link and possibly its corelation to another there is a range of reporting hidden in the trey at the bottom. Press <b>ALT + SHIFT + K</b> for extra Knowledge.
				Dont worry soon there will be a production brach of this, as a updatable core if not merge-able; it is just still taking its form and shape at the moment and many things are dummy place holder function snapins.
				<hr>
				That is MODULES in the Site Engine System; the APPLICATIONS you make outside the system folder however is wrapped by it.
				You probably want to make a APP rather than a MOD.
			</p>
		<h3>www Where is it?</h3>
			<p>
				If not in WWWroot, then each module and event level will have a chance to provide a just in time replacement for the response from their _Resources sub folder before it fails. This I refer to as a virtual.
			</p>
		<h3></h3>
	<hr>

<h1>Problems</h1>
<h3>Put mysql links in a place in _INTIN</h3> or one of the filtered memory locations or turn it off memory tracking with the config parameter (soon to come) or with toggling code boolean. RADPHE\_system\mod\-_CORE\_MODE_Level_Manager.php:71

<h1>TODO</h1>
<h3>SELF Testing <sub>With test files, limit it to the host</sub><sup>and CURL</sup></h3>For all my currently manual test scenarios stored in _INTIN awareness and cashed otherwise triggered by a cronjob or an algorithm for writing that cache.
<h3>HOSTING Probe</h3> again to awareness as it is for all on the server.
<h3>DEFINES<sub>Primary Required Defaults and Detected</sub></h3> Reducing Memory and CODE footprint and setting non changeables. Also for things like _system folder, and sit engine naming convention or namespace and #HASH:PIPE# code execution bridges and CMS Block e(b)POOP. For example the hashpipe and e.poop langrage format and regex patterns are currently defines, so you may change the language structure by altering them once.
<h3>Bench SLEEP overload to include bench</h3> ;-) and bench triggering an optional environment change snapshot. because you want to wait around anyway. Making debugging auto magic when it is rest-full AND WITH ZERO MOD OR LINES IN YOUR CODE from the outside as the prepend hook wrapper.
<h3>Learning Firewall Mode<h3> To learn the access patterns and subsequent posts and their structure to make a filter for what is let through to the wrapped un-integrated app. Possibly a low bandwidth hunnypot with a js alert window to escape it when a thret level tolerance has been reached. running on the history quota of previous dynamic responses as a submitted support or threat ticket to support. IP Blocking if it is determined to be automated or a bot net. where as the response is broken and silent completely with no response headers early in code, and further escalation to netblocks added and removed to FailToBan for an hour duration at the worst counteraction. automated, and undoable by support.
<h3>obfu(scation)-cription</h3>obfu-cription. which is layering levels of encryption and obfuscation in a recipe that can be done forwards and back if you have all the ingredients and the recipe of library functions and version used.
<h3>FS FileTree and array include structure</3h3> as a alternate db bridge. possibly with obfu-cription.
<h3>...</h3> theres already a lot i said here and there. thats why i need a single doc with a TOC.
<h3>and also make it simpler and cleaner</h3> if that is not enough complex work.

<h1>Features</h1>
	<h2>Output Buffer Blocking</h2>
		<h3>OBB HASH-URL Markup Language: <sup>#type#uri:param;command;...#</sup></h3> This is a server side url which becomes evaluated and replaced or is an event's output so it becomes and can take a payload. These are recursively solved from the output of the request. I might refer to these as [building] BLOCKS (of output, or information).
		<h3>Stateless Recursive Output Blocks <sup>and alternate format conversion</sup></h3>
		<h3>HTTP Output Channeling <sup>http3 and prior</sub></h3>  Essentially this is the beginnings of output channeling for its own http3 process AND/OR parallel subsequent http 1-3 requests.
		<h3>Resource Alternates and Extensions <sup>per session and public</sup></h3> You will be able to alter, extend, replace resources called by the result from the process your working under.
		<h3>Templates and Layouts in html php and tpl if you want.</h3> You have the full php language.
		<h3></h3>
		<hr>
	<h2>Forced Kernel Mode PHP</h2>
		<h3>Making PHP Right <sup>and Kernel Optimization Wrong</sup></h3> First off you want your script to be doing what your saying. So you want php to run in Kernel Mode; but surprisingly that is not a thing. Unless you go through some lengths to make it that way; and there is not really wa way to do that. So the kernel has to decide that it is wrong, and back off of process optimization; and then you get the result you desire after opt-cash is made. If php became kernel mode on its own, things would go even faster and it would be doing exactly as you say. For now this is the best you get.
	<hr>
	<h2>Event Levels<h3>
		<h3>e.POOP <sub>Event based</sub> 
			<sup>Process</sup>
			<sub>Oriented</sub>
			<sup>Object</sup>
			Programming - or hash (#) pipes, like a system pipe ;->
		</h3> Its the thing that cant and should be; you should really try it out; as it is everything from every camp. OOP vs POP. Events!, POP and OOP. All at the same time, like they are the same thing.
		<h3>Request Response Result Production</h3> Tracking.
		<h3>Tracks changes between events <sup>Saves Work</sup></h3>
	<hr>
	<h2>SEO</h2>
		<h3>Used/Missing/Forced Keywords</h3> reporting of your seo hits and misses for a page once you make your seo serps array configuration in _INTIN.
		<h3>response output without template boiled down user text content.</h3> words found in your template will not count to the SEO'able content and automation of KEYWORDS in the HTML output.
		<h3>dynamic and seo file per request customization.</h3>You can change the SEO configuration at any time because it is an array. You can have index.php also pair with index.seo.php from a external user's home directory; if you wanted... or something like that. You SEO team wont need web access and they can process or modify anything; after it is done as it is being renderer. .seo.php files may be in an isolated ftp or user folder.
		<h3>the application may programmatically add and remove seo response metadata.</h3>
	<hr>
	<h2>Debug and Persistent Recursive Dump</h2> which with History will be able to see previous session related server responses and environments. So if you want to go HIPPA compliant, you can implement secure storage or remote mounts of such. you can use session and files or parts of filesystem but you will have to solve security with configuration and physical implantation. History will be in session, and it will be unafraid to get big, and it will only make a single sessID cookie. There will be a way to implement no caching of certain files/responses or everything.
	<hr>
	<h2>Minified! <sup>after your merge</sup><h2> This script gets it done in very small, try minimizing it with a program that takes notes out and makes it as small as possible.
	<hr>
	<h2>PHP Language <sup>Is what you get</sup></h2>
		You are expected to make your own things in PHP and what you can produce with it. You get the full language in this platform and you have control to break out of the sanity check wrapper. The Site Engine and Application Firewall is what you do with to the process environment prior to and without modification to your existing scripts and apps. PHP is essentially C language; am I wrong? I use a C style code macro defined and evaluated when called; but it currently only sets the main global structured array. As for Namespace that switching is on you and at present it is currently uninitiated and therefore not switched unless you manage it. The debugger at present does not version and dump all namespaces; only what your on.
	<hr>
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
		<h3>Self Check sanity and standard enforcement audits and checks.</h3> Ability to spider it self and probe for misconfigurations, verify production or development identity, installation, and logs. So that your problem is not that you dont periodicals check for certain things. [at present in no way at all]
	<hr>
	<h2>Server Side Terminal Rendering <sup>In high JPEG fps as a stream</sup></h2> and that is just me tinkering with any ol thing to have something in this project to run as I master the environment it runs in. It should be noted that if you want a php form submitted during an ongoing php generated stream or output or even into an already running process... you might want to take a loot at what I am doing. I am making a mjpeg stream as a sort fo server side image map where as the touch/click, gestures, and keys will be sent over post with slight Javascript (basic and common to browsers on any device). This is just a proof of concept. You can touch the screen and a dot's location will be chosen as it fly's through random. That is all it does besides this nifty trick of inserting information into a running process (With a database because sessions don't have an update or merge event built into php).
	<hr>
	<h2>Light Bench Performance Report <sup>with its own secondary application firewall<sup> </h2> May need to press ALT+SHIFT+K and you will see there is the potential for time awareness. Here is how the output currently works. All CAPS events are major, and mixed case is minor. It will try to consolidate Major and Minor Events if they are less than a few percent of the total report so you may not see all your major events. Bench snapshots will be made around the php kernel events with snapshots of memory changes if enabled.
<h1>Kelly<sup>702-900-5355</sup><sub>702-748-7764‬</sub></h1> Should mostly be a working phone. Google Voice should forward the call txt or v-mail to me.
<h2>I now have a phone and some data in San Diego and I am in a shelter; maybe a bank soon... so for now don't get scammed on a donation.</h2> There is no donate route that I know at the moment that is actually for me or obtainable. I need to get a bank for my paypal or something.‬
<h1>Auto w/Manual SEO Notice</h1>
<h2>View Source - HTML>HEAD>META</h2> this page has html meta keywords for present and possibly forces serps if it is in the content of the code. the serps are in RUSH\_INTIN.php but you may change them at any time programmatically. 
<h1>Interesting Test Case.</h1>
<h3>Included MODE_SELF_INITIATE CMS BLOCKS</h3>
#mod:example;WiKi_TOC#
<h3>Included afterBY Virtual</h3>
#mem:PageTOC;#
<h1>The Code that made this if this is development <sub>below</sub>.</h1>
<?php
require_once('Wiki-From-Heading-TOC.php'); //NOTICED THIS DOES NOT WORK AS EXPECTED. 2nddary include from virtual doesn't run till post debug or not at all.

?>