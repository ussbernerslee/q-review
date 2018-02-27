<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Create Card</title>

<!--		Bootstrap CSS-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


<!--		Bootstrap Javascript-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</head>
	<body>
		<div class="container p-5">
			<div class="jumbotron bg-dark text-light">
				<form>
					<h1>Create Categories and Cards</h1>
					<hr>
					<h3>Create a New Category or Select One</h3>
					<div class="form-group">
						<label for="newCategoryName">Category Name</label>
						<input type="" class="form-control" id="newCategoryName" aria-describedby="newCategoryName" placeholder="Enter New Category Name">
					</div>
					<div class="form-group">
						<label for="selectCategoryName">Select Category Name</label>
						<select class="form-control" id="selectCategoryName">
							<option>Sample Category Name</option>
							<option>Sample Category Name</option>
							<option>Sample Category Name</option>
							<option>Sample Category Name</option>
							<option>Sample Category Name</option>
						</select>
					</div>
					<hr>
					<h4>Create a New Card</h4>
					<div class="form-group">
						<label for="question">Write Your Question Here</label>
						<textarea class="form-control" id="question" rows="3"></textarea>
					</div>
					<div class="form-group">
						<label for="Answer">Write Your Answer Here</label>
						<textarea class="form-control" id="answer" rows="3"></textarea>
					</div>
					<div class="form-group">
						<label for="points">Point Value</label>
						<input type="" class="form-control" id="points" aria-describedby="points" placeholder="Enter Points Here">
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>

	</body>
</html>