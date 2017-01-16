<?php
	
	error_reporting("E_ALL");
	ini_set("display_errors", 1);




	if(isset($_POST["intializare"])){

		require_once("mysql.php");

		$sql_preia = "SELECT description, lat, lng FROM incident_reports";

		$res_preia = mysqli_query($con, $sql_preia);

		$results="";

		while($row_preia = mysqli_fetch_array($res_preia)){
			
			$results = $row_preia[0]."|".$row_preia[1]."|".$row_preia[2]."*".$results;
			
		}

		
		echo $results;

	}




?>