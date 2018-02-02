<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Ken's Conceptual Model-Edited AK 2/1/2018</title>
	</head>
	<body>

		<!-- Profile authentication information to match when checked against active directory -->
		<h1>Entity: Profile</h1>
		<p><strong>Attribute: </strong> profileId(Primary Key) BINARY(16) NOT NULL</p>
		<p><strong>Attribute: </strong> profileActivationToken</p>
		<p><strong>Attribute: </strong> profileHash CHAR(128)</p>
		<p><strong>Attribute: </strong> profileName VARCHAR(50)</p>
		<p><strong>Attribute: </strong> profilePrivilege CHAR(1)</p><!--question for Bridge: what type to use for this?-->
		<p><strong>Attribute: </strong> profileSalt CHAR(64)</p>
		<p><strong>Attribute: </strong> profileUsername VARCHAR(50)</p>


		<!-- List of categories tied to the columns in game, tied to specific profile for the instructor/proctor (CSS, HTML, SQL, etc) -->
		<h1>Entity: Category</h1>
		<p><strong>Attribute: </strong> categoryId (Primary Key) VARCHAR(15) NOT NULL</p>
		<p><strong>Attribute: </strong> categoryProfileId VARCHAR(15)(instructor/proctor)</p>


		<!-- Question card containing question in specific category, answer, and value -->
		<h1>Entity: Card</h1>
		<p><strong>Attribute: </strong> cardId(Primary Key) BINARY(16) NOT NULL</p>
		<p><strong>Attribute: </strong> cardCategoryId (Foreign Key)BINARY(16) NOT NULL</p><!--only 1 category per card-->
		<p><strong>Attribute: </strong> cardAnswer  VARCHAR(500)</p>
		<p><strong>Attribute: </strong> cardPoints INTEGER</p>
		<p><strong>Attribute: </strong> cardQuestion VARCHAR(500)</p>


		<!-- Created game board filled with questions and values -->
		<h1>Entity: Board</h1>
		<p><strong>Attribute: </strong> boardId(Primary Key) BINARY(16) NOT NULL</p>
		<p><strong>Attribute: </strong> boardProfileId (Foreign Key)BINARY(16) NOT NULL</p><!--this is the proctor who created the game-->
		<p><strong>Attribute: </strong> boardName VARCHAR(50)</p><!--or boardSubject-->


		<!-- Created ledger (weak entity) -->
		<h1>Entity: Ledger</h1>
		<p><strong>Attribute: </strong> ledgerBoardID (Foreign Key)BINARY(16) NOT NULL</p>
		<p><strong>Attribute: </strong> ledgerProfileId (student)(Foreign Key)BINARY(16) NOT NULL</p>
		<p><strong>Attribute: </strong> ledgerCardId (Foreign Key)</p>

		<!--<p><strong>Attribute: </strong> ledgerCorrect(yes/no)</p>-->

		<p><strong>Attribute: </strong> ledgerType</p>
		<p><strong>Attribute: </strong> ledgerWager</p>



</html>