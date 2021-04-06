<?php

function datumokIntervallumban($start, $end, $format = 'Y-m-d') {   
    // egy üres tömböt hozunk létre
    $tomb = array(); 
    //ebben a változóban tároljuk, hogy 1 naponként akarunk lépkedni
    $step = new DateInterval('P1D'); 
    //print_r($step);
    $end->add($step); 
    $period = new DatePeriod($start, $step, $end); 
    foreach($period as $date) {                  
        $tomb[] = $date->format($format);  
    } 
    return $tomb; 
} 

function ido($perc){
    $ora=intdiv($perc,60);
    $perc=fmod($perc,60);//maradék
    $idoIntervallum=new DateInterval("PT{$ora}H{$perc}M");
    return $idoIntervallum->format('%H:%I');
}
//visszatéríti az összes datumot egy hónapon belül tömbként:
function getDateArr($datum){
    $kezdoDatum=new DateTime($datum);
    $vegsoDatum=new DateTime($kezdoDatum->format( 'Y-m-t' ));//a hónap utolsó napja
    return datumokIntervallumban($kezdoDatum,$vegsoDatum); 
} 

function timeToMinute($time){
        $time = explode(':', $time);
        return $time[0]*60 + $time[1];
}

function fejlec($arr){
    $str="<thead>";
    foreach($arr as $datum){
        $nap=substr($datum,8);
        $str.="<th>{$nap}</th>";
    }
    return $str."</thead>";

}
function fejlec2($arr){
    $str="<thead><th>&nbsp;</th>";
    foreach($arr as $datum){
        $nap=substr($datum,8);
        $str.="<th>{$nap}</th>";
    }
    return $str."<th class='bg-dark text-white'>N</th><th class='bg-dark text-white'>SZ</th></thead>";

}
?>