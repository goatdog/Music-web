<?php 
	session_start(); 
	if(isset($_SESSION['user'])){
		//echo("<pre>Logged in");
		//print_r($_SESSION['user']); 
	}else{
		header("Location: login.php");
		die();
	}
	include 'files/functions.php';
	$current_user = $_SESSION['user']['user_id']; 
	$songs = get_all_songs_by_user($conn,$current_user);
?>
<?php require_once("files/header.php"); ?> 

<div class="container">
 
	<div class="row">
		<?php include 'files/admin_side_bar.php'; ?>
		<div class="col-md-8">
			<h2>All Songs</h2>

			<a href="admin_song_upload.php" class="btn btn-dark float-right mt-md-3 mb-md-3">
				Add new song
			</a>
 
			<table class="table table-bordered">
			  <thead class="thead-dark">
			    <tr>
			      <th scope="col" style="width: 30%;">#</th>
			      <th scope="col">Song Title</th>
			      <th scope="col" style="width: 20%;">Artist</th>
			      <th scope="col" style="width: 20%;">Action</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php

			  		foreach ($songs as $key => $a): 
			  		/*$current_user = $_SESSION['user']['user_id'];
			  		foreach ($songs as $key => $a): 
			  			if($a['upload_by'] != $current_user)
			  				continue;
*/
			  		?>
				    <tr>
				      <th scope="row"><img class="img-fluid rounded" width="100%" src="uploads/<?php echo $a['song_photo']; ?>" alt=""></th>
				      <td><?php 
				      	echo $a['song_name']; 
				      ?></td>
				      <td><?php 
				      	echo $a['artist_name']; 
				      ?></td>
				      <td><div class="btn-group btn-group-sm">
				      	<a href="play.php?song=<?php echo($a['song_id']); ?>" title="<?php echo $a['song_name']; ?> By <?php echo $a['artist_name']; ?>" class="btn btn-primary"  >View</a>
				      	<a href="admin_edit_song.php?song_id=<?php echo($a['song_id']); ?>" class="btn btn-dark" title="">Edit</a>
				      	<a href="admin_delete_process.php?song_id=<?php echo($a['song_id']); ?>" class="btn btn-danger" title="">Delete</a>
				      </div></td>
				    </tr> 
			  	<?php endforeach ?>
			  </tbody>
			</table>
		</div>
	</div>
</div>


<?php require_once("files/footer.php"); ?> 

  