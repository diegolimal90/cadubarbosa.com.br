<?php
require_once 'lib/defines.php';

$con = new PDO('mysql:host='.HOST.';dbname='.DBNAME, USER, PASS);

$sql = "SELECT * FROM fiel";
$query = $con->query($sql);

while($res = $query->fetch()){
	
	echo $res['id_fiel'];
}