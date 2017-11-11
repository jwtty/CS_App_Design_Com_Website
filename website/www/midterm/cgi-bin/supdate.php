<?php require "../login/loginheader.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Change student information</title>
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
require "db_stu.php";
$s_db = new StuDb();
if(isset($_POST['inputName1'])) {
		$q_name = $s_db->quote($_POST['inputName1']);
		$s_db->query("UPDATE students SET students_name = ".$q_name." WHERE id = '{$uid}';");
}
if(isset($_POST['inputTel1'])) {
		$q_tel = $s_db->quote($_POST['inputTel1']);
		$s_db->query("UPDATE students SET students_tel = ".$q_tel." WHERE id = '{$uid}';");
}
$s_db->close();
echo "<script>window.location.href='./student.php'</script>";
?>
</body>
