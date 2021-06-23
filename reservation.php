<?php

	//to use session
	session_start();

	//for mysqli database connection
	include('database/dbconnection.php');
	
	if (!isset($_SESSION['authentication'])) {
		echo "<script>window.location.href = 'index.php';</script>";
	}
	

	$customerid = $_SESSION['customerid'];

	$getbookingsql = mysqli_query($conn,"select * from bookings where customerid = '$customerid' ORDER BY bookingtime DESC") or die(mysqli_error($conn));
	$checkgetbooking = mysqli_num_rows($getbookingsql);
	$currentpage = 'reservation';
	

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>My Bookings</title>

		<!-- Bootstrap -->
		<link href="style/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="fa/css/font-awesome.min.css" rel="stylesheet">
		<!-- Sweet Alert -->
		<link rel="stylesheet" href="style/sweetalert.css">
		<!-- Custom Style -->
		<link href="style/customstyle.css" rel="stylesheet">
		<!-- Site Logo -->
		<link href = "images/design/logoo.jpg" rel="icon" type="image/jpg">

	</head>

	<body class="other">

		<?php include '_navigationbar.php'; ?> <!-- navigation bar -->

		<div class="container adjustnavpositon">
			<div class="row">
				<div class="col-md-11 col-md-offset-1 reservation">
				<?php if ($checkgetbooking < 1) { ?>
					<h1>There is no reservation in your account!</h1>
				<?php }  else { ?>
					<table class="table table-responsive reservation-table">
						<thead>
							<tr>
								<td>Booking ID</td>
								<td>Office Name</td>
								<td>Pickup Time</td>
								<td>Return Time</td>
								<td>Pickup Location</td>
								<td>Return Location</td>
								<td>Total Cost</td>
								<td>Booking Time</td>
								<td>Status</td>
								<td></td>
								<td></td>
							</tr>
						</thead>
						<?php while($rowbooking = mysqli_fetch_assoc($getbookingsql)): $bookingid = $rowbooking['bookingid']; ?>
						<tr>
							<td><?php echo $rowbooking['bookingid']; ?></td>
							<td>
								<?php
								$officeid = $rowbooking['officeid'];
								$getofficesql = mysqli_query($conn,"select * from office where officeid = '$officeid'") or die(mysqli_error($conn));
								$rowoffice = mysqli_fetch_assoc($getofficesql);
								echo $rowoffice['officename'];
								?>
							</td>
							<td><?php echo $rowbooking['pickuptime']; ?></td>
							<td><?php echo $rowbooking['returntime']; ?></td>
							<td><?php echo $rowbooking['pickuplocation']; ?></td>
							<td><?php echo $rowbooking['returnlocation']; ?></td>
							<td>£<?php echo $rowbooking['totalcost']; ?></td>
							<td><?php echo $rowbooking['bookingtime']; ?></td>
							<td>
								<?php
								switch ($rowbooking['confirmstatus']) {
									case 'pending':
										echo "Reservation Pending";
										break;
									case 'confirmed':
										echo "Reservation Accepted";
										break;
									case 'declined':
										echo "Reservation Denied!";
										break;
									case 'completed':
										echo "Process Completed";
										break;
									default:
										# code...
										break;
								}
								?>
							</td>
							<td>
								<a href="viewbookingdetails.php?bookingid=<?php echo $bookingid; ?>" class="btn btn-primary"><i class="fa fa-info-circle"></i> View Detail</a>
							</td>

							<?php if(($rowbooking['confirmstatus'] == 'confirmed') OR ($rowbooking['confirmstatus'] == 'pending')): ?>
							<td>
								<?php
								$date1=strtotime("$rowbooking[pickuptime]");
								$date2 = date("Y-m-d H:i:s");
								$date2=strtotime("$date2");
								$days = abs(($date1 - $date2)/60/60/24);
								if ($days > 5):
								?>
								<a href="_cancelbooking.php?bookingid=<?php echo $bookingid; ?>" class="btn btn-default"><i class="fa fa-minus-circle"></i> Cancel</a>
								<?php
								else:
								?>
								<span style="color: red"><em>Can't Cancel</em></span>
								<?php
								endif;
								?>
							</td>
							<?php endif; ?>
						</tr>
						<?php endwhile; ?>
					</table>
				<?php } ?>
				</div>
			</div>
		</div>

			
	</body>

	<!-- jQuery -->
	<script src="javascripts/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="javascripts/bootstrap.min.js"></script>
	<!-- SweetAlert -->
	<script src="javascripts/sweetalert-dev.js"></script>
	<script>
	</script>
</html>