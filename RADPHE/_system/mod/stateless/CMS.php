<?php
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php');//Fallback Hook.
//start block begins ob buffer capture with callback to end block.
//start block of all types may replace,pre,post,insert default post.
//	mode if a and b measure the block. a=before, default *b=after, c=drop for now but version cancel sooner or later., or insert with preg_replace pattern on end ob level callback.
//start default top block to request.
//fallback block dump featuring assembles template with request on the stream side. and debug bench
//therefore endblock by name brings it down to that level and nameless ends last of function call kind.
//make blocks be incremented for all writes and choose that orden to start dumping from.
//alternate block containing pointer to alternate block. in indexed array of block edits... to that insert also has templating without complex rex-ex pattern replacemnts.
//pre and post block fuctions/modes must insert into array and increment after keys maybe not in that order. walk array mod vs rebuild replace vs bubble shift.
//HOPEFULLY what you end up with is the ability to start throing output fragments around in all sorts of wierd orders that with optional termination of the block so long as you make a new output redirection. and the ob buffer level could get insanely deep throwing output here and there per each level then it all collappes like magig and all the callbacks for each new block come out assembled and routed.
//optionaly you can control your ob levels with ending blocks.
//CMS_Blocks::init();
?>
