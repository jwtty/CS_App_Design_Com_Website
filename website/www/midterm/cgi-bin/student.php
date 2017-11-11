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
			if(!($ucat==='0')) {
					echo "<script>window.location.href='../login/logout.php'</script>";
					exit;
			}
			require_once "db_stu.php";

			//Query info needed here;
			$s_db = new StuDb();
			$s_res = $s_db->select("SELECT * FROM students WHERE id = '{$uid}';");
			$s_name = $s_res[0]['students_name'];
			$s_tel = $s_res[0]['students_tel'];
			$s_team = $s_res[0]['teams_id'];

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
            <li><a href="#">Dashboard</a></li>
            <li><a href="./team.php">Team</a></li>
            <li><a href="./sinfo.php">My Info</a></li>
            <li><a href="../login/logout.php"><big>LOGOUT</big></a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-10 main">
		<h1 class="page-header">Welcome, <?php echo $uname; ?></h1>
          <h2 class="sub-header">My information</h2>
          <div class="table-responsive">
            <table class="table table-striped">
			  <tbody>
                <tr>
                  <th>Name</th>
				  <td><?php echo $s_name; if(!isset($s_name)) echo "Not Set"; ?></td>
				</tr>
				<tr>
					<th>Tel.</th>
					<td><?php echo $s_tel; if(!isset($s_tel)) echo "Not Set"; ?></td>
				</tr>
				<tr>
					<th>Team ID</th>
					<td><?php echo $s_team; if(!isset($s_team)) echo "Not Set"; ?></td>
				</tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
	<script src="../login/js/jquery-2.2.4.min.js"></script>
	<script src="../login/js/bootstrap.js"></script>

  </body>
</html>
