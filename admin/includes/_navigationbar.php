<div class="top_nav">
	<div class="nav_menu">
	<!-- nav bar -->
		<nav>
		<div class="nav toggle">
			<a id="menu_toggle"><i class="fa fa-bars"></i></a>
		</div>

		<ul class="nav navbar-nav navbar-right">
			<li class="">
				<a href="staffprofile.php" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<img src="../images/staffphoto/<?php echo $staffphoto; ?>" alt=""><?php echo $username; ?>
					<span class=" fa fa-angle-down"></span>
				</a>

			<ul class="dropdown-menu dropdown-usermenu pull-right">
				<li><a href="staffprofile.php">Profile</a></li>
				<li>
				</li>
				<li><a href="changepassword.php"><i class="fa fa-unlock pull-right"></i> Change Password</a></li>

				<li><a href="stafflogout.php"> <i class="fa fa-sign-out pull-right"></i>  Log Out</a></li>
			</ul>
			</li>


            <li role="presentation" class="dropdown">

				<a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
					<i class="fa fa-envelope-o"></i>
					<span class="badge bg-green" id="notifi"></span>
				</a>

				<ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">

            	<?php
            	$noti = 0;
            	$stafflastlogin = $rowgetstaff['lastlogin'];

            	if ($stafflastlogin == "") {
            		# code...
            	}
            	else{

            		$getbookingnoti = mysqli_query($conn,"SELECT * FROM Bookings WHERE confirmstatus = 'pending' AND officeid = '$officeid' AND bookingtime > '$stafflastlogin'");
            		$getbookingrowno = mysqli_num_rows($getbookingnoti);
            		$noti = $noti + $getbookingrowno;
            		if ($getbookingrowno > 0) {
            			while ($rowbooking = mysqli_fetch_assoc($getbookingnoti)):
            				$customerid = $rowbooking['customerid'];
            				$getcustomer = mysqli_query($conn,"Select * from Customers where customerid = '$customerid'");
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
            	<input type="hidden" id="noti" value="<?php echo $noti ?>">
            	<script>
			        var noti = document.getElementById("noti").value;
			        document.getElementById("notifi").innerHTML = noti;
            	</script>
					<li>
						<div class="text-center">
							<a>
								<strong>See All Alerts</strong>
								<i class="fa fa-angle-right"></i>
							</a>
						</div>
					</li>
				</ul>
			</li>



		</ul>
		</nav>
	</div>
</div>