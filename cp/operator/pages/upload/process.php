<?php

//process.php

$connect = new PDO("mysql:host=localhost; dbname=testing", "root", "");

$query = "SELECT * FROM absensi_ptk";

$statement = $connect->prepare($query);

$statement->execute();

echo $statement->rowCount();

?>