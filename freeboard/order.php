<?php 
error_reporting(E_ALL);

ini_set("display_errors", 1);



  session_start();
  $session_username = $_SESSION['username'];
  if( is_null($session_username)) {
    header( 'Location: ../login.php' );
  }

  header('Content-Type: text/html; charset=utf-8'); // utf-8인코딩

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
    <meta charset="utf-8">
    <title>HOME</title>
    <link rel="stylesheet" href="/css/loginstyle.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css"/>
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
                <a href="../home.php"><i class="fas fa-home"></i>Home</a>
        <a href="../profile.php"><i class="fas fa-user-circle"></i>Profile</a>
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

<div id="board_area"> 
  <h2>자유게시판</h2>
<?php
echo "<p>{$_SESSION['username']} 님 환영합니다.</p>";
?>
  <p>자유롭게 글을 쓸 수 있는 게시판입니다.</p>
     <form method ="post" action="order.php">
     <input style='float:right;' type="submit" value="선택"/>
      <select style='float:right;' name="order" >
	<option value="">정렬 방법 선택</option>
	<option value="title">제목 (가나다 순)</option>
	<option value="name">글쓴이 (가나다 순)</option>
	<option value="date">작성일 (최신 순)</option>
	<option value="hit">조회수 (높은 순)</option>
      </select>
    </form>
    <table class="table table-hover" style="border: 1px solid;">
      <thead class="thead-dark">
          <tr>
              <th scope="col" width="70">번호</th>
                <th width="500">제목</th>
                <th width="120">글쓴이</th>
                <th width="100">작성일</th>
                <th width="100">조회수</th>
            </tr>
        </thead>
	<?php
	if(isset($_GET['page'])){
              $page = $_GET['page'];
	                  
	}else{
                  $page = 1;
		              
	}
  	$sql = mq("select * from freeboard");
	$row_num = mysqli_num_rows($sql);
	$list = 10; //한 페이지에 보여줄 개수
	$block_ct = 5; //블록당 보여줄 페이지 개수

	$block_num = ceil($page/$block_ct); // 현재 페이지 블록 구하기
	$block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호
	$block_end = $block_start + $block_ct - 1; //블록 마지막 번호

	$total_page = ceil($row_num / $list); // 페이징한 페이지 수 구하기
	if($block_end > $total_page) {
	    $block_end = $total_page; //만약 블록의 마지박 번호가 페이지수보다 많다면 마지박번호는 페이지 수
	}
	$total_block = ceil($total_page/$block_ct); //블럭 총 개수
	$start_num = ($page-1) * $list; //시작번호 (page-1)에서 $list를 곱한다.

	if($_POST['order'] == 'title')
	{
	    $sql3 = mq("select * from freeboard order by title limit $start_num, $list");
	}
	else if ($_POST['order'] == 'name')
	{
	    $sql3 = mq("select * from freeboard order by name limit $start_num, $list");
	}
	else if ($_POST['order'] == 'date')
	{
	    $sql3 = mq("select * from freeboard order by date desc limit $start_num, $list");
	}
	else if ($_POST['order'] == 'hit')
	{
	    $sql3 = mq("select * from freeboard order by hit desc limit $start_num, $list");
	}
	else{
            $sql3 = mq("select * from freeboard order by idx desc limit $start_num, $list"); 
	}
            while($board = $sql3->fetch_array())
            {
              //title변수에 DB에서 가져온 title을 선택
              $title=$board["title"]; 
              if(strlen($title)>30)
              { 
                //title이 30을 넘어서면 ...표시
                $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
              }
        ?>
      <tbody>
        <tr>
          <td width="70"><?php echo $board['idx']; ?></td>
          <td width="500"><a href="/freeboard/read?idx=<?php echo $board["idx"];?>"><?php echo $title;?></a></td>
          <td width="120"><?php echo $board['name']?></td>
          <td width="100"><?php echo $board['date']?></td>
          <td width="100"><?php echo $board['hit']; ?></td>
        </tr>
      </tbody>
      <?php } ?>
    </table>
    <div id="page_num">	
      <ul>
	<?php
	      if($page <= 1)
	      {
		  echo "<li class='fo_re'>처음</li>";
	      }else{
		  echo "<li><a href='?page=1'>처음</a></li>";
	      }
	      if($page <= 1)
	      {

	      }
	      else{
		   $pre = $page-1;
		   echo "<li><a href='?page=$pre'>이전</a></li>";
	      }
	      for($i=$block_start; $i<=$block_end; $i++){
		  if($page == $i){
		      echo "<li class='fo_re'>[$i]</li>";
		  }else{
		      echo "<li><a href='?page=$i'>[$i]</a></li>";
		  }
	      }
	      if($page >= $total_page){
		  
	      }else{
		  $next = $page + 1;
		  echo "<li><a href='?page=$next'>다음</a></li>";
	      }
	      if($page >= $total_page){
		  echo "<li class='fo_re'>마지막</li>";
	      }else{
		  echo "<li><a href='?page=$total_page'>마지막</a><li>";
	      }
	?>
      </ul>
    </div>
    <hr>
   <body>
   <br>
    <div id="search_box">
    <form action="search.php" method="get">
      <select name="menu">
        <option value="title">제목</option>
        <option value="name">글쓴이</option>
      </select>
      <input type="text" name="search" size="40" required="required" /> <button>검색</button>
    </form>
    </div>
    <div id="write_btn">
      <a href="/freeboard/write.html" class="btn btn-outline-info float-right">글쓰기</a>
    </div>
  </div>
    <footer class="footer">
  
</footer>
<script src="/js/jquery-3.4.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>

</html>
</body>
</html>
