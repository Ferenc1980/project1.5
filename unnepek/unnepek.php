<?php
//print_r($_SESSION);
require_once "config.php";
$sql="select datum from unnepek order by datum desc";
$stmt=$db->query($sql);
$str="";

while($row=$stmt->fetch()){
	extract($row);
	$str.="<tr><td>{$datum}</td><td class='btn btn-outline-danger m-1 '><a href='unnepek/delete.php?datum={$datum}'>törlés</a></td></tr>";
}

$sql="select concat(year(datum),'-',month(datum)) ho,min(datum) datum from unnepek group by concat(year(datum),'-',month(datum)) order by ho desc;";
$stmt=$db->query($sql);
$evek="";
while($row=$stmt->fetch()){
	extract($row);
	$evek.="<option value='{$datum}'>{$ho}</option>";
}

?>
<div class="row">
<h3 class='w-100 text-center mb-2'>Az éves ünnepnapok nyilvántartása</h3>
	<div class="col border text-center "> 
		<h5 class="text-center w-100 mt-3">Új dátumok bevezetése</h5>
		<form class="" id="frm">
			<table id="tbl" class='  table '>
				<tr class="">
					<td>
						<input class='form-control input-datum' type="date" name="datum[]"  >
					</td>
					<td>
						<button class='btn btn-success' type="button" id="add">Új dátum</button>
					</td>
				</tr>
			</table>
			<button class='btn btn-info' type="button" id="submit">Mentés az adatbázisba</button>
		</form>

		<p><?=isset($_SESSION['save-date']) ? $_SESSION['save-date'] : '' ?></p>

	</div>

	<div class="col-2 pt-5">
		<select name="evho" id="evho" class="form-control">
			<option value="0">szűrés egy hónapra</option>
			<?=$evek?>
		</select>
	</div>



	<div class="col">
		<p><?=isset($_SESSION['delete-date']) ? $_SESSION['delete-date'] : '' ?></p>
		<table class='table-responsive table-striped '><thead class=' bg-dark text-white'><th class="p-2">ünnepnapok</th><th>&nbsp;</th></thead>
			<tbody id="tbl-body">	<?=$str?></tbody>
		</table>

	</div>
</div>
<script src="unnepek/jquery.js"></script>
<script src='unnepek/unnepek.js'></script>	
