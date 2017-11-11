<?php require "../login/loginheader.php"; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Contest Results</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../css/main.css" rel="stylesheet" media="screen">
    <link href="../dash.css" rel="stylesheet">
  </head>
  <body>
	<?php
session_start();
$r_stage = $_SESSION['stage'];
if(!($r_stage === "finish")) {
		echo "<script>window.location.href='../index.php'</script>";
		exit;
}

require_once "db_obj.php";
$db = new Db();
$r_res = $db->select("CALL sort();");
$db->close();
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
            <li><a href="../index.php">Dashboard</a></li>
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
<th>Ranking</th>
<td>Team ID</td>
<td>Product</td>
<td>Score</td>
</tr>
<?php
foreach($r_res as $r_key => $r_value) {
		$r_rank = $r_key + 1;
		$r_tid = $r_value['teams_id'];
		$r_prod = $r_value['product'];
		$r_sc = $r_value['avgscore'];
		if(is_null($r_sc))
				$r_sc = 'No Score';
		echo <<<RES_FORM
                <tr>
                  <th><big>$r_rank</big></th>
					<td>$r_tid</td>
					<td>$r_prod</td>
					<td>$r_sc</td>
					</tr>
RES_FORM;
}
?>
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

