<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Ken's Conceptual Model</title>
	</head>
	<body>

		<!-- Profile authentication information to match when checked against active directory -->
		<h1>Entity: Profile</h1>
		<h3>Attribute: profileId</h3>
		<h3>Attribute: profileAuthorization</h3>
		<h3>Attribute: profileHash</h3>
		<h3>Attribute: profileSalt</h3>
		<h3>Attribute: profileUsername</h3>

		<!-- List of categories tied to the columns in game (CSS, HTML, SQL, etc) -->
		<h1>Entity: Category</h1>
		<h3>Attribute: categoryId</h3>
		<h3>Attribute: categoryProfileId</h3>
		<h3>Attribute: categoryTag</h3>
		<h3>Attribute: </h3>
		<h3>Attribute: </h3>
		<h3>Attribute: </h3>
		<h3>Attribute: </h3>
		<h3>Attribute: </h3>

		<!-- Question card containing question in specific category, answer, and value -->
		<h1>Entity: Card</h1>
		<h3>Attribute: cardId</h3>
		<h3>Attribute: cardCategoryId</h3>
		<h3>Attribute: cardQuestion</h3>
		<h3>Attribute: cardAnswer</h3>
		<h3>Attribute: cardValue</h3>
		<h3>Attribute: cardDoubleOrNothing</h3>
		<h3>Attribute: cardFinalWager</h3>
		<h3>Attribute: </h3>
		<h3>Attribute: </h3>


		<!-- Created game board filled with questions and values -->
		<h1>Entity: Board</h1>
		<h3>Attribute: boardId</h3>
		<h3>Attribute: boardProfileId</h3>
		<h3>Attribute: boardSubject</h3>
		<h3>Attribute: boardCategories</h3>
		<h3>Attribute: boardCards</h3>
		<h3>Attribute: </h3>
		<h3>Attribute: </h3>
		<h3>Attribute: </h3>
		<h3>Attribute: </h3>

		<!-- Track stats? -->
		<h1>Entity: Play-By-Play</h1>
		<h3>Attribute: playByPlayId</h3>
		<h3>Attribute: </h3>

		<h1>Entity: Score</h1>
		<h3>Attribute: </h3>

	</body>
</html>