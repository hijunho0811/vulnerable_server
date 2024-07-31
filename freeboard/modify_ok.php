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
$sql = mq("update freeboard set name='".$username."',title='".$title."',content='".$content."' where idx='".$bno."'");

?>

<script type="text/javascript">alert("수정되었습니다."); </script>
<meta http-equiv="refresh" content="0 url=/freeboard/read.php?idx=<?php echo $bno; ?>">
