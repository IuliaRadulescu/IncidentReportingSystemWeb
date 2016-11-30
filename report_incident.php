<!DOCTYPE html>
<html>

	<head>
		<title>Incident Reporting System - Report an incident</title>
		<meta charset="UTF-8">
		<?php require_once("functions.php"); ?>
		<?php head(); ?>
		<script src="js/mapScript.js"></script>
	</head>


	<body>

	<?php 
		meniu();
	?>

	<div class="row report">

		<div class="col-md-6 report-incident">
		<h3>Report an incident</h3><br>
			<form name="report-form" class="report-form">

				<label for="country">Country</label>
				<select name="country" id="country" class="form-control">
						<option value="France">France</option>
						<option value="England">England</option>
						<option value="Romania">Romania</option>
				</select>
				<br>
				<label for="city">City</label>
				<input type="text" name="city" id="city" class="form-control">
				<br>
				<label for="address">Address</label>
				<input type="text" name="address" id="address" class="form-control">
				<br>
				<label for="tag">Type</label>
				<select name="tag" id="tag" class="form-control">
					<option value="fire">Fire</option>
					<option value="pollution">Pollution source</option>
					<option value="jam">Traffic jam</option>
				</select>
				<br>
				<label for="date">Date</label>
				<input type="text" name="date" id="date" class="form-control" value="<?php echo date('d-m-Y'); ?>">
				<br>
				<input type="submit" name="send" id="send" value="Add incident" class="btn btn-default">

			</form>

		</div>

		<div class="col-md-6 report-map">

		</div>

	</div>

	</body>

</html>

<script>

  $( function() {
    $( "#date" ).datepicker({ dateFormat: 'dd-mm-yy' });
  } );

 </script>