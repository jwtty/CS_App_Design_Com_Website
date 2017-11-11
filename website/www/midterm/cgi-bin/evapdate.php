<?php require "../login/loginheader.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Update Evaluations</title>
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
require "db_tea.php";
$s_db = new TeaDb();

foreach($_POST as $t_key => $t_value)
		if($t_key !='Submit' && $t_value != '') {
				$t_tid = intval(substr($t_key, 2));
				$t_tsc = intval($t_value);
				$stat = $s_db->query("UPDATE V_UP_EVAL set score = {$t_tsc} where teams_id = {$t_tid} and teacher_id = '{$uid}';");
		}
$s_db->close();
echo "<script>window.location.href='./evaluations.php'</script>";
?>
</body>
