<?php
    if ( in_array(realpath($_SERVER['DOCUMENT_ROOT'].'/-RADPHError404.php'),get_included_files()) && 
        (!empty($_GET['Resource'])) &&
        (!empty(@$_INTIN['MOD']['ResourceFinder']['found']['ModuleRelativeLocation']))
    ) {
        if (file_exists($_SERVER['DOCUMENT_ROOT'].'/_system/'.@$_INTIN['MOD']['ResourceFinder']['found']['ModuleRelativeLocation'])) {
            @$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= '';
            $_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= '<blockquote><center>Missing Resource Locator<hr>'.$_GET['Resource'].' IS '.$_INTIN['MOD']['ResourceFinder']['found']['ModuleRelativeLocation'].'<hr>According TO -RADPHEError404.php | core mod _ModuleResourceFinder<hr>core mod example _lvl_10_before_PreShutdown.php made this message...<hr> Contents of this VIRTUAL<sup>not in site root as ordered</sup> file: '.$_INTIN['MOD']['ResourceFinder']['found']['ModuleRelativeLocation'].'<hr></center><pre><code>';
            $_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= highlight_file($_SERVER['DOCUMENT_ROOT'].'/_system/'.$_INTIN['MOD']['ResourceFinder']['found']['ModuleRelativeLocation'],true);
            $_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= '</code></pre><center><hr>Notice that <a href="/style.css">/style.css</a> and other non executable or non dynamic VIRTUAL resources end abruptly without progressing in site engine.<hr>that is how you take full control and it can be encouraged at at times.</center></blockquote>';
        }
    }
?>