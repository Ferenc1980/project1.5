<?php 
class Szemely { 
    public $azonosito;
    public $nev;
    public $hadrendi;
    public $napok=[];
     
    public function __construct($item = array()){ 
        $this->azonosito =$item['azonosito']; 
        $this->nev =$item['nev'];       
        $this->hadrendi=$item['hadrendi'];   
       
    }    
        
    public function set_napok($item = array()){
        $this->napok[]=['perc'=>$item['perc'],'kateg_kod'=>$item['kateg_kod']];
    }
    public function osszDolgIdo(){
        $osszPerc=0;
        foreach($this->napok as $key=>$value) 
            $osszPerc+=$value['kateg_kod']=='N'? $value['perc']: 0;
        return $osszPerc;
    }
    public function osszSzabadsag(){
        $osszSzabadsag=0;
        foreach($this->napok as $key=>$value) 
            $osszSzabadsag+=$value['kateg_kod']=='SZ'? 1: 0;
        return $osszSzabadsag;
    }
}
?>