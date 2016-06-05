<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/app.php";

	$app = new App();
	$app->connect();

	if(isset($_POST['name']) && !empty($_POST['name'])){
		$app->addName($_POST['name']);
	}

?>