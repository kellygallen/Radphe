<?php
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php');//Fallback Hook.
if (!empty($_INTIN['DB']['Profiles']['Defaults']['Host'])) $Link = DBConn::connect();
?>