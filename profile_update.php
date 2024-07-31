<?php
    session_start();
    $session_username = $_SESSION['username'];
    if( is_null($session_username)) {
        header( 'Location: login.php' );
    }

    header('Content-Type: text/html; charset=utf-8');

    $db = new mysqli("localhost", "hijunho0811", "wedd1108", "myuser1");
    $db -> set_charset("utf8");

    function mq ($sql)
    {
        global $db;
        return $db -> query($sql);
    }


?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>HOME</title>
        <link rel="stylesheet" href="/css/loginstyle.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="/css/gallery.css">
    </head>
    <body class="loggedin">
    <!-- Nav Bar -->
        <nav class="navtop">
            <div>
                <h1>My Website</h1>
                <a href="/home.php"><i class="fas fa-home"></i>Home</a>
                <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
                <a href="/member/logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </div>
        </nav>
        <div class="container mt-3">
            <div class="row">
                <div class="col-sm-12 col-md-3 col-lg-2 p-2">
                <!-- Sidebar  -->
          <nav id="sidebar" class="border-top border-secondary">
            <div class="list-group">
              <a class="rounded-0 list-group-item list-group-item-action list-group-item-light " href="/freeboard/index.php">자유게시판</a>
             
            </div>
                    </nav>
                </div>
                <div class="col-sm-12 col-md-9 col-lg-10 p-2">
                    <div class="content">

<h2>내 정보</h2>
<div class="col-11">
    <div class="card">
        <div class="card-body">

    <div class="find">
        <form method="post" action="profile_update_ok.php">
            <?php
                $sql1 = mq("select * from member where id ='{$_SESSION['username']}'");
    while($member = $sql1->fetch_array()){
            ?>
        <fieldset>
            <legend>Profile</legend>
                <table>
                    <tr>
                        <td>아이디</td>
                        <td><input type="text" size="35" name="username" value="<?php echo $_SESSION['username']; ?> (아이디는 변경불가)" disabled></td>
                    </tr>
                    <tr>
                        <td>패스워드</td>
                        <td><input type="password" size="35" name="password"?></td>
                    </tr>

                    <tr>
                        <td>이름</td>
                        <td><input type="text" size="35" name="name" placeholder="이름" value="<?php echo $member['name']; ?>"></td>  
                    </tr>
                    <tr>
                        <td>주소</td>
                        <td><input type="text" size="35" name="address" placeholder="주소" value="<?php echo $member['address']; ?>"> </td>" 
                    </tr>
                    <tr>
                        <td>성별</td>
                        <td>남<input type="radio" name="sex" value="남"> 여<input type="radio" name="sex" value="여"></td>
                    </tr>
                    <tr>
                        <td>이메일</td>
                        <td><input type="text" size="35" name="email" placeholder="이메일" value=<?php $str= explode("@", $member['email']); $str = $str[0]; echo $str; ?>>@<select name="emaddress"><option value="naver.com">naver.com</option><option value="nate.com">nate.com</option><option value="hanmail.com">hanmail.com</option><option value="daum.net">daum.net</option><option value="gmail.com">gmail.com</option></select></td>  
                    </tr>
                </table>
                <button type="button" class="btn btn-primary" onclick="location.href='profile.php'">뒤로가기</buton>
                <button type="submit" class="btn btn-success" onclick="location.href='profile_update.php'">수정하기</buton>



            </fieldset>
        <?php } ?>
        </form>
    </div>  





        </div>
    </div>
</div>


                    </div>
                </div>
            </div>
            <hr>
        </div>
    
        <footer class="footer">
</footer>
<script src="/js/jquery-3.4.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
    </body>
</html>
