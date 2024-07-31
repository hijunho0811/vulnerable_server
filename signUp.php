<?php
session_start();
$id=$_POST['userid'];
$pw=$_POST['userpw'];
$pwc=$_POST['userpwconfirm'];
$sex=$_POST['sex'];
$address=$_POST['adress'];
$name=$_POST['name'];
$email=$_POST['email'].'@'.$_POST['emadress'];
 
if($pw!=$pwc) //비밀번호와 비밀번호 확인 문자열이 맞지 않을 경우
{
    echo "비밀번호와 비밀번호 확인이 서로 다릅니다.";
    echo "<a href=signUp.html>back page</a>";
    exit();
}
if($id==NULL || $pw==NULL || $name==NULL || $email==NULL) //
{
    echo "빈 칸을 모두 채워주세요";
    echo "<a href=signUp.html>back page</a>";
    exit();
}


$encrypted_passwd = password_hash($pw, PASSWORD_DEFAULT);
$mysqli = mysqli_connect( 'localhost', 'hijunho0811', 'wedd1108','myuser1' ); 
$check="SELECT *from member WHERE id='$id'";
$result=$mysqli->query($check);
if($result->num_rows==1)
{
    echo "중복된 id입니다.";
    echo "<a href=signUp.html>back page</a>";
    exit();
}
 
$signup=mysqli_query($mysqli,"INSERT INTO member (id,pw,name,address,sex,email) 
VALUES ('$id','$encrypted_passwd','$name','$address','$sex','$email')");
if($signup){
	header('Location: ./main.php');
}

 
?>
