<?php
//CMSInitiatorTest();
function CMSInitiatorTest() {
//TODO:Stateless SEO CMS is not catching out of channel output for debug. which will be acl and login with role/group and config and session and ip with wild card bound... so for errors and debug and dump it will be threading a needle for it to get out... it may avoid http entirely. and will be repayable due to history.  catch not drop.
    echo 'OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS! OPS!';
    return (__FILE__.' WITH '.__FUNCTION__);
}
function CMSInitiatorTestMistake() {
    throw new Exception("Error Processing Request ON-PURPOSE",2);
    return ('Exception will be in _INTIN[Debug] array in alternate knowledge.');
}

//
?>