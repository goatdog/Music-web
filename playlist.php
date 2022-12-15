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
	$categories = get_all_categories($conn);
?>
<?php require_once("files/header.php"); ?> 

<div class="container">
	<ul class="list-group mt-md-3">
	  <li class="list-group-item">
	  	<h2 class="display-4">Playlist</h2>
	  </li>
	  

	  <?php $i = 0; foreach ($categories as $key => $c):
	  	$i++;
	  ?>	

	  <li class="list-group-item">
	  	<h5><?php echo $c['category_name']; ?></h5>
	  </li>

	  	<?php
	  	$songs = get_songs_by_category($conn, $c['category_id']); 
	  	$j = 0; foreach ($songs as $key => $s):
	  		$sg = get_top_song_by_song_id($conn, $s['song_id']);
	  	$j++;
	  ?>
	  		  <li class="list-group-item">
			  	<div class="row">
			  		<div class="col">
			  			<img class="img-fluid rounded" width="100" src="uploads/<?php echo $sg['song_photo']; ?>" alt="">
			  		</div>
			  		<div class="col">
			  			<div class="row">
			  				<div class="col-12">
			  					<?php echo $sg['song_name']; ?>
			  				</div>
			  				<div class="col-12">
			  					<?php echo $sg['artist_name']; ?>
			  				</div>
			  			</div>
			  		</div>
			  		<div class="col">
			 		<div class="col">
				  			<div class="row">
				  				<div class="col-12">
				  					<?php echo $sg['download_count']; ?> Downloads
				  				</div>
				  				<div class="col-12">
				  					<?php echo $sg['view_count']; ?> Views
				  				</div>
				  			</div>
				  		</div>	  			
			  		</div>
			  		<div class="col text-center">
			  			<a href="play.php?song=<?php echo($s['song_id']); ?>" title=""><img width="100" src="img/play.png" alt=""></a>
			  		</div>
			  	</div>
			  </li>
			  <?php endforeach ?>

	  <?php endforeach ?>
 
	</ul>
</div>