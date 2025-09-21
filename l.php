<?php session_start(); ?>

<html lang="en">
	<head>
		<title>Shopping Cart</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		
<link rel="stylesheet" href="login/css/style.css">
		<link rel="stylesheet" type="text/css" href="login.css">
	</head>
	<body>
		<div class="login-box">
		<form class="login100-form validate-form p-b-33 p-t-5" action="cheack_login.php" method="POST">
			<section class="ftco-section">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-md-6 text-center mb-5">
							<h2 class="heading-section">Login EpicGAMESHOP</h2>
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-md-6 col-lg-5">
							<div class="login-wrap p-4 p-md-5">
								<div class="icon d-flex align-items-center justify-content-center">
									<span class="fa fa-user-o"></span>
								</div>
								<div class="user-box">
								<h3 class="text-center mb-4">Have an account?</h3>
								<form action="#" class="login-form">
									<div class="form-group">
										<input type="text" name="m_user" class="form-control rounded-left" placeholder="Username" required>
									</div>
									<div class="form-group d-flex">
										<input type="password" name="m_pass" class="form-control rounded-left" placeholder="Password" required>
									</div>
									<div class="form-group d-md-flex">
										<div class="w-50">
											<label class="checkbox-wrap checkbox-primary">Remember Me
												<input type="checkbox" checked>
												<span class="checkmark"></span>
											</label>
										</div>
										<div class="w-50 text-md-right">
											<a href="#">Forgot Password</a>
										</div>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary rounded submit p-3 px-5"><span></span>
        <span></span>
        <span></span>
        <span></span>เข้าสู่ระบบ</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
		</form>
		<script src="login/js/jquery.min.js"></script>
		<script src="login/js/popper.js"></script>
		<script src="login/js/bootstrap.min.js"></script>
		<script src="login/js/main.js"></script>
	</body>
</html>