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

?>

<!doctype html>
<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/style.css"/>
    <link rel="stylesheet" href="/css/loginstyle.css">
    <link
        rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
        crossorigin="anonymous">
    <script
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
    <script
        src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/gallery.css">
        <?php
		$bno = $_GET['idx']; /* bno함수에 idx값을 받아와 넣음*/
		$hit = mysqli_fetch_array(mq("select * from freeboard where idx ='".$bno."'"));
		$hit = $hit['hit'] + 1;
		$fet = mq("update freeboard set hit = '".$hit."' where idx = '".$bno."'");
		$sql = mq("select * from freeboard where idx='".$bno."'"); /* 받아온 idx값을 선택 */
		$board = $sql->fetch_array();
	?>
</head>
<body class="loggedin">

    <nav class="navtop">
        <div>
            <h1>My Website</h1>
            <a href="../home.php">
                <i class="fas fa-home"></i>Home</a>
            <a href="../profile.php">
                <i class="fas fa-user-circle"></i>Profile</a>
            <a href="/member/logout.php">
                <i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </nav>
    <div class="container mt-3">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-2 p-2">
                <!-- Sidebar -->
                <nav id="sidebar" class="border-top border-secondary">
                    <div class="list-group">
                        <a
                            class="rounded-0 list-group-item list-group-item-action list-group-item-light "
                            href="/freeboard/index.php">자유게시판</a>
                       
                    </div>
                </nav>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-10 p-2">
                <div class="content">
                    <!-- 글 불러오기 -->
                    <div class="container my-3">
                        <h2 class="border-bottom py-2"><?php echo $board['title']; ?></h2>
                        <div id="row my-3">
                            <div class="col-11">
                                <!-- 질문영역 -->
                                <div class="card">
                                    <div class="card-body">
					<div class="card-text"><?php echo nl2br("$board[content]"); ?></div>
                                        <div class="d-flex justify-content-end">
                                            <div class="badge badge-light p-2 text-left">
                                                <div class="mb-2"><?php echo $board['name']; ?></div>
                                                <div><?php echo $board['date']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-text">첨부파일 <a href="upload/<?php echo $board['file'];?>" download><?php echo $board['file']; ?></a></div>
                        </div>

                    </div>

                </div>
                                <!-- 목록, 수정, 삭제 -->
                                <div class="row">
									<div class="col-md-4"><button type="button" class="btn btn-primary btn-sm" onclick="location.href='/freeboard/index.php'">목록으로</button></div>
                                    <div class="col-md-4"><button type="button" class="btn btn-warning btn-sm" onclick="location.href='modify.php?idx=<?php echo $board['idx']; ?>'">수정</button></div>
									<div class="col-md-4"><button type="button" class="btn btn-danger btn-sm" onclick="location.href='delete.php?idx=<?php echo $board['idx']; ?>'">삭제</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>

        <footer class="footer">
          
        </footer>
        <script src="/js/jquery-3.4.1.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
    </body>
</html>
