<?php require "../login/loginheader.php"; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Welcome, teacher!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../css/main.css" rel="stylesheet" media="screen">
    <link href="../dash.css" rel="stylesheet">
  </head>
  <body>
	<?php
			session_start();
			$uid = $_SESSION['uid'];
			$uname = $_SESSION['username'];
			$ucat = $_SESSION['cat'];
			if(!($ucat==='1')) {
					echo "<script>window.location.href='../login/logout.php'</script>";
					exit;
			}
			require_once "db_tea.php";

			$t_db = new TeaDb();

			$t_res = $t_db->select("SELECT * FROM teachers WHERE id = '{$uid}';");
			$t_name = $t_res[0]['teachers_name'];
			$t_tel = $t_res[0]['teachers_tel'];
			$t_eval = $t_db->select("SELECT count(*) FROM V_UP_EVAL where teacher_id = '{$uid}' and score is NULL;");
			$t_ufe = $t_eval[0]['count(*)'];
			$t_db->close();
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
            <li><a href="./evaluations.php">Evaluations</a></li>
            <li><a href="./tinfo.php">My Info</a></li>
            <li><a href="../login/logout.php"><big>LOGOUT</big></a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-10 main">
		<h1 class="page-header">Welcome, <?php echo $uname; ?></h1>
          <h2 class="sub-header">My Information</h2>
          <div class="table-responsive">
            <table class="table table-striped">
			  <tbody>
                <tr>
                  <th>Name</th>
				  <td><?php echo $t_name; if(!isset($t_name)) echo "Not Set"; ?></td>
				</tr>
				<tr>
					<th>Tel.</th>
					<td><?php echo $t_tel; if(!isset($t_tel)) echo "Not Set"; ?></td>
				</tr>
				<tr>
					<th>Unfinished Evaluations</th>
					<td><?php echo "{$t_ufe}";?></td>
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
