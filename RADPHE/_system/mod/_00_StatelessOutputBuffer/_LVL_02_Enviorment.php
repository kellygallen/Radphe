<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_StatelessOutputBuffer/CMS.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_StatelessOutputBuffer/CMS-SEO.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_StatelessOutputBuffer/CMS-SKINNER.php');
CMS_Skinner::Init();
CMS_Blocks::SetTopBlock('Layout');
function HashTagWall(&$item, $key) {
    preg_match_all('/'.CMS_Blocks::TagBlockHead.'('.CMS_Blocks::TagPart1.')'.CMS_Blocks::TagBlockPart2Delimiter.'('.CMS_Blocks::TagPart2.')'.CMS_Blocks::TagBlockPart3Delimiter.'('.CMS_Blocks::TagPart3.')'.CMS_Blocks::TagBlockFoot.'/i', $item, $matches, PREG_SET_ORDER);
    foreach ($matches as $MatchNum=>$MatchArr) {
        $item = str_replace($MatchArr[0], ' #Blocking #BlockTag ', $item);
        //get mad?
    }
}

array_walk_recursive($_GET, 'HashTagWall');
array_walk_recursive($_POST, 'HashTagWall');
?>
