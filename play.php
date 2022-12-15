<?php 
	session_start(); 
	include 'files/functions.php';
	
	if(!isset($_SESSION['user'])){
		message("Login before you play a song.","info");
		header("Location: login.php");
		die();
	}

	$user_id = $_SESSION['user']['user_id'];
	$song_id = $_GET['song'];
	record_view($conn,$song_id,$user_id);


	require_once("files/header.php"); 

	$song =$_GET['song'];
	$s = get_top_song_by_song_id($conn,$song);
	$cmts = get_cmt_by_song_id($conn, $song);
	$artist_id = $s['artist_id'];
	$format = "%H:%M:%S %d-%B-%Y";

	$c = get_category_by_id($conn, $s['category_id']);
	$category_name = null;
	
	if (empty($c)) {
		$category_name = "Unknown";	  		
	} else $category_name = $c['category_name'];		  	  	 	  	
?> 
<!-- 
  [artist_id] => 4
    [artist_name] => Sheebah Karungi
    [artist_biography] => Sheebah Karungi is a Ugandan recording artist
    [artist_details] => 
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
	  	<h2 class="display-4"><?php echo $s['song_name']; ?></h2>
	  </li>
  		  <li class="list-group-item">
		  	<div class="row">
		  		<div class="col-md-2">
		  			<img class="img-fluid rounded"  src="uploads/<?php echo $s['song_photo']; ?>" alt="">
		  		</div>
		  		<div class="col-md-4">
		  			<div class="row">
		  				<div class="col-12">
		  					<b>Song Title:</b> <?php echo $s['song_name']; ?>
		  				</div>
		  				<div class="col-12">
		  					<b>Artist: </b>
			  					<a class="text-dark" href="artist.php?artist_id=<?= $s['artist_id'] ?>" title="<?= $a['artist_name'] ?>"> 
		  							<?php echo $s['artist_name']; ?> 
		  						</a>
		  				</div>
		  				<div class="col-12">
		  					<b>Category:</b> <?php echo $category_name; ?>
		  				</div>
		  				<div class="col-12">
		  					<b>Views: </b> <?php echo $s['view_count']; ?>
		  				</div>
		  				<div class="col-12">
		  					<b>Downloads: </b> <?php echo $s['download_count']; ?>
		  				</div>
		  			</div>
		  		</div>
		  		<div class="col-md-4">
		  			<audio controls>
					  <source src="horse.ogg" type="audio/ogg">
					  <source src="uploads/<?php echo $s['song_mp3']; ?>" type="audio/mpeg">
					Your browser does not support the audio element.
					</audio> 
		  		</div>
		  		<div class="col-md-2">
			  		<a class="btn btn-dark btn-block" href="download.php?song=<?= $song_id ?>">Download Mp3</a> 
		  		</div>
		  	</div>
		  </li>
 
	</ul>


	<!-- Latest songs -->
	<ul class="list-group mt-md-3">
	  <li class="list-group-item">
		<h2 class="display-4">Related Songs</h2>
	  </li>
	 <li class="list-group-item">


	 <!-- Laetset songs -->
	 <div class="row">

	  	<?php 
		  	$latest_songs = get_by_artist_id($conn,$artist_id);
	  		$i = 0; foreach ($latest_songs as $key => $s): 
		  	if($i>5)
		  		break;
		  	$i++; ?>

			 	<div class="col-6 col-md-2 rounded mt-3">
			 		<a href="play.php?song=<?php echo($s['song_id']); ?>" title=""><img class="img-fluid rounded"   src="uploads/<?php echo $s['song_photo']; ?>" alt=""></a>
			 	</div>

	 	<?php endforeach ?>
	 </div>

	</li>

	</ul>


	<ul class="list-group mt-md-3">
	  <li class="list-group-item">
		<h2 class="display-4">Comments</h2>
	  </li>

	 <li class="list-group-item">
			<form action="comments.php?song_id=<?php echo($s['song_id']); ?>" method="post">
				<div>
					<textarea name="cmt" id="cmt" rows="3" cols="110">Write something .... </textarea>
				</div>
				<input type="submit" value="Submit">
			</form><br>
	</li><br>

		<?php $i = 0; foreach ($cmts as $key => $c):
			$u = get_user_by_user_id($conn, $c['user_id']);
			$username = $u['username'];
	  	if($i > 10)
	  		break;
	  	$i++;
	  ?> 

	  <li class="list-group-item">
			  <div class="row"> 
			  		<div class="col-1"><?php echo $username ?></div>
			  		<div class="col"><?php echo $strTime = strftime($format, $c['cmt_time']) ?></div>
			  </div>
				<div class="row">
					<div class="col"><?php echo $c['cmt'] ?></div>
				</div>
	</li>

	<?php endforeach ?>
	  
	</ul>

<?php require_once("files/footer.php"); ?> 
