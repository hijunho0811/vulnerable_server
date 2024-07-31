<?php 
	include $_SERVER['DOCUMENT_ROOT']."/freeboard/db.php";
	error_reporting(E_ALL);

	ini_set("display_errors", 1);

	session_start();
	$session_username = $_SESSION['username'];
	if( is_null($session_username)) {
		header( 'Location: ../login.php' );
	}

	header('Content-Type: text/html; charset=utf-8'); 

	

	$connect = mysqli_connect("localhost", "hijunho0811", "wedd1108", "myuser1") or die("fail");
	$id = $_SESSION['username'];
	$title = $_POST['title'];

	$tmpfile =  $_FILES['b_file']['tmp_name'];
	$o_name = $_FILES['b_file']['name'];
	$filename = iconv("UTF-8", "EUC-KR",$_FILES['b_file']['name']);
	$folder = "upload/".$filename;
	move_uploaded_file($tmpfile,$folder);
	$content = $_POST['content'];             

	$URL = "index";

	if($id && $title && $content){;
		$sql = mq("insert into freeboard(name, title, content, date, hit, recom, file) values('".$id."','".$title."','".$content."',now(), 0,0, '".$o_name."')");
		echo "<script>
    alert('글쓰기 완료되었습니다.');
    location.href='/freeboard/index.php';</script>";
}else{
    echo "<script>
    alert('글쓰기에 실패했습니다.');
    history.back();</script>";
}
?>

<script type="text/javascript">alert("등록되었습니다.");</script>
<meta http-equiv="refresh" content="0 url=index.php" />
