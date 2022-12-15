<?php 
	session_start(); 
	include 'files/functions.php';
	if(isset($_SESSION['user'])){
		 
	}else{
		header("Location: login.php");
		die();
	}

	if(isset($_POST["song_name"])){ 
		if (!empty($_POST['song_name']) && !empty($_POST['artist_name']) && !empty($_POST['category_name']) &&isset($_FILES['song_photo']) && isset($_FILES['song_mp3']) && !empty($_FILES['song_photo']['name']) && !empty($_FILES['song_mp3']['name'])) {
		
		$artist_name = $_POST['artist_name'];
		$a = get_artist_by_artist_name($conn, $artist_name);

		if(empty($a)) {
			$sql = "INSERT INTO artist(artist_name, artist_photo)
					VALUES ('{$artist_name}', 'play.png')";
			$temp = $conn->query($sql);		
		}

		$a = get_artist_by_artist_name($conn, $artist_name);

		$category_name = $_POST['category_name'];
		$c = get_category_by_name($conn, $category_name);

		if(empty($c)) {
			$sql = "INSERT INTO category(category_name)
					VALUES ('{$category_name}')";
			$temp = $conn->query($sql);
		}

		$c = get_category_by_name($conn, $category_name);

		$song_id = $_POST['song_id'];
		$song =  get_top_song_by_song_id($conn,$song_id);
 
		$song_photo = $song['song_photo'];
		$song_mp3 = $song['song_mp3'];
	 
		if(isset($_FILES['song_photo']['error'])){
			if($_FILES['song_photo']['error'] == 0){
		 
				$target_dir = "uploads/";
				
				$song_photo = $_FILES["song_photo"]["name"];

				$song_photo = str_replace(" ", "_", $song_photo);
				$song_photo = urlencode($song_photo);
 

				$source = $_FILES["song_photo"]["tmp_name"];
				$destinatin = $target_dir.$song_photo;
				
				 if(move_uploaded_file($source, $destinatin)){
				 }else{ 
				 	$song_photo = $song['song_photo'];
				 }
			}
		}
 

		if(isset($_FILES['song_mp3']['error'])){
			if($_FILES['song_mp3']['error'] == 0){
		 
				$target_dir = "uploads/";
				
				$song_mp3 = $_FILES["song_mp3"]["name"];

				$song_mp3 = str_replace(" ", "_", $song_mp3);
				$song_mp3 = urlencode($song_mp3);
 

				$source = $_FILES["song_mp3"]["tmp_name"];
				$destinatin = $target_dir.$song_mp3;
				
				 if(move_uploaded_file($source, $destinatin)){
				 	if(file_exists($target_dir.$song['song_mp3'])){
				 		unlink($target_dir.$song['song_mp3']);
				 	} 
				 }else{ 
				 	$song_mp3 = $song['song_mp3'];
				 }
			}
		}

		$song_name = $_POST['song_name'];
		$artist_id = $a['artist_id'];
		$category_id = $c['category_id'];
		
		$sql = "UPDATE songs SET 
					song_name = '{$song_name}',
					aritst_id = '{$artist_id}',
					song_photo = '{$song_photo}',
					song_mp3 = '{$song_mp3}',
					category_id = '{$category_id}'
				WHERE 
					song_id = '{$song_id}'
		";

		if($conn->query($sql)){ 
			message("Song was updated successfully.","success");
		}else{ 
			message("Something went wrong while updating song.","warning");
		}
		header("Location: admin_songs.php");
		die();
	} else {
		message("You should fill in all fields!", "warning");
		header("location: admin_edit_song.php?song_id=".$_POST['song_id']);
		die();
	}
	}

	$artists = get_all_artists($conn);
	$song_id = $_GET['song_id'];

	$song =  get_top_song_by_song_id($conn,$song_id);

	$c = get_category_by_id($conn, $song['category_id']);
?>
<?php require_once("files/header.php"); ?> 
<div class="container">
	
<!-- 
	song_date 
 -->
	<div class="row pl-0">
		<?php include 'files/admin_side_bar.php'; ?>
		<div class="col-md-8">
			<h2>Editing  <?php echo($song['song_name']); ?> by <?php echo($song['artist_name']); ?> </h2>

			<form method="post" action="admin_edit_song.php" enctype="multipart/form-data">
			  <div class="form-group">
			    <label for="song_name">Song name</label>
			    <input type="text" name="song_name" value="<?php echo($song['song_name']); ?>" class="form-control" id="song_name"  placeholder="Enter song name"> 
			  </div>

			  <input type="text" name="song_id" hidden="" readonly="" value="<?= $song_id ?>" >

			  <div class="form-group">
			    <label for="artist_name">Artist name</label>
			    <input type="text" name="artist_name" value="<?php echo($song['artist_name']); ?>" class="form-control" id="artist_name"  placeholder="Enter artist name"> 
			  </div>

			  <div class="form-group">
			    <label for="category_name">Category</label>
			    <input type="text" name="category_name" value="<?php echo($c['category_name']); ?>" class="form-control" id="category_name"  placeholder="Enter category"> 
			  </div>
 
 			  <div class="form-group">
			   <div class="row">
			   		<div class="col-md-6">
			   			<label for="song_photo">Song photo</label>
					    <input type="file"  name="song_photo" class="form-control" id="song_photo" value="<?php echo($song['song_photo']); ?>"> 
			   		</div>
			   		<div class="col-md-6">
			   			<img class="rounded" width="100" src="uploads/<?php echo($song['song_photo']); ?>" alt="">
			   		</div>
			   </div>
			  </div>


 			  <div class="form-group">
			   <div class="row">
			   		<div class="col-md-6">
					    <label for="song_mp3">Song mp3</label>
					    <input type="file" accept=".mp3" name="song_mp3" class="form-control" id="song_mp3" value="<?php echo($song['song_mp3']); ?>">
			   		</div>
			   		<div class="col-md-6">
			   			<br>
					    <audio controls>
							  <source src="horse.ogg" type="audio/ogg">
							  <source src="uploads/<?php echo $song['song_mp3']; ?>" type="audio/mpeg">
							Your browser does not support the audio element.
						</audio> 
			   		</div>
			   </div>	 
			  </div>

			  <button type="submit" class="float-right mt-md-3 btn btn-lg btn-dark">Update Song</button>

			</form>

		</div>
	</div>

</div>


<?php require_once("files/footer.php"); ?> 

  
