<?php
include '../config.php';
$sql="select kod from kategoriak where kod<>'N'";
$stmt=$db->query($sql);
$tomb=[];
while($row=$stmt->fetch())   
    array_push($tomb,$row['kod']);

print_r($tomb);

?>