<!doctype html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</head>
	<body>
		<div class="jumbotron">
			<div class="row align-items-center justify-content-center">
			<h1 class="display-3">Sign Up</h1>
			<div class="container fluid">
			</div>
				<div class="row align-items-center justify-content-center">
				<form>
					<div class="form-group">
						<label for="firstName">First name</label>
						<input type="firstName" class="form-control" id="firstName" aria-describedby="nameHelp"
								 placeholder="First name">
						<label for="lastName">Last name</label>
						<input type="lastName" class="form-control" id="lastName" aria-describedby="nameHelp"
								 placeholder="Last name">
						<label for="profileId">Profile name</label>
						<input type="profileId" class="form-control" id="profileId" aria-describedby="profileHelp"
								 placeholder="Profile Id">
						<label for="exampleInputEmail1">Email address</label>
						<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
								 placeholder="Enter email">
						<label for="password">Password</label>
						<input type="password" class="form-control" id="password" aria-describedby="passwordHelp"
								 placeholder="Enter password">
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</body>
</html>
