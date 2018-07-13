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
			<li>profileHash</li>
		</ul>
		<h2>Vote</h2>
		<ul>
			<li>voteProfileId (foreign key)</li>
			<li>votePhoneSpecs (foreign key)</li>
			<li>voteType</li>
		</ul>
		<h2>Phone</h2>
		<ul>
			<li>phoneSpecs (primary key)</li>
			<li>phoneBrand</li>
			<li>phoneModel</li>
			<li>phoneCamera</li>
			<li>phoneScreen</li>
			<li>phoneProcessor</li>
			<li>phoneRam</li>
			<li>phoneMemory</li>
			<li>phoneBattery</li>
		</ul>
		<h2>Relations</h2>
		<ul>
			<li>Many phones can have many votes (m to n)</li>
			<li>Many profiles can make many votes (m to n)</li>
		</ul>
		<nav>
			<a href="index.php">Index</a>
		</nav>
	</body>
</html>