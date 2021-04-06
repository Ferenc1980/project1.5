<?php

//require_once "../config.php";
include __DIR__ . "/../config.php";
// létrehozunk egy tömböt amiben felsoroljuk mi szerint szeretnénk rendezni a táblázatot
$columns = array('kod','leiras');

//ha nincs semmi a GET-ben akkor kod szerintis sorrend lesz:
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

// növekvő vagy csökkenő sorrend:
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';
$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';

$toggle_kod=$column == 'kod' ? '-' . $up_or_down : '';
$toggle_leiras=$column == 'leiras' ? '-' . $up_or_down : ''; 


$sql="SELECT kod,leiras FROM kategoriak ORDER BY {$column} {$sort_order}";
$stmt=$db->query($sql);
$urlkod=currentUrl().'&column=kod&order='.$asc_or_desc;
$urlleiras=currentUrl().'&column=leiras&order='.$asc_or_desc;
$tbl="<tr>
		<th><a href='{$urlkod}'>
				Kód <i class='fas fa-sort{$toggle_kod}'></i>
			</a>
		</th>
		<th><a href='{$urlleiras}'>
				Leírás<i class='fas fa-sort{$toggle_leiras}'></i>
			</a>
		</th>
	</tr>";
 while ($row = $stmt->fetch()){
	extract($row);
	$tbl.="<tr><td>{$kod}</td><td>{$leiras}</td></tr>";
 }
?>



<table><?=$tbl?></table>
