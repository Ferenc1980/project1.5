<?php 
	session_start();
	include '../config.php';
	$n=count($_POST["datum"]);
	if($n>=1){
		$sql="";
		for($i=0;$i<$n;$i++)
			if(trim($_POST["datum"][$i])!='')
				$sql.="insert into unnepek  values ('{$_POST["datum"][$i]}');";
		try{
			$stmt=$db->exec($sql);
			$_SESSION['save-date']="sikeres mentes";
			echo "sikeres mentes";
		}catch(Exception $e){
			$_SESSION['save-date']="Hiba !!!";
			echo "hiba";
		}		
	}	

?>