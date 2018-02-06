<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Student Persona 2</title>
	</head>
	<body>
			<h1>Persona 2</h1>

			<h3>Miguel</h3>
		<p>Miguel is a 38 year old who has decided to make a complete career change. After the opportunity to attend an 10 week excelerated full stack bootcamp presented itself miguels family encouraged him to take advantage of the chance. He is very unsure of his abilities and ability to complete the course but is determined to make a better life for himself.    </p>
		<br>
		<p>Miguel does not consider himself a "techy". His only computer experience is as a passive user for browsing the internet , his only computer is a 6 year old hp laptop that he just recently upgraded to Windows 10. In anticipation of attending the course Miguel invested in a used 4 year old MacBook Pro after quickly realizing during pre-work that not only was he moving slowly so was his laptop.</p>
		<br>
		<p>Miguel uses the computer in a very limited capacity to shop online and visit social media site. Miguel uses a hunt and peck style user that has no working knowledge of the command line or its existence.He is very cautious in every keystroke and constantly has to use Google to learn new computer commands. Miguel is very timid because of his lack of computer knowledge and needs extra instruction for tasks.</p>
		<br>
		<p>Miguel has to read and comprehend the instructions before attempting tasks and will often not attempt a task without clear direction. He is very hard working and very determined although not very technically saavy.He is hoping that his determination and work ethic will help him be a successful in this daunting task of learning to code</p>

			<h3>User Story</h3>
		<p>Miguel is a novice computer user, he owns a 4 year old MacBook Pro but does own an IPhone 7Plus.He has little to no experience with command line and is a basic Google search user.He is attending a 10 week coding bootcamp with very little computer skills but has lots of determination and desire to become a great programmer </p>
			<h3>Use Case</h3>
		<p>Miguel participates in game of Q-review</p>
			<h3>Preconditions</h3>
		<p>Miguel is a student enrolled in CNM's Deep Dive Coding Boot-camp and has a CNM Username and Password.</p>
			<h3>Post-conditions</h3>
		<p>Miguel participated in the game of Q-Review but did not actually get any answers correct ,however he attempted several questions by being first player to "click" in</p>

			<h3>Interaction Flow</h3>
		<ul>
			<li>Miguel clicks the link shared by the Instructor on Slack</li>
			<li>The server then presents a Student Login Page</li>
			<li>Miguel then enters his CNM Username and Password and clicks Submit</li>
			<li>The site hashes and salts his Password and checks with the CNM Student Database, returns true, and the Server issues miguel a session ID</li>
			<li>After the first question is read miguel presses his spacebar to attempt to gain control over the question ahead of other students playing</li>
			<li>The server then immediately records which students key-press came first and gives control of that question to that student whos screen then lights up giving control to that student to answer the question.</li>
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
			<li>The server then adjusts Miguel's score and the leader-board if necessary. Because there is only one question left the server also displays "Final Wager</li>
			<li>All of the students enter an amount of points they wish to wager for "final-wager", no more than the amount of points they have on leader-board. (miguel - very few points)</li>
			<li>The server records all of the submissions and allows the Instructor to see the Final Wager Question. And unfreezes the text box</li>
			<li>The students then enter their submissions in text area</li>
			<li>The server generates a list of students and their responses</li>
			<li>The instructor goes down the list and checks "correct" or "incorrect" for each of the answers</li>
			<li>For each selection the server immediately adds, or subtracts the wagered value to/from the student's accumulated points and adjusts the leader-board if necessary</li>
			<li>THe instructor then inputs the top score to a running leader-board that keeps the high score for future reference</li>
		</ul>
	</body>
</html>