<?php 
	include "config.php";
?>
<h4 class='page-header'><i class="fa fa-users"></i> Student Details</h4>
<table class="table">
		<tr>
		
			<th>Hadrendi</th>
			<th>Név</th>
			<th>Beosztás</th>
			<th>Év</th>
			<th>Nap</th>
			<th>EDIT</th>
			<th>DELETE</th>
		</tr>
		<?php 
			$sql="select azonosito,hadrendi,nev,beosztas,ev,nap from szabadsag a,szemelyek b where a.sz_azon=b.azonosito;";
			$stmt=$db->query($sql);
			if($stmt->rowCount()>0)
			{
				while($row=$stmt->fetch())
				{
					echo"<tr>";
					echo"<td>{$row["hadrendi"]}</td>";
					echo"<td>{$row["nev"]}</td>";
					echo"<td>{$row["beosztas"]}</td>";
					echo"<td>{$row["ev"]}</td>";
					echo"<td>{$row["nap"]}</td>";

					echo"<td><button type='button' class='btn btn-sm btn-info edit' data-id='{$row["azonosito"]}'><i class='fa fa-edit'></i></td>";
					echo"<td><button type='button' class='btn btn-sm btn-danger del' data-id='{$row["azonosito"]}'><i class='fa fa-trash'></i></td>";
					echo"</tr>";
				}
			}
		?>
		
</table>