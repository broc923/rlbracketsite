<?php
require('connectDB.php');
$id = $_GET['matchup'];
if ($id != 0) {
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt2 = $conn->prepare("SELECT * FROM matchups WHERE ID = '$id'");
	$stmt2->execute();
	$result2 = $stmt2->fetch();
	$now = new DateTime();
	$eventTime = date_create_from_format('Y-m-d H:i:s', $result2["startTime"]);
	$interval = $eventTime->diff($now);
	if($now < $eventTime) {
		$timeUntil = $interval->format("%a days, %h hours, and %i minutes from now");
	} else {
		$timeUntil = $interval->format("%a days, %h hours, and %i minutes ago");
	}
	
	$arrFromDb = array(
		'id' => $result2['ID'],
		'team1Name' => $result2['team1Name'],
		'team2Name' => $result2['team2Name'],
		'team1Logo' => $result2['team1Logo'],
		'team2Logo' => $result2['team2Logo'],
		'team1WinChance' => $result2['team1WinChance'],
		'team2WinChance' => $result2['team2WinChance'],
		'streamURL' => $result2['streamURL'],
		'startTime' => $timeUntil
	);
	echo json_encode( $arrFromDb );
	exit();
}
?>