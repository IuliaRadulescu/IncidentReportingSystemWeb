<!DOCTYPE html>
<html>

	<head>
		<title>Incident Reporting System</title>
		<?php include "functions.php"; include "mysql.php"; ?>
		<?php head(); ?>
	</head>


	<body>

	<?php 
		meniu();
	?>

	<div class="row report">
		<div class="col-md-6 report-incident">

		<?php

			if(isset($_GET["lat"]) && isset($_GET["lng"])){


				echo "<input type='hidden' name='lat' value='".$_GET["lat"]."'>";
				echo "<input type='hidden' name='lng' value='".$_GET["lng"]."'>";

			}

			if(isset($_POST["send"])){


				$country = $_POST["country"];
				$city = $_POST["city"];
				$address = implode("+", explode(" ", $_POST["address"]));
				$type= mysqli_real_escape_string($con, $_POST["type"]);
				$date_reported = mysqli_real_escape_string($con, $_POST["date"]);
				$user_email = mysqli_real_escape_string($con, $_POST["user_email"]);
				$description = mysqli_real_escape_string($con, $_POST["description"]);

				//toate campurile sunt obligatorii

				//verificari

				$err_country=0; $err_city=0; $err_address=0; $err_type=0; $err_date_reported=0; $err_user_email=0; $err_description=0;

				if(empty($country))
					$err_country="Country cannot be empty.";

				if(empty($city))
					$err_city="City cannot be empty.";

				if(empty($_POST["address"]))
					$err_address="Address cannot be empty.";

				if(empty($type))
					$err_type="Type cannot be empty.";

				if(empty($date_reported))
					$err_date_reported="Date reported cannot be empty.";

				if(empty($user_email))
					$err_user_email="User email cannot be empty.";

				if(empty($description))
					$err_description="Description cannot be empty.";

				if(!empty($err_country) || !empty($err_city) || !empty($err_address) || !empty($err_date_reported) || !empty($err_user_email) || !empty($err_description)){

					?>

					<div class="alert alert-danger alert-dismissable">
					  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  <strong>There are errors!</strong><br>
					<?php
						if(!empty($err_country)) echo $err_country."<br>";
						if(!empty($err_city)) echo $err_city."<br>";
						if(!empty($err_address)) echo $err_address."<br>";
						if(!empty($err_date_reported)) echo $err_date_reported."<br>";
						if(!empty($err_user_email)) echo $err_user_email."<br>";
						if(!empty($err_description)) echo $err_description."<br>";
					?>
					</div>

					<?php


				}

				else{

					//trimit url

						$final_address = $country."+".$city."+".$address;
						$url = "https://maps.googleapis.com/maps/api/geocode/json?address=$final_address&key=AIzaSyAdA2H-Tcc9mQ_ZNYoyGga4THzXXnJLxj4";
						//echo $url;
						$json = file_get_contents($url);
						$response = json_decode($json);
						$lat = $response->results[0]->geometry->location->lat;
						$lng = $response->results[0]->geometry->location->lng;

						//introduc chestiile in baza de date

						$sql_insert = "INSERT INTO incident_reports SET lat=".$lat.", lng=".$lng.", type='{$type}', description='{$description}',
						user_email='{$user_email}', date_reported='{$date_reported}'";

						if(mysqli_query($con, $sql_insert)===FALSE){
							?>
							<div class="alert alert-danger alert-dismissable">
							  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							  <strong>There are errors!</strong> Please resend form.
							</div>
							<?php

						}

						else
							{

								//trimit mail la admin

								$headers =  'MIME-Version: 1.0' . "\r\n"; 
								$headers .= 'From: Incident Reporting System <incident_reports@address.com>' . "\r\n";
								$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 

								mail("radulescuiuliamaria@yahoo.com", "A FOST RAPORTAT UN INCIDENT", "Adresa: ".$country." ".$city." ".$address." Tip incident: ".$type." Raportat la data de ".$date_reported." de catre ".$user_email, $headers);
								header("Location:".BASE_URL."report_incident.php?lat=".$lat."&lng=".$lng);

							}

				} //de la else


			} //de la if isset POST

		?>

		<h3>Report an incident</h3><br>
			<form name="report-form" class="report-form" method="POST" action="">
				<label for="user_email">User Email</label>
				<input type="text" name="user_email" id="address" class="form-control"><br>
				<label for="country">Country</label><br>
				<select name="country" id="country" class="form-control">
						<option value="Iceland">Iceland</option>
						<option value="France">France</option>
						<option value="England">England</option>
						<option value="Romania">Romania</option>
				</select><br>
				<label for="city">City</label>
				<input type="text" name="city" id="city" class="form-control">
				<br>
				<label for="address">Address</label>
				<input type="text" name="address" id="address" class="form-control">
				<br>
				<label for="type">Type</label>
				<select name="type" id="type" class="form-control">
					<option value="fire">Fire</option>
					<option value="pollution">Pollution source</option>
					<option value="jam">Traffic jam</option>
				</select>
				<br>
				<label for="description">Description</label>
				<input type="text" name="description" id="description" class="form-control">
				<br>
				<label for="date">Date</label>
				<input type="text" name="date" id="date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
				<br>
				<input type="submit" name="send" id="send" value="Add incident" class="btn btn-default">

			</form>

		</div>

		<div class="col-md-6 report-map" style="height: 600px">
			<div class="row row-map" id="map" style="height: 500px; position: absolute!important; width: 95%; top: 50%; transform: translateY(-50%);">

				<script async defer
				    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAdA2H-Tcc9mQ_ZNYoyGga4THzXXnJLxj4&callback=initMap">
				</script>

			</div>
		</div>

	</div>


	<?php footer(); ?>

	</body>

</html>

<script>

  $( function() {
    $( "#date" ).datepicker({ dateFormat: 'dd-mm-yy' });
  } );


function initMap() {

	//verific daca am ceva in inputuri

	if($("input[name='lat']").val() && $("input[name='lng']").val()){

		var lat_helper = $("input[name='lat']").val();
		var lng_helper = $("input[name='lng']").val();

		var myLatLng = {lat: lat_helper, lng:lng_helper};
	}

	else
  		var myLatLng = {lat: -20, lng: 67};

  	console.log("myLatLng: "+lat_helper+" "+lng_helper);

  $.ajax({

    url:"ajaxMap.php",
    type:"POST",
    data:{intializare:1},
    success:function(response){


        var responses_helper = response.split('*');
        responses_helper = responses_helper.filter(function(n){ return n != "" }); //filtrez valori nule

        var responses = new Array();
        var k=0;
        for(var i=0; i<responses_helper.length; i++){

        	pieces = responses_helper[i].split('|');

        	responses[k] = new Array(pieces[0], pieces[1], pieces[2]); //description, latitude, longitude
        	k++;

        }

        if($("input[name='lat']").val() && $("input[name='lng']").val()){

			var lat_helper = $("input[name='lat']").val();
			var lng_helper = $("input[name='lng']").val();

			var valoriCentru = new google.maps.LatLng(lat_helper, lng_helper);
		}

		else
  			var valoriCentru = new google.maps.LatLng(responses[0][1], responses[0][2]);

        
        console.log(responses[0][1]+" "+responses[0][2]);

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: valoriCentru
        });

      
        for(var i=0; i<responses.length; i++){

        	var marker = new google.maps.Marker({
	          position: new google.maps.LatLng(responses[i][1], responses[i][2]),
	          map: map,
	          title: responses[i][0] //descrierea
	        });
        }

        

        


    }

  });
  
  

}




</script>

