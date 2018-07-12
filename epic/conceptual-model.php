<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Conceptual Model</title>
	</head>
	<body>
		<p>users</p>
		<ul>
			<li>userId (primary key)</li>
			<li>userEmail</li>
			<li>userPassword</li>
		</ul>
		<p>poll</p>
		<ul>
			<li>doYouVotePoll (primary key)</li>
			<li>doYouVoteUserId (foreign key)</li>
			<li>doYouWantVote</li>
			<li>doYouHaveVote</li>
			<li>doYouHadVote</li>
		</ul>
		<p>Vote</p>
		<ul>
			<li>countUserId (foreign key)</li>
			<li>countDoYouVotePoll (foreign key)</li>
		</ul>
		<p>Relations</p>
		<ul>
			<li>One poll can have many users (1 to n)</li>
			<li>Many users can have many votes (m to n)</li>
		</ul>
		<nav>
			<a href="index.php">Index</a>
		</nav>
	</body>
</html>