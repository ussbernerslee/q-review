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

			<p>In order to create a review session, the instructor will have to create multiple categories and cards. The initial release of Q-Review, will require a MINIMUM of 4 categories, though more can be added. Once the categories are entered, the instructor can begin to add cards. In order to make cards the instructor will be required to select one category tag, enter a question and answer, and select a difficulty “rating” - the difficulty rating simply serves to compare one card to another and serve up an easier or harder question. In the initial release of Q-Review, the instructor will be required to enter a MINIMUM of 5 cards per category, in order to be able to create a review session. The site can of course hold as many cards as the instructor would like.</p>

			<p>For the initial release of Q-Review, the focus will be on functionality and experience. For this reason, we have decided to remove several complications, by restricting a Review Session to only allow 4 categories, and 5 cards per category. As previously mentioned, any number of sessions can be generated, with different categories, or cards depending on how many have been stored, but in order to create their first review session, an instructor MUST have entered at least 4 categories with 5 cards each.</p>

			<p>Once the instructor chooses the 4 categories for the review session, the categories will be assigned alphabetically left to right. Once the categories are selected, Q-Review will populate the questions by randomly selecting questions with appropriate difficulty ratings sorted by easiest at the top, and most-difficult at the bottom. </p>

			<p>Before the instructor invites their students into the game, they will be able to adjust parameters, like point values for rows, category titles, and which card should be the session’s Double-or-Nothing.</p>

			<h3>A Review Session (Game)</h3>

			<p>Once the review sessions is created, the instructor can allow students to join the game. Multiple students can login simultaneously to any game hosted by the instructor. The instructor will select a student to lead the game, or if a game has already been played with this group of students, the winner of the previous game will have control of the board and be able to pick the topic and difficulty of the question. Every student will have the ability to buzz-in by pressing a “hot-key,”, but only the fastest will be recorded and allowed to answer the question. The instructor will be able to select whether the student got the question correct or not and the the game will update the points accordingly. If the student answers correctly, they will retain control of the board. If the student answers incorrectly the game will again allow for another round of buzz-ins for a second student to answer the question. This will continue until all of the cards have been revealed and answered.</p>

			<h3>Special case:</h3>
			<h4>The Double or Nothing Question</h4>
			<p>One card out of every game will be randomly selected to be a Double or Nothing questions. There will be no buzz-ins for this question, the student who had control of the board will be allowed to try and answer the question. If they are correct, they will double their points, if they are incorrect they will lose the value of the card. Also if they are incorrect, the game will allow other students to “steal” the points by buzzing-in and answering correctly, though, after, the student who originally chose the Double or Nothing will retain control of the board and pick a new topic and difficulty.</p>

			<h3>The Final Wager</h3>

			<p>At the conclusion of every game, there is one questions that every student must answer. They will first have to enter and save a wager that is either equal to or less than their current score, or the highest value of the board that day, whichever is greater (though they risk losing that many points if they get it wrong). After the wagers are set, the question will be read and students will input their answers into a textbox and submit them. The teacher will be able to review the answers as they come in, but the scoreboard will not update until all answers have been submitted. </p>

			<p>At the conclusion of the game, the student with the highest number of points will be declared the winner, and in the subsequent game, will begin with control of the board. </p>

			<p>All review sessions will be archived so that an instructor may re-use previous sessions, or review how their students performed. </p>

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
				<p><strong>Assumption: </strong>User has previously created an account and is registered as a Proctor.</p>
				<ul>
					<li><strong>System: </strong> Q-review prompts login using username and password</li>
					<li><strong>User: </strong> DeepDiveDylan enters his username and password.</li>
					<li><strong>System: </strong> Q-review logs him in and gives him proctor permissions.</li>
					<li><strong>User: </strong>DeepDiveDylan chooses to set up a game, and clicks the 'Create New Game' button</li>
					<li><strong>System: </strong>Q-Review opens the set up game screen.</li>
					<li><strong>User: </strong>DeepDiveDylan selects the option to use pre created questions for the game.</li>
					<li><strong>System: </strong>Prompts proctor to select 4 unique predefined categories</li>
					<li><strong>User: </strong>DeepDiveDylan selects: CSS, HTML, JavaScript, MySQL, and Fired Employees</li>
					<li><strong>System: </strong>Prompts proctor to select difficulty of questions</li>
					<li><strong>User: </strong>DeepDiveDylan selects "Moderate" (its only week[2] after all...)</li>
					<li><strong>System: </strong>Q-review auto populates a game board of 4 categories of 5 questions each. Ready to play.</li>
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
					<li><strong>System: </strong>Final Question and a text box open on all "Players" screens then display answers to proctor</li>
					<li><strong>User: </strong>Janet approves or denies "Players" answers by clicking "yes" or "no" next to each one</li>
					<li><strong>System: </strong>Displays "Game Over" on screen</li>
					<li><strong>User: </strong>Janet logs out</li>
				</ul>
				</div>

			<div>
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

			<div class="user story">
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

		</section>

		<hr>
<!----------------------------------------------------------------------------------------------------------------------


----------------------------------------------------------------------------------------------------------------------->
		<section>

			<div class="section header">
				<h2>Software Goals</h2>
			</div>

			<div>
				<h3>Goals for Q-Review</h3>
				<p>Profile Creation with User Role Privileges </p>

				<p>User Role, Capitan: Create new categories</p>

				<p>User Role, Capitan: Create new cards with category, questions, answer, and difficulty attributes.</p>

				<p>User Role, Capitan: Create new Review Sessions with 4 categories and 5 cards each</p>

				<p>User Role, Captain: Host Review Sessions with multiple students </p>

				<p>User Role, Captain: View Questions and Answers for selected cards</p>

				<p>User Role, Captain: Input whether student answers are “correct” or “incorrect”</p>

				<p>User Role, Captain: See all student scores in real-time</p>

				<p>User Role, Captain: Archive Review Sessions</p>

				<p>User Role, Captain: Update Question and Answer</p>

				<p>User Role, Student: Join Review Session</p>

				<p>User Role, Student: Select category and point value that they wish to try and answer</p>

				<p>User Role, Student: See selected question</p>

				<p>User Role, Student: See scores in real-time</p>

				<p>User Role, Student: Make wager for Final Wager Question</p>

				<p>User Role, Student: Enter text response for Final Wager Question</p>

			</div>
		</section>
	</body>
</html>