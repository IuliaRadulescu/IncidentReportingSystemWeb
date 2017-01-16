<?php


	function head(){

		define("BASE_URL", "http://localhost/incident_reporting_system/");

		?>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.11.0.custom/jquery-ui-1.11.0.custom/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/jquery-ui-1.11.0.custom/jquery-ui-1.11.0.custom/jquery-ui.js"></script>
	<script src="bootstrap/js/bootstrap.js"></script>
		<?php
	}

	function meniu(){
		?>

		<div class="row">

			<div class="col-md-12 preheader">
				&copy;By Radulescu Iulia-Maria
			</div>

		</div>

		<nav class="navbar navbar-default navbar-static-top">

			<div class="container-fluid">

				<div class="navbar-header">
					<a class="navbar-brand" href="index.php">
						<img alt="incindent-reporting-system" src="">
					</a>
				</div>

				<ul class="nav navbar-nav navbar-right">
					<li><a href="list_view.php">List view</a></li>
					<li><a href="report_incident.php">Report an Incident</a></li>
				</ul>

			</div>



		</nav>

		<?php

	}

	function footer(){
		?>
		<div class="row row-footer">

			<div class="col-md-12 preheader">
			&copy;By Radulescu Iulia-Maria
			</div>

		</div>
		<?php

	}



?>