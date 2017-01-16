<?php

	include "mysql.php";

	$lat = $_POST["lat"];
	$lng = $_POST["lng"];

	$lat_lower = $lat - 10;
	$lat_upper = $lat + 10;

	$lng_lower = $lng - 10;
	$lng_upper = $lng + 10;

	//var_dump($_POST);

	$sql = "SELECT lat, lng, type, description FROM incident_reports WHERE (lat >= $lat_lower AND lat <= $lat_upper) AND (lng >= $lng_lower AND lng <= $lng_upper)";
	$res = mysqli_query($con, $sql);

	$toSend = array();

	while($row = mysqli_fetch_assoc($res)){

		array_push($toSend, array("lat"=>$row["lat"], "lng"=>$row["lng"], "type"=>$row["type"], "description"=>$row["description"]));

	}

	echo json_encode(array("result"=>$toSend));


?>