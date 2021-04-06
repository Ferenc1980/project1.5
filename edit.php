<?php

require_once 'config.php';

//ha megerkezett az URL-ben az azonosito, eg kell jeleniteni a megfelelo rekordot:
if(isset($_GET['id'])){
	$id=$_GET['id'];//ezt az $id elrejtjuk a form-ban egy hidden tipusu tag-ban
	$sql="select nev,beosztas from szemelyek where azonosito={$id}";
	$stmt=$db->query($sql);
	$row=$stmt->fetch();
    print_r($row);
    extract($row);
	
}


//print_r($_POST);
if(isset($_POST['mentes'])) {
    extract($_POST);
	$sql="update szemelyek set nev='{$nev}', beosztas='{$beosztas}' where azonosito={$id}";
	//echo $sql;
    $stmt=$db->exec($sql);
    if($stmt){
           $msg="sikeres adatmodsitas";  
           //header("Location:alkalmazottak.php?msg={$msg}");
    }
    else
        $msg="hiba!! nem sikerult az adat modositasa";
    
}


?>

    <div class="container border">
        <h3 class="text-center">Adatok modositasa</h3>
        <div class="row justify-content-center p-3">	
			<a class="btn btn-info " href="index.php?p=alkalmazottak.php">Vissza</a>
		</div>
        <div class="row m-1 p-2">   
            <div class="col-5">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">A munkás neve:</label>
                        <input type="text" name="nev" class="form-control" value="<?=$nev?>" required>
                    </div>
                    <div class="form-group">
                        <label for="">beosztas</label>
                        <input type="text" name="beosztas" class="form-control" value="<?=$beosztas?>" required>
					</div>
					<input type="hidden" name="id" value="<?=$id?>">
                    <input type="submit" name="mentes" value="modositas" >
                </form>
              </div>
         </div>
    </div>
