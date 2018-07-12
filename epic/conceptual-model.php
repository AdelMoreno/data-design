<?php
/**
 * Created by PhpStorm.
 * User: adels
 * Date: 7/11/2018
 * Time: 4:40 PM
 */?>

<html>
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
		<p>Poll Results</p>
		<ul>
			<li>countUserId (foreign key)</li>
			<li>countDoYouVotePoll (foreign key)</li>
		</ul>
		<p>Relations</p>
		<ul>
			<li>One poll can have many results (1 to n)</li>
			<li>Many users can vote on many polls (m to n)</li>
		</ul>
		<nav>
			<a href="index.php">Index</a>
		</nav>
	</body>
</html>