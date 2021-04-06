<?php
include '../config.php';
include "myFunctions.php";
$columnName = $_POST["column"];
$columnValue = $_POST["editval"];
$id= $_POST["id"];
$datum=$_POST["datum"];

if(strpos($columnValue,":")){
    $columnValue = timeToMinute($columnValue);
    $sql="update jelenlet set perc='{$columnValue}' where sz_azon={$id} and datum='{$datum}';";
}else
    $sql="update jelenlet set kateg_kod='{$columnValue}' where sz_azon={$id} and datum='{$datum}';";


echo $sql;
$stmt=$db->exec($sql);

?>