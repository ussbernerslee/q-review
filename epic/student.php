<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Student Persona</title>
	</head>
	<body>
		<h1>Persona</h1>
		<h3>Kevin</h3>
		<p>Kevin is an individual in their mid-twenties who has decided to take on an immersive learning experience and tackle the daunting chanllenge of becoming a Full Stack Web Developer. They have chosen to attend a 10-week bootcamp-style class through CNM's Stemulus Center. Kevin was not interested in a traditional classroom and learning experience, finding it difficult to sit through long lectures, and study tangemtially related material in order to satisfy graduating requirements. Fascinated by the web, Kevin sees potential for a broad career, full of interesting projects. The motivation to take the bootcamp at the stemulus center is based on several recommendations through friends and family and an ability to aquire a grant through a local tech grant. Kevin is motivated to give everything to the 10-week course to ensure the greatest return.</p>
		<br>
		<p>Kevin is a longtime technology user. They are familiar with both mac and windows machines, though they gravitate towards macintosh for their sleek designs, and simple, user-friendly, interface. For the bootcamp they were able to secure a brand new 13-inch macbook pro laptop. Already familiar with other mac products, their was no learning curve to the software implementation, and Kevin found the pre-work easy to replicate.</p>
		<br>
		<p>Kevin is an avid user of google, always scouring the web for new facts and information. Kevin likes to try things and iterate fast, discovering through trial-and-error. Kevin is liable to click a button to see what it does, or delete lines of code to see what happens, and is quick to jump into new projects, even before the instructions have been given</p>
		<br>
		<p>Kevin does not like test, nor do they like to get too deep into documentation, without the immediate feedback of practice code or a demonstration. Kevin learns through seeing, and doing.</p>
		<h3>User Story</h3>
		<p>Kevin has just finished a Monday morning snap challenge and would like to log into and play another game of Q-Review, a Jeopardy-esque game where the course instructor allows students to battle for points by answering questions faster than other students. Kevin really enjoys the simple, intuitive, user interface combined with the seamless game-play that suggests a very well thought out site.</p>
		<h3>Use Case</h3>
		<p>Kevin would like to log in and win today's game of Q-Review.</p>
		<h3>Preconditions</h3>
		<p>Kevin is a student enrolled in CNM's Deep Dive Coding Bootcamp and had a CNM Username and Password.</p>
		<h3>Postconditions</h3>
		<p>Kevin has won the game of Q-Review by stealing control from the previous winner, and sweeping the board, doubling his score twice through the Double or Nothing question and the Final Wager.</p>
		<h3>Interaction Flow</h3>
		<ol>
			<li>Kevin clicks the link that the instructor shared on Slack</li>
			<li>The server directs Kevin to a Student Login Page</li>
			<li>Kevin enters his CNM Username and Password and clicks Submit</li>
			<li>The site hashes and salts his Password and checks with the CNM Student Database, returns true, and the Server issues Kevin a session ID</li>
			<li>After the first question is read Kevin quickly presses his spacebar</li>
			<li>The Server instantaneously records this key-press as the first press and freezes the game, lights up Kevin's screen and highlights his name on the Leaderboard</li>
			<li>Kevin answers the question correctly, in the form of a question, and the instructor checks "correct"</li>
			<li>The server then removes the question being played, and adds the point-value assigned to the question to Kevin's score and moves his name to the top of the Leaderboard</li>
			<li>Kevin then clicks another tile, still in play</li>
			<l>The Server displays the question to the instructor and unfreezes the game</l>
			<li>Kevin repeats steps 7-10 until the only one question remains. Kevin selects the tile, which happens to be the Double or Nothing Question</li>
			<li>The Server flashes Kevin's screen multiple times and makes a really obnoxious sound.</li>
			<li>The question is read and a timer is started</li>
			<li>The server displays the question to Kevin and the rest of the class and a text-box becomes active on Kevin's screen</li>
			<li>Kevin submits his answer</li>
			<li>The server displays Kevin's answer on the instructors screen</li>
			<li>The instructor checks "correct"</li>
			<li>The server flashes Kevin's screen multiple times and multiplies his current score by two and adjusts the leaderboard if necessary. Because it was the last question, the server also displays Final Wager</li>
			<li>All of the students enter an amount of points they wish to wager, no more than the amount of points they have won this game (Kevin - ALL THE POINTS, Other Students - no points...) Kevin is ALL IN</li>
			<li>The server records all of the submissions and allows the Instructor to see the Final Wager Question. And unfreezes the text box</li>
			<li>The class submit their answers even though they all were only able to wager nothing. Kevin submits his answer.</li>
			<li>The server generates a list of students and their responses</li>
			<li>The instructor goes down the list and checks "correct" or "incorrect" for each of the answers</li>
			<li>For each selection the server immediately add, or subtracts the wagered value to/from the student's accumulated points and adjusts the leaderboard if necessary</li>
		</ol>
	</body>
</html>