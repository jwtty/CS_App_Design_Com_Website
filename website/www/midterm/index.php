<?php require "login/loginheader.php"; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet" media="screen">
  </head>
  <body>
	<?php
			session_start();
			$uname = $_SESSION['username'];
		//	$uname = "rogela";
			$ucat = $_SESSION['cat'];
			$url = "index.php";
			if($ucat==='0') {
					$url = "cgi-bin/student.php";
			}
			else if($ucat==='1') {
					$url = "cgi-bin/teacher.php";
			}
			else {
					$url = "forbidden.php";
			}
			echo "<script>window.location.href='{$url}';</script>";
	?>
    <div class="container">
      <div class="form-signin">
        <div class="alert alert-success">You have been <strong>successfully logged in</strong>.</div>
		<a href="login/logout.php" class="btn btn-default btn-lg btn-block">Logout</a>
      </div>
    </div> <!-- /container -->
  </body>
</html>
