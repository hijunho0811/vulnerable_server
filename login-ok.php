<?php
	session_start();
	$session_username = $_SESSION['username'];
	if( is_null($session_username)) {
		header( 'Location: login.php' );
	}

?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8" />
	<title>메인페이지</title>
</head>
<body>
	<?php
	if(isset($_SESSION['username'])){
		header( 'Location: home.php' );
	?>


	<a href="/member/logout.php"><input type="button" value="로그아웃" /></a>
	<?php 
		}else{
		echo "<script>alert('잘못된 접근입니다.'); history.back();</script>";
	} 
	?>
</body>
</html>
