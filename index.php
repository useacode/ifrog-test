<?php
	require "app.php";
	$app = new App();
	$app->connect();
	$app->addName('Alex');
?>
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

	<h1 id="page_title"><?=$app->outHeader()?></h1>

	<ul id="names">		
	</ul>

	<label for="hidden-input">Имя:</label>
	<input type="hidden" id="hidden-input">
	<input type="button" id="show-dialog" value="Ввести имя">
	<input type="button" id="show-hidden" value="Показать скрытое поле">
	<input type="button" id="add-name" value="Добавить имя" disabled="disabled">

	<div id="dialog" title="Введите имя">
    	<input id="name" />
	</div>

	<script src="js/main.js"></script>
</body>
</html>

