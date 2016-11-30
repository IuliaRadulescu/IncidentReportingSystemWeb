<!DOCTYPE html>
<html>

	<head>
		<title>Incident Reporting System</title>
		<meta charset="UTF-8">
		<?php require_once("functions.php"); ?>
		<?php head(); ?>
		<script src="js/mapScript.js"></script>
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
	  <h1>Who we are?</h1>
	  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis consectetur egestas tortor et lobortis. Fusce mauris ipsum, tempor id ante ut, feugiat efficitur dui. Aliquam ultricies dolor eget dui molestie vehicula. Donec a ullamcorper urna. Sed imperdiet, ipsum vitae aliquet bibendum, tortor odio pellentesque ante, a faucibus ex turpis eget felis. </p>
	  <p><a class="btn btn-primary btn-lg" href="#" role="button">Add a Report</a></p>
	</div>
	
	<div class="row row-map" id="map">

		<script async defer
		    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAdA2H-Tcc9mQ_ZNYoyGga4THzXXnJLxj4&callback=initMap">
		</script>

	</div>

	<div class="jumbotron">
	  <h1>And there's more...</h1>
	  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis consectetur egestas tortor et lobortis. Fusce mauris ipsum, tempor id ante ut, feugiat efficitur dui. Aliquam ultricies dolor eget dui molestie vehicula. Donec a ullamcorper urna. Sed imperdiet, ipsum vitae aliquet bibendum, tortor odio pellentesque ante, a faucibus ex turpis eget felis. </p>
	  <p><a class="btn btn-primary btn-lg" href="#" role="button">View all reports</a></p>
	</div>

	<?php footer(); ?>

	</body>

</html>

<script>

function initMap() {
  var myLatLng = {lat: -25.363, lng: 131.044};

  $.ajax({

    url:"ajaxMap.php",
    type:"POST",
    data:{intializare:1},
    success:function(response){

        var response = $.parseJSON(response);
        console.log(response);

        var LatLngInit = new google.maps.LatLng(response[0].lat, response[0].lng);

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: LatLngInit
        });

        for(var i=0; i<=response.length; i++){

        	var LatLng = new google.maps.LatLng(response[i].lat, response[i].lng);

        	var marker = new google.maps.Marker({
	          position: LatLng,
	          map: map,
	          title: response[i].description
	        });

        } 

        

        


    }

  });
  
  

}




</script>