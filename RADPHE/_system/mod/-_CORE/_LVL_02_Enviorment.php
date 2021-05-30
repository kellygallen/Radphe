<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);

//Lay Statewide or default Foundation
//Include Closest - Used to check for and include the closest file if it exists.
/*	_application.php uses this to find the first parent folder with this blanket Type file.
	it will split the unification of the site and give a sub folder its on branch of unification.
	you can also use .htaccess php-prepend NONE to terminate automatic inheritance at the branch folder. */
include_once($_SERVER['DOCUMENT_ROOT'].'/_system/function/include_closest.php');
//_application happens much later for it's own zones.
?>