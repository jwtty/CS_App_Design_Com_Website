<?php require "../login/loginheader.php"; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>My Team</title>
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
			$s_res = $s_db->select("SELECT teams_id FROM students WHERE id = '{$uid}';");
			$s_team = $s_res[0]['teams_id'];
			$s_db->close();

			//Jump to page accordingly;
			if(is_null($s_team))
					echo "<script>window.location.href='./createam.php'</script>";
			else
					echo "<script>window.location.href='./teaminfo.php'</script>";
	?>
  </body>
</html>
