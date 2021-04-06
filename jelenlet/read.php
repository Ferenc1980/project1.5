<?php
session_start();
include "../config.php";
include "myFunctions.php";

if(isset($_GET['datum'])){
    $ev=intval(substr($_GET['datum'],0,4));
    $ho=intval(substr($_GET['datum'],5));
    $sql="select a.azonosito,a.nev,b.perc,b.kateg_kod,b.datum from szemelyek a,jelenlet b where a.azonosito=b.sz_azon and month(datum)={$ho} and year(datum)={$ev}";
    $stmt=$db->query($sql);
    if($stmt->rowCount()==0)
        echo "Nincs bevezetve:  {$_GET['datum']}";
    else
        echo fejlec(getDateArr($_GET['datum'])).genHtmlTableFunction($stmt);
}
///uj bevezetése, s megjelenítése:
if(isset($_GET['ujdatum'])){
        $ev=intval(substr($_GET['ujdatum'],0,4));
        $ho=intval(substr($_GET['ujdatum'],5));
        // előállítjuk a bemenő paramétereket és meghívjuk a függvényt:
        $datumokTombje =getDateArr($_GET['ujdatum']);
         //létrehozzuk az ünnepek tömbbjét:
         $sql="select datum from unnepek where month(datum)={$ho} and year(datum)={$ev} ";
         $stmt=$db->query($sql);
         $unnepek=[];
         while($row=$stmt->fetch())
            $unnepek[]=$row['datum'];
        $sql="";
        foreach($datumokTombje as $datum)
            if(!in_array($datum,$unnepek))
                $sql.="insert into jelenlet (select azonosito ,'{$datum}',480,'N' from szemelyek);";
            else
                $sql.="insert into jelenlet (select azonosito ,'{$datum}',0,'Ü' from szemelyek);";
            //echo "<br>".$sql;
        $stmt=$db->exec($sql);
        if($stmt){
            $sql="select a.azonosito,a.nev,b.perc,b.kateg_kod,b.datum from szemelyek a,jelenlet b where a.azonosito=b.sz_azon and month(datum)={$ho} and year(datum)={$ev}";
            $stmt=$db->query($sql);
            echo fejlec($datumokTombje).genHtmlTableFunction($stmt);
        }else
            echo "nem sikerült az adatok feltöltése";  
}

    function genHtmlTableFunction($stmt){
        $str="";
        $id=1;
        $arr=$stmt->fetchAll();
        $id=$arr[0]['azonosito'];
        $str.="<tbody><tr><td>{$arr[0]['nev']}</td></tr><tr>";
        foreach($arr as $item){
            extract($item);
            //echo $datum;
            $ido=ido($perc);
           if($id==$azonosito){
                $str.=$kateg_kod=='N' ? 
                    "<td contenteditable='true'  
                        onBlur='save(this,\"perc\",{$id},\"{$datum}\");'  
                        onClick='showEdit(this);'
                        onFocus='initial(this)'>{$ido}</td>" : 
                    "<td contenteditable='true' 
                        onBlur='save(this,\"kateg-kod\",{$id},\"{$datum}\")'  
                        onClick='showEdit(this);'
                        onFocus='initial(this)'>{$kateg_kod}</td>" ;
            }else{
                $id=$azonosito;
                $str.=$kateg_kod=='N' ? 
                    "</tr><tr><td>{$nev}</td></tr><tr><td contenteditable='true' 
                        onBlur='save(this,\"ido\",{$id},\"{$datum}\")'  
                        onClick='showEdit(this);'
                        onFocus='initial(this)'>{$ido}</td>" : 
                    "</tr><tr><td>{$nev}</td><td contenteditable='true' 
                        onBlur='save(this,\"kateg-kod\",{$id},\"{$datum}\")'  
                        onClick='showEdit(this);'
                        onFocus='initial(this)'>{$kateg_kod}</td>";
            }
        }
        $str.="</tr></tbody>";
        return $str;
    }
  
?>
