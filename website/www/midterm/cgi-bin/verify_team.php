<?php require "../login/loginheader.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>New Team</title>
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
require "db_obj.php";
$db = new Db();
$q_username = $db->quote($_POST['tmname']);
$q_email = $db->quote($_POST['tmemail']);

$tm_stat = $db->select("SELECT members.id, members.teacher_status, students.teams_id FROM (members INNER JOIN students ON members.id = students.id) WHERE (members.email = {$q_email} AND members.username = {$q_username} AND members.id != '{$uid}');")[0];

if(!($tm_stat['teacher_status']==='0' && is_null($tm_stat['teams_id']))) {
		$db->close();
		echo "<h1>The info you entered was not correct. Try again in 5 seconds.</h1>\n";
		echo "<script>window.setTimeout(function(){\nwindow.location.href='./createam.php';\n}, 5000);</script>";
		exit;
}

$tmid = $tm_stat['id'];
$db->query("START TRANSACTION READ WRITE;");

$db->query("INSERT INTO teams(captain_id, player_id) VALUES ('{$uid}','{$tmid}');");
$tid = $db->select("SELECT teams_id FROM teams WHERE captain_id = '{$uid}';")[0]['teams_id'];
$db->query("UPDATE students SET teams_id = {$tid} WHERE id = '{$uid}';");
$db->query("UPDATE students SET teams_id = {$tid} WHERE id = '{$tmid}';");

$db->query("COMMIT;");
$db->close();
echo "<h1>Successful! Redirecting in 2 seconds.</h1>\n";
echo "<script>window.setTimeout(function(){\nwindow.location.href='./team.php';\n}, 2000);</script>";
exit;
?>
</body>
