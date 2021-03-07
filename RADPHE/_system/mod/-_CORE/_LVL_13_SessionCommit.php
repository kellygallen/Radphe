<?php
if(session_id()) {
	@session_write_close(); //Closes writing to the output buffer.
	//i dont no. could already be aborted for write ability. that situation should definitely die early. and not make it this far.
}
?>