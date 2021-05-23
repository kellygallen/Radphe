<?php
    //For The Example: The Manual is the default request.
    include('Wiki-Single-Doc.php');
	@$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= '';
	$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= '<blockquote>Contents of this file:'.__FILE__.'<hr><pre><code>';
	$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= highlight_file(__FILE__,true);
	$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= '</code></pre></blockquote>';

    echo '<br><hr><br><hr><br>';
    //Then also the Radphe Index.
    include($_SERVER['DOCUMENT_ROOT'].'-RADPHEindex.php');
?>