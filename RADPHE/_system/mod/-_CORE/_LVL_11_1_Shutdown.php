<?php return 'NOT READY';
foreach ($_INTIN['MOD']['']['AWARENESS']['Mods'] as $CoreLevel) {
	//$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][@$_INTIN['CORE']]['Prior-STATE']
	foreach($CoreLevel as $modLevel) {
		foreach($modLevel as $ModInclude) {
				foreach ($ModInclude['RETURN'] as $ModualInheritance) {
					foreach ($ModualInheritance as $ModType => $IncACL) {
						/*//run _MODE_ACL_step.php		_MODE_ACL_relative.php
						//it precesss relative and stepped named runlevels.
						//it decides if ACL prepends a 1 or a 0 to a acl string variable.
						//if not present it skips having acl weighted digit say. for a deny.
						//the modual will have its chance to object with a strencth measured in weight from NOTcomplain=0; to severity of objection.
						which once it goes into the alpha numerics will mean that it tarnished a neighbors count.
						so you can set a threshhold window of grey.
						you have have one push a issue so hard it concerns its neighbor digit which happens to be in the desision window on a lessor weighting of the levels.
						0=no prolem
						1=notice
						2=warning ; actualy adds 1 to both its less authoritive neighbor digit..
						3+ error window for example; actualy adds a 1 both its neighbors.
						9=stacking like a +1 pirimid centered to its digit.
						a=stacking like a +1 pirimid centered to it less important neighbor.

						or it may have its own lodgic to just say no, it may only check its one thing.

						ordered digits by severity list of absolute no!'s
						then appended order of mod level inheritance root is most severe
						then custom modual named events

						but this area is for modual event levels that are relative.... LVL_<priority><**_Optional Relativ word or step increment**>_NamedEvent.php

						it is this way becasue the script may return what ever it feels like and the modual must know what to think of it or to judge on other things.
						*/
					}
					//same as abobe but above is grouped as a single digit for all relative or steps by it _MODE_ACL_module.php which if has a relative stepp decision is probably that answer but may change.
					//this makes the same desicion about its acl based on what ever it wants
					//this gets recorded to ACL string digits, the other does not.
					//Then mode_ACL_tke over will give it a chance to take over it it dosent like its digeit or onothers. they may also be weighted with a meaning.
					//there will also be array structre room for pushing up messages and alerts to places.
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

	THE ACL STRING is then converted to a binary with a plus or minus window determined by the modual for its held digit.
	and that value is settles to a 1  or a 0 for allow.
	now that string is cast as a integer. which may be 0 for allow or a higher number for a stonger dislike.


*/
?>