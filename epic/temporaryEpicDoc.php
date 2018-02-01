<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />

		<link rel="stylesheet" href="../css/epicCss/epicStyle.css">
	</head>
	<body>


<!----------------------------------------------------------------------------------------------------------------------


----------------------------------------------------------------------------------------------------------------------->
		<section>

			<div class="section header">
				<h1>Executive Summary</h1>
			</div>

			<h3>What is Q-Review</h3>

			<p>Q-Review is a game-show style, question and answer, subject-matter review website that allows an instructor to input custom flash-cards to create a deck for Q-Review to generate fun interactive review sessions based on parameters set by the instructor.</p>

			<h3>Building a New Deck</h3>

			<p>Each “deck” can generate an infinite number of new review sessions, though their variability will be determined by the number of cards available. Each unique deck will be entered by the instructor themselves, who will have the ability to write in the question, suitable answers, a difficulty rating on a scale of 0-10, and a category tag.</p>

			<h3>Creating a New Review Session (Game)</h3>

			<p>Once a deck is built, the instructor can build a review session (game) by building the board. Each board will be composed of categories along the top, and questions of increasing difficulty cascading down for each. The instructor will input how many columns and rows they want for each of these sessions. For the columns, the instructor cannot have more than the number of different categories in the deck, or 7, whichever is less. For the number of rows, or questions per category, again they cannot have more than the number of unique difficulty values they have assigned in this deck, or 10, whichever is less. Categories will be assigned alphabetically left to right, and custom category titles may then be added for the game. Questions will populate accordingly with the easiest being at the top, and most-difficult at the bottom. The instructor will then be able to input a point-value that corresponds to each row.</p>

			<h3>Review Session (Game)</h3>

			<p>Once the review session is created, the instructor can allow students to join the game. Multiple students can login simultaneously to any review session hosted by the instructor. The instructor will then select a student to lead the game, or if a game has already been played with this group of students, the winner of the previous game will have control of the board and be able to pick the question by category and point-value. Every student will have the ability to buzz-in by pressing the space-bar on their keyboard, but only the fastest will be recorded and allowed to answer the question. The instructor will be able to select whether the student got the question correct or incorrect and then the game will update the student's points accordingly. If the student answers correctly, they will retain control of the board. If the student answers incorrectly and the instructor makes that selection, the game will allow for another round of buzz-ins for a second student to answer the question. This will continue until all of the card have been revealed and answered.</p>

			<h3>Special cases</h3>

			<h4>The Double-or-Nothing Question</h4>

			<p>One card out of every game will be randomly selected to be a double-or-nothing question. There will be no buzz-ins for this question, the student who had control of the board will be allowed to try and answer the question. If they are correct, they will double their points, if they are incorrect the point-value of the card will be deducted from their points. If they are incorrect, the game will allow other students to “steal” the points by buzzing-in and answering correctly, though after, the student who originally chose the double-or-nothing will retain control of the board and pick a new topic and difficulty.</p>

			<h4>The Final Wager</h4>

			<p>At the conclusion of every game, there is one final question that every student must answer. They will first have to enter and save a wager that is either equal to or less than their current score, or the highest value of the board that day, whichever is greater (though they risk losing that many points if they get it wrong, even going into negative values). After the wagers are set, the question will be read and students will input their answers into a textbox and submit them. The teacher will be able to review the answers as they come in, but the scoreboard will not update until all answers have been submitted.</p>

			<p>At the conclusion of the game, the student with the highest number of points will be declared the winner, and in the subsequent game, will begin with control of the board.</p>

			<h3>Ending a Review Session</h3>

			<p>Each game is automagically saved during gameplay and, in the case of an accidental closing of the session, can be recovered. Therefore, at the conclusion of the game, the students and instructor can simply log out of the session. Upon returning to that Deck, the instructor can select Create New Review Session to generate a new board and start a fresh game based on the most up-to-date information from the last game, or the instructor could select Resume an Old Review Session, and open up a previous or unfinished session.</p>

		</section>

		<hr>
<!----------------------------------------------------------------------------------------------------------------------


----------------------------------------------------------------------------------------------------------------------->
		<section>

			<div class="section header">
				<h2>Persona, Use Cases, and Interaction Flow for DeepDive Proctor:</h2>
			</div>

			<div class="persona">
					<h3>Instructor Persona</h3>
					<ul>
						<li><strong>Name</strong>: DeepDiveDylan</li>
						<li><strong>Personality</strong>: Enthusiastic, energetic, brilliant, generous, kind to his students and co-workers. Loves his job, willing to "go there" to investigate any question his students ask.</li>
						<li><strong>Gender</strong>: Male</li>
						<li><strong>Age</strong>: 35</li>
						<li><strong>Technology</strong>: mac, pc, linux...but happiest on mac
							<ul>
								<li><strong>Device </strong> Newest Macbook Pro xxwith Touch Bar..The 15-inch MacBook Pro features a powerful Radeon Pro discrete GPU in every configuration. Manufactured with a 14 nm process, Radeon Pro graphics combine outstanding power with outstanding power efficiency. And now 4GB of GDDR5 memory comes standard on the top configuration, giving you fluid, real-time performance for pro tasks like rendering 3D titles in Final Cut Pro X. Every 13-inch model features powerful integrated graphics with 64MB of embedded DRAM, which accelerates graphics tasks. That means more time for what matters most — creating amazing work (and mining Ethereum)</li>
								<li><strong>Browser: </strong>DuckDuckGo....despite living life online, he hates to be tracked.</li>
								<li><strong>Proficiency: </strong>extreme...Captain</li>
								<li><strong>Love/Hate </strong> Loves, Loves, LOVES!  Checks Slack continuously. Keeps track of Ethereum shares.</li>
							</ul>
						</li>
						<li><strong>Attitudes and Needs</strong>
							<ul>
								<li><strong>What need does this person have?</strong> He needs a Jeopardy-like game for his Full Stack Bootcamp Coding students to play.</li>

								<li><strong>Why choose your site over other options?</strong> Q-Review (this Jeopardy-like game) is built specifically to his specifications, and allows him to add questions on the fly. </li>
							</ul>
						</li>
					</ul>
			</div>

			<div class="user story">
					<h3>User Story</h3>
					<p>As the proctor, I would like to host a game.</p>
			</div>

			<div class="use case">
					<h3>Use Case</h3>
					<ul>
						<li><strong>Title: </strong>Proctoring a round of game-play</li>
						<li><strong>User and Role: </strong>DeepDiveDylan, Captain/Proctor of game</li>
						<li><strong>Pre-conditions: </strong>DeepDiveDylan must be signed into Q-review using his previously registered account.</li>
						<li><strong>Post-conditions: </strong>DeepDiveDylan has successfully set up a game, proctored it, has the scores of his players/students, and knows who the winner is.</li>
						<li><strong>Frequency of Use: </strong>at least once-per-week</li>
					</ul>
			</div>

			<div class="interaction flow">
					<h3>Interaction Flow</h3>
					<!--Enter each after the </strong> and before the </li>-->
					<p><strong>Assumption: </strong>User has previously created an account and is registered as a Proctor.</p>
					<ul>
						<li><strong>System: </strong> Q-review prompts login using username and password</li>
						<li><strong>User: </strong> DeepDiveDylan enters his username and password.</li>
						<li><strong>System: </strong> Q-review logs him in and gives him proctor permissions.</li>
						<li><strong>User: </strong>DeepDiveDylan chooses to set up a game, and clicks the 'Create New Game' button</li>
						<li><strong>System: </strong>Q-Review opens the set up game screen.</li>
						<li><strong>User: </strong>DeepDiveDylan selects the option to use pre created questions for the game.</li>
						<li><strong>System: </strong>Prompts proctor to select the number number of categories and questions per subject.</li>
						<li><strong>User: </strong>DeepDiveDylan chooses to make a game using 5 categories and 4 questions per category.</li>
						<li><strong>System: </strong>Prompts proctor to select 5 unique predefined categories</li>
						<li><strong>User: </strong>DeepDiveDylan selects: CSS, HTML, JavaScript, MySQL, and Fired Employees</li>
						<li><strong>System: </strong>Prompts proctor to select difficulty of questions</li>
						<li><strong>User: </strong>DeepDiveDylan selects "Moderate" (its only week[2] after all...)</li>
						<li><strong>System: </strong>Q-review auto populates a game board of 5 categories of 4 questions each. Ready to play.</li>
					</ul>
				</div>


			<div class="persona">
					<h3>Instructor Persona</h3>
					<ul>
						<li><strong>Name</strong>: Janet Fredrickson</li>
						<li><strong>Personality</strong>: Quiet and down-to-earth. Holds her students in high regards and holds them to high expectations. Kind but professionally demanding.</li>
						<li><strong>Gender</strong>: Female</li>
						<li><strong>Age</strong>: 42</li>
						<li><strong>Technology</strong>: Solely a PC user
							<ul>
								<li><strong>Device: </strong>Two year old Acer laptop with external keyboard and wireless mouse.</li>
								<li><strong>Browser: </strong>Google Chrome</li>
								<li><strong>Proficiency: </strong>Day to day user with average knowledge of the machine and it's applications.</li>
								<li><strong>Love/Hate </strong>Loves to teach via digital media, however she hates her options to do so.</li>
							</ul>
						</li>
						<li><strong>Attitudes and Needs</strong>
							<ul>
								<li><strong>What need does this person have? </strong> Janet needs to present her course material to her students in a fun and engaging manner.</li>
								<li><strong>Why choose your site over other options? </strong> Q-Review is designed to make sometimes tedious material more enjoyable for students to learn by presenting the information in a competitive game format. When an individual is enjoying themselves, retention and interest can be enhanced. </li>
							</ul>
						</li>
					</ul>
			</div>

			<div class="user story">
					<h3>User Story</h3>
					<p>As the proctor, I would like to make learning fun.</p>
			</div>

			<div class="use case">
					<h3>Use Case</h3>
					<ul>
						<li><strong>Title: </strong>Teaching material more enjoyably</li>
						<li><strong>User and role: </strong> The proctor Janet Fredrickson</li>
						<li><strong>Pre-conditions: </strong>Janet must be logged into her account and prepared to input her questions for the days Q-review game</li>
						<li><strong>Post-conditions:</strong>Janet ends the game having inspired three students to invest more time into studying Biology</li>
						<li><strong>Frequency of Use: </strong>Once a week as a tool for her students to review</li>
					</ul>
			</div>

			<div class="interaction flow">
					<h3>Interaction Flow:</h3>
					<!--Enter each after the </strong> and before the </li>-->
					<p><strong>Assumption: </strong>User has previously created an account and is registered as a Proctor.</p>
					<ul>
						<li><strong>System: </strong> Q-review prompts login using username and password</li>
						<li><strong>User: </strong> Janet enters her username and password.</li>
						<li><strong>System: </strong> Q-review logs her in and gives her proctor permissions.</li>
						<li><strong>User: </strong>Janet chooses to set up a game, and clicks the 'Create New Game' button</li>
						<li><strong>System: </strong>Q-Review opens the set up game screen.</li>
						<li><strong>User: </strong>Janet selects the option to create new questions for this game.</li>
						<li><strong>System: </strong>Asks for input on number of categories and questions per category</li>
						<li><strong>User: </strong>Janet inputs 4 for categories and 6 for questions and one FINAL question</li>
						<li><strong>System: </strong>Q-review generates a blank table with each cell as a text box.</li>
						<li><strong>User: </strong>Janet inputs her categories and questions</li>
						<li><strong>System: </strong>Asks if user is ready to play</li>
						<li><strong>User: </strong>Janet clicks "Play" button</li>
						<li><strong>System: </strong>"Game Started" message appears on screen</li>
						<li><strong>User: </strong>Janet selects a student by highest test score to start the game</li>
						<li><strong>System: </strong>ALERTS proctor that the "hot key" has been pressed by a specific student</li>
						<li><strong>User: </strong>Janet selects "yes" if question was correct, "no" if not</li>
					</ul>
					<p><em>Repetitious process until all questions have been answered</em></p>
					<ul>
						<li><strong>System: </strong>Prompts proctor, "Would you like to start the Final Question?"</li>
						<li><strong>User: </strong>Janet selects "yes"</li>
						<li><strong>System: </strong>Final Question and a text box open on all "Players" screens then displays answers to proctor</li>
						<li><strong>User: </strong>Janet approves or denies "Players" answers by clicking "yes" or "no" next to each one</li>
						<li><strong>System: </strong>Displays "Game Over" on screen</li>
						<li><strong>User: </strong>Janet logs out</li>
					</ul>
				</div>


			<h2>Student Persona</h2>
			<h3>Kevin - Power User Student</h3>
			<ul>
				<li><strong>Name</strong>: Kevin</li>
				<li><strong>Personality</strong>: </li>
				<li><strong>Gender</strong>: Male</li>
				<li><strong>Age</strong>: 25</li>
				<li><strong>Technology</strong>: mac, pc, but let's be honest...mac
					<ul>
						<li><strong>Device </strong> New Macbook Pro 13-inch</li>
						<li><strong>Browser: </strong>Chrome</li>
						<li><strong>Proficiency: </strong>Intermediate -> Advanced (has played around with the Dev Tools)</li>
						<li><strong>Love/Hate: </strong>Reddit/Facebook (even though they check it constantly)</li>
					</ul>
				</li>
				<li><strong>Attitudes and Needs</strong>
					<ul>
						<li><strong>What need does this person have?</strong> Kevin needs </li>

						<li><strong>Why choose your site over other options?</strong> Q-Review offers  </li>
					</ul>
				</li>
			</ul>
			</div>

			<div class="user story"></div>
			<h3>User Story</h3>
			<p>As a student, power-user, I want to dominate (win) today's review session.</p>
			</div>

			<div class="use case">
				<h3>Use Case</h3>
				<ul>
					<li><strong>Title: </strong>Kevin wins today's game of Q-Review.</li>
					<li><strong>Name of the "actor, user or Persona, and their role: </strong> Kevin, One of the  students playing the game</li>
					<li><strong>Pre-conditions: </strong>Kevin is logged into Q-Review and in their instructors game.</li>
					<li><strong>Post-conditions: </strong>Kevin has won the game of Q-Review by stealing control from the previous winner, and sweeping the board, doubling his score twice through the Double or Nothing question and the Final Wager.</li>
					<li><strong>Frequency of Use: </strong>at least once-per-week</li>
				</ul>
			</div>

			<div class="interaction flow">
				<h3>Interaction Flow</h3>
				<ol>
					<li><strong>User: </strong>After the first question is read Kevin quickly presses his spacebar</li>
					<li><strong>System: </strong>The Server instantaneously records this key-press as the first press and freezes the game, lights up Kevin's screen and highlights his name on the Leaderboard</li>
					<li><strong>User: </strong>Kevin answers the question correctly, in the form of a question, and the instructor checks "correct"</li>
					<li><strong>System: </strong>The server then removes the question being played, and adds the point-value assigned to the question to Kevin's score and moves his name to the top of the Leaderboard</li>
					<li><strong>User: </strong>Kevin then clicks another tile, still in play</li>
					<li><strong>System: </strong>The Server displays the question to the instructor and unfreezes the game</li>
					<li><strong>User: </strong>Kevin repeats steps 7-10 until the only one question remains. Kevin selects the tile, which happens to be the Double or Nothing Question</li>
					<li><strong>System: </strong>The Server flashes Kevin's screen multiple times and makes a really obnoxious sound.</li>
					<li><strong>User: </strong>The question is read and a timer is started</li>
					<li><strong>System: </strong>The server displays the question to Kevin and the rest of the class and a text-box becomes active on Kevin's screen</li>
					<li><strong>User: </strong>Kevin submits his answer</li>
					<li><strong>System: </strong>The server displays Kevin's answer on the instructors screen</li>
					<li><strong>User: </strong>The instructor checks "correct"</li>
					<<li><strong>System: </strong>The server flashes Kevin's screen multiple times and multiplies his current score by two and adjusts the leaderboard if necessary. Because it was the last question, the server also displays Final Wager</li>
					<li><strong>User: </strong>All of the students enter an amount of points they wish to wager, no more than the amount of points they have won this game (Kevin - ALL THE POINTS, Other Students - no points...) Kevin is ALL IN</li>
					<li><strong>System: </strong>The server records all of the submissions and allows the Instructor to see the Final Wager Question. And unfreezes the text box</li>
					<li><strong>User: </strong>The class submit their answers even though they all were only able to wager nothing. Kevin submits his answer.</li>
					<li><strong>System: </strong>The server generates a list of students and their responses</li>
					<li><strong>User: </strong>The instructor goes down the list and checks "correct" or "incorrect" for each of the answers</li>
					<li><strong>System: </strong>For each selection the server immediately add, or subtracts the wagered value to/from the student's accumulated points and adjusts the leaderboard if necessary</li>
				</ol>
			</div>


			<div class="persona">
				<h2>Student Persona: Miguel</h2>

				<h3>Miguel</h3>
				<p>miguel is a 38 year old who has decided to make a complete career change. After the opportunity to attend an 10 week excelerated full stack bootcamp presented itself miguels family encouraged him to take advantage of the chance. He is very unsure of his abilities and ability to complete the course but is determined to make a better life for himself.    </p>
				<br>
				<p>Miguel does not consider himself a "techy". His only computer experience is as a passive user for browsing the internet , his only computer is a 6 year old hp laptop that he just recently upgraded to Windows 10. In anticipation of attending the course Miguel invested in a used 4 year old MacBook Pro after quickly realizing during pre-work that not only was he moving slowly so was his laptop.</p>
				<br>
				<p>Miguel uses the computer in a very limited capacity to shop online and visit social media site. Miguel uses a hunt and peck style user that has no working knowledge of the command line or its existence.He is very cautious in every keystroke and constantly has to use Google to learn new computer commands. Miguel is very timid because of his lack of computer knowledge and needs extra instuction for tasks.</p>
				<br>
				<p>Miguel has to read and comprehend the instructions before attempting tasks and will often not attempt a task without clear direction. He is very hard working and very determined although not very technically saavy.He is hoping that his determination and work ethic will help him be a successful in this daunting task of learning to code</p>
			</div>

			<div class="user story">
				<h3>User Story</h3>
				<p>Miguel is a novice computer user, he owns a 4 year old MacBook Pro but does own an IPhone 7Plus.He has little to no experience with command line and is a basic Google search user.He is attending a 10 week coding bootcamp with very little computer skills but has lots of determination and desire to become a great programmer </p>
			</div>

			<div class="use case">
				<h3>Use Case</h3>
				<p>Miguel participates in game of Q-review</p>
				<h3>Preconditions</h3>
				<p>Miguel is a student enrolled in CNM's Deep Dive Coding Boot-camp and has a CNM Username and Password.</p>
				<h3>Postconditions</h3>
				<p>Miguel participated in the game of Q-Review but did not actually get any answers correct ,however he attempted several questions by being first player to "click" in</p>
			</div>

			<div class="interaction flow">
				<h3>Interaction Flow</h3>
				<ol>
					<li>Miguel clicks the link shared by the Instructor on Slack</li>
					<li>The server then presents a Student Login Page</li>
					<li>Miguel then enters his CNM Username and Password and clicks Submit</li>
					<li>The site hashes and salts his Password and checks with the CNM Student Database, returns true, and the Server issues miguel a session ID</li>
					<li>After the first question is read miguel presses his spacebar to attempt to gain control over the question ahead of other students playing</li>
					<li>The server then immediately records which students keypress came first and gives control of that question to that student whos screen then lights up giving control to that student to answer the question.</li>
					<li>Student then answers the question correctly, in the form of a question, and the instructor checks "correct"</li>
					<li>The server then removes the question being played, and adds the point-value assigned to the question to that students score being shown on leader-board</li>
					<li>That student then clicks another tile, still in play</li>
					<li>The Server displays the question to the instructor and unfreezes the game</li>
					<li>Miguel repeats steps 7-10 until the only one question remains. Miguel selects the tile, which happens to be the "Double or Nothing" Question</li>
					<li>Miguel is prompted by Instructor to wager up to his total score on "leader" board.</li>
					<li>The question is then read and a timer is started for him to answer question</li>
					<li>The server displays the question the class and a text-box becomes active on miguels screen</li>
					<li>Miguel then submits his answer to the question and clicks submit</li>
					<li>The Instructor then verifies his answer to be correct or not and then selects the correct or incorrect button at that time</li>
					<li>The server then adjusts Miguels score and the leader-board if necessary. Because there is only one question left the server also displays "Final Wager</li>
					<li>All of the students enter an amount of points they wish to wager for "final-wager", no more than the amount of points they have on leader-board. (miguel - very few points)</li>
					<li>The server records all of the submissions and allows the Instructor to see the Final Wager Question. And unfreezes the text box</li>
					<li>The students then enter their submissions in text area</li>
					<li>The server generates a list of students and their responses</li>
					<li>The instructor goes down the list and checks "correct" or "incorrect" for each of the answers</li>
					<li>For each selection the server immediately adds, or subtracts the wagered value to/from the student's accumulated points and adjusts the leaderboard if necessary</li>
					<li>THe instructor then inputs the top score to a running leaderboard that keeps the high score for future reference</li>
				</ol>
			</div>
		</section>

		<hr>
<!----------------------------------------------------------------------------------------------------------------------


----------------------------------------------------------------------------------------------------------------------->
		<section>

			<div class="section header">
				<h2>Conceptual Model</h2>
			</div>

			<<!-- Profile authentication information to match when checked against active directory -->
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
		</section>

		<hr>
<!----------------------------------------------------------------------------------------------------------------------


----------------------------------------------------------------------------------------------------------------------->
		<section>

			<div clas="section header">
				<h2>Software Goals</h2>
			</div>

			<div>
				<h3>Goals for Q-Review</h3>
				<p>Easy to use interface for creating a new Deck and submitting new Cards.</p>

				<p>System for categorizing cards based on a subject matter tag or category, as well as a difficulty rating on a sliding-scale.</p>

				<p>Ability to effortlessly generate new Review Sessions with custom category titles and point values for questions.</p>

				<p>Ability for multiple students up to ______ to simultaneously join a session hosted by a single instructor.</p>

				<p>Ability for live game-play and buzz-ins with the spacebar.</p>

				<p>Ability for live scoreboard.</p>

				<p>Ability to reveal question and answer discretely only to the instructor.</p>

				<p>Ability for students to enter wagers.</p>

				<p>Ability for students to enter typed responses to select questions.</p>

				<p>Ability to save games.</p>

				<p>Ability to steal questions.</p>

				<p>Future goals -</p>

				<p>Allow for a Deck to be shared and used like individual flashcards for studying.</p>

			</div>

	</body>
</html>