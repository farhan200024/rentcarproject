<!-- sidebar menu of the admin page -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	<div class="menu_section">
		<h3>General</h3>
		<?php
			$staffrole = $_SESSION['staffrole'];
			if ($staffrole == 'branchmanager'):
		?>
		<ul class="nav side-menu">
			<li><a href="mdashboard.php"><i class="fa fa-home"></i> Dashboard</a>
			<li><a href="bookingmanagement.php"><i class="fa fa-inbox"></i> Bookings</a>
			<li><a href="contactus.php"><i class="fa fa-inbox"></i> Contact us queries</a>

			</li>
			<li><a><i class="fa fa-edit"></i> Registrations <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="addnewcartooffice.php">Add other cars to Office</a></li>
					<li><a href="carregis.php">Car Registration</a></li>
	
				</ul>
			</li>
			<li><a><i class="fa fa-desktop"></i> Management <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="usersmanagement.php">Users Management</a></li>
					<li><a href="carmanagement.php">Cars Management</a></li>
					<li><a href="drivermanagement.php">Drivers Management</a></li>
				</ul>
			</li>
	<?php
			else:
		?>
		<ul class="nav side-menu">
			<li><a href="sdashboard.php"><i class="fa fa-home"></i> Dashboard</a>
			<li><a href="bookingmanagement.php"><i class="fa fa-inbox"></i> Bookings</a>
			<li><a href="feedbacks.php"><i class="fa fa-inbox"></i> Contact us Queries</a>
			</li>
			
		</ul>
		<?php endif; ?>
	</div>

</div>