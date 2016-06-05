<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="/js/jquery-ui/jquery-ui.css">
	<script src="/js/jquery.min.js" type="text/javascript"></script>
	<script src="/js/jquery-ui/jquery-ui.js"></script>
	<title>Awesome test task</title>
</head>
<body>
<?php
	require "app.php";
	$app = new App();

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$app->install($_POST['user'], $_POST['pass'], $_POST['db']);
		echo "<script>
			window.location = '/';
		</script>";
		exit;
	}
?>
	<h1 id="page_title">Install</h1>
	
	<form action="" method="POST">
		<label for="user">UserName</label>
		<input id="user" type="text" name="user">
		<br>
		<label for="pass">Password</label>
		<input id="pass" type="password" name="pass">
		<br>
		<label for="db">DB Name</label>
		<input id="db" type="text" name="db">
		<input type="submit" value="Install">
	</form>
</body>
</html>

