<?php
$ma=new DateTime();
print_r($ma);

$napsorszam = intval($ma->format('w'));//a héten belül a napnak a sorszáma
echo "<br> hányadik nap a héten beül:".$napsorszam;

//például 2 dátum közti dátumok előállítása programozottan, egy függvény segítségével:

function datumokIntervallumban($start, $end, $format = 'Y-m-d') {   
    // egy üres tömböt hozunk létre
    $tomb = array(); 
    //ebben a változóban tároljuk, hogy 1 naponként akarunk lépkedni
    $step = new DateInterval('P1D'); 
    print_r($step);
    $end->add($step); 
    $period = new DatePeriod($start, $step, $end); 
    foreach($period as $date) {                  
        $tomb[] = $date->format($format);  
    } 
    return $tomb; 
} 
  
// előállítjuk a bemenő paramétereket és meghívjuk a függvényt:
$kezdoDatum=new DateTime('2021-03-01');
$vegsoDatum=new DateTime($kezdoDatum->format( 'Y-m-t' ));//a hónap utolsó napja
$datumokTombje =datumokIntervallumban($kezdoDatum,$vegsoDatum); 

echo "<hr>";
echo "március hónap napjai: <br>";  
print_r($datumokTombje); 
echo "<hr>";
$ora=6;
$idoIntervallum=new DateInterval("PT{$ora}H8M");
echo "<br> ido intervallum=".$idoIntervallum->format('%H:%I');
$percek=$idoIntervallum->h * 60 + $idoIntervallum->i;
echo "<br> percek összege:".$percek;
//////
echo "<hr>";
function ido($perc){
    $ora=intdiv($perc,60);
    $perc=fmod($perc,60);//maradék
    $idoIntervallum=new DateInterval("PT{$ora}H{$perc}M");
    return $idoIntervallum->format('%H:%I');
}
echo ido(480);
?>
