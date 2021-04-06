<?php
//ha megerkezett az URL-ben az azonosito, meg kell jeleniteni a megfelelo rekordot:
if(isset($_GET['editId'])){
	$id=$_GET['editId'];//ezt az $id elrejtjuk a form-ban egy hidden tipusu tag-ban
	$sql="select a.id,a.ev,a.nap,a.hadrendi,b.nev from szabadsag a,szemelyek b where a.id={$id}";
	$stmt=$db->query($sql);
	$row=$stmt->fetch();
    extract($row);
	
}
//print_r($_POST);
if(isset($_POST['mentes'])) {
    extract($_POST);
	$sql="update szabadsag set nap='{$nap}', hadrendi='{$hadrendi}' where id={$id}";
	//echo $sql;
    $stmt=$db->exec($sql);
    if($stmt){
           $msg="sikeres adatmodsitas";  
           header("Location:index.php?p=szabadsag/szabadsag.php&msg={$msg}");
    }
    else
        $msg="hiba!! nem sikerult az adat modositasa";
}

?>
    <div class="container border">
        <h3 class="text-center">Adatok modositasa</h3>
        <div class="row justify-content-center p-3">	
			<a class="btn btn-outline-primary " href="index.php?p=szabadsag/szabadsag.php">Vissza</a>
		</div>
        <div class="row m-1 p-2">   
            <div class="col">
                <form action="" method="post" class="form-inline">
                    <h4 class="w-100"><?=$nev.'- '.$ev.'-re tárolt éves adatai.'?></h4>
                    <div class="form-group">
                        <label for="">Az éves szabadság napok száma:</label>
                        <input type="text" name="nap" class="form-control col-3" value="<?=$nap?>" required>
					</div>
                    <div class="form-group">
                        <label for="">Hadrendi száma:</label>
                        <input type="text" name="hadrendi" class="form-control col-3" value="<?=$hadrendi?>" required>
					</div>
					<input type="hidden" name="id" value="<?=$id?>">
                    <input  class="btn btn-primary form-control col " type="submit" name="mentes" value="modositas" >
                </form>
              </div>
         </div>
    </div>
