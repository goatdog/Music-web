    <?php 
session_start(); 
include 'files/functions.php';
require_once("files/header.php"); 
$top_songs = get_top_songs($conn);
?> 

<div class="container">  
	<ul class="list-group mt-md-3">
	  <li class="list-group-item">
	  	<h2 class="display-4">TOP 10 Hits</h2>
	  </li>
	  

	  <?php $i = 0; foreach ($top_songs as $key => $s):
	  	$c = get_category_by_id($conn, $s['category_id']);
	  	$category_name = null;
	  	if (empty($c)) {
	  		$category_name = "Unknown";
	  	} else $category_name = $c['category_name'];
	  	if($i>9)
	  		break;

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



	<!-- Artists -->
	<ul class="list-group  mt-5 mb-5">
	  <li class="list-group-item">
		<h2 class="display-4">Top Artists</h2>
	  </li>
	 <li class="list-group-item">


	 <!--  all artists songs -->
	 <div class="row">

	  	<?php 
		  	$all_artists = get_all_artists($conn);
	  		$i = 0; 
	  		foreach ($all_artists as $key => $a): 
		  	if($i>5)
		  		break;
		  	$i++; ?> 
			 	<div class="col-6 col-md-2 rounded ">
			 		<a href="artist.php?artist_id=<?= $a['artist_id'] ?>" title="<?= $a['artist_name'] ?>"><img class="img-fluid rounded-circle"   src="uploads/<?php echo $a['artist_photo']; ?>" alt=""></a>
			 	</div>

	 	<?php endforeach ?>
	 </div>

	</li>

	</ul>

</div>


<?php require_once("files/footer.php"); ?> 
