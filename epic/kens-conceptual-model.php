<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Ken's Conceptual Model-Edited AK 2/1/2018</title>
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


		<!-- List of categories tied to the columns in game, tied to specific profile for the instructor/proctor (CSS, HTML, SQL, etc) -->
		<h1>Entity: Category</h1>
		<h3>Attribute: categoryId (Primary Key) VARCHAR(15) NOT NULL</h3>
		<h3>Attribute: categoryProfileId VARCHAR(15)(instructor/proctor)</h3>


		<!-- Question card containing question in specific category, answer, and value -->
		<h1>Entity: Card</h1>
		<h3>Attribute: cardId(Primary Key) BINARY(16) NOT NULL</h3>
		<h3>Attribute: cardCategoryId (Foreign Key)BINARY(16) NOT NULL</h3><!--only 1 category per card-->
		<h3>Attribute: cardAnswerVARCHAR(500)</h3>
		<h3>Attribute: cardDifficulty INTEGER (1)1:beginner, 2:intermediate, 3:advanced(?)</h3>
		<h3>Attribute: cardQuestion VARCHAR(500)</h3>


		<!-- Created game board filled with questions and values -->
		<h1>Entity: Board</h1>
		<h3>Attribute: boardId(Primary Key) BINARY(16) NOT NULL</h3>
		<h3>Attribute: boardProfileId (Foreign Key)BINARY(16) NOT NULL</h3><!--this is the proctor who created the game-->
		<h3>Attribute: boardName VARCHAR(50)</h3><!--or boardSubject-->


		<!-- Created ledger (weak entity) -->
		<h1>Entity: Ledger</h1>
		<h3>Attribute: LedgerID (NOT a composite key)(Primary Key)</h3>
		<h3>Attribute: ledgerBoardID (Foreign Key)BINARY(16) NOT NULL</h3>
		<h3>Attribute: ledgerProfileId(instructor/proctor) (Foreign Key)BINARY(16) NOT NULL</h3>
		<h3>Attribute: ledgerProfileId (student)(Foreign Key)BINARY(16) NOT NULL</h3>
		<h3>Attribute: ledgerCardId</h3>
		<h3>Attribute: ledgerCorrect(yes/no)</h3>
		<h3>Attribute: ledgerDouble(yes/no)</h3>
		<h3>Attribute: ledgerFinalWager</h3>
		<h3>Attribute: ledgerPointsId (sets row by value)</h3>
		<h3>Attribute: ledgerTypeId(sets column)</h3>



</html>