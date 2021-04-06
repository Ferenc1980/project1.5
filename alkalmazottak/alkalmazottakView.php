<?php
$tbl="";
	$sql="select * from szemelyek order by nev asc";
    $stmt=$db->query($sql);
    while($row=$stmt->fetch()){
		extract($row);
    	$tbl.="<tr><td>{$azonosito}</td><td>{$nev}</td><td>{$beosztas}</td>";           
             $tbl.="<td class=' btn btn-outline-primary m-1'><a class='text-warning' href='index.php?p=alkalmazottak.php&editId=$azonosito'>Edit</a></td>";
		     $tbl.="<td class=' btn btn-outline-primary  m-1'><a class='text-danger' href='index.php?p=alkalmazottak.php&deleteId=$azonosito'>Delete</a></td></tr>";
	}
	
?>

<div class="container border">
  <h6 class="text-center">Alkalmazottak nyilvántartása</h6>
  <div class="row ">
	 <div class="col-md-4"  ><?=isset($_GET['msg'])? $_GET['msg']: "" ?></div>
	 <div class="col-md-4 text-center shadow rounded">
	 	<div class="btn btn-outline-light  m-1 p-1 rounded"><a  href="index.php?p=alkalmazottak.php&insert=alkalmazottak/insert.php"><b>Insert</b> (uj alkalmazott bevezetese)</a></div>
	  </div>
  </div>
	<div class="row shadow p-1 bg-light">
	  <div class="col-md-6">
		 <div class="tbl-container">
		   <table class="table table-striped  table-fixed" >
			   <thead class="thead-dark"><tr><th scope="col">Azonosito</th><th scope="col">Nev</th><th scope="col">beosztas</th><th scope="col">&nbsp</th><th scope="col">&nbsp</th></tr></thead>
			   <tbody ><?=$tbl?></tbody>
		  </table>
		</div>
	  </div>
	  <div class="col-md-6">
			<?php
			if(isset($_GET['insert']))
				include $_GET['insert'];
			?>
	</div>
	</div>
</div>


