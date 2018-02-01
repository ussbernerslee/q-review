<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Ken's Conceptual Model-Edited AK 1/31/2018 21:31</title>
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
		<h3>Attribute: categoryTag VARCHAR(15)</h3><!--this is the name of the category-->


		<!-- Question card containing question in specific category, answer, and value -->
		<h1>Entity: Card</h1>
		<h3>Attribute: cardId(Primary Key) BINARY(16) NOT NULL</h3>
		<h3>Attribute: cardCategoryId (Foreign Key)BINARY(16) NOT NULL</h3><!--this works if there is only 1 category per card-->
		<h3>Attribute: cardAnswerVARCHAR(500)</h3>
		<h3>Attribute: cardDifficulty INTEGER (1)1:beginner, 2:intermediate, 3:advanced(?)</h3><!--for Minimum Viable Product, we COULD assign the value of the card here so we don't have to have another weak entity called pointsBoard, however there are many errors that can be associated with doing it this way, rather than using an additional table. The main problem is that if the person who sets up their cards messes up the point system, the columns could have differing point values in matching rows. -->
		<h3>Attribute: cardQuestion VARCHAR(500)</h3>
		<h3>Attribute: cardValue CHAR(1)</h3><!--ask bridge: assign fixed number of points vs assign a letter A,B,C,D (or something like this)corresponding to comparative ease of question(A=Easiest, D=Hardest)Then when the proctor sets up the game, she/he sets what values they want for each box, and the cards fill the appropriate box in game board-->


		<!-- Created game board filled with questions and values -->
		<h1>Entity: Board</h1>
		<h3>Attribute: boardId(Primary Key) BINARY(16) NOT NULL</h3>
		<h3>Attribute: boardProfileId (Foreign Key)BINARY(16) NOT NULL</h3><!--this is the proctor who created the game-->
		<h3>Attribute: boardName VARCHAR(50)</h3><!--or boardSubject-->


		<!-- Created score ledger  -->
		<h1>Entity: Score</h1>
		<h3>Attribute: scoreID (NOT a composite key)(Primary Key)</h3><!--ask bridge about this...can it be a simple unique index or does it need to be UUID?-->
		<h3>Attribute: scoreBoardID (Foreign Key)BINARY(16) NOT NULL</h3>
		<h3>Attribute: scoreProfileId (Foreign Key)BINARY(16) NOT NULL</h3>
		<h3>Attribute: scoreCorrect(is this an INTEGER or CHAR? it should be a yes/no)</h3><!--The way we set this should depend on how we intend to calculate the score-->
		<h3>Attribute: scoreDoubleOrNothing (is this an INTEGER or CHAR? it should be a yes/no)</h3>
		<h3>Attribute: scoreFinalWager INTEGER of some type</h3>
		<h3>Attribute: scorePoints INTEGER of some type</h3>


		<!-- Created weak entity linking Board to Category (needed because there are more than 1 category/column(and a variable number of columns) to each board to indicate which categories make up the columns of the game board to be populated from cards of the same category)-->
		<h1>Entity: boardCategory</h1>
		<h3>Attribute: boardCategoryId (CompositePrimaryKey)BINARY(16) NOT NULL</h3>
		<h3>Attribute: boardCategoryBoardId(Foreign Key) BINARY(16) NOT NULL</h3>
		<h3>Attribute: boardCategoryCategoryId (Foreign Key)BINARY(16) NOT NULL</h3>
		<h3>Attribute: boardCategoryColumn INTEGER(1)</h3><!--this assigns the category to a specific column in the board and doesn't need to be more than a single digit-->


		<!-- Created weak entity assigning points scheme to specific rows for a specific Board(needed because there are more than 1 rows per board(and a variable number of points set by proctor for each of these)-->
		<h1>Entity: pointsBoard</h1>
		<h3>Attribute: pointsBoardId (PrimaryKey) BINARY(16) NOT NULL</h3><!--this CAN be a composite primary key using the foreign key: "pointsBoardBoardId" + "pointsBoardRowNumber"-->
		<h3>Attribute: pointsBoardBoardId (Foreign Key) BINARY(16) NOT NULL</h3><!--there are going to need to be -->
		<h3>Attribute: pointsBoardRowNumber</h3>
		<h3>Attribute: pointsBoardValue</h3>









		<!--*************Stuff for Extension beyone minimum viable product****************-->

		<!-- Created weak entity linking Cards to Category if we want to assign more than one category per card-->
		<h1>Entity: cardCategory</h1>
		<h3>Attribute: cardCategoryId (CompositePrimaryKey)BINARY(16) NOT NULL</h3>
		<h3>Attribute: cardCategoryCardId(Foreign Key) BINARY(16) NOT NULL</h3>
		<h3>Attribute: cardCategoryCategoryId (Foreign Key)BINARY(16) NOT NULL</h3>
		<h3>Attribute: </h3>
		<h3>Attribute: </h3>
		<h3>Attribute: </h3>
		<h3>Attribute: </h3>
		<h3>Attribute: </h3>
		<h3>Attribute: </h3>



</html>