<?php
	
	error_reporting("E_ALL");
	ini_set("display_errors", 1);


	//var_dump($con);


	function mapToXML($centerLat=0, $centerLng=0){

		require_once("mysql.php");

		if($centerLat==0)
			$centerLat = 45.5246;
		if($centerLng==0)
			$centerLng = -122.354; //le inlocuiesc in cererea sql

		$sql = "SELECT address, description, lat, lng, ( 3959 * acos( cos( radians($centerLat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($centerLng) ) + sin( radians($centerLat) ) * sin( radians( lat ) ) ) ) AS distance FROM incidents HAVING distance < 1020 ORDER BY distance LIMIT 0 , 20";

		//echo $sql."<br><br>";

		$res = mysqli_query($con, $sql);

		if(!$res){
			var_dump($res);
			die('Eroare mysqli: '.mysqli_error($con));

		}


		
		header("Content-type: text/xml");

		/*
			Utilizare DOMDocument
			- crearea unui nod (element xml):$nod = $dom->createElement("nume_element");
			- adaugarea unui nod copil la un nod parinte: $newnode = $xmlRoot->appendChild($nod); --am adaugat copilul $nod la elementul $xmlRoot
		*/

		$dom = new DOMDocument('1.0'); //creaza un document xml nou
		$xmlRoot = $dom->createElement("markers"); //creez radacina arborelui xml
		$xmlRoot = $dom->appendChild($xmlRoot); //adaug radacina la documentul xml creat*/

		while($row = mysqli_fetch_assoc($res)){
			$node = $dom->createElement("marker");
		  	$newnode = $xmlRoot->appendChild($node);
		  	$newnode->setAttribute("description", $row['description']);
		  	$newnode->setAttribute("address", $row['address']);
		  	$newnode->setAttribute("lat", $row['lat']);
		  	$newnode->setAttribute("lng", $row['lng']);
		  	$newnode->setAttribute("distance", $row['distance']);
		  	
		}
		echo $dom->saveXML();

	}

	mapToXML();


?>