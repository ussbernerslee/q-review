<!DOCTYPE html>
<html>
	<head>
		<!--this is the leaderboard html template for KMaru.
This will be used on player views so that cadets/players can keep track of their score
in relation to the scores of others.
This will also be used by the captain/person who runs the game to keep track of current student scores.
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
	<!--the table below has 3 players, as a sample. In the final version, we need javascript
	that creates a row for each player and displays their name and score-->
	<h2>Leaderboard</h2>
	<table class="table table-hover table-dark table-sm table-responsive-md">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Name</th>
				<th scope="col">Points</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th scope="row">1</th>
				<td>Kevin</td>
				<td>256</td>

			</tr>
			<tr>
				<th scope="row">2</th>
				<td>Anna</td>
				<td>-666</td>
			</tr>
			<tr>
				<th scope="row">3</th>
				<td>Kirk</td>
				<td>1000</td>
			</tr>
		</tbody>
	</table>
</div>
	</body>

