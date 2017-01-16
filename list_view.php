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

	<div class="row">

		<div class="col-md-12">

			<?php

				$sql = "SELECT * FROM incident_reports";
				$res = mysqli_query($con, $sql);

				while($row = mysqli_fetch_assoc($res)){
					?>

						<div class="row incidente">

							<div class="col-md-6">

								<div class="type"><h3><?php echo $row["type"] ?></h3></div><br><hr><br>
								<div class="description"><?php echo $row["description"] ?></div>
								<div class="date_reported"><?php echo $row["date_reported"] ?></div>
							</div>
							<div class="col-md-6">
								<?php if(!empty($row["image_path"])): ?><div class="imagine"><img src="<?php echo BASE_URL.$row["image_path"]; ?>" style="width:100%"></div><?php endif; ?>
							</div>

						</div>

					<?php

				}

			?>

		</div>

	</div>


	</body>


</html>