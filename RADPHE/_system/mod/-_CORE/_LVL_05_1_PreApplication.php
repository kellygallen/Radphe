<?php

//Application Area Code - Code that is run before any other code in an area.
bench('APP START');
if (file_exists(dirname($_SERVER['PHP_SELF']).'/_Application.php')) {
    bench('Application Overide');
    include dirname($_SERVER['PHP_SELF']).'/_Application.php';
} elseif (include_closest(dirname($_SERVER['PHP_SELF']).'/_application.php')) {
    bench('Application Stackable');
} else {
    bench('Application not present');
}
bench('APP DONE');

?>