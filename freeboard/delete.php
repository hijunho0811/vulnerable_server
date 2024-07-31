<?php 
	session_start();
	$session_username = $_SESSION['username'];
	if( is_null($session_username)) {
		header( 'Location: login.php' );
	}

header('Content-Type: text/html; charset=utf-8');  
$db = new mysqli("localhost","hijunho0811","wedd1108","myuser1"); 
  $db->set_charset("utf8");

  function mq($sql)
  {
    global $db;
    return $db->query($sql);
  }
$bno = $_GET['idx'];
$username = $_SESSION['username']; 
$title = $_POST['title'];
$content = $_POST['content'];
$sql = mq("select * from freeboard where idx='$bno';");
$board = $sql->fetch_array();

if($username == $board["name"])
{
    $sql1 = mq("delete from freeboard where idx='$bno';");
    ?>
    <script type="text/javascript">alert("삭제되었습니다.");</script>
    <meta http-equiv="refresh" content="0 url=/freeboard" />
<?php
}
else 
{
?>
	<script type="text/javascript">alert("작성자가 아닙니다!");</script>
	<meta http-equiv="refresh" content="0 url=/freeboard" />
<?php
}
?>

