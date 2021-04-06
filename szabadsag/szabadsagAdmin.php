<?php 
$sql="select ev from szabadsag group by ev order by ev";
$stmt=$db->query($sql);
$strEvek="";
while($row=$stmt->fetch()){
	extract($row);
	$strEvek.="<option value='{$ev}'>{$ev}</option>";
}

$ev_uj=$nap_uj=$msg="";

if(isset($_POST['mentes'])){
	extract($_POST);
	$evNum=intval($ev_uj);
	$napNum=intval($nap_uj);
	$sql="select count(ev) db from szabadsag where ev={$evNum}";
	$stmt=$db->query($sql);
	$row=$stmt->fetch();
	if($row['db']>0)
		$msg=" A {$ev_uj}-es évre mát vannak bevezetve adatok!!!";
	else{
		$sql="insert into szabadsag select null,azonosito,{$evNum},{$napNum},azonosito from szemelyek";
		$stmt=$db->exec($sql);
		if($stmt)
			$msg="Sikeres mentés!";
		else
			$msg="Hiba! nem sikerült az adatok mentése!";
		//header('Location:index.php?p=szabadsag/szabadsag.php&message='.$msg);
		}
}

	if(isset($_POST['torles'])){
		extract($_POST);
		$evNum=intval($ev_uj);
		$sql="select count(ev) db from szabadsag where ev={$evNum}";
		$stmt=$db->query($sql);
		$row=$stmt->fetch();
		if($row['db']==0)
			$msg=" A {$ev_uj}-es évre nincsenek bevezetve adatok!!!";
		else{
			$sql="delete from szabadsag where ev={$evNum}";
			$stmt=$db->exec($sql);
			if($stmt)
				$msg="Sikeres törlésés!";
			else
				$msg="Hiba! nem sikerült az adatok törlése!";
			//header('Location:index.php?p=szabadsag/szabadsag.php&message='.$msg);
		}
	}
?>

<div class="row justify-space-between">
	<h4 class='col page-header'><i class="fa fa-users"></i>Szabadság napok / hadrendi szám aktualizálása</h4>
	<a class=" col-2 btn btn-primary  text-white" href="index.php?p=szabadsag/szabadsagView.php"> Felahasználói nézet</a>
</div>

<form class="form-inline" method="post">
	<select class="form-control col-2" name="ev_szures" >
		<option value="0">összes év</option>
		<?=$strEvek?>
	</select>
	<input class="form-control col-1 btn btn-primary" type="submit" name="szures" value="szűres">
</form>

<div class="col-md-4"  ><?=isset($_GET['msg'])? $_GET['msg']: "" ?></div>
<table class="table">
		<tr class="text-white">
		
			<th>Hadrendi</th>
			<th>Név</th>
			<th>Beosztás</th>
			<th>Év</th>
			<th>Nap</th>
			<th>EDIT</th>
			<th>DELETE</th>
		</tr>
		<?php 
		if(isset($_POST['szures'])&& $_POST['ev_szures']!='0'){
			$ev_szures=intval($_POST['ev_szures']);
			$sql="select a.id,azonosito,hadrendi,nev,beosztas,ev,nap from szabadsag a,szemelyek b where a.sz_azon=b.azonosito and a.ev={$ev_szures};";
		}else
			$sql="select a.id,azonosito,hadrendi,nev,beosztas,ev,nap from szabadsag a,szemelyek b where a.sz_azon=b.azonosito;";
			$stmt=$db->query($sql);
			if($stmt->rowCount()>0)
			{
				while($row=$stmt->fetch()){
					extract($row);
					echo"<tr>";
					echo"<td>{$hadrendi}</td>";
					echo"<td>{$nev}</td>";
					echo"<td>{$beosztas}</td>";
					echo"<td>{$ev}</td>";
					echo"<td>{$nap}</td>";

					echo"<td><button type='button' class='btn btn-sm btn-info edit' >
							<a class='text-white' href='index.php?p=szabadsag/szabadsag.php&editId=$id'><i class='fa fa-edit'></i></a>
						</td>";
					echo"<td><button type='button' class='btn btn-sm btn-danger del' >
							<a class='text-white' href='index.php?p=szabadsag/szabadsag.php&deleteId=$id'><i class='fa fa-trash'></i></a>
						</td>";
					echo"</tr>";
				}
			}
		?>
		
</table>

	<form  class="form-inline border w-50 justify-content-center" method="post">
	<fieldset>
		<legend>Éves adatok bevezetése / törlése:</legend>
		<div class="form-group ">
			<label for="">Év:  </label>
			<input class="form-control "type="number" name="ev_uj" required id="" value="<?=$ev_uj?>">
		</div>
		<div class="form-group">
			<label for="">Alapértelmezett szabdságnapok száma:  </label>
			<input class="form-control " type="number" name="nap_uj" id="" required value="<?=$nap_uj?>">
		</div>
		<input class=" btn btn-primary mr-5" type="submit" value="mentés" name="mentes">
		<input class=" btn btn-danger" type="submit" value="törlés" name="torles">
		
	</fieldset>
	<div><?=$msg?></div>
	</form>
	
