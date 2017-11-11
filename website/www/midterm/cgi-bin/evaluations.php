<?php require "../login/loginheader.php"; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Evaluations</title>
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
			$ustage = $_SESSION['stage'];
			if(!($ucat==='1')) {
					echo "<script>window.location.href='../login/logout.php'</script>";
					exit;
			}
			if($ustage === "submit") {
					echo "<script>window.location.href='./teacher.php'</script>";
					exit;
			}
			else if($ustage === "finish") {
					echo "<script>window.location.href='./result.php'</script>";
					exit;
			}
			
			require_once "db_tea.php";
			$t_db = new TeaDb();
			$t_res = $t_db->select("SELECT * FROM V_UP_EVAL WHERE teacher_id = '{$uid}';");
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
            <li><a href="./teacher.php">Dashboard</a></li>
            <li><a href="#">Evaluations</a></li>
            <li><a href="./tinfo.php">My Info</a></li>
            <li><a href="../login/logout.php"><big>LOGOUT</big></a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-10 main">
		<h1 class="page-header">Evaluation</h1>
			<form class="form-horizontal" name="modprod_form" method="post" action="evapdate.php">
<?php
			foreach($t_res as $t_key => $t_value) {
					$t_id = $t_value['teams_id'];
					$t_prod = $t_value['product'];
					$t_score = intval($t_value['score']);
					if(is_null($t_score))
							$t_score = '';
					echo <<<EVAL_FORM
				<div class="row">
					<label for="static_prod$t_id" class="col-md-2 control-label">Team $t_id</label>
					<div class="col-md-8">
						<p name="static_prod" type="text" class="form-control-static">$t_prod</p>
					</div>
				</div>
				<div class="row">
					<label for="sc$t_id" class="col-md-2 control-label">Score</label>
					<div class="col-md-8">
						<input name="sc$t_id" id="sc$t_id" type="number" class="form-control" min="0" max="100" step="1" placeholder="$t_score" value="$t_score">
					</div>
				</div>
EVAL_FORM;
			}
?>
				<button name="Submit" id="submit" class="btn btn-default" type="submit">Submit</button>
			</form>
          </div>
        </div>
      </div>
    </div>
	<script src="../login/js/jquery-2.2.4.min.js"></script>
	<script src="../login/js/bootstrap.js"></script>

  </body>
</html>

