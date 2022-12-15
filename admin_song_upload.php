<?php 
	session_start(); 
	include 'files/functions.php';
	if(isset($_SESSION['user'])){
		 
	}else{
		header("Location: login.php");
		die();
	}

	if(isset($_POST['song_name'])){
		if (!empty($_POST['song_name']) && !empty($_POST['artist_name']) && !empty($_POST['category_name']) &&isset($_FILES['song_photo']) && isset($_FILES['song_mp3']) && !empty($_FILES['song_photo']['name']) && !empty($_FILES['song_mp3']['name'])) {
		
		$artist_name = $_POST['artist_name'];
		$a = get_artist_by_artist_name($conn, $artist_name);

		if(empty($a)) {
			$sql = "INSERT INTO artist(artist_name, artist_photo)
					VALUES ('{$artist_name}', 'play.png')";
			$temp = $conn->query($sql);		
		}

		$a = get_artist_by_artist_name($conn, $artist_name);
		$artist_id = $a['artist_id'];

		$category_name = $_POST['category_name'];
		$c = get_category_by_name($conn, $category_name);

		if(empty($c)) {
			$sql = "INSERT INTO category(category_name)
					VALUES ('{$category_name}')";
			$temp = $conn->query($sql);
		}

		$c = get_category_by_name($conn, $category_name);

		$file_name = "";  
		$song_photo = "";
		$song_mp3 = "";
		$upload_by = $_SESSION['user']['user_id'];
 
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
				 	$song_photo = "";
				 }
			}
		}


		if(isset($_FILES['song_mp3']['error'])){
			if($_FILES['song_mp3']['error'] == 0){
		 
				$target_dir = "uploads/";
				
				$song_mp3 = $_FILES["song_mp3"]["name"];

				$song_mp3 = str_replace(" ", "_", $song_mp3);
				$song_mp3 = urlencode($song_mp3);
 		

				$t = get_songs_by_song_mp3($conn, $song_mp3);
				if (!empty($t)) {
					message("Song already exists!", "warning");
					header("location: admin_song_upload.php");
					die();
				}

				$source = $_FILES["song_mp3"]["tmp_name"];
				$destinatin = $target_dir.$song_mp3;
				


				 if(move_uploaded_file($source, $destinatin)){
				 	 
				 }else{
				 	$song_mp3 = "";
				 }
			}
		}

		$song_date = time();

		$song_name = $_POST['song_name'];

		$category_id = $c['category_id'];
 		 
		$SQL = "INSERT INTO songs(
						song_mp3,song_photo,aritst_id,song_name,upload_by,category_id
					)VALUES(
						'{$song_mp3}','{$song_photo}','{$artist_id}','{$song_name}','{$upload_by}', '{$category_id}'
					)
				";

		if($conn->query($SQL)){ 
			message("New song was uploaded successfully.","success");
		}else{ 
			message("Something went wrong while uploading New song.","warning");
		}

		header("Location: admin_songs.php");
		die();
	} else {
		message("You should fill in all fields!", "warning");
	}
	}

	$artists = get_all_artists($conn);
?>
<?php require_once("files/header.php"); ?> 
<div class="container">
	
<!-- 
		song_date		
 -->
	<div class="row pl-0">
		<?php include 'files/admin_side_bar.php'; ?>
		<div class="col-md-8">
			<h2>Uploading new song</h2>

			<form method="post" action="admin_song_upload.php" enctype="multipart/form-data">
			  <div class="form-group">
			    <label for="song_name">Song name</label>
			    <input type="text" name="song_name" class="form-control" id="song_name"  placeholder="Enter song name"> 
			  </div>

			  <div class="form-group">
			    <label for="artist_name">Artist name</label>
			    <input type="text" name="artist_name" class="form-control" id="artist_name"  placeholder="Enter artist name"> 
			  </div>

			  <div class="form-group">
			    <label for="category_name">Category</label>
			    <input type="text" name="category_name" class="form-control" id="category_name"  placeholder="Enter category"> 
			  </div>
 
 			  <div class="form-group">
			    <label for="song_photo">Song photo</label>
			    <input type="file"  name="song_photo" class="form-control" id="song_photo"> 
			  </div>


 			  <div class="form-group">
			    <label for="song_mp3">Song mp3</label>
			    <input type="file" accept=".mp3" name="song_mp3" class="form-control" id="song_mp3"> 
			  </div>

			  <button type="submit" class="float-right mt-md-3 btn btn-lg btn-dark">Add new song</button>

			</form>

		</div>
	</div>

</div>


<?php require_once("files/footer.php"); ?> 

  
