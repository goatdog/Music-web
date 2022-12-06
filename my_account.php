<?php 
	session_start(); 
	if(isset($_SESSION['user'])){
		//echo("<pre>Logged in");
		//print_r($_SESSION['user']); 
	}else{
		header("Location: login.php");
		die();
	}
	$u = $_SESSION['user'];
	$format = "%H:%M:%S %d-%B-%Y"; 
?>
<?php require_once("files/header.php"); ?> 

<div class="container">
	
	<div class="row">
		<?php include 'files/admin_side_bar.php'; ?>
		<div class="col-md-8">
			<h2>My account</h2><br>
			<h6>User name : <?php echo $u['username']; ?></h6>
			<h6>First name : <?php echo $u['first_name']; ?></h6>
			<h6>Last name : <?php echo $u['last_name']; ?></h6>
			<h6>Register date : <?php echo $strTime = strftime($format, $u['reg_date']) ?></h6>
		</div>
	</div>

</div>


<?php require_once("files/footer.php"); ?> 

  