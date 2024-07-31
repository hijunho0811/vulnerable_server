<?php
	session_start();
	$res=session_destroy();
	
	if( is_null($session_username)) {
		header( 'Location: ../login.php' );
	}

	
?>
