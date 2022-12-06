<?php 
session_start();
include("files/functions.php");

$input = $_POST["search"];

$a = get_artist_by_artist_name($conn, $input);
$s = get_top_song_by_song_name($conn, $input);

if (empty($a) && empty($s)) {
	message("Invalid name!", "warning");
	header("Location: index.php");
	die();
} else if(!empty($a)) {
	$artist_id = $a['artist_id'];
	header("Location: artist.php?artist_id=".$artist_id);
	die();
} else if(!empty($s)) {
	$song = $s['song_id'];
	header("Location: play.php?song=".$song);
	die();
}

?>