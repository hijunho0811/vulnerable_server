<?php 
include("connect.php");
error_reporting(E_ALL);

ini_set("display_errors", 1);



  session_start();
  $session_username = $_SESSION['username'];
  if( is_null($session_username)) {
    header( 'Location: /login.php' );
  }

  header('Content-Type: text/html; charset=utf-8'); // utf-8인코딩

?>
<!doctype html>
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
                <a href="../home.php"><i class="fas fa-home"></i>Home</a>
        <a href="/profile.php"><i class="fas fa-user-circle"></i>Profile</a>
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
    $menu = $_GET['menu'];
    $search = $_GET['search'];
if(isset($_GET["search"]))
{

    $search = $_GET["search"];

    $sql = "SELECT * FROM freeboard WHERE title LIKE '%" . $search . "%'";

    $recordset = mysqli_query($link, $sql);

    if(!$recordset)
    {

        // die("Error: " . mysql_error());

?>

        <tr height="50">
            <td colspan="5" width="580"><?php die("Error: " . mysqli_error($link)); ?></td>

        </tr>
<?php

    }

    if(mysqli_num_rows($recordset) != 0)
    {

        while($row = mysqli_fetch_array($recordset))
        {

            // print_r($row);

?>

        <tr height="30">

          <td width="70"><?php echo $row['idx']; ?></td>
          <td width="500"><a href="/freeboard/read?idx=<?php echo $row["idx"];?>"><?php echo $row["title"];?></a></td>
          <td width="120"><?php echo $row['name']?></td>
          <td width="100"><?php echo $row['date']?></td>
          <td width="100"><?php echo $row['hit']; ?></td>
        </tr>
<?php

        }

    }
    else{
?>
        <tr height="50">

            <td colspan="5" width="580">No Result found!</td>

        </tr>

<?php
}
mysqli_close($link);
}
?>
</table>
    <hr>
   <body>
    <div id="search_box">
    <form action="search.php" method="get">
      <select name="menu">
        <option value="title">제목</option>
        <option value="name">글쓴이</option>
      </select>
      <input type="text" name="search" size="40" value = "<?php echo $_GET['search']; ?>" required="required" /> <button>검색</button>
    </form>
    </div>
    <div id="write_btn">
      <a href="/freeboard/write.html" class="btn btn-outline-info float-right">글쓰기</a>
    </div>
  </div>
<script src="/js/jquery-3.4.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>

</html>
</body>
</html>
