<?php 
	session_start(); 
	include 'files/functions.php';
	if(isset($_SESSION['user'])){
		 
	}else{
		header("Location: login.php");
		die();
	}

	if(isset($_POST['artist_name'])){
		if (!empty($_POST['artist_name']) && !empty($_POST['artist_biography']) && !empty($_FILES['artist_photo']['name']) && isset($_FILES['artist_photo'])) {
		$artist_id = $_POST['artist_id'];
		$a = get_artist_by_artist_id($conn, $artist_id);
 
		$artist_photo = $a['artist_photo'];
	 
		if(isset($_FILES['artist_photo']['error'])){
			if($_FILES['artist_photo']['error'] == 0){
		 
				$target_dir = "uploads/";
				
				$artist_photo = $_FILES["artist_photo"]["name"];

				$artist_photo = str_replace(" ", "_", $artist_photo);
				$artist_photo = urlencode($artist_photo);
 

				$source = $_FILES["artist_photo"]["tmp_name"];
				$destinatin = $target_dir.$artist_photo;
				
				 if(move_uploaded_file($source, $destinatin)){
				 }else{ 
				 	$artist_photo = $a['artist_photo'];
				 }
			}
		}

		$artist_name = $_POST['artist_name'];
		$artist_id = $_POST['artist_id'];
		$artist_biography = $_POST['artist_biography'];
		
		$sql = "UPDATE artist SET 
					artist_name = '{$artist_name}',
					artist_biography = '{$artist_biography}',
					artist_photo = '{$artist_photo}'
				WHERE 
					artist_id = '{$artist_id}'
		";

		if($conn->query($sql)){ 
			message("Artist was updated successfully.","success");
		}else{ 
			message("Something went wrong while updating artist.","warning");
		}
		header("Location: admin_artists.php");
		die();
	} else {
		message("You should fill in all fields!", "warning");
		header("location: artist_edit.php?artist_id=".$_POST['artist_id']);
		die();
	}
	}

	$artist_id = $_GET['artist_id'];
	$a = get_artist_by_artist_id($conn, $artist_id);

?>
<?php require_once("files/header.php"); ?> 
<div class="container">
	
<!-- 
	song_date 
 -->
	<div class="row pl-0">
		<?php include 'files/admin_side_bar.php'; ?>
		<div class="col-md-8">
			<h2>Editing artist <?php echo($a['artist_name']); ?> </h2>

			<form method="post" action="artist_edit.php" enctype="multipart/form-data">
			  <div class="form-group">
			    <label for="artist_name">Artist name</label>
			    <input type="text" name="artist_name" value="<?php echo($a['artist_name']); ?>" class="form-control" id="artist_name"  placeholder="Enter artist name"> 
			  </div>

			  <input type="text" name="artist_id" hidden="" readonly="" value="<?= $artist_id ?>" >

			  <div class="form-group">
			    <label for="artist_biography">Artist's biography</label>
			    <input type="text" name="artist_biography" value="<?php echo($a['artist_biography']); ?>" class="form-control" id="artist_biography"  placeholder="Enter artist's biography"> 
			  </div>

 			  <div class="form-group">
			   <div class="row">
			   		<div class="col-md-6">
			   			<label for="artist_photo">Artist photo</label>
					    <input type="file"  name="artist_photo" class="form-control" id="artist_photo"> 
			   		</div>
			   		<div class="col-md-6">
			   			<img class="rounded" width="100" src="uploads/<?php echo($a['artist_photo']); ?>" alt="">
			   		</div>
			   </div>
			  </div>

			  <button type="submit" class="float-right mt-md-3 btn btn-lg btn-dark">Update Artist</button>

			</form>

		</div>
	</div>

</div>


<?php require_once("files/footer.php"); ?> 

  