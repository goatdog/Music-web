<?php 
session_start();
include("files/functions.php");

$u = $_SESSION['user'];
$format = "%H:%M:%S %d-%B-%Y";
$user_id = $u['user_id'];
$cmt = $_POST['cmt'];
$song_id = $_GET['song_id'];
$cmt_time = time();

$sql = "INSERT INTO comments (
		user_id,
		song_id,
		cmt,
		cmt_time)
		VALUES (
		'{$user_id}',
		'{$song_id}',
		'{$cmt}',
		'{$cmt_time}')
		";

if ($conn->query($sql)) {
	message("Successfully commented!", "success");
	header("location: play.php?song=".$song_id);
	die();
} else {
	message("Somthing went wrong!", "danger");
	header("location: play.php?song=".$song_id);
	die();
}
?>