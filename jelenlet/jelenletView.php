<?php
include "szemely.class.php";
include "myFunctions.php";
//a select feltöltése a bevezetett honapokkal:
$sql="select year(datum) ev,month(datum) ho,min(datum) datum from jelenlet group by year(datum),month(datum) order by year(datum) desc,month(datum) desc";
$stmt=$db->query($sql);
$strHonapok="";
while($row=$stmt->fetch()){
    extract($row);
    $strHonapok.="<option value='{$datum}'>{$ev}-{$ho}</option>";
}
$fejlec="";
$tartalom="";
$ev=$ho=null;
if(isset($_POST['megjelenit']) && $_POST['honap']!='0'){
    $ev=intval(substr($_POST['honap'],0,4));
    $ho=intval(substr($_POST['honap'],5));
    $fejlec=fejlec2(getDateArr($_POST['honap']));

    $sql="select a.azonosito,a.nev,c.hadrendi,b.perc,b.kateg_kod,b.datum,day(b.datum) nap from szemelyek a,jelenlet b,szabadsag c where a.azonosito=b.sz_azon and a.azonosito=c.sz_azon and c.ev={$ev} and month(datum)={$ho} and year(datum)={$ev} order by a.azonosito";
    $stmt=$db->query($sql);
    $lepedo=[];
    $id=0;
    while($row=$stmt->fetch()){
        if($id<>$row['azonosito']){
            $szemely=new Szemely($row);
            $lepedo[]=$szemely;
            $id=$row['azonosito'];
        }
        $szemely->set_napok($row);
    }
    $tartalom="";
    foreach($lepedo as $key=>$value){
        $tartalom.="<tr><td><div>{$value->azonosito}-{$value->nev}</div><div>{$value->hadrendi}</div></td>";
        foreach($value->napok as $nap=>$ertek){
            $cella=$class='';
            if($ertek['kateg_kod']=='N')
                $cella=$ertek['perc']/60;
            else{
                $cella=$ertek['kateg_kod']=='Ü' ? '' : $ertek['kateg_kod'] ;
                $class=$cella=='' ? 'red' : '';
            }
            $tartalom.="<td class='{$class}'>{$cella}</td>";
        }
        $dolgIdo=$value->osszDolgIdo()/60;
        $tartalom.="<td>{$dolgIdo}</td><td>{$value->osszSzabadsag()}</td></tr>";
    }
     
}
?>

<style>
    .red{
        background-color:red;
    }
</style>

<div class="row justify-content-end"><a class="btn btn-primary  text-white" href="index.php?p=jelenlet.php"> Adatok aktualizálása</a></div>
<form class="form-inline" method='post'>
   <select class="form-control" name="honap" id="">
       <option value="0">válassz ki egy hónapot</option>
        <?=$strHonapok?>
   </select>
   <input class="form-control btn btn-primary" type="submit" name="megjelenit" value="adatok megjelenítése">
</form>

<div class='row p-2'>Jelenlét: <?=$ev.'-'.$ho?></div class='row p-2'>
<table class="table-responsive table-striped table-bordered text-center">
    <?=$fejlec?>
    <tbody><?=$tartalom?></tbody>
  
</table>
