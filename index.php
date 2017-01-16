<!DOCTYPE html>
<html>

	<head>
		<title>Incident Reporting System</title>
		<?php include "functions.php"; ?>
		<?php head(); ?>
	</head>


	<body>

	<?php 
		meniu();
	?>

	<!--imagine_faina-->

	<div class="row header-row">
		<div class="col-md-12 header">

			<div class="col-md-12 title-container">

				<div class="site-title">
					Information Reporting System<br>
					<i>Take action. Build a better world.</i>
				</div>

			</div>

		</div>
	</div>

	<div class="jumbotron">
	  <h1>Make the world safer. Add a report.</h1>
	  <p>Add a report to let everybody know if there's a fire or a pollution source. You can also use our <b><i>Android app</i></b> to submit a report whenever you observe something is wrong!</p>
	  <p><a class="btn btn-primary btn-lg" href="report_incident.php" role="button">Add a Report</a></p>
	</div>
	
	<div class="row row-map" id="map">

		<script async defer
		    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAdA2H-Tcc9mQ_ZNYoyGga4THzXXnJLxj4&callback=initMap">
		</script>

	</div>

	<div class="jumbotron">
	  <h1>And there's more...</h1>
	  <p>View all the submited reports in List View or Map View.</p>
	  <p><a class="btn btn-primary btn-lg" href="list_view" role="button">List view</a></p>
	</div>

	<?php footer(); ?>

	</body>

</html>

<script>

function initMap() {


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