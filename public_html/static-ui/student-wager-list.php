<!DOCTYPE html>
<html>
	<head>
		<!--this is the student wager list (a variation of the leaderboard) html template for KMaru.
This will be used on captain/the master of the game's views to be able to view player's answers
to the final KMaru question and the amount of points they have wagered (see wager-input) on their answer.
This will also allow the captain to check off the answers as correct or incorrect
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
			<h1>Final Answers and Wagers</h1>
			<table class="table table-hover table-dark table-sm">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Name</th>
						<th scope="col">Wager</th>
						<th scope="col">Answer</th>
						<th scope="col">Correct/Not Correct</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row">1</th>
						<td>Kevin</td>
						<td>200</td>
						<td>What is the Kobayashi Maru?</td>
						<!--this is a field with a dropdown button to choose from
						correct or incorrect for the captain/game owner to check answers-->
						<td class = "select">
							<select class="custom-select" id="inputGroupSelect01">
								<option value="1">Correct</option>
								<option value="2">NOT Correct</option>
							</select>
						</td>
					</tr>
					<tr>
						<th scope="row">2</th>
						<td>Anna</td>
						<td>32</td>
						<td>Kobayashi Maru?</td>
						<!--this is a field with a dropdown button to choose from
						correct or incorrect for the captain/game owner to check answers-->
						<td class = "select">
							<select class="custom-select" id="inputGroupSelect01">
								<option value="1">Correct</option>
								<option value="2">NOT Correct</option>
							</select>
						</td>
					</tr>
					<tr>
						<th scope="row">3</th>
						<td>Kirk</td>
						<td>999</td>
						<td>What is the Kobayashi Maru that I refused to die on, even for a game so I hacked the game and made it much better</td>
						<!--this is a field with a dropdown button to choose from
						correct or incorrect for the captain/game owner to check answers-->
						<td class = "select">
							<select class="custom-select" id="inputGroupSelect01">
								<option value="1">Correct</option>
								<option value="2">NOT Correct</option>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
			<!--This is a button for the captain to submit all the correct/incorrect grades for the players
			so that the wagers can be added to or subtracted from their total points on the "leaderboard"
			a "Correct" should add the wagered points to the player's current points on leaderboard
			a "NOT Correct should subtract the wagered points from the player's current points on the leaderboard-->
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</body>
