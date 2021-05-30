<?php
bench('RENDER');
CMS_Blocks::render();
bench('RENDERED');
session_write_close();
$endOB =0;
while (@ob_end_flush()) $endOB++;
?>