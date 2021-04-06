<?php
include 'config.php';

$columnName = $_POST["column"];
$columnValue = $_POST["editval"];
$id= $_POST["id"];
$sql="update szemelyek set {$columnName}='{$columnValue}' where azonosito={$id}";
echo $sql;
$stmt=$db->exec($sql);

?>