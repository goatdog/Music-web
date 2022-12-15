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
	$songs = get_latest_songs($conn);
?>
<?php require_once("files/header.php"); ?> 

<div class="container">
	<ul class="list-group mt-md-3">
	  <li class="list-group-item">
	  	<h2 class="display-4">Latest Songs</h2>
	  </li>
	  

	  <?php $i = 0; foreach ($songs as $key => $s): 
	  	$c = get_category_by_id($conn, $s['category_id']);
	  	$category_name = null;
	  	if (empty($c)) {
	  		$category_name = "Unknown";
	  	} else $category_name = $c['category_name'];
	  	$i++;
	  ?>
	  		  <li class="list-group-item">
			  	<div class="row">
			  		<div class="col">
			  			<img class="img-fluid rounded" width="100" src="uploads/<?php echo $s['song_photo']; ?>" alt="">
			  		</div>
			  		<div class="col">
			  			<div class="row">
			  				<div class="col-12">
			  					<?php echo $s['song_name']; ?>
			  				</div>
			  				<div class="col-12">
			  					<?php echo $s['artist_name']; ?>
			  				</div>
			  				<div class="col-12">
			  					Category : <?php echo $category_name; ?>
			  				</div>
			  			</div>
			  		</div>
			  		<div class="col">
			 		<div class="col">
				  			<div class="row">
				  				<div class="col-12">
				  					<?php echo $s['download_count']; ?> Downloads
				  				</div>
				  				<div class="col-12">
				  					<?php echo $s['view_count']; ?> Views
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
 
	</ul>
</div>
