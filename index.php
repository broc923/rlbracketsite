<?php
	include("connectDB.php");
	$stmt = $conn->prepare("SELECT * FROM matchups");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Fauna+One' rel='stylesheet' type='text/css'>		
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css" />		
    <title>Rocket League Brackets</title>
</head>
<body>
	<nav class="wrapper">
		<div class="holder">
			<ul class="ps-menu">
				<li><a class="icon-exchange icon-2x selected" href="#bracket" id="navBracket" onclick="return scrollto('bracket')">Brackets</a></li>
				<li><a class="icon-briefcase icon-2x" href="#inventory" id="navInventory" onclick="return scrollto('inventory')">My Inventory</a></li>
				<li><a class="icon-question icon-2x" href="#about" id="navAbout" onclick="return scrollto('about')">About</a></li>
				<li><a class="icon-comments icon-2x" href="#contact" id="navContact" onclick="return scrollto('contact')">Contact Us</a></li>
			</ul>
		</div>
	</nav>
	<section id="bracket">
		<div class="scrollBar">
		<!-- bracketHolder ID will reference to match ID in the DB -->
			<?php
				foreach ($result as $matchup) {
					$now = new DateTime();
					$eventTime = date_create_from_format('Y-m-d H:i:s', $matchup["startTime"]);
					$interval = $eventTime->diff($now);
					if($now < $eventTime) {
						$timeUntil = $interval->format("%a days, %h hours, and %i minutes from now");
					} else {
						$timeUntil = $interval->format("%a days, %h hours, and %i minutes ago");
					}
					echo '
						<div class="bracketHolder" id="'.$matchup["ID"].'" onclick="return scrollto(\'matchup\',this)">
							<h1><span class="highlight">'.$timeUntil.'</span></h1>
							<div class="rr rr-left">
								<img src="'.$matchup["team1Logo"].'" alt="Team Logo" style="width:80px;height:80px;position:absolute;left:0;top:0;">
								<div>
									<h2>'.$matchup["team1Name"].'</h2>
									<p>'.$matchup["team1WinChance"].'%</p>
								</div>
							</div>
							<div class="rr vs">VS</div>
							<div class="rr rr-right">
								<div>
									<h2>'.$matchup["team2Name"].'</h2>
									<p>'.$matchup["team2WinChance"].'%</p>
								</div>
								<img src="'.$matchup["team2Logo"].'" alt="Team Logo" style="width:80px;height:80px;position:absolute;right:0;top:0;">
							</div>
						</div>
						<div class="spacer"></div>
					';
				}
			?>
		</div>
	</section>
	<section id="inventory">
		
	</section>
	<section id="about">
		
	</section>
	<section id="contact">
		<div class="contactHolder">
			<div class="contactElement">
				<iframe src="https://discordapp.com/widget?id=147815063326031872&theme=dark" width="750" height="500" allowtransparency="true" frameborder="0"></iframe>
			</div>
		</div>
	</section>
	<section id="matchup">
		<div class="matchupHolder">
			<h1 id="mTime"><span class="highlight">Time</span></h1>
			<div class="rr rr-left matchupTeam" id="team1" onclick="pickedTeam1()">
				<img src="" alt="Team Logo" id="mLogo1" style="width:80px;height:80px;position:absolute;left:0;top:0;">
				<div>
					<h2 id="mName1">Team 1 Name</h2>
					<p id="mWin1">Team 1 Win %</p>
				</div>
			</div>
			<div class="rr vs">VS</div>
			<div class="rr rr-right matchupTeam" id="team2" onclick="pickedTeam2()">
				<div>
					<h2 id="mName2">Team 2 Name</h2>
					<p id="mWin2">Team 2 Win %</p>
				</div>
				<img src="" alt="Team Logo" id="mLogo2" style="width:80px;height:80px;position:absolute;right:0;top:0;">
			</div>
		</div>
		<div class="spacer"></div>
		<div class="playerBettableItems">
			
		</div>
	</section>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script src="js/index.js"></script>
</body>
</html>