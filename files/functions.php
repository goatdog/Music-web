<?php 
$conn = new mysqli("localhost","root","","hmusic");

function get_user_by_username($conn,$username){
	$sql = "SELECT * FROM users WHERE username = '{$username}'";
 	$res = $conn->query($sql);
 	$data = $res->fetch_assoc();
 	if($data==null){
 		return array(); 
 	}else{
 		return $data;
 	}
}

function get_user_by_user_id($conn,$user_id){
	$sql = "SELECT * FROM users WHERE user_id = '{$user_id}'";
 	$res = $conn->query($sql);
 	$data = $res->fetch_assoc();
 	if($data==null){
 		return array(); 
 	}else{
 		return $data;
 	}
}

function get_category_by_id($conn,$category_id){
	$sql = "SELECT * FROM category WHERE category_id = '{$category_id}'";
 	$res = $conn->query($sql);
 	$data = $res->fetch_assoc();
 	if($data==null){
 		return array(); 
 	}else{
 		return $data;
 	}
}

function get_category_by_name($conn,$category_name){
	$sql = "SELECT * FROM category WHERE category_name = '{$category_name}'";
 	$res = $conn->query($sql);
 	$data = $res->fetch_assoc();
 	if($data==null){
 		return array(); 
 	}else{
 		return $data;
 	}
}
/*  
  
            [] => 1592902550_15623277316181_IMG_1965.jpeg
            [] => 2
            [] => 1592903501_24985636169454_Jizzle_-_Jealousy_(
            [] => 1592903501_75222169227962_song_pic.png
            [] => 1592904725
            [] => 5
            [] => Jealousy 
            [view_id] => 2
            [user_id] => 7
            [view_time] => 1592904925
*/


// get top 10 songs
function get_all_songs_by_user($conn,$upload_by){
	$songs = get_all_songs($conn,$upload_by);
	$_songs = array( );
 
	foreach ($songs as $key => $song) {
		$song['view_count'] = get_song_views($conn,$song['song_id']);
		$song['download_count'] = get_song_downloads($conn,$song['song_id']);
		array_push($_songs, $song);
	}

	$i  = 0;
	$j  = 0;

	for($j = 0; $j < (count($_songs) - 1);$j++) {
		for($i = 0; $i < (count($_songs) - 1);$i++) {
			if($_songs[$i]['song_id'] < $_songs[$i+1]['song_id'] ){
				$temp = $_songs[$i];
				$_songs[$i] = $_songs[$i+1];
				$_songs[$i+1] = $temp;
			}
		}
	}
  
 	return $_songs;
}



// get top 10 songs
function get_popular_songs($conn){
	$songs = get_all_songs($conn);
	$_songs = array( );
 
	foreach ($songs as $key => $song) {
		$song['view_count'] = get_song_views($conn,$song['song_id']);
		$song['download_count'] = get_song_downloads($conn,$song['song_id']);
		array_push($_songs, $song);
	}

	$i  = 0;
	$j  = 0;

	for($j = 0; $j < (count($_songs) - 1);$j++) {
		for($i = 0; $i < (count($_songs) - 1);$i++) {
			if($_songs[$i]['view_count'] < $_songs[$i+1]['view_count'] ){
				$temp = $_songs[$i];
				$_songs[$i] = $_songs[$i+1];
				$_songs[$i+1] = $temp;
			}
		}
	}
  
 	return $_songs;
}

function get_latest_songs($conn){
	$user_id = $_SESSION['user']['user_id'];
	$sql = "SELECT max(view_time) as vt, s.*, art.* FROM views v 
			INNER join songs s ON v.song_id = s.song_id
            INNER join artist art ON s.aritst_id = art.artist_id
			WHERE user_id = {$user_id}
			GROUP BY song_id
			ORDER BY vt DESC limit 10";
	$res = $conn->query($sql);
 	$songs = array();  
  	while ($data = $res->fetch_assoc()) {
  		array_push($songs, $data);
 	}
 	
 	$_songs = array();
	foreach ($songs as $key => $s) {
		$s['view_count'] = get_song_views($conn,$s['song_id']);
		$s['download_count'] = get_song_downloads($conn,$s['song_id']);
		array_push($_songs, $s);
	}

 	return $_songs;
}

// get top 10 songs
function get_top_song_by_song_id($conn,$song_id){
	$sql = "SELECT * FROM artist,songs
			WHERE
				songs.aritst_id = artist.artist_id AND
				song_id = {$song_id}				
			ORDER BY artist_name ASC";
 	$res = $conn->query($sql);
 	$song = $res->fetch_assoc();
	$song['view_count'] = get_song_views($conn,$song_id);
	$song['download_count'] = get_song_downloads($conn,$song_id);

 	return $song;
}

function get_cmt_by_song_id($conn, $song_id) {
	$sql = "SELECT * FROM comments
			WHERE song_id = {$song_id}
			ORDER BY cmt_time DESC";
	$res = $conn->query($sql);
	$cmts = array();
	
	while ($data = $res->fetch_assoc()) {
  		array_push($cmts, $data);
 	}
 	return $cmts;
}

function get_songs_by_category($conn, $category_id) {
	$sql = "SELECT * FROM songs 
			WHERE category_id = {$category_id}";

	$res = $conn->query($sql);
	$songs = array();
	
	while ($data = $res->fetch_assoc()) {
  		array_push($songs, $data);
 	}
 	return $songs;
}

function get_top_song_by_song_name($conn,$song_name){

	$sql = "SELECT * FROM artist,songs
			WHERE
				songs.aritst_id = artist.artist_id AND
				song_name = '{$song_name}'				
			ORDER BY artist_name ASC";
 	$res = $conn->query($sql);
 	$song = $res->fetch_assoc();
 	if ($song == null) {
 		return array();
 	} else {
		$song['view_count'] = get_song_views($conn,$song['song_id']);
		$song['download_count'] = get_song_downloads($conn,$song['song_id']);

	 	return $song;
 	}
}

// get top 10 songs
function get_by_artist_id($conn,$artist_id){
	$songs = get_all_songs($conn);
	$_songs = array( );
 
	foreach ($songs as $key => $song) {
		$song['view_count'] = get_song_views($conn,$song['song_id']);
		$song['download_count'] = get_song_downloads($conn,$song['song_id']);
		if($artist_id == $song['artist_id']){
			array_push($_songs, $song);
		}
	}

	$i  = 0;
	$j  = 0;

	for($j = 0; $j < (count($_songs) - 1);$j++) {
		for($i = 0; $i < (count($_songs) - 1);$i++) {
			if($_songs[$i]['view_count'] < $_songs[$i+1]['view_count']){
				$temp = $_songs[$i];
				$_songs[$i] = $_songs[$i+1];
				$_songs[$i+1] = $temp;
			}
		}
	} 
 	return $_songs;
}

function get_artist_by_artist_name($conn, $artist_name) {
	$sql = "SELECT * FROM artist WHERE artist_name = '{$artist_name}'";
	$res = $conn->query($sql);
 	$artist = $res->fetch_assoc();
 	if($artist == null) {
 		return array();
 	}else {
 		return $artist;
 	}
}

// get top 10 songs
function get_top_songs($conn){
	$songs = get_all_songs($conn);
	$_songs = array( );
 
	foreach ($songs as $key => $song) {
		$song['view_count'] = get_song_views($conn,$song['song_id']);
		$song['download_count'] = get_song_downloads($conn,$song['song_id']);
		array_push($_songs, $song);
	}

	$i  = 0;
	$j  = 0;

	for($j = 0; $j < (count($_songs) - 1);$j++) {
		for($i = 0; $i < (count($_songs) - 1);$i++) {
			if($_songs[$i]['view_count'] < $_songs[$i+1]['view_count']){
				$temp = $_songs[$i];
				$_songs[$i] = $_songs[$i+1];
				$_songs[$i+1] = $temp;
			}
		}
	} 
 	return $_songs;
}

//song view count
function get_song_downloads($conn,$song_id){
	$sql = "SELECT count(download_id) AS download FROM downloads WHERE song_id = {$song_id}";
 	$res = $conn->query($sql);
 	$views = array();  
  	$data = $res->fetch_assoc(); 
  	return $data['download'];
}

//song view count
function get_song_views($conn,$song_id){
	$sql = "SELECT count(view_id) AS view_count  FROM views WHERE song_id = {$song_id}";
 	$res = $conn->query($sql);
 	$views = array();  
  	$data = $res->fetch_assoc(); 
  	return $data['view_count'];
}


// Get all songs
function get_all_songs($conn,$upload_by = ""){

	if(strlen($upload_by) > 0){	
		$sql = "SELECT * FROM artist,songs
				WHERE
					songs.aritst_id = artist.artist_id AND 
					songs.upload_by = {$upload_by}
				ORDER BY artist_name ASC";
	}else{
		$sql = "SELECT * FROM artist,songs
				WHERE
					songs.aritst_id = artist.artist_id
				ORDER BY artist_name ASC";
	}


 	$res = $conn->query($sql);
 	$songs = array();  
  	while ($data = $res->fetch_assoc()) {
  		array_push($songs, $data);
 	}
 	return $songs;
}

function get_all_categories($conn){
	$sql = "SELECT * FROM category";

 	$res = $conn->query($sql);
 	$c = array();  
  	while ($data = $res->fetch_assoc()) {
  		array_push($c, $data);
 	}
 	return $c;
}

function record_view($conn,$song_id,$user_id){
	$view_time = time();
	$sql = "INSERT INTO `views` 
			(song_id,user_id,view_time)
			VALUES 
			(
				{$song_id},{$user_id},'{$view_time}'
			)
	";

 	if($conn->query($sql)){

 	}else{

 	}
}

function record_dowload($conn,$song_id,$user_id){
	$download_time = time();
	$sql = "INSERT INTO `downloads` 
			(song_id,user_id,download_time)
			VALUES 
			(
				{$song_id},{$user_id},'{$download_time}'
			)
	";

 	if($conn->query($sql)){

 	}else{

 	}
 	
}

function get_songs_by_song_mp3($conn, $song_mp3) {
	$sql = "SELECT * FROM songs WHERE song_mp3 = '{$song_mp3}'";
	$res = $conn->query($sql);
 	$data = $res->fetch_assoc(); 
 	if ($data == null) {
 		return array();
 	} else return $data;
}


function get_artist_by_artist_id($conn,$artist_id){
	$sql = "SELECT * FROM artist WHERE artist_id = '{$artist_id}'";
 	$res = $conn->query($sql);
 	$data = $res->fetch_assoc(); 
 	return $data;
}





function get_all_artists($conn){
	$sql = "SELECT * FROM artist ORDER BY artist_name ASC";
 	$res = $conn->query($sql);
 	$artists = array();  
  	while ($data = $res->fetch_assoc()) {
  		array_push($artists, $data);
 	}
 	return $artists;
}


function message($body,$type){
	$_SESSION['message']['body'] = $body;
	$_SESSION['message']['type'] = $type;
}
