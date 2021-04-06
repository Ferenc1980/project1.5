<?php
//az url-bol kapjuk az adatot:
$msg="";
$id = $_GET['deleteId'];
$sql="delete from szemelyek where azonosito={$id}";
try{
	$count=$db->exec($sql);
	$msg ="A/Az {$id} azonositoju szemely torolve az adatbazisbol !"; 
}catch(PDOException $e){		
	$msg= "A/Az {$id} azonositoju szemelyt nem lehet kitorolni!"; 
}
header("Location:index.php?p=alkalmazottak.php&msg={$msg}");
?> 