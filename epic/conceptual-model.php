<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Conceptual Model</title>
		<link rel="stylesheet" type="text/css" href="styles.css">
	</head>
	<body>
		<h1>Conceptual Model</h1>
		<h2>Profile</h2>
		<ul>
			<li>profileId (primary key)</li>
			<li>profileEmail</li>
			<li>profilePassword</li>
		</ul>
		<h2>Vote</h2>
		<ul>
			<li>votePoll (primary key)</li>
			<li>profileMakeVoteId (foreign key)</li>
			<li>wantVote</li>
			<li>haveVote</li>
			<li>hadVote</li>
		</ul>
		<h2>Poll</h2>
		<ul>
			<li>votePollValue (foreign key)</li>
			<li>profileVoteId (foreign key)</li>
			<li>voteCount</li>
		</ul>
		<h2>Relations</h2>
		<ul>
			<li>One profile can make many votes (1 to n)</li>
			<li>Many polls can have many votes (m to n)</li>
		</ul>
		<nav>
			<a href="index.php">Index</a>
		</nav>
	</body>
</html>