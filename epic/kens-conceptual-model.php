<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Ken's Conceptual Model</title>
	</head>
	<body>

		<!-- Profile authentication information to match when checked against active directory -->
		<h1>Entity: Profile</h1>
		<h3>Attribute: profileId(Primary Key) BINARY(16) NOT NULL</h3>
		<h3>Attribute: profileActivationToken</h3>
		<h3>Attribute: profileHash CHAR(64)</h3>
		<h3>Attribute: profileName VARCHAR(50)</h3>
		<h3>Attribute: profilePrivilege CHAR(10)</h3><!--question for Bridge: what type to use for this?-->
		<h3>Attribute: profileSaltCHAR(128)</h3>
		<h3>Attribute: profileUsername VARCHAR(50)</h3>


		<!-- List of categories tied to the columns in game (CSS, HTML, SQL, etc) -->
		<h1>Entity: Category</h1>
		<h3>Attribute: categoryId(Primary Key) BINARY(16) NOT NULL</h3>
		<h3>Attribute: categoryProfileId (Foreign Key)BINARY(16) NOT NULL</h3>
		<h3>Attribute: categoryTag VARCHAR(15)</h3>
		<h3>Attribute: </h3>
		<h3>Attribute: </h3>
		<h3>Attribute: </h3>
		<h3>Attribute: </h3>

		<!-- Question card containing question in specific category, answer, and value -->
		<h1>Entity: Card</h1>
		<h3>Attribute: cardId(Primary Key) BINARY(16) NOT NULL</h3>
		<h3>Attribute: cardCategoryId (Foreign Key)BINARY(16) NOT NULL</h3>
		<h3>Attribute: cardQuestion VARCHAR(500)</h3>
		<h3>Attribute: cardAnswerVARCHAR(500)</h3>
		<h3>Attribute: cardValue CHAR(1)</h3><!--ask bridge: we want this to be assigned a letter A,B,C,D corresponding to comparative ease of question(A=Easiest, D=Hardest)Then when the proctor sets up the game, she/he sets what values they want for each box, and the cards fill the appropriate box in game board-->
		<h3>Attribute: cardDoubleOrNothing</h3><!--not here-->
		<h3>Attribute: cardFinalWager</h3><!--not here-->
		<h3>Attribute: </h3>
		<h3>Attribute: </h3>


		<!-- Created game board filled with questions and values -->
		<h1>Entity: Board</h1>
		<h3>Attribute: boardId(Primary Key) BINARY(16) NOT NULL</h3>
		<h3>Attribute: boardProfileId (Foreign Key)BINARY(16) NOT NULL</h3><!--this is the proctor who created the game-->
		<h3>Attribute: boardSubject</h3><!--here- we might need a subject table to tie cards to game subjects-->
		<h3>Attribute: boardCategories</h3><!--This needs to be broken out to a new table-->
		<h3>Attribute: boardCards</h3><!--this needs to be broken out into a new table-->
		<h3>Attribute: </h3>
		<h3>Attribute: </h3>
		<h3>Attribute: </h3>
		<h3>Attribute: </h3>

		<!-- Created score ledger  -->
		<h1>Entity: Score</h1>
		<h3>Attribute: scoreID</h3>
		<h3>Attribute: scoreBoardID</h3>
		<h3>Attribute: scoreProfileId</h3>
		<h3>Attribute: </h3>
		<h3>Attribute: </h3>
		<h3>Attribute: </h3>


		<!--Created weak entity linking cards to board-->
		<h1>Entity: cardBoard</h1>
		<h3>Attribute: cardBoardId (CompoundPrimaryKey)BINARY(16) NOT NULL</h3>
		<h3>Attribute: cardBoardBoardId(Foreign Key) BINARY(16) NOT NULL</h3>
		<h3>Attribute: cardBoardCardId (Foreign Key)BINARY(16) NOT NULL</h3>
		<h3>Attribute: </h3>


		<!-- Created weak entity linking Cards to Category -->
		<h1>Entity: cardCategory</h1>
		<h3>Attribute: cardCategoryId (CompoundPrimaryKey)BINARY(16) NOT NULL</h3>
		<h3>Attribute: cardCategoryCardId(Foreign Key) BINARY(16) NOT NULL</h3>
		<h3>Attribute: cardCategoryCategoryId (Foreign Key)BINARY(16) NOT NULL</h3>
		<h3>Attribute: </h3>
		<h3>Attribute: </h3>
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