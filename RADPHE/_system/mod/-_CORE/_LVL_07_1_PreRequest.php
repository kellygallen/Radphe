<?php
//Handle Get post if unified to 1 handler.
//But this is an example of a Exception Hook.
//If there is a post, then handle it for a simple site.
//This should probably be left to the states of your request.
//but really the request can handle and terminate before this or at least empty the post array after its been handled.
if (!empty($_POST)) {
	//Was for login only being available on in-house self-hosted dev server.
	if (isset($_POST['LoginType'])) {
		require_once($_SERVER['DOCUMENT_ROOT'].'/_system/functions/_Login.php');//?
	} else {
//		require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_post.php');//unified post handler??
	}//might consider switch case default break(s) for more complex.
	bench('POSTED');
} else bench('Posted');
?>