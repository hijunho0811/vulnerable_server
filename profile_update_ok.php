<?php
	session_start();
	$session_username = $_SESSION['username'];
	if(is_null($session_username)) {
    		header ( 'Location: login.php' );
	}
	header('Content-Type: text/html; charset=utf-8');
	$db = new mysqli("localhost", "hijunho0811", "wedd1108", "myuser1");
	$db->set_charset("utf8");

	function mq($sql)
	{
	    global $db;
	    return $db->query($sql);
	}

$id=$_SESSION['username'];
$password = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);
$sex=$_REQUEST['sex'];
$address=$_REQUEST['address'];
$name=$_REQUEST['name'];
$email=$_REQUEST['email'].'@'.$_REQUEST['emaddress'];


if( $name==NULL || $password==NULL || $email==NULL || $address==NULL || $sex==NULL ) //
{
	?>
	<script>alert("빈칸을 모두 채워주세요!"); location.replace('profile_update.php');</script>
<?php

    exit();
}

$sql = mq("update member set name='".$name."', pw='".$password."', address='".$address."', sex='".$sex."', email='".$email."' where id='".$id."'");

if($sql){
	?><script>alert("회원정보가 수정되었습니다."); location.replace('home.php');</script>
	<?php
}

 
?>
