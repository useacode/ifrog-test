<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/app.php";

	$app = new App();
	$app->connect();

	$get = $app->getAllNames();

	echo json_encode($get);

?>