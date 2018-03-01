<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Player navigation bar</title>

		<!--		Bootstrap CSS-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
				integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


		<!--		Bootstrap Javascript-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
				  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
				  crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
				  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
				  crossorigin="anonymous"></script>
	</head>
	<body>

		<nav class="navbar navbar-default navbar-expand-md navbar-dark bg-dark" id="playerNav">
			<a class="navbar-brand" href="">KMARU</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#playerNav" aria-controls="playerNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="playerNav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="#">"Whos Signed in"</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Sign Out</a>
					</li>
				</ul>
			</div>
		</nav>


	</body>
</html>