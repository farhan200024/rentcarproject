<?php
	//to use session
	session_start();
	//for mysqli database connection
	include('database/dbconnection.php');
	
	if (!isset($_SESSION['authentication'])) {
		echo "<script>window.location.href = 'index.php';</script>";
	}
	

	$customerid = $_SESSION['customerid'];
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

		<title>All Drivers</title>

		<!-- Bootstrap -->
		<link href="style/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="fa/css/font-awesome.min.css" rel="stylesheet">
		<!-- Sweet Alert -->
		<link rel="stylesheet" href="style/sweetalert.css">
		<link rel="stylesheet" href="style/rating.css">
		<!-- Custom Style -->
		<link href="style/customstyle.css" rel="stylesheet">
		<!-- Site Logo -->
		<link href = "images/design/logoo.jpg" rel="icon" type="image/jpg">

	</head>


	<body class="other">
		<!-- navigation bar -->
		<?php include '_navigationbar.php'; ?> 

		<div class="container adjustnavpositon">
			<div class="row">
				<div class="col-md-9">
					<h3>Drivers that are available to hire with your car</h3>
				</div>
				<div class="col-md-3">
		        	<input type="text" class="text-input form-control" id="filter" placeholder="Search Here" value=""/>
				</div>
			</div>
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<?php
                  # Paging
                    $limit = 10;
                    $start = 0;
                    if(isset($_GET['start'])) {
                        $start = $_GET['start'];
                    }
                    
                    $next = $start + $limit; 
                    $prev = $start - $limit;

                    $total = mysqli_query($conn,"SELECT * FROM drivers where driverid != 'nodriver' and Active = 1");
                    $total = mysqli_num_rows($total);

					$getdriversquery = mysqli_query($conn,"SELECT * FROM drivers where driverid != 'nodriver'  and active = 1 ORDER BY driverexperience DESC LIMIT $start, $limit");
					while ($rowgetdrivers = mysqli_fetch_assoc($getdriversquery)):
						$driverid = $rowgetdrivers['driverid'];
					?>

					<div class="row driver">
						<div class="col-md-3">
							<img src="images/driverphoto/<?php echo $rowgetdrivers['driverphoto']; ?>" width="210px" height="150px" alt="">
						</div>

						<div class="col-md-3">

							<ul class="list-unstyled user_data">
								<li><i class="fa fa-user-circle-o user-profile-icon"></i> <?php echo $rowgetdrivers['drivername']; ?>
								</li>

								<li>
								<i class="fa fa-envelope user-profile-icon"></i> <?php echo $rowgetdrivers['driveremail']; ?>
								</li>

								<li>
								<i class="fa fa-male user-profile-icon"></i> <?php echo $rowgetdrivers['drivergender']; ?>
								</li>

								<li>
								<i class="fa fa-calendar user-profile-icon"> Age:</i> <?php echo $rowgetdrivers['driverage']; ?>
								</li>

								<li>
								<i class="fa fa-globe user-profile-icon"></i> <?php echo $rowgetdrivers['driverexperience']; ?> years experience
								</li>

								<li>
								<i class="fa fa-money user-profile-icon"></i> £<?php echo $rowgetdrivers['drivercost'];$getofficeid = $rowgetdrivers['officeid']; ?> per day
								</li>

								<li>
								<?php
									$getofficesql = mysqli_query($conn,"select * from office where officeid = '$getofficeid'") or die(mysqli_error($conn));
									$rowgetoffice = mysqli_fetch_assoc($getofficesql);
								?>
								<i class="fa fa-home user-profile-icon"></i> From <?php echo $rowgetoffice['officename']; ?> Office
								</li>

								<li><i class="fa fa-drivers-license-o user-profile-icon"></i>
									<img src="images/licensephoto/<?php echo $rowgetdrivers['licensephoto']; ?>" width="100px" height="70px">
								</li>
							</ul>
						</div>

						<div class="col-md-3">
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

						<div class="col-md-3">
							<?php
							$driverid = $rowgetdrivers['driverid'];
							$checkuserratingsql = mysqli_query($conn,"select * from ratingsdriver where customerid = '$customerid' and driverid = '$driverid'") or die(mysqli_error($conn));

							$rowcheckuserrating = mysqli_num_rows($checkuserratingsql);
							if($rowcheckuserrating > 0):
							$rowuserrating = mysqli_fetch_assoc($checkuserratingsql);
							$userrating = $rowuserrating['driverrating'];
							$one = ''; $two = ''; $three = ''; $four = ''; $five = '';
							for ($i=1; $i < 6; $i++) { 
								switch ($userrating) {
									case '1':
										$one = 'checked';
										break;
									case '2':
										$two = 'checked';
										break;
									case '3':
										$three = 'checked';
										break;
									case '4':
										$four = 'checked';
										break;
									case '5':
										$five = 'checked';
										break;
									default:

										break;
								}
							}
							?>
							<div class="driverrating form-group">
							    <input type="radio" name="rating" class="rating" <?php echo $one; ?> value="1" />
							    <input type="radio" name="rating" <?php echo $two; ?>  class="rating" value="2" />
							    <input type="radio" name="rating" <?php echo $three; ?> class="rating" value="3" />
							    <input type="radio" name="rating" <?php echo $four; ?> class="rating" value="4" />
							    <input type="radio" name="rating" <?php echo $five; ?> class="rating" value="5" />
							</div>

							<div class="form-group">
								<p><i class="fa fa-comment"></i> <?php echo $rowuserrating['driverreview']; ?></p>
							</div>

							<div class="form-group">
								<a href="_editdriverrating.php?driverid=<?php echo $driverid; ?>&&customerid=<?php echo $customerid; ?>">

									<button class="btn btn-primary"><i class="fa fa-pencil-square-o"></i> Delete Rating & comment</button>
								</a>
							</div>


							<?php else: ?>
							<div class="ratingdriver">
								<form method="post">
									<input type="hidden" name="driverid" value="<?php echo $rowgetdrivers['driverid']; ?>">
									<div class="driverrating form-group">
									    <input type="radio" name="rating" class="rating" value="1" />
									    <input type="radio" name="rating" class="rating" value="2" />
									    <input type="radio" name="rating" class="rating" value="3" />
									    <input type="radio" name="rating" class="rating" value="4" />
									    <input type="radio" name="rating" class="rating" value="5" />
									</div>

									<div class="form-group">
									    <textarea name="comment" rows="3" class="form-control" placeholder="Your Comment" required></textarea>
									</div>

									<div class="form-group">
									    <input type="submit" name="rate" class="btn btn-primary" value="Submit">
									</div>
								</form>
							</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endwhile; ?>
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
	<script src="javascripts/rating.js"></script>
	<!-- SweetAlert -->
	<script src="javascripts/sweetalert-dev.js"></script>
	<script>
	$('.driverrating').rating();
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
	<?php
	if (isset($_POST['rate'])) {
		$rating = $_POST['rating'];
		$comment = $_POST['comment'];

		$customerid = $_SESSION['customerid'];
		$driverid = $_POST['driverid'];

		$insertratingsql = mysqli_query($conn,"INSERT INTO ratingsdriver(driverid, customerid, driverrating, driverreview, ratingtime) VALUES('$driverid', '$customerid', '$rating', '$comment', NOW())") or die(mysqli_error($conn));

		$updateratingavg = mysqli_query($conn,"UPDATE drivers SET driverrating = (SELECT AVG(driverrating) FROM ratingsdriver WHERE ratingsdriver.driverid = '$driverid') WHERE drivers.driverid = '$driverid'") or die(mysqli_error($conn));
  		echo "<script>swal({
		  title: 'Success!',
		  text: 'Your Comment has been saved!',
		  type: 'success',
		  timer: 1100,
		  showConfirmButton: false
		}, function(){
		      window.location.href = 'drivers.php';
		});</script>";
	}

	?>
</html>