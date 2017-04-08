<?php
	require('../connectDB.php');
	//$id = $_GET['matchup'];
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt2 = $conn->prepare("SELECT * FROM queue ORDER BY ID");
	$stmt2->execute();
	echo json_encode($stmt2->fetchAll(PDO::FETCH_ASSOC));
	exit();
?>