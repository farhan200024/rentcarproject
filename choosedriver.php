<?php

	//to use session
	session_start();

	//for mysqli database connection
	include('database/dbconnection.php');

	
	if (!isset($_SESSION['authentication'])) {
		echo "<script>window.location.href = 'index.php';</script>";
	}
	$currentpage = 'drivers';
	
	

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Choose Driver</title>

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
				<div class="col-md-9">
					<h3>Choose your Driver from here</h3>
				</div>
				<div class="col-md-3">
		        	<input type="text" class="text-input form-control" id="filter" placeholder="Filter Drivers" value=""/>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 driver-filter">
					<h3>Booking Detail</h3>

					<ul class="list-unstyled user_data">
						<li><i class="fa fa-home user-profile-icon"></i> Pickup from <?php echo $_SESSION['pickuplocation']; ?>
						</li>

						<li>
							<i class="fa fa-map-marker user-profile-icon"></i> Return to <?php echo $_SESSION['returnlocation']; ?>
						</li>

						<li><i class="fa fa-clock-o user-profile-icon"></i> From <?php echo $_SESSION['pickuptime']; ?>
						</li>
						
						<li><i class="fa fa-clock-o user-profile-icon"></i> to <?php echo $_SESSION['returntime']; ?>
						</li>
					</ul>

					<hr>
					<h3>Customer Detail</h3>
					<div class="profile_img">
						<div id="crop-avatar">
						<!-- Current avatar -->
							<img class="img-circle avatar-view" width="200px" height="200px"  src="images/customerphoto/<?php echo $rowgetcustomer['customerphoto']; ?>" alt="Avatar">
						</div>
					</div>
					<h4><?php echo $rowgetcustomer['customername']; ?></h4>

					<ul class="list-unstyled user_data">
						<li><i class="fa fa-user-circle-o user-profile-icon"></i> <?php echo $rowgetcustomer['customerusername']; ?>
						</li>

						<li>
						<i class="fa fa-envelope user-profile-icon"></i> <?php echo $rowgetcustomer['customeremail']; ?>
						</li>

						<li>
						<i class="fa fa-male user-profile-icon"></i> <?php echo $rowgetcustomer['customergender']; ?>
						</li>

						<li>
						<i class="fa fa-calendar user-profile-icon"></i> <?php echo $rowgetcustomer['customerdob']; ?>
						</li>
					</ul>
				</div>
				<div class="col-md-3"></div>
				<div class="col-md-8 col-md-offset-1">
					<?php
					$officeid = $_SESSION['officeid'];
					$pickuptime = $_SESSION['pickuptime'];
					$returntime = $_SESSION['returntime'];
                  # Paging
                    $driverlimit = 10;
                    $start = 0;
                    if(isset($_GET['start'])) {
                        $start = $_GET['start'];
                    }
                    
                    $next = $start + $driverlimit; 
                    $prev = $start - $driverlimit;

                    $total = mysqli_query($conn,"SELECT * FROM Drivers
													WHERE officeid = '$officeid'
													AND driverid != 'nodriver'
													AND active = 1
													AND driverid NOT IN
													(SELECT driverid FROM Bookings
													WHERE confirmstatus = 'confirmed'
													AND pickuptime BETWEEN '$pickuptime' AND '$returntime'
													OR returntime BETWEEN '$pickuptime' AND '$returntime')");
                    $total = mysqli_num_rows($total);

					$getdriversquery = mysqli_query($conn,"SELECT * FROM Drivers
													WHERE officeid = '$officeid'
													AND driverid != 'nodriver'
													AND active = 1
													AND driverid NOT IN
													(SELECT driverid FROM Bookings
													WHERE confirmstatus = 'confirmed'
													AND pickuptime BETWEEN '$pickuptime' AND '$returntime'
													OR returntime BETWEEN '$pickuptime' AND '$returntime') LIMIT $start, $driverlimit");
					if($total == 0){
						echo "<div class='row driver'> <p>Sorry, there is no driver available for your booking date!</div>";
					}
					else{
					while ($rowgetdrivers = mysqli_fetch_assoc($getdriversquery)):
					?>

					<div class="row driver">
						<div class="col-md-3">
							<img src="images/driverphoto/<?php echo $rowgetdrivers['driverphoto']; ?>"  width="100%" alt="">
						</div>

						<div class="col-md-3">

							<ul class="list-unstyled user_data">
								<li><i class="fa fa-user-circle-o user-profile-icon"></i> <?php echo $rowgetdrivers['driverusername']; ?>
								</li>

								<li>
								<i class="fa fa-envelope user-profile-icon"></i> <?php echo $rowgetdrivers['driveremail']; ?>
								</li>

								<li>
								<i class="fa fa-male user-profile-icon"></i> <?php echo $rowgetdrivers['drivergender']; ?>
								</li>

								<li>
								<i class="fa fa-drivers-license-o user-profile-icon">Age</i> <?php echo $rowgetdrivers['driverage']; ?>
								</li>

								<li>
								<i class="fa fa-globe user-profile-icon"></i> <?php echo $rowgetdrivers['driverexperience']; ?> years experience
								</li>

								<li>
								<i class="fa fa-money user-profile-icon"></i> <?php echo $rowgetdrivers['drivercost']; ?> per Hour
								</li>

								<li>
								<i class="fa fa-star user-profile-icon"></i> <?php echo $rowgetdrivers['driverrating']; $driverid = $rowgetdrivers['driverid']; ?> Stars
								</li>
							</ul>
						</div>

						<div class="col-md-4">
							<div class="ratingdriver">
							<?php
								$countrating = mysqli_query($conn,"SELECT * FROM ratingsdriver dr, users c WHERE dr.customerid = c.customerid AND driverid = '$driverid'") or die(mysqli_error($conn));
								$rowcountrating = mysqli_num_rows($countrating);

							?>
							<h4>Ratings</h4>
							<?php
								if($rowcountrating == 0):
							?>
								<p>Not Enough Ratings to show!</p>
							<?php
								else:
								for ($i=0; $i < $rowgetdrivers['driverrating']; $i++) { 
							?>
								<img src="images/design/star.png" width="20px" alt="">
							<?php
								}
							?>
							(Based on <?php echo $rowcountrating; ?> users)
							<?php endif;?>
							</div>
							<hr>
							<h4><i class="fa fa-comments"></i> Comments</h4>
							<?php
								$getcommentssql = mysqli_query($conn,"SELECT * FROM ratingsdriver dr, users c WHERE dr.CustomerID = c.CustomerID AND driverid = '$driverid' order by dr.ratingtime DESC limit 2 ") or die(mysqli_error($conn));
								$rownogetcomments = mysqli_num_rows($getcommentssql);
								if ($rownogetcomments < 1) {
							?>
							<p>There is no comment to show yet!</p>
							<?php
								} else{
							?>
							<ul class="list-unstyled comments">
							<?php
								while ($rowgetcomments = mysqli_fetch_assoc($getcommentssql)):
							?>
								<li>
									<span style="color: black"><strong><i class="fa fa-user"></i> <?php echo $rowgetcomments['customerusername']; ?></strong></span> : <em><?php echo $rowgetcomments['driverreview']; ?></em> 
								</li>
							<?php endwhile; ?>
							</ul>
							<?php } ?>

						</div>

						<div class="col-md-2">
							<p class="drivercost"><i class="fa fa-money"></i> £<?php echo $rowgetdrivers['drivercost']; ?> per Day</p>
							<span style="color: #aff; text-align: center;"><i class="fa fa-money"></i> £<?php echo $rowgetdrivers['drivercost']/24 * $_SESSION['durationinhours']; ?> for your duration</span>
							<hr>
							<a href="_thirdstepdriverbooking.php?driverid=<?php echo $rowgetdrivers['driverid']; ?>">
								
								<button class="btn btn-primary">Hire Driver</button>
							</a>
						</div>
					</div>
				<?php endwhile;} ?>
				</div>
			</div>
			<div class="row">
	            <div class="paging" style="text-align: center; font-size: 30px; margin-bottom: 50px; color: white;">
	                <?php if($prev < 0): ?>
	                <?php else: ?> 
	                <a href="?start=<?php echo $prev ?>" style="text-decoration: none; color: yellow;" class="pull-left">&laquo; Previous</a>
	                <?php endif; ?>
	                
	                <?php if($next >= $total): ?>
	                <?php else: ?> 
	                <a href="?start=<?php echo $next ?>" style="text-decoration: none; color: yellow;" class="pull-right">Next &raquo;</a>
	                <?php endif; ?>
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
	$(document).ready(function(){
    $("#filter").keyup(function(){
 
        // Retrieve the input field text and reset the count to zero
        var filter = $(this).val(), count = 0;
 
        // Loop through the comment list
        $(".driver").each(function(){
 
            // If the list item does not contain the text phrase fade it out
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
 
            // Show the list item if the phrase matches and increase the count by 1
            } else {
                $(this).show();
                count++;
            }
        });
        // Update the count
        var numberItems = count;
    });
});
	</script>
</html>