<?php

//CMS-Blocks - Stateless Management at any time, of the building blocks of a response.
require_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_StatelessOutputBuffer/CMS.php');
//CMS-SEO - Seemingly pointless but through alteration of the html metadata per response.
require_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_StatelessOutputBuffer/CMS-SEO.php');
//CMS-Skinner -
require_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_StatelessOutputBuffer/CMS-SKINNER.php');
CMS_Skinner::Init();
CMS_Blocks::SetTopBlock('Layout');
//CMS_Blocks::Init();
//CMS_Blocks::startBlock('Layout');//Root of recursive block call and replace.
//CMS_Blocks::endBlock();//not required if you call a new block unless you terminate it.
//CMS_Blocks::startBlock('SEOKeywords');//Example Keywords meta override in layout
//CMS_Blocks::startBlock('SEOPageTitle');//Example Page Title override in layout
//CMS_Blocks::startBlock('SEODescription');//Example Page Description Override in layout.
//CMS_Blocks::startBlock('SEOMeta');//Example meta tags to MERGE in.
//CMS_Blocks::endBlock('SEOMeta');//Like right there it might have been necessary to finish a block clean. endBlock

//This is a permissive surgeon firewall example.
function HashTagWall(&$item, $key) {
    preg_match_all('/'.CMS_Blocks::TagBlockHead.'('.CMS_Blocks::TagPart1.')'.CMS_Blocks::TagBlockPart2Delimiter.'('.CMS_Blocks::TagPart2.')'.CMS_Blocks::TagBlockPart3Delimiter.'('.CMS_Blocks::TagPart3.')'.CMS_Blocks::TagBlockFoot.'/i', $item, $matches, PREG_SET_ORDER);
    foreach ($matches as $MatchNum=>$MatchArr) {
        $item = str_replace($MatchArr[0], ' #Blocking #BlockTag ', $item);
        //get mad?
    }
}

array_walk_recursive($_GET, 'HashTagWall');
array_walk_recursive($_POST, 'HashTagWall');
//array_walk_recursive($_FILES, 'HashTagWall');
?>
