<?php
bench('APP START');
if (file_exists(dirname($_SERVER['PHP_SELF']).'/_Application.php')) {
    bench('Application Override');
    include dirname($_SERVER['PHP_SELF']).'/_Application.php';
} elseif (include_closest(dirname($_SERVER['PHP_SELF']).'/_application.php')) {
    bench('Application Stackable');
} else {
    bench('Application not present');
}
bench('APP DONE');

?>