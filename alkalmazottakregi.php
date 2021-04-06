<?php

if(!isset($_SESSION["user"])=="admin")
    header("Location:index.php");

	require_once 'config.php';
	
	$tbl="";
	$sql="select * from szemelyek order by nev asc";
    $stmt=$db->query($sql);
    while($row=$stmt->fetch()){
		extract($row);
    	$tbl.="<tr><td>{$azonosito}</td><td>{$nev}</td><td>{$beosztas}</td>";           
             $tbl.="<td class=' btn btn-outline-light m-1'><a  href='index.php?i=edit.php?id=$azonosito'>Edit</a></td>";
		     $tbl.="<td class=' btn btn-outline-light  m-1'><a  href='delete.php?id=$azonosito'>Delete</a></td></tr>";
	}
	
?>

<div class="container border p-3">
  <h2 class="text-center">Alkalmazottak nyilvántartása</h2>
  <div class="row ">
	 <div class="col-md-4"  ><?=isset($_GET['msg'])? $_GET['msg']: "" ?></div>
	 <div class="col-md-4 text-center shadow p-3 m-1  rounded">
	 	<div class="btn btn-outline-light  m-1 p-1 rounded"><a  href="alkalmazottak.php?i=alkalmazottak/insert.php"><b>Insert</b> (uj alkalmazott bevezetese)</a></div>
	  </div>
  </div>
	<div class="row shadow p-1 bg-light">
	  <div class="col-md-6">
		 <div class="table-responsive">
		   <table class="table table-hover table-fixed-border" >
			   <thead><tr><th scope="col">Azonosito</th><th scope="col">Nev</th><th scope="col">beosztas</th><th scope="col">&nbsp</th><th scope="col">&nbsp</th></tr></thead>
			   <tbody ><?=$tbl?></tbody>
		  </table>
		</div>
	  </div>
	  <div class="col-md-6">
			<?php
			if(isset($_GET['i']))
				include $_GET['i'];
			?>
	</div>
	</div>
</div>


