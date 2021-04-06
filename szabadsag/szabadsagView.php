<?php
$sql="select ev from szabadsag group by ev order by ev";
$stmt=$db->query($sql);
$strEvek="";
while($row=$stmt->fetch()){
	extract($row);
	$strEvek.="<option value='{$ev}'>{$ev}</option>";
}

//include __DIR__ . "/../config.php";
// létrehozunk egy tömböt amiben felsoroljuk mi szerint szeretnénk rendezni a táblázatot
$columns = array('nev','hadrendi','ev','nap');

//ha nincs semmi a GET-ben akkor kod szerintis sorrend lesz:
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

// növekvő vagy csökkenő sorrend:
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';
$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';

$toggle_nev=$column == 'nev' ? '-' . $up_or_down : '';
$toggle_ev=$column == 'ev' ? '-' . $up_or_down : ''; 
$toggle_nap=$column == 'nap' ? '-' . $up_or_down : ''; 
$toggle_hadrendi=$column == 'hadrendi' ? '-' . $up_or_down : ''; 


if(isset($_POST['szures']) && $_POST['ev']!='0'){
	$ev=intval($_POST['ev']);
	$sql="select a.id,a.ev,a.nap,a.hadrendi,b.nev from szabadsag a,szemelyek b where a.sz_azon=b.azonosito and a.ev={$ev} order by {$column} {$sort_order}";
}else
	$sql="select a.id,a.ev,a.nap,a.hadrendi,b.nev from szabadsag a,szemelyek b where a.sz_azon=b.azonosito order by {$column} {$sort_order}";
$stmt=$db->query($sql);
$urlnev=currentUrl().'&column=nev&order='.$asc_or_desc;
$urlev=currentUrl().'&column=ev&order='.$asc_or_desc;
$urlhadrendi=currentUrl().'&column=hadrendi&order='.$asc_or_desc;
$urlnap=currentUrl().'&column=nap&order='.$asc_or_desc;
$tbl="<tr>
		<th><a href='{$urlhadrendi}'>
				Hadrendi <i class='fas fa-sort{$toggle_hadrendi}'></i>
			</a>
		</th>
		<th><a href='{$urlnev}'>
				Név<i class='fas fa-sort{$toggle_nev}'></i>
			</a>
		</th>
        <th><a href='{$urlev}'>
				Év<i class='fas fa-sort{$toggle_ev}'></i>
			</a>
		</th>
        <th><a href='{$urlnap}'>
				Nap<i class='fas fa-sort{$toggle_nap}'></i>
			</a>
		</th>
	</tr>";
 while ($row = $stmt->fetch()){
	extract($row);
	$tbl.="<tr><td>{$hadrendi}</td><td>{$nev}</td><td>{$ev}</td><td>{$nap}</td></tr>";
 }
?>
<form class="form-inline" method="post">
	<select class="form-control col-2" name="ev" >
		<option value="0">összes év</option>
		<?=$strEvek?>
	</select>
	<input class="form-control col-1 btn btn-primary" type="submit" name="szures" value="szűres">
</form>
<div class="row justify-content-end"><a class="btn btn-primary  text-white" href="index.php?p=szabadsag/szabadsag.php"> Adatok aktualizálása</a></div>
<table><?=$tbl?></table>
