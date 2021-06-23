<?php
	session_start();
	include('../database/dbconnection.php');
	if (!$_SESSION['companyauth']) {
		echo "<script>window.location='../adminlogin.php'</script>";
	}

	$staffid = $_SESSION['staffid'];
	$username = $_SESSION['staffusername'];

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	$getstaffsql = mysqli_query($conn, "Select * from administrator where staffid = '$staffid'");
	$rowgetstaff = mysqli_fetch_assoc($getstaffsql);
	$staffname = $rowgetstaff['staffname'];
	$officeid = $rowgetstaff['officeid'];
	$staffphoto = $rowgetstaff['staffphoto'];

	$getfeedbacksql = mysqli_query($conn, "select * from contactus order by sendtime desc limit 4") or die(mysql_error());

	$checknumrofb = mysqli_num_rows($getfeedbacksql);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Contact us queries</title>

		<!-- Bootstrap -->
		<link href="../style/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="../fa/css/font-awesome.min.css" rel="stylesheet">
		<!-- Site Logo -->
		<link href = "../images/design/logoo.jpg" rel="icon" type="image/jpg">
		<!-- Font Awesome -->
		<link href="../style/chosen.min.css" rel="stylesheet">

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
							<a href="mdashboard.php" class="site_title"><i class="fa fa-rocket"></i><span>Rent Cars</span></a>
						</div>

						<div class="clearfix"></div>

						<!-- menu profile quick info -->
						<div class="profile clearfix">
							<div class="profile_pic">
								<img src="../images/staffphoto/<?php echo $staffphoto; ?>" alt="..." class="img-circle profile_img">
							</div>
							<div class="profile_info">
								<span>Welcome,</span>
								<h2><?php echo $staffname; ?></h2>
							</div>
							<div class="clearfix"></div>
						</div>
						<!-- /menu profile quick info -->

						<br />

						<!-- sidebar menu -->
						<?php
							include ('includes/_sidebarmenu.php');
						?>
					</div>
				</div>

				<!-- top navigation -->
						<?php
							include('includes/_navigationbar.php');
						?>
				<!-- /top navigation -->

				<!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="page-title">
              <div class="title_left">
                <h3>Feedbacks</h3>
              </div>
            </div>

            <div class="clearfix"></div>


			<?php if ($checknumrofb < 1) {
				echo "<h1>No Feedback to show</h1>";
			} else{ ?>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Feedbacks Inbox<small>User Mail</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div class="col-sm-3 mail_list_column">
                      <?php
                      	while ($rowgetfeedbacks = mysqli_fetch_assoc($getfeedbacksql)):
                      ?>
                        <a href="?feedbackid=<?php echo $rowgetfeedbacks['feedbackid']; ?>">
                          <div class="mail_list">
                            <div class="left">
                              <i class="fa fa-circle"></i>
                            </div>
                            <div class="right">
                              <h3><?php echo $rowgetfeedbacks['name']; ?> <small><?php echo $rowgetfeedbacks['sendtime']; ?></small></h3>
                              <p>Click this to read this mail! The sender's name is <?php echo $rowgetfeedbacks['name']; ?>!</p>
                            </div>
                          </div>
                        </a>
                        <?php
                        	endwhile;
							if(isset($_GET['feedbackid'])) {
								$feedbackid = $_GET['feedbackid'];
							}
							else {
								$feedbackid = '1';
							}
							$getmailsql = mysqli_query($conn, "select * from contactus where feedbackid = '$feedbackid'") or die(mysql_error());
							$rowmail = mysqli_fetch_assoc($getmailsql);
                        ?>
                      </div>

                      <!-- Mail content -->
                      <div class="col-sm-9 mail_view">
                        <div class="inbox-body">
                          <div class="mail_heading row">
                            <div class="col-md-8">
                                <strong><?php echo $rowmail['name']; ?></strong>
                                <span><?php echo $rowmail['email']; ?></span>
                                <a class="sender-dropdown"><i class="fa fa-chevron-down"></i></a>
                            </div>
                            <div class="col-md-4 text-right">
                              <p class="date"> <?php echo $rowmail['sendtime']; ?></p>
                            </div>
                            <div class="col-md-12">
                              <h4><?php echo $rowmail['name']; ?></h4>
                            </div>
                          </div>
                          <div class="sender-info">
                            <div class="row">
                              <div class="col-md-12">
                              </div>
                            </div>
                          </div>
                          <div class="view-mail">
                            <p><?php echo $rowmail['feedback']; ?></p><hr>
                          </div>
                        </div>

                      </div>
                      <!-- /CONTENT MAIL -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
				<!-- /page content -->

				<!-- footer content -->
				<footer>
					<div class="pull-right">
						Online Car Rental
					</div>
					<div class="clearfix"></div>
				</footer>
				<!-- /footer content -->
			</div>
		</div>

		<!-- jQuery -->
		<script src="../javascripts/jquery.min.js"></script>
		<!-- Bootstrap -->
		<script src="../javascripts/bootstrap.min.js"></script>
		<!-- FastClick -->
		<script src="../javascripts/fastclick.js"></script>
		<!-- FastClick -->
		<script src="../javascripts/chosen.jquery.min.js"></script>
		<!-- Custom Theme Scripts -->
		<script src="../javascripts/custom.min.js"></script>
		<!-- SweetAlert -->
		<script src="../../javascripts/sweetalert-dev.js"></script>

		<script>
		</script>
	</body>
</html>
