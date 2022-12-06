<?php 
	session_start(); 
	if(!isset($_SESSION['user'])){
		message("Login before you play a song.","info");
		header("Location: login.php");
		die();
	}


	include 'files/functions.php';
	require_once("files/header.php"); 

	$user_id = $_SESSION['user']['user_id'];
	$song_id = $_GET['song'];
	record_dowload($conn,$song_id,$user_id);


	$song =$_GET['song'];
	$s = get_top_song_by_song_id($conn,$song);
?> 
<!-- 
  [artist_id] => 4
    [artist_name] => Sheebah Karungi
    [artist_biography] => Sheebah Karungi is a Ugandan recording artist
    [artist_details]  => 
    [artist_photo] => 1592129479_31892627593739_howwebiz_88e723f97cde9c8b7eb0aaaabcacbe51_1464525504_cover.jpg
    [song_id] => 8
    [song_mp3] => 1593507781_25997519201764_Harmonize_&_Sheebah_-_Follow_Me.mp3
    [song_photo] => 1593507781_69484951915618_shebah.png
    [song_date] => 
    [aritst_id] => 4
    [song_name] => Follow Me
    [view_count] => 0
    [download_count] => 0
 -->
<div class="container">  
	<ul class="list-group mt-md-3">
	  <li class="list-group-item">
	  	<h2 class="display-4"><b>Download</b> <?php echo $s['song_name']; ?> <b>By</b> <?php echo $s['artist_name']; ?></h2>
	  </li>
  		  <li class="list-group-item">
	  		  	<a class="btn btn-dark btn-block" href="uploads/<?php echo $s['song_mp3']; ?>" download>Download Mp3</a> 
		  </li>

  		  <li class="list-group-item">
	  		  	<a class="btn btn-dark btn-block" href="index.php">Home</a> 
		  </li>
	</ul>
</div>


<?php require_once("files/footer.php"); ?> 