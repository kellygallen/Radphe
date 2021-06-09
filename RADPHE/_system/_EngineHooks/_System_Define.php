<?php
	$SystemInstances = glob('*/_SiteEngine.php');
    var_dump($SystemInstances);
    die(); //does not find all.
//    define('systemFOLDER',,true);
//TODO: make find and detect installs in wwwroot and provide a path define to them so kernel will possibly take on child event traits OR pass into the child instance rather than it's request to reach the resource.
//This file would solve all prepend hooks except for the line in every file fallback.
//it probably is better to rely on include_path behavior but I need internet for reference to dig into this.

?>