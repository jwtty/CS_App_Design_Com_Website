<?php require "../login/loginheader.php"; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Welcome, student!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../css/main.css" rel="stylesheet" media="screen">
    <link href="../dash.css" rel="stylesheet">
  </head>
  <body>
	<?php
			session_start();
			$uname = $_SESSION['username'];
			$ucat = $_SESSION['cat'];
			$uid = $_SESSION['uid'];
			$ustage = $_SESSION['stage'];
			if(!($ucat==='0')) {
					echo "<script>window.location.href='../login/logout.php'</script>";
					exit;
			}
			if($ustage === "evaluation") {
					echo "<script>window.location.href='../forbidden.php'</script>";
					exit;
			}
			else if($ustage === "finish") {
					echo "<script>window.location.href='./result.php'</script>";
					exit;
			}

			require_once "db_stu.php";
			$s_db = new StuDb();
			$s_res = $s_db->select("SELECT * FROM students WHERE id = '{$uid}';");
			$s_name = $s_res[0]['students_name'];
			$s_tel = $s_res[0]['students_tel'];
			$s_team = $s_res[0]['teams_id'];
			if(is_null($s_team))
			{
					$s_db->close();
					echo "<script>window.location.href='createam.php'</script>";
					exit;
			}
			else
			{
					$_SESSION['tid'] = $s_team;
			}
			$t_res = $s_db->select("SELECT product FROM teams WHERE teams_id = '{$s_team}';");
			$t_prod = $t_res[0]['product'];
			$s_db->close();
?>
	
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="result.php"><big>SEE RESULT</big></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="./student.php">Dashboard</a></li>
            <li><a href="#">Team</a></li>
            <li><a href="./sinfo.php">My Info</a></li>
            <li><a href="../login/logout.php"><big>LOGOUT</big></a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-10 main">
		<h1 class="page-header">My Team</h1>
		<form class="form-horizontal" name="modprod_form" method="post" action="produpdate.php">
			<div class="row">
			<label for="mod_prod" class="col-md-2 control-label">My Product</label>
			<div class="col-md-8">
			<input name="mod_prod" id="mod_prod" type="text" class="form-control" maxlength="1023" placeholder="<?php echo $t_prod; ?>" value="<?php echo $t_prod; ?>">
			</div>
			</div>
			<button name="Submit" id="submit" class="btn btn-default" type="submit">Submit</button>
      </form>
</div>	  
</div>
    </div>
	<script src="../login/js/jquery-2.2.4.min.js"></script>
	<script src="../login/js/bootstrap.js"></script>

  </body>
</html>
