<div class="top_nav">
	<div class="nav_menu">
	<!-- navigation bar -->
		<nav>
		<div class="nav toggle">
			<a id="menu_toggle"><i class="fa fa-bars"></i></a>
		</div>

		<?php $driverusername =""; ?>

		<ul class="nav navbar-nav navbar-right">
			<li class="">
				<a href="/driverprofile.php" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<img src="../images/driverphoto/<?php echo $driverphoto; ?>" alt=""><?php echo $driverusername; ?>
					<span class=" fa fa-angle-down"></span>
				</a>

			<ul class="dropdown-menu dropdown-usermenu pull-right">
				<li><a href="driverprofile.php">My Profile</a></li>
				<li>
				</li>
				<li><a href="driverlogout.php"> Log Out</a></li>
			</ul>
			</li>


            <li role="presentation" class="dropdown">


				<ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">

            	<?php
       
            	$driverlastlogin = $rowgetdriver['lastlogin'];

            	if ($driverlastlogin == "") {

            	}
            	else{
            		include('../database/dbconnection.php');
            		$getbookingnoti = mysqli_query($conn,"SELECT * FROM Bookings WHERE confirmstatus = 'confirmed' AND driverid = '$driverid'");
            		$getbookingrowno = mysqli_num_rows($getbookingnoti);
            		$noti = $noti + $getbookingrowno;
            		if ($getbookingrowno > 0) {
            			while ($rowbooking = mysqli_fetch_assoc($getbookingnoti)):
            				$customerid = $rowbooking['customerid'];
            				$getcustomer = mysqli_query($conn,"Select * from users where customerid = '$customerid'");
            				$rowgetcustomer = mysqli_fetch_assoc($getcustomer);
            		?>

					<li>
						<a href="bookingdetail.php?bookingid=<?php echo $rowbooking['bookingid']; ?>">
							<span class="image"><img src="../images/customerphoto/<?php echo $rowgetcustomer['customerphoto']; ?>" alt="Profile Image" /></span>
							<span>
								<span><?php echo $rowgetcustomer['customername']; ?></span>
							</span>
							<span class="message">
								From <?php echo $rowbooking['pickuplocation']; ?> to <?php echo $rowbooking['returnlocation']; ?>
							</span>
						</a>
					</li>

            		<?php
            			endwhile;
            		}
            	}
            	?>

		</ul>
		</nav>
	</div>
</div>