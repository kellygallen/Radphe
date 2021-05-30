<?php

if (!isset($_GET['ShowLongestRoute'])) die();

return 'NOT READY';

foreach ($_INTIN['MOD']['']['AWARENESS']['Mods'] as $CoreLevel) {
	foreach($CoreLevel as $modLevel) {
		foreach($modLevel as $ModInclude) {
				foreach ($ModInclude['RETURN'] as $ModuleInheritance) {
					foreach ($ModuleInheritance as $ModType => $IncACL) {
					}
				}
		}
	}
}
?>