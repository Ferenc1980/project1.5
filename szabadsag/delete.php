<?php
//az url-bol kapjuk az adatot:
$msg="";
$id = $_GET['deleteId'];
$sql="delete from szabadsag where id={$id}";
try{
	$count=$db->exec($sql);
	$msg ="Sikeres törlés !"; 
}catch(PDOException $e){		
	$msg= "NEM lehet kitorolni!"; 
}
header("Location:index.php?p=szabadsag/szabadsag.php&msg={$msg}");
?> 