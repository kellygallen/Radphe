<?php 
    $_INTIN['Dump'][__FILE__]=1;
    if (($_SERVER['REQUEST_URI']==$_SERVER['PHP_SELF'])||($_SERVER['REQUEST_URI']=='/'.$_SERVER['PHP_SELF'])) {
        if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$_SERVER['PHP_SELF'])) {
            @$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= '';
            $_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= '<center><hr>Contents of this <b>REAL SITE ROOT FILE</b>: /'.$_SERVER['PHP_SELF'].'<hr></center>';
            $_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= '<blockquote><pre><code>';
            $_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= highlight_file($_SERVER['DOCUMENT_ROOT'].'/'.$_SERVER['PHP_SELF'],true);
            $_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= '</code></pre></blockquote>';
        }
    }
?>