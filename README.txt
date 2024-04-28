homeless, outlook bleek for updates any time soon. or community to organize manage modules. if you like though you can donate some 'beer' money to me on cashapp $RADPHE

would be less beer and more like boost nutrition drinks unless I get going with enough or a situation to try with.
........ 2024 ........

Suggestion: read wiki file from example mod resources https://github.com/kellygallen/Radphe/blob/main/RADPHE/_system/mod/disabled/example/_Resources/Wiki-Single-Doc.php

Turnkey LAMP on VM in VMWare or VirtualBox BUT bare metal doesn't suffer CLICK.

mod_php not fcgi though that works mostly too.

Unix/Linux/Windows/WSL but really _NIX so you get the php/perl/python/ruby as it was intended on the primary os that it was intended for running for-real directly on hardware. I am Old School. You want more? Load Balancers and clusters or session on shared nfs.

.htaccess with AllowOveride All from Apache site definition is depreciated but you do still want the example merged in for mod_rewrite precautions enabled.
Now you will install the root preferred blanket hook with .user.ini


Install
0) PROJECT\RADPHE\WEBROOT so _system is in the root of the web.
1) make the right path to site engine hook in .user.ini
1a)	You Currently need .htaccess enabled for some crucial hardening as well as the root blanket hook. This is the intended way. Apache "AllowOveride All" installed on either the http&s definitions of your site or the global default for all definitions. You may also install it just for a directory in your Apache related configuration files. The argument against doing it to all on dedicated hosting is that it may also affect other apache mods and virtual directories like mod_stats. On the other hand, if you don't use interfaces like mod_stats for Apache Status reporting then it 404's all the requests for that mod_service. There are lots of ways to bypass, back-out, skip over (default: it reacts), or be exempt from it even though it gets into everything.
	*	The full path is required for php_value auto_prepend_file "FILE.php"
	*	It should be in quotes but on some os's may need to be in single quotes. " vs '
	*	This will affect all sub directories. You may prune its affects and inheritance with "f.php" vs NONE without quotes. If that doesn't work you can change it to a new blank file names skip.php; because this sets up code running before all code.

1b)	It may also be coded into php's actual configuration i suppose. but this is a old copy because it was almost lost as a project, and it does not have any other in code hardening (for it self).

2)	You will currently want Apache mod_rewrite for hardening implemented by htaccess.
		a2enmod rewrite
Though not necessary, the code can protect it self.

3) For Production rename or delete -RADPHEindex.php but leave -RADPHError404.php in web root with _system folder.<br>Then delete <u>/_system/mod/disabled</u> <u>/_system/mod/example</u> <u>/_system/mod/example</u> <u>/_system/_DevServer.php</u><br>
Doing this should make it act more production ready but it certainly will need your files merged in to the site root.

4) edit or merge your _INTIN.php and config files
<ol>
<li>/_system/Rush/_INTIN.php</li>
<li>/_system/_ProServer.php</li>
<li><b>/_system/_DevServer.php <sup>OK TO BE MISSING or renamed unlike others.</sup></b><br>
_DevServer.php <sub>or inversely you might see _DevServer.php.disabled</sub> CAN TOGGLE the server state to dev and activate the terrible demo resources and mods.</li>
<li>/_system/_DEV_Config.php</li>
<li>/_system/mod/-_CORE/_LVL_00_RequirementsCache.php</li>
<li>/_system/mod/-_CORE/_LVL_01_Config.php</li>
</ol>

5) Default Design and example folder. You can switch this programmatically if you keep the structure.
/_system/mod/_00_StatelessOutputBuffer/Layouts/-DefaultCORE
The immediate files in side are different 'layouts' of the same design possibly a layout chooser and common peaces among all layouts in the design.

6) You may also install the example modules/apps. move <u>/_system/mod/disabled/example</u> to <u>/_system/mod/example</u> rather than deleting it.

7) Kernel Event Levels and installed MODS:
The _LVL_ files in RADPHE\_system\mod\-_CORE
determine the events and their order for the rest of the modules.
at present you at least need a blank file _LVL_##_EVENTname.php file in -_CORE for it to happen as an event for the rest of the modules.
the order is determined by natural-sort so the ## becomes your own numbering levels and that sets the order of the events; or allows you to move them around if your code allows. 

8) mostly you don't need to make a mod. continue like you make your apps... the site engine will wrap them.
the difference is that you only put into the request file what needs to change in the content area of your layout for the rest of your site.
so each request has only what makes it different on the site.
if you code had it's own layout and template then it just needs to set the top block to request.
and you will bypass mostly the template injection.

This folder /_system/mod/_00_StatelessOutputBuffer/Layouts/-DefaultCORE/_Resources
is for resources that are included in the Design, but only the first found will be used regardless of which design is selected as this could differ greatly and the best way for you to have non overlapping virtual resources is for you to keep their URL namespace unique enough in name and or path.
If you really want control over which file is served... install it as a real file and not a module virtual by copying it out of the _system branch.
OR you may also consider hardlink'ing it to have the same file exist in 2 places.

In a way you can use it as an application firewall... how about a fire umbrella; because to be serious any firewall should be its own physical device and you can do that to with this.

It has a Application.php inheritance, and it has a visual variable dump akin to coldfuaion style rapid development. But it also has some other trickery plus the whole time its just you. Doing what you want on a request script, programming only how that script is different from the rest of the site. That is difficult to picture. Your index.php has only what makes it differ from the rest of the pages, it possibly doesn't even have a include of the underlying code. I do this as peer code though; it is not any deeper your supporting services.

want to exit just your script early? try return;
you may also $var=include(scropt.php); and inside that script... return(what var should be.);