<?php
if(session_id()) {
	@session_write_close(); //Closes writing to the output buffer.
	//i donno could already be aborted for write ability. that situation sould deffinitly die early.
}
?>