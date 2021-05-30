<?php
if(session_id()) {
	@session_write_close();
}
?>