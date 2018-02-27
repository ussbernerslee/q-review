<!DOCTYPE html>
<html>
	<head>
		<!--this is the final wager input for players html template for KMaru.
This will be used by the players to enter their wagers and final answer to KMaru
author: Anna Khamsamran <akhamsamran1@cnm.edu>
-->
		<meta charset="UTF-8">
		<title>KMaru Leaderboard</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


		<!--BOOTSTRAP CSS-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

		<!--Other and custom CSS-->
		<link rel="stylesheet" href="css/style1.css"/>
		<!--Slick styling for Carousel-->
		<link rel="stylesheet" type="text/css" href="slick/slick/slick.css"/>
		<!--Slick default styling new slick-theme.css-->
		<link rel="stylesheet" type="text/css" href="slick/slick/slick-theme.css"/>

		<!--Optional Javascript links-->
		<!--link to Bootstrap javascript dependencies-->
		<!--(Put it here, but if it is a heavy site, put this block just below the closing body tag)-->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</head>

	<body>
		<div class="container">
			<!--This form is used for the student to enter a final wager amount of points
			and to enter their answer to the final KMaru question-->
			<h1>Final Wager</h1>
			<form>
				<div class="form-group">
					<label for="number">Points Wagered</label>
					<input type="number" class="form-control" id="number" name="number" placeholder="0">
					<small id="wagerHelp" class="form-text text-muted">You may wager up to the number of points you have OR 32, whichever is higher.</small>
				</div>
				<div class="form-group">
					<label for="studentAnswer">Your Answer</label>
					<textarea class="form-control" rows="5" id="studentAnswer" name="studentAnswer" placeholder="Answer the question here (2000 characters max)"></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
		</form>



	</body>