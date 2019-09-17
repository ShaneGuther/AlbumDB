<!DOCTYPE HTML>
<html>
	<head>
		<!--
		This page will filter selection of music based on the parameters set by the user
		-->
		<meta charset="UTF-8">
		<title>Album Database</title>
		<link rel="stylesheet" href="AlbumDB.css">
	</head>
	<body id="container">
				<form method="POST" action="addition.php" id="forms">
			<input type="submit" name="submit" value="Add New Value" id="newBtn">
		</form>
	<!-- 	<form method="POST" action="addition.php">
			<input type="submit" name="Delete" value="Clean rows">
		</form> -->
		<form method="POST" action="#" id="forms">
			<input type="checkbox" name="genres[]" value="HipHop">
			<input type="checkbox" name="genres[]" value="Rock">
			<input type="checkbox" name="genres[]" value="SingerSongwriter">
			<input type="checkbox" name="genres[]" value="Alternative">	
			<input type="checkbox" name="genres[]" value="Jazz">
			<input type="checkbox" name="genres[]" value="Pop">
			<input type="checkbox" name="genres[]" value="Country">	
			<input type="submit" name="submit" value="Update Table">
		<?php
		//Connect to the database using info in connect.php page
		require("connect.php");

		try{
		$dbConn = new PDO("mysql:host=$hostname;dbname=guthers_albums", $user, $passwd);
		echo 'Connection Successful';
		}catch(PDOException $e){
		echo 'Connection error: ' . $e->getMessage();
		}

			// $hh = $_POST['Hiphop'];
			// $rc = $_POST['Rock'];
			// $ss = $_POST['SingerSongwriter'];
			// $alt = $_POST['Alternative'];
			// $jz = $_POST['Jazz'];
			// $pop = $_POST['Pop'];
			// $ct = $_POST['Country'];

			$value = $_POST['value'];
			$album = $_POST['album'];	
			$artist = $_POST['artist'];
			$genre = $_POST['genre'];
			
			$sqlGenres = "";
			foreach($_POST['genres'] as $index => $genres){
				if($sqlGenres == ""){
					$sqlGenres = " IN (";
					$sqlGenres .= $genres . ",";
				}else{
					$sqlGenres .= $genres . ",";
				// }elseif($sqlGenres != ""){
				// //$sqlGenres = rtrim($sqlGenres, ",");
				
				// }
				}
			}
			$sqlGenres .= ")";
		//Establish PDO connection
			
		// if(isset($value)){
		// 	try{
		// 	$dbConn = new PDO("mysql:host=$hostname;dbname=guthers_albums", $user, $passwd);
		// 	echo 'Connection Successful';
		// 	}catch(PDOException $e){
		// 		echo 'Connection unsuccessful' . $e->getMessage();
		// 	}
		// 	$cmd = "INSERT INTO album(Value, Album, Artist, Genre) VALUES ('$value','$album','$artist','$genre')";
		// 	$dbConn->exec($cmd);

		// }else
		if($sqlGenres != " "){
			$comm = "SELECT Value, Album, Artist, Genre FROM album WHERE Genre" . $sqlGenres;
			$stmnt = $dbConn->query($comm);
			$execOk = $stmnt->execute();
			//if($execOk){
				echo '<table>';
				echo '<tr><td>Value</td><td>Album</td><td>Artist</td><td>Genre</td></tr>';
			while($row = $stmnt->fetch()){
				echo '<tr><td>' . $row[Value] . '</td><td>' . $row[Album] . '</td><td>' . $row[Artist] . '</td><td>' . $row[Genre] . '</td></tr>';
				}
				echo '</table>';
			//}

		}else{
		$command = "SELECT Value, Album, Artist, Genre FROM album ORDER BY Value";
		$statement = $dbConn->query($command);
		$execOk = $statement->execute();
		if($execOk){
			echo '<table>';
			echo '<tr><td>Value</td><td>Album</td><td>Artist</td><td>Genre</td></tr>';
		while($row = $statement->fetch()){
			echo '<tr><td>' . $row[Value] . '</td><td>' . $row[Album] . '</td><td>' . $row[Artist] . '</td><td>' . $row[Genre] . '</td></tr>';
			}
			echo '</table>';
		}
		}
		
		//$command = "SELECT Value, Album, Artist, Genre FROM album ORDER BY Value";
		//$statement = $dbConn->query($command);
		//$execOk = $statement->execute();

		
		// if($execOk){
		// 	echo '<table>';
		// 	echo '<tr><td>Value</td><td>Album</td><td>Artist</td><td>Genre</td></tr>';
		// 	while($row = $statement->fetch()){
		// 		echo '<tr><td>' . $row[Value] . '</td><td>' . $row[Album] . '</td><td>' . $row[Artist] . '</td><td>' . $row[Genre] . '</td></tr>';
		// 	}
		// 	echo '</table>';
		// }
				?>
		</form>
	</body>
</html>
