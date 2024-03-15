<!DOCTYPE html>
<html>

<!-- Head -->
<head>

<link rel="icon" type="image/png" href="../images/logo.jpg">
<title>IT Manager Dasboard</title>

<!-- Meta-Tags -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="Existing Login Form Widget Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //Meta-Tags -->

<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />

<!-- Style --> <link rel="stylesheet" href="css/style.css" type="text/css" media="all">

<!-- Fonts -->
<link href="//fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
<!-- //Fonts -->

</head>
<!-- //Head -->

<!-- Body -->
<body>
	<?php 
			require 'xuly.php';
	?>
	<h1><font style="color: #66f490;">SYSTEM MANAGER </font> DASHBOARD</h1>

	<div class="w3layoutscontaineragileits">
	<h2> <a href="index.php" >
            <img src="../images/logo.jpg" width="300" height="150" alt="">
          </a></h2>
		<form action="login.php" method="post">
			<input type="text" name="txtUsername" placeholder="Username" required="">
			<input type="password" name="txtPassword" placeholder="Password" required="">
			<div class="aitssendbuttonw3ls">
				<input type='submit' name="dangnhap" value="LOGIN">
				<div class="clear"></div>
			</div>
		</form>
	</div>
	
	<div class="w3footeragile">
		<p class="copyright">Copyright: <span>System Biti's</span> . Design and Developed by Tiến Phạm</a></p>
	</div>

	
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>

	<!-- pop-up-box-js-file -->  
		<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
	<!--//pop-up-box-js-file -->
	<script>
		$(document).ready(function() {
		$('.w3_play_icon,.w3_play_icon1,.w3_play_icon2').magnificPopup({
			type: 'inline',
			fixedContentPos: false,
			fixedBgPos: true,
			overflowY: 'auto',
			closeBtnInside: true,
			preloader: false,
			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in'
		});
																		
		});
	</script>
</body>
<!-- //Body -->

</html>