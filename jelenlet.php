<?php
include 'config.php';
$sql="select kod from kategoriak where kod!='N'";
$stmt=$db->query($sql);
$ktg="";
while($row=$stmt->fetch())   
  $ktg.=$row['kod']." | ";
?>
<div class="row justify-content-end"><a class="btn btn-primary  text-white" href="index.php?p=jelenlet/jelenletView.php"> Felahasználói nézet</a></div>
<form>
  <div class="form-row">
    <div class="col-3">
      <label for="honap">Válaszd ki a hónapot:</label>
    </div>
    <div class="col-3"> 
      <input type="month" class="form-control" id="honap" >
    </div>
    <div class="col-1">
      <div id="feltolt" class="btn btn-primary">Feltöltés</div>
    </div>
    <div class="col-1">
      <div id="torol" class="btn btn-primary">Törlés</div>
    </div>
    <div class="col" id="kategoriak">Kategória kódok:&nbsp;<?=$ktg?></div>
  </div>
</form>

<div class="table-responsive">
  <table class="table-sm table-striped table-bordered" id="output"></table>
</div>
<script src="jelenlet/honap.js"></script>

<!--az adatok módosíthatóságát, adatbázisba mentését valósítja meg:-->

<script src="jquery-3.2.1.min.js"></script>
<script src="jelenlet/inLineEdit.js"></script>