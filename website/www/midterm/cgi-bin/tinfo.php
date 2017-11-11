<?php require "../login/loginheader.php"; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Change teacher information</title>
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
			if(!($ucat==='1')) {
					echo "<script>window.location.href='../login/logout.php'</script>";
					exit;
			}
			require_once "db_tea.php";

			//Query info needed here;
			$s_db = new TeaDb();
			$s_res = $s_db->select("SELECT * FROM teachers WHERE id = '{$uid}';");
			$s_name = $s_res[0]['teachers_name'];
			$s_tel = $s_res[0]['teachers_tel'];

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
            <li><a href="./teacher.php">Dashboard</a></li>
            <li><a href="./evaluations.php">Evaluations</a></li>
            <li><a href="#">My Info</a></li>
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
			
		<form class="form-horizontal" name="sinfo_form" method="post" action="tupdate.php">
			<div class="row">
			<label for="inputName1" class="col-md-2 control-label">Real Name</label>
			<div class="col-md-8">
			<input name="inputName1" id="inputName1" type="text" class="form-control" maxlength="65" placeholder="<?php echo $s_name; ?>" value="<?php echo $s_name; ?>">
			</div>
			</div>
			<div class="row">
			<label for="inputTel1" class="col-md-2 control-label">Telephone</label>
			<div class="col-md-8">
			<input name="inputTel1" id="inputTel1" type="tel" class="form-control" maxlength="11" placeholder="<?php echo $s_tel; ?>" value="<?php echo $s_tel; ?>">
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
