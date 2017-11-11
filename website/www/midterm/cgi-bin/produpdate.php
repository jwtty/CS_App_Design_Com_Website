<?php require "../login/loginheader.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Update Product</title>
  </head>
<body>
<?php
session_start();
$uname = $_SESSION['username'];
$ucat = $_SESSION['cat'];
$uid = $_SESSION['uid'];
$tid = $_SESSION['tid'];
if(!($ucat==='0')) {
		echo "<script>window.location.href='../login/logout.php'</script>";
		exit;
}
if(is_null($tid)) {
		echo "<script>window.location.href='./student.php'</script>";
		exit;
}
require "db_stu.php";

$s_db = new StuDb();
$q_name = $s_db->quote($_POST['mod_prod']);
$s_db->query("UPDATE teams SET product = ".$q_name." WHERE teams_id = {$tid};");
$s_db->close();
echo "<script>window.location.href='./teaminfo.php'</script>";
?>
</body>
