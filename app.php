<?php
	class App
	{
		private $link = null;

		function connect(){
			if(!file_exists($_SERVER['DOCUMENT_ROOT']."/config/config.php"))
				header("location:install.php");
			
			include_once $_SERVER['DOCUMENT_ROOT']."/config/config.php";

			$this->link = mysql_connect('localhost', $user, $password);
			if (!$this->link) {
			    die('Ошибка соединения: ' . mysql_error());
			}

			mysql_select_db($dbname) or die(mysql_error());
		}

		function install($user, $password, $dbname){
			$this->link = mysql_connect('localhost', $user, $password);
			if (!$this->link) {
			    die('Ошибка соединения: ' . mysql_error());
			}

			$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
			if (mysql_query($sql, $this->link)) {
			    echo "База $dbname успешно создана\n";
			} else {
			    die ('Ошибка при создании базы данных: ' . mysql_error() . "\n");
			}

			mysql_select_db("$dbname") or die(mysql_error());
			mysql_query("CREATE TABLE IF NOT EXISTS `table` (
				  id INT AUTO_INCREMENT,
				  name VARCHAR(255),
				  PRIMARY KEY(id)
				)") Or die(mysql_error());

			file_put_contents( $_SERVER['DOCUMENT_ROOT']."/config/config.php", '
				<?php
					$dbname = "'.$dbname.'";
					$user = "'.$user.'";
					$password = "'.$password.'";
				');
		}

		function __construct(){
			
		}

		function __destruct(){
			
		}

		function disconnect(){
			mysql_close ();
		}

		function addName($name){
			$name = mysql_real_escape_string($name);
			$result = mysql_query("SELECT name FROM `table` WHERE name = '$name' LIMIT 1");
			$row = mysql_fetch_array($result, MYSQL_NUM);
			if(!$row){
				mysql_query("INSERT INTO  `table` (name) VALUES ('$name')") Or die(mysql_error());
			}	
		}

		function deleteName($id){
			$id = intval($id);
			mysql_query("DELETE FROM `table` WHERE id = '$id'");
		}

		function getAllNames(){
			$arr = array();
			$result = mysql_query("SELECT id, name FROM `table` ORDER BY name DESC");
			while($row = mysql_fetch_array($result, MYSQL_NUM))
			{
				$arr[]=array("id" => $row[0], "name" => $row[1]);
			}
			return $arr;
		}
		
		function outName(){
			$result = mysql_query("SELECT name FROM `table` LIMIT 1");
			$row = mysql_fetch_array($result, MYSQL_NUM);
			if($row){
				echo $row[0];
			}
		}

		function outHeader(){
			$q = !empty($_SERVER['QUERY_STRING']) ? htmlspecialchars(urldecode($_SERVER['QUERY_STRING'])) : "Awesome test task";
			echo $q;
		}
	}
?>