Sugjestions: read wiki file from example mod resources

Turnkey LAMP on VM in VMWare or VirtualBox BUT bare metal if not clusters of it for production.

mod_php not fcgi.

Unix/Linux not Windows or WSL so you get the php/perl/python/ruby as it was intended on the primary os that it was intended for funning for real directly on hardware. Maybe I am Old School.

.htaccess with AllowOveride All from Apache site definition.

mod_rewrite enabled.




Install

1a)	You Currently need .htaccess enabled for some crucial hardening as well as the root blanket hook. This is the intended way. Apache "AllowOveride All" installed on either the http&s definitions of your site or the global default for all definitions. You may also install it just for a direcory in your Apache related configuration files. The argument agaist doing it to all on dedicated hosting is that it may also affect other apache mods and virtual directories like mod_stats. On the other hand, if you dont use interfaces like mod_stats for Apache Status reporting then it 404's all the requests for that mod_service. There are lots of ways to bypass, backout, skip over (default: it reacts), or be exempt from it even though it gets into everything.
	*	The full path is required for php_value auto_prepend_file "FILE.php"
	*	It should be in quotes but on some os's may need to be in single quotes. " vs '
	*	This will affect all sub directories. You may prune its affects and inheritance with "f.php" vs NONE without quotes. If that dosent work you can change it to a new blank file names skip.php; becasue this sets up code running before all code.

1b)	It may also be coded into php's actual configuration i suppose. but this is a old copy becasue it was almost lost as a project, and it does not have any other in code hardening (for it self).

2)	You will currently want Apache mod_rewrite for hardening implemented by htaccess.
		a2enmod rewrite

In a way you can use it as an application firewall... how about a fire unbrealla.

It has a Application.php inheritance, and it has a visual variable dump akin to coldfuaion style rapid development. But it also has some other tirckery plus the whole time its just you. Doing what you want on a request script, programming only how that script is differant from the rest of the site. That is difficut to picture. Your index.php has only what makes it differ from the rest of the pages, it possibly dosent even have a include of the underlying code. I do this as peer code though; it is not any deeper your supporting services.

want to exit just your script early? try return;
you may also $var=include(scropt.php); and inside that return(what var should be.)