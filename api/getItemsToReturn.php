<?php
	require('../connectDB.php');
	$steamID = $_GET['SteamID'];
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt2 = $conn->prepare("SELECT * FROM getItems WHERE SteamID='$steamID' ORDER BY ID");
	$stmt2->execute();
	echo json_encode($stmt2->fetchAll(PDO::FETCH_ASSOC));
	exit();
?>