<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8"/>
		<title>Proctor Persona</title>

	</head>
	<body>
		<div>
			<h2>Persona, Use Cases, and Interaction Flow for DeepDive Proctor:</h2>
			<h3>Persona:</h3>
			<ul>
				<li><strong>Name</strong>: DeepDiveDylan</li>
				<li><strong>Personality</strong>: Enthusiastic, energetic, brilliant, generous, kind to his students and
					co-workers. Loves his job, willing to "go there" to investigate any question his students ask.
				</li>
				<li><strong>Gender</strong>: Male</li>
				<li><strong>Age</strong>: 35</li>
				<li><strong>Technology</strong>: mac, pc, linux...but happiest on mac
					<ul>
						<li><strong>Device </strong> Newest Macbook Pro xxwith Touch Bar..The 15-inch MacBook Pro features a
							powerful Radeon Pro discrete GPU in every configuration. Manufactured with a 14 nm process, Radeon
							Pro graphics combine outstanding power with outstanding power efficiency. And now 4GB of GDDR5
							memory comes standard on the top configuration, giving you fluid, real-time performance for pro
							tasks like rendering 3D titles in Final Cut Pro X. Every 13-inch model features powerful integrated
							graphics with 64MB of embedded DRAM, which accelerates graphics tasks. That means more time for
							what matters most — creating amazing work (and mining Ethereum)
						</li>
						<li><strong>Browser: </strong>DuckDuckGo....despite living life online, he hates to be tracked.</li>
						<li><strong>Proficiency: </strong>extreme...Captain</li>
						<li><strong>Love/Hate </strong> Loves, Loves, LOVES! Checks Slack continuously. Keeps track of
							Ethereum shares.
						</li>
					</ul>
				</li>
				<li><strong>Attitudes and Needs</strong>
					<ul>
						<li><strong>What need does this person have?</strong> He needs a Jeopardy-like game for his Full Stack
							Bootcamp Coding students to play.
						</li>

						<li><strong>Why choose your site over other options?</strong> Q-Review (this Jeopardy-like game) is
							built specifically to his specifications, and allows him to add questions on the fly.
						</li>
					</ul>
				</li>
			</ul>

			<h3>User Story</h3>
			<p>As the proctor, I would like to host a game.</p>


			<h3>Use Case</h3>
			<ul>
				<li><strong>Title: </strong>Proctoring a round of game-play:</li>
				<li><strong>Name of the "actor, user or Persona, and their role: </strong> DeepDiveDylan, Captain/Proctor of
					game
				</li>
				<li><strong>Pre-conditions: </strong>DeepDiveDylan must be signed into Q-review using his previously
					registered account.
				</li>
				<li><strong>Post-conditions:</strong>DeepDiveDylan has successfully set up a game, proctored it, has the
					scores of his players/students, and knows who the winner is.
				</li>
				<li><strong>Frequency of Use: </strong>at least once-per-week</li>
			</ul>


			<h3>Interaction Flow:</h3>
			<!--Enter each after the </strong> and before the </li>-->
			<p><strong>Assumption: </strong>User has previously created an account and is registered as a Proctor.</p>
			<ul>
				<li><strong>System: </strong> Q-review prompts login using username and password</li>
				<li><strong>User: </strong> DeepDiveDylan enters his username and password.</li>
				<li><strong>System: </strong> Q-review logs him in and gives him proctor permissions.</li>
				<li><strong>User: </strong>DeepDiveDylan chooses to set up a game, and clicks the 'Create New Game' button
				</li>
				<li><strong>System: </strong>Q-Review opens the set up game screen.</li>
				<li><strong>User: </strong>DeepDiveDylan selects the option to use pre created questions for the game.</li>
				<li><strong>System: </strong>Prompts proctor to select 4 unique predefined categories</li>
				<li><strong>User: </strong>DeepDiveDylan selects: CSS, HTML, JavaScript, MySQL, and Fired Employees</li>
				<li><strong>System: </strong>Prompts proctor to select difficulty of questions</li>
				<li><strong>User: </strong>DeepDiveDylan selects "Moderate" (its only week[2] after all...)</li>
				<li><strong>System: </strong>Q-review auto populates a game board of 4 categories of 5 questions each. Ready
					to play.
				</li>
			</ul>
		</div>
		
		<div>
			<h3>Interaction Flow 2:</h3>
			<!--Enter each after the </strong> and before the </li>-->
			<p><strong>Assumption: </strong>User has previously created an account and is registered as a Proctor.</p>
			<ul>
				<li><strong>System: </strong> Q-review prompts login using username and password</li>
				<li><strong>User: </strong> DeepDiveDylan enters his username and password.</li>
				<li><strong>System: </strong> Q-review logs his in and gives his proctor permissions.</li>
				<li><strong>User: </strong>DeepDiveDylan chooses to set up a game, and clicks the 'Create New Game' button</li>
				<li><strong>System: </strong>Q-Review opens the set up game screen.</li>
				<li><strong>User: </strong>DeepDiveDylan selects the option to create new questions for this game.</li>
				<li><strong>System: </strong>Q-review generates a blank table with each cell as a text box.</li>
				<li><strong>User: </strong>DeepDiveDylan inputs his categories and questions</li>
				<li><strong>System: </strong>Asks if user is ready to play</li>
				<li><strong>User: </strong>DeepDiveDylan clicks "Play" button</li>
				<li><strong>System: </strong>"Game Started" message appears on screen</li>
				<li><strong>User: </strong>DeepDiveDylan selects a student by highest test score to start the game</li>
				<li><strong>System: </strong>ALERTS proctor that the "hot key" has been pressed by a specific student</li>
				<li><strong>User: </strong>DeepDiveDylan selects "yes" if question was correct, "no" if not</li>
			</ul>
			<p><em>Repetitious process until all questions have been answered</em></p>
			<ul>
				<li><strong>System: </strong>Prompts proctor, "Would you like to start the Final Question?"</li>
				<li><strong>User: </strong>DeepDiveDylan selects "yes"</li>
				<li><strong>System: </strong>Final Question and a text box open on all "Players" screens then displays
					answers to proctor
				</li>
				<li><strong>User: </strong>DeepDiveDylan approves or denies "Players" answers by clicking "yes" or "no" next to each
					one
				</li>
				<li><strong>System: </strong>Displays "Game Over" on screen</li>
				<li><strong>User: </strong>DeepDiveDylan logs out</li>
			</ul>
		</div>

	</body>
</html>