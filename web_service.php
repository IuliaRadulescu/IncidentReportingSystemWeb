<?php

	require_once("mysql.php");

	//preluam datele de la aplicatia Android in variabilele $_POST si $_FILE
	$email = $_POST["email"];
	$incidentType = $_POST["incidentType"];
	$description = $_POST["description"];
	$lat = $_POST["lat"];
	$lng = $_POST["lng"];
	$date_reported = date("Y-m-d h:i:s");

	echo "email = ".$_POST["email"]." description = ".$_POST["description"];

	var_dump($_POST);

	$ok_fisier = 1;

	if($_FILES["imagineIncident"]["error"]===UPLOAD_ERR_OK){

			$destination = "IncidentImages/".$_FILES["imagineIncident"]["name"];

			if(move_uploaded_file($_FILES["imagineIncident"]["tmp_name"], $destination)) //copiez poza la destinatia dorita
				echo "SUCCES!";
			else
				{
					$ok_fisier=0;
					echo "Eroare la move_uploaded_file";
				}

		if($ok_fisier===1){

			//introducem datele in baza de date - aici sa fac cu prepared statements (TO_DO)
			$sql = "INSERT INTO incident_reports SET user_email = '{$email}', description = '{$description}', type = '{$incidentType}', lat = '{$lat}', lng = '{$lng}',
			image_path='{$destination}', date_reported ='{$date_reported}'";

			if(mysqli_query($con,$sql)===FALSE){
				echo "Eroare la inserare in baza de date ".$sql;
			}

		}

	}
	else
		echo "Fisierul contine erori ".$_FILES["imagineIncident"]["error"];


?>