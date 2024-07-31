
 

<?php
	session_start();
	header('Content-Type: text/html; charset=utf-8'); // utf-8인코딩

	$db = new mysqli("localhost", "hijunho0811", "wedd1108", "myuser1");
	$db->set_charset("utf8");

	function mq($sql)
	{
		global $db;
		return $db->query($sql);
	}
?>
