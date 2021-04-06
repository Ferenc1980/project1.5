<?php
session_start();
include "../config.php";


if(isset($_GET['datum'])){
    $ev=intval(substr($_GET['datum'],0,4));
    $ho=intval(substr($_GET['datum'],5));
    $sql="delete from jelenlet where month(datum)={$ho} and year(datum)={$ev}";
    $stmt=$db->query($sql);
    if($stmt)
        echo "Törölve:  {$_GET['datum']}";
}
?>