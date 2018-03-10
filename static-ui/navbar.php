<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Create Card</title>

		<!--		Bootstrap CSS-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<!--Other and custom CSS-->
		<link rel="stylesheet" href="/src/app.css"/>

		<!--		Bootstrap Javascript-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</head>
	<body>
		<header>
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
				<a class="navbar-brand text-danger" href="#">
					<img src="../src/app/images/kmaru-v4-sm.svg" alt="kmaru logo"> &nbsp K Maru
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto">

						<li class="nav-item">
							<button class="btn btn-warning my-0 mr-sm-2" data-toggle="modal" data-target="#signin-modal"><i class="fas fa-sign-in-alt"></i>&nbsp;Sign In</button>
						</li>

						<li class="nav-item">
							<button class="btn btn-danger my-0 mr-sm-2" data-toggle="modal" data-target="#signup-modal"><i class="fas fa-paw"></i>&nbsp;Sign Up!</button>
						</li>

						<li> <button class="btn btn-info my-0 mr-sm-2" (click)="logOut();">Logout</button></li>

						<!--<form class="form-inline mb-auto mx-auto ml-sm-2">
							<div class="input-group">
								<input class="form-control" type="search" placeholder="Search" aria-label="Search">
								<span class="input-group-btn">
									<button class="btn btn-info"><i class="fas fa-search"></i></button>
								</span>
							</div>
						</form>-->
					</ul>
				</div>
			</nav>

		</header>
	</body>
</html>

