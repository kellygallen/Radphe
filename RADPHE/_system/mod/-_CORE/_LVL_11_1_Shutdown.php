<?php return 'NOT READY';
foreach ($_INTIN['MOD']['']['AWARENESS']['Mods'] as $CoreLevel) {
	//$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][@$_INTIN['CORE']]['Prior-STATE']
	foreach($CoreLevel as $modLevel) {
		foreach($modLevel as $ModInclude) {
				foreach ($ModInclude['RETURN'] as $ModuleInheritance) {
					foreach ($ModuleInheritance as $ModType => $IncACL) {
						/*//run _MODE_ACL_step.php		_MODE_ACL_relative.php
						//it processes relative and stepped named run levels.
						//it decides if ACL prepends a 1 or a 0 to a acl string variable.
						//if not present it skips having acl weighted digit say. for a deny.
						//the module will have its chance to object with a strength measured in weight from NOComplain=0; to severity of objection.
						which once it goes into the alpha numerics will mean that it tarnished a neighbors count.
						so you can set a threshold window of grey.
						you have have one push a issue so hard it concerns its neighbor digit which happens to be in the decision window on a lessor weighting of the levels.
						0=no problem
						1=notice
						2=warning ; actually adds 1 to both its less authoritative neighbor digit..
						3+ error window for example; actually adds a 1 both its neighbors.
						9=stacking like a +1 pyramid centered to its digit.
						a=stacking like a +1 pyramid centered to it less important neighbor.

						or it may have its own logic to just say no, it may only check its one thing.

						ordered digits by severity list of absolute no!'s
						then appended order of mod level inheritance root is most severe
						then custom module named events

						but this area is for module event levels that are relative.... LVL_<priority><**_Optional Relatively word or step increment**>_NamedEvent.php

						it is this way because the script may return what ever it feels like and the module must know what to think of it or to judge on other things.
						*/
					}
					//same as adobe but above is grouped as a single digit for all relative or steps by it _MODE_ACL_module.php which if has a relative step decision is probably that answer but may change.
					//this makes the same decision about its acl based on what ever it wants
					//this gets recorded to ACL string digits, the other does not.
					//Then mode_ACL_take_over will give it a chance to take over it it doesn't like its digit or others. they may also be weighted with a meaning.
					//there will also be array structure room for pushing up messages and alerts to places.
					//it can be as strict or and spreading of weight and meaning as you like.
					//it can have acl conditional take over.

				}
		}
	}
}
/*
 * 			$_INTIN['MOD']['']['AWARENESS']['CORE']['ACL'][$_INTIN['CORE Level']][(key)] = $ModInclude['RETURN']['CORE'];
			$ModInclude['RETURN']['CORE']['']= $_INTIN['MOD']['']['AWARENESS']['CORE']['ACL'];
			$_INTIN['MOD']['']['AWARENESS']['CORE']['ACL'] .= $ModInclude['RETURN']['CORE'];

	THE ACL STRING is then converted to a binary with a plus or minus window determined by the module for its held digit.
	and that value is settles to a 1  or a 0 for allow.
	now that string is cast as a integer. which may be 0 for allow or a higher number for a stronger dislike.


*/
?>