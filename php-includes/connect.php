<?php
define('DB_USER', 'aimedidierm');
define('DB_PASS', '');
define('DB_HOST', 'localhost');
define('DB_NAME', 'smart_toilette');
$db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
if (!is_null($db->errorCode())) {
	die("Not Connected");
	exit();
}
?>
