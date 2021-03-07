<?php
//Render Request from Blocks
bench('RENDER');
CMS_Blocks::render();
bench('RENDERED');

//Commit Session. - Usually Not needed.
session_write_close();
//CMS_Blocks::closeBuffers(-1);
//OTHERWISE you can keep control of the request like this.
$endOB =0; //count opb buffers i didnt do.
//Close All open nested output buffering into their blocks.
while (@ob_end_flush()) $endOB++;
//otherwise die... done here.

?>