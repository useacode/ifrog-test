<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/app.php";

	$app = new App();
	$app->connect();

	if(isset($_POST['id']) && !empty($_POST['id'])){
		$app->deleteName($_POST['id']);
	}

?>