<?php


	function head(){
		?>

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.11.0.custom/jquery-ui-1.11.0.custom/jquery-ui.css">
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
					<a class="navbar-brand" href="#">
						<img alt="incindent-reporting-system" src="">
					</a>
				</div>

				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">Map view</a></li>
					<li><a href="#">List view</a></li>
					<li><a href="#">Report an Incident</a></li>
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