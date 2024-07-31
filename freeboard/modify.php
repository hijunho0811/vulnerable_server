<?php 
	session_start();
	$session_username = $_SESSION['username'];
	if( is_null($session_username)) {
		header( 'Location: login.php' );
	}



	header('Content-Type: text/html; charset=utf-8'); 

  $db = new mysqli("localhost","hijunho0811","wedd1108","myuser1"); 
  $db->set_charset("utf8");


  	$bno = $_GET['idx'];
  	$username = $_SESSION['username'];
	$sql = mq("select * from freeboard where idx='$bno';");
	$board = $sql->fetch_array();
	if($username != $board["name"])
	{
	?>
		<script type="text/javascript">alert("작성자가 아닙니다!");</script>
		<meta http-equiv="refresh" content="0; url=index.php"></meta>
	<?php
	}

  function mq($sql)
  {
    global $db;
    return $db->query($sql);
  }
                
?>
<!DOCTYPE>

<html>
    <head>
        <meta charset="utf-8">
        <title>HOME</title>
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
    </head>
    <body class="loggedin">
        <nav class="navtop">
            <div>
                <h1>My Website</h1>
                <a href="../home.php">
                    <i class="fas fa-home"></i>Home</a>
                <a href="{{ url_for('profile.php') }}">
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
                        <form
                            method="post"
                            class="was-validated"
                            action="modify_ok.php?idx=<?php echo $bno; ?>"
                            enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="validationTextarea">제목</label>
                                <textarea
                                    class="form-control is-invalid"
                                    id="validationTextarea"
                                    name="title"
                                    placeholder="제목을 입력해주세요"
                                    required="required"><?php echo $board['title']; ?></textarea>
                                <div class="invalid-feedback">
                                    제목은 필수 입력 항목입니다!
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">본문</label>
                                <textarea
                                    class="form-control"
                                    name="content"
                                    id="exampleFormControlTextarea1"
                                    rows="10"><?php echo $board['content']; ?></textarea>
                            </div>
                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-primary">
                                        Browse&hellip;
                                        <input
                                            id="my-file-selecter"
                                            type="file"
                                            name="file"
                                            style="display: none;"
                                            onchange="$('#upload-file-info').val($(this).val());"
                                            multiple="multiple">
                                    </span>
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="upload-file-info"
                                    readonly="readonly">
                            </div>
                            <span class="help-block">
                                파일 용량 제한은 50MB입니다. 허용된 확장자는 jpg, jpeg, gif, png입니다.
                            </span>
                            <div class="col-auto my-1">
                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                    onclick='chkex(my-file-selecter.value);'>Submit</button>
                            </div>

                        </form>

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
