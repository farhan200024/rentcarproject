<?php
	session_start();
	include('../database/dbconnection.php');
	if (!$_SESSION['driverauth']) {
		echo "<script>window.location='../driverlogin.php'</script>";
	}

	$driverid = $_SESSION['driverid'];
	$driverusername = $_SESSION['driverusername'];

	$getdriversql = mysqli_query($conn,"Select * from drivers where driverid = '$driverid'");
	$rowgetdriver = mysqli_fetch_assoc($getdriversql);
	$drivername = $rowgetdriver['drivername'];
	$officeid = $rowgetdriver['officeid'];

	$driverphoto = $rowgetdriver['driverphoto'];

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Driver Panel</title>

		<!-- Bootstrap -->
		<link href="../style/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="../fa/css/font-awesome.min.css" rel="stylesheet">
		<!-- Site Logo -->
		<link href = "../images/design/logoo.jpg" rel="icon" type="image/jpg">

		<!-- Custom Theme Style -->
		<link href="../style/custom.min.css" rel="stylesheet">
		<link href="../style/customstyle.css" rel="stylesheet">
		<!-- Sweet Alert -->
		<link rel="stylesheet" href="../style/sweetalert.css">
	</head>

	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<div class="col-md-3 left_col">
					<div class="left_col scroll-view">
						<div class="navbar nav_title" style="border: 0;">
							<a href="ddashboard.php" class="site_title"><i class="fa fa-rocket"></i> <span>Rent Cars</span></a>
						</div>

						<div class="clearfix"></div>

						<!-- menu profile quick info -->
						<div class="profile clearfix">
							<div class="profile_pic">
								<img src="../images/driverphoto/<?php echo $driverphoto; ?>" alt="..." class="img-circle profile_img">
							</div>
							<div class="profile_info">
								<span>Welcome,</span>
								<h2><?php echo $drivername; ?></h2>
							</div>
							<div class="clearfix"></div>
						</div>
						<!-- /menu profile quick info -->

						<br />

						<!-- sidebar menu -->
						<?php
							 include "../driverpanel/includes/_sidebarmenu.php";
						?>
					</div>
				</div>

				<!-- top navigation -->
						<?php
							 include "../driverpanel/includes/_navigationbar.php";
						?>
				<!-- /top navigation -->

				<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>All Bookings for <?php echo $driverusername; ?></h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                <?php
                  $getallBookingsql = mysqli_query($conn,"SELECT * FROM Bookings where driverid = '$driverid' and confirmstatus != 'declined' ORDER BY pickuptime");
                ?>
                  <div class="x_content">
                              <table id="datatable-fixed-header" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <td>Customer Name</td>
                          <td>Pickup Time</td>
                          <td>Return Time</td>
                          <td>Pickup Location</td>
                          <td>Return Location</td>
                          <td>Car Name</td>
                          <td>Driver Name</td>
                          <td>Payment Method</td>
                          <td>Driver Cost</td>
                          <td>Confirmation</td>
                          <td>View Detail</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          while ($rowgetallBookings = mysqli_fetch_assoc($getallBookingsql)) {
                        ?>
                        <tr>
                          <td>
                            <?php
                              $customerid = $rowgetallBookings['customerid']; 
                              $getcusname = mysqli_query($conn,"select customername from users where customerid = '$customerid'");
                              $rowcusname = mysqli_fetch_assoc($getcusname);
                              echo $rowcusname['customername'];
                            ?>
                          </td>
                          <td><?php echo $rowgetallBookings['pickuptime']; ?></td>
                          <td><?php echo $rowgetallBookings['returntime']; ?></td>
                          <td><?php echo $rowgetallBookings['pickuplocation']; ?></td>
                          <td><?php echo $rowgetallBookings['returnlocation']; ?></td>
                          <td>
                            <?php
                              $carid = $rowgetallBookings['carid']; 
                              $getcarname = mysqli_query($conn,"select carname from Cars, OfficeCars  where cars.carno = OfficeCars.carno AND OfficeCars.carid = '$carid'");
                              $rowcarname = mysqli_fetch_assoc($getcarname);
                              echo $rowcarname['carname'];
                            ?>
                          </td>
                          <td>
                            <?php
                              $driverid = $rowgetallBookings['driverid']; 
                              $getdrivername = mysqli_query($conn,"select drivername from Drivers where driverid = '$driverid'");
                              $rowdrivername = mysqli_fetch_assoc($getdrivername);
                              echo $rowdrivername['drivername'];
                            ?>
                          </td>
                          <td><?php echo $rowgetallBookings['paymentmethod']; ?></td>
                          <td><?php echo $rowgetallBookings['drivercost']; ?></td>
                          <td><?php echo $rowgetallBookings['confirmstatus']; ?></td>
                          <td>
                            <a href="bookingdetail.php?bookingid=<?php echo $rowgetallBookings['bookingid']; ?>"><button class="btn btn-round btn-info btn-sm">View Detail</button></a>
                          </td>
                        </tr>
                        <?php
                          }
                        ?>
                        
                      </tbody>
                              </table>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

				<!-- footer  -->
				<footer>
					<div class="pull-right">
						Online Car Rental
					</div>
					<div class="clearfix"></div>
				</footer>
				</div>
		</div>

		<!-- jQuery -->
		<script src="../javascripts/jquery.min.js"></script>
		<!-- Bootstrap -->
		<script src="../javascripts/bootstrap.min.js"></script>
		<!-- FastClick -->
		<script src="../javascripts/fastclick.js"></script>
		
		<!-- Custom Theme Scripts -->
		<script src="../javascripts/custom.min.js"></script>
		<!-- SweetAlert -->
		<script src="../javascripts/sweetalert-dev.js"></script>
	</body>
</html>
