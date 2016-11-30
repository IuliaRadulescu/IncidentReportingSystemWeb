<?php
	
	error_reporting("E_ALL");
	ini_set("display_errors", 1);




	if(isset($_POST["intializare"])){

		require_once("mysql.php");

	
		$centerLat = 45.5246;
		$centerLng = -122.354; //le inlocuiesc in cererea sql

		$sql = "SELECT address, description, lat, lng, ( 3959 * acos( cos( radians($centerLat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($centerLng) ) + sin( radians($centerLat) ) * sin( radians( lat ) ) ) ) AS distance FROM incidents HAVING distance < 1020 ORDER BY distance LIMIT 0 , 20";

	
		$res = mysqli_query($con, $sql);

		if(!$res){
			var_dump($res);
			die('Eroare mysqli: '.mysqli_error($con));

		}

		$rezultat = array();

		while($row = mysqli_fetch_assoc($res)){
			
		  	$rezultat_helper["lat"] = $row["lat"];
		  	$rezultat_helper["lng"] = $row["lng"];
		  	$rezultat_helper["description"] = $row["description"];

		  	array_push($rezultat, $rezultat_helper);

		}

		echo json_encode($rezultat);
		

	}




?>