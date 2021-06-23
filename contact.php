<?php
/// this script is the contact us page in the website, in this page the user can send messages to the admin 
// this allows the communication between the admin and the user or not user of the website
   //to use session
	session_start();

	//for mysqli database connection
	include('database/dbconnection.php');
	$currentpage = 'contact';


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Contact Us</title>

		<!-- Bootstrap -->
		<link href="style/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="fa/css/font-awesome.min.css" rel="stylesheet">>
		<!-- Logo -->
		<link href = "images/design/logoo.jpg" rel="icon" type="image/jpg">
		<!-- Custom Style -->
		<link href="style/customstyle.css" rel="stylesheet">

	</head>

	<body class="onepagebody">

		<?php include '_navigationbar.php'; ?>

	<div id="contactform">
		<form method="post">
			<div class="form-group">
				<label for="name"><i class="fa fa-user"></i> Name</label>
				<input type="text" name="name" required class="form-control">
			</div>

			<div class="form-group">
				<label for="email"><i class="fa fa-envelope"></i> Email</label>
				<input type="email" name="email" required class="form-control">
			</div>

			<div class="form-group">
				<label for="suggestion"><i class="fa fa-comment"></i> Comment</label>
				<textarea name="suggestion" id="comment" class="form-control" required cols="30" rows="3"></textarea>
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn-primary center-block" name="submit" value="Send">
			</div>
		</form>
	</div>
	<div id="officelocation">
		<?php
			$sql = mysqli_query($conn,"SELECT * FROM office");
			while ($row = mysqli_fetch_assoc($sql)):
				
					$office = $row['officename']." Office";
					$default = '';
				
		?>
		<div class="box" id="<?php echo $default ?>">
			<h3><i class="fa fa-home"></i> <?php echo $office; ?></h3>
			<ul>
				<li><span style="color: yellow;"><i class="fa fa-location-arrow"></i> Office Address:</span> <em><?php echo $row['officeaddress'] ?></em></li>
				<?php
					$officeid = $row['officeid'];
					$sqlphone = mysqli_query($conn,"SELECT * FROM officephone WHERE officeid = '$officeid'");
				?>
					<li><span style="color: yellow;"><i class="fa fa-phone"></i>&nbsp; Contact Phone Numbers:</span>
					<?php
						while ($rowphone = mysqli_fetch_assoc($sqlphone)):
						echo $rowphone['officephoneprefix']."-".$rowphone['officephoneno'] ?>
					<?php
						endwhile;
					?>
					</li>
			</ul>
		</div>
		<?php
			endwhile;
		?>
	</div>


	<!-- jQuery -->
	<script src="javascripts/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="javascripts/bootstrap.min.js"></script>
	<!-- SweetAlert -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


	<script>
		$("h3").click(function() {
			var parent = $(this).parent();
		    $('h3').nextUntil('h3').hide();
			$("ul", parent).slideToggle("fast");
		});
	</script>
	<?php
	if (isset($_POST['submit'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$suggestion = $_POST['suggestion'];

		$insertsql = mysqli_query($conn,"insert into contactus(name, email, feedback, sendtime) values ('$name', '$email', '$suggestion', now())") 
		or die(mysqli_error($conn));

		echo " <script>swal({
        title: 'Success!',
        text: 'Your message has been sent!',
        icon: 'success',
        type: 'success'
        });</script>";

	}
	?>
	</body>
</html>