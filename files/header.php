<!DOCTYPE html>
<html>
<head>
	<title>HMUSIC</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

	<style type="text/css">
		body {
			background-image: linear-gradient(to top, #fbc2eb 0%, #a6c1ee 100%);
			background-repeat: no-repeat;
			background-size: cover;
			background-attachment: fixed;
		}

		.container {
			background-image: linear-gradient(to top, #cfd9df 0%, #e2ebf0 100%);
			border-radius: 10px;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light container">
	  <a class="navbar-brand" href="index.php">HMUSIC</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto"> 
	      <li class="nav-item">
	        <a class="nav-link" href="index.php">Home</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="popular_tracks.php">Popular Tracks</a>
	      </li> 
	      <li class="nav-item">
	        <a class="nav-link" href="latest_tracks.php">Latest Tracks</a>
	      </li>  
	      <li class="nav-item">
	      	<?php if (isset($_SESSION['user'])){ ?>
		        <a class="nav-link" href="my_account.php">My Account</a>
	      	<?php }else{ ?>
		        <a class="nav-link" href="login.php">Login</a>	      	
	      	<?php } ?>
	      </li>
	      <li class="nav-item">
	      	<?php if (isset($_SESSION['user'])){ ?>
		        <a class="nav-link" href="logount_process.php">Logout</a>
	      	<?php }else{ ?><?php } ?>
	      </li>
	        <li class="nav-item">
	        <a class="nav-link" href="playlist.php">Playlist</a>
	      </li> 	
	       <li class="nav-item">
	        <a class="btn btn-dark btn-sm mt-1" href="admin_song_upload.php">UPLOAD NEW MUSIC</a>
	      </li>  
	    </ul>
	    <form class="form-inline my-2 my-lg-0" action="search.php" method="post">
	      <input class="form-control mr-sm-2" type="search" placeholder="Artist's name, song's name ..." aria-label="Search" name="search">
	      <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
	    </form>
	  </div>
	</nav>

<?php if(isset($_SESSION['message'])){ ?>
	<div class="alert alert-<?= $_SESSION['message']['type'] ?>  m-3">
		<?php 
			echo($_SESSION['message']['body']);
			unset($_SESSION['message']);
		 ?>
	</div>
<?php	} ?>
