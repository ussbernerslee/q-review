<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Kmaru Board Layout</title>

		<!--		Bootstrap CSS-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


		<!--		Bootstrap Javascript-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</head>
	<body>

		<div class="container mt-5">
			<table class="table table-bordered text-center">
				<thead>
					<tr>
						<th>Category 1</th>
						<th>Category 2</th>
						<th>Category 3</th>
						<th>Category 4</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><a href="#!" class="btn btn-outline-light container-fluid" role="button">1</a></td>
						<td><a href="#!" class="btn btn-outline-light container-fluid" role="button">1</a></td>
						<td><a href="#!" class="btn btn-outline-light container-fluid" role="button">1</a></td>
						<td><a href="#!" class="btn btn-outline-light container-fluid" role="button">1</a></td>
					</tr>
					<tr>
						<td><button type="button" name="" id="" class="btn btn-block btn-light">2</button></td>
						<td>2</td>
						<td>2</td>
						<td>2</td>
					</tr>
					<tr>
						<td>4</td>
						<td>4</td>
						<td>4</td>
						<td>4</td>
					</tr>
					<tr>
						<td>8</td>
						<td>8</td>
						<td>8</td>
						<td>8</td>
					</tr>
					<tr>
						<td>16</td>
						<td>16</td>
						<td>16</td>
						<td>16</td>
					</tr>
					<tr>
						<td>32</td>
						<td>32</td>
						<td>32</td>
						<td>32</td>
					</tr>
				</tbody>
			</table>
		</div>
	</body>
</html>


<div class="container mt-5">
	<h2 *ngFor="let board of boards">{{ board.boardName }}</h2>
	<table class="table table-bordered text-center">
		<thead>
			<tr *ngFor="let category of categories">
				<th>{{ category.categoryName }}1</th>
				<th>{{ category.categoryName }}2</th>
				<th>{{ category.categoryName }}3</th>
				<th>{{ category.categoryName }}4</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><a href="#!" class="btn btn-outline-light container-fluid" role="button">1</a></td>
				<td><a href="#!" class="btn btn-outline-light container-fluid" role="button">1</a></td>
				<td><a href="#!" class="btn btn-outline-light container-fluid" role="button">1</a></td>
				<td><a href="#!" class="btn btn-outline-light container-fluid" role="button">1</a></td>
			</tr>
			<tr *ngFor="let card of cards">
				<td><button type="button" name="" id="" class="btn btn-block btn-light">2</button></td>
				<td>{{ card.cardPoints=for(i=0;i<=array.length;i++) (getCardByCardCategoryId (category 1))}}</td>
				<td>{{ cardPoints=1 (getCardByCardCategoryId (category2))}}</td>
				<td>{{ cardPoints=1 (getCardByCardCategoryId (category 3))}}</td>
				<td>{{ cardPoints=1 (getCardByCardCategoryId (category 4))}}</td>
			</tr>
			<tr>
				<td>{{ cardPoints=2 (getCardByCardCategoryId (category 1))}}</td>
				<td>{{ cardPoints=2 (getCardByCardCategoryId (category 2))}}</td>
				<td>{{ cardPoints=2 (getCardByCardCategoryId (category 3))}}</td>
				<td>{{ cardPoints=2 (getCardByCardCategoryId (category 4))}}</td>
			</tr>
			<tr>
				<td>{{ cardPoints=4 (getCardByCardCategoryId (category 1))}}</td>
				<td>{{ cardPoints=4 (getCardByCardCategoryId (category 2))}}</td>
				<td>{{ cardPoints=4 (getCardByCardCategoryId (category 3))}}</td>
				<td>{{ cardPoints=4 (getCardByCardCategoryId (category 4))}}</td>
			</tr>
			<tr>
				<td>{{ cardPoints=8 (getCardByCardCategoryId (category 1))}}</td>
				<td>{{ cardPoints=8 (getCardByCardCategoryId (category 2))}}</td>
				<td>{{ cardPoints=8 (getCardByCardCategoryId (category 3))}}</td>
				<td>{{ cardPoints=8 (getCardByCardCategoryId (category 4))}}</td>
			</tr>
			<tr>
				<td>{{ cardPoints=16 (getCardByCardCategoryId (category 1))}}</td>
				<td>{{ cardPoints=16 (getCardByCardCategoryId (category 2))}}</td>
				<td>{{ cardPoints=16 (getCardByCardCategoryId (category 3))}}</td>
				<td>{{ cardPoints=16 (getCardByCardCategoryId (category 4))}}</td>
			</tr>
			<tr>
				<td>{{ cardPoints=32 (getCardByCardCategoryId (category 1))}}</td>
				<td>{{ cardPoints=32 (getCardByCardCategoryId (category 2))}}</td>
				<td>{{ cardPoints=32 (getCardByCardCategoryId (category 3))}}</td>
				<td>{{ cardPoints=32 (getCardByCardCategoryId (category 4))}}</td>
			</tr>
		</tbody>
	</table>
</div>