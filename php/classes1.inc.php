<?php

    class MyDay{
        private $id;
        private $datum;
        private $uhrzeit;
        private $titel;
        private $beschr;

        public function __construct($id, $datum, $uhrzeit, $titel, $beschr){
            $this->id=$id;
            
            $tempDatumArr=explode(".", $datum);
            if(count($tempDatumArr)==3){
                $this->datum=$datum;
            }
            else{
                $tempDatumArr=explode("-",$datum);
                if(count($tempDatumArr)==3){
                    $tempDatum=$tempDatumArr[2].".".$tempDatumArr[1].".".$tempDatumArr[0];
                    $this->datum=$tempDatum;
                }
                else{
                    $this->datum=NULL;
                }
            }

            $tempUhrzeitArr=explode(":", $uhrzeit);
            if(count($tempUhrzeitArr)==2){
                $this->uhrzeit=$uhrzeit;
            }
            else if(count($tempUhrzeitArr)==3){
                $tempUhrzeit=$tempUhrzeitArr[0].":".$tempUhrzeitArr[1];
                $this->uhrzeit=$tempUhrzeit;
            }
            else{
                $this->uhrzeit=NULL;
            }

            if(strcmp($titel,"")==0){
                $this->titel=NULL;
            }
            else{
                $this->titel=$titel;
            }
            
            if(strcmp($beschr, "")==0){
                $this->beschr=NULL;
            }
            else{
                $this->beschr=$beschr;
            }      
        }

        public function __clone(){
            $this->id=$this->id;
            $this->datum=$this->datum;
            $this->uhrzeit=$this->uhrzeit;
            $this->titel=$this->titel;
            $this->beschr=$this->beschr;
        }
        public function getId(){
            return $this->id;
        }
        public function getDatum(){
            return $this->datum;
        }
        public function getUhrzeit(){
            return $this->uhrzeit;
        }
        public function getTitel(){
            return $this->titel;
        }
        public function getBeschr(){
            return $this->beschr;
        }
        public function setId($id){
            $this->id=$id;
        }
        public function setDatum($datum){
            $this->datum=$datum;
        }
        public function setUhrzeit($uhrzeit){
            $this->uhrzeit=$uhrzeit;
        }
        public function setTitel($titel){
            $this->titel=$titel;
        }
        public function setBeschr($beschr){
            $this->beschr=$beschr;
        }

        public function getSQLDatum(){
            $retValue;
            if($this->datum!=NULL){
                $tempDatumArr=explode(".", $this->datum);
                $retValue=$tempDatumArr[2]."-".$tempDatumArr[1]."-".$tempDatumArr[0];
            }
            else{
                $retValue=NULL;
            }
            return $retValue;
        }

        public function getSQLUhrzeit(){
            $retValue;
            if($this->uhrzeit!=NULL){
                $retValue=$this->datum.":00";
            }
            else{
                $retValue=NULL;
            }
            return $retValue;
        }

        public function vergleich2($Wert2){
            if(strcasecmp($this->datum,$Wert2->getDatum())==0){
                return true;
            }
            if(strcasecmp($this->uhrzeit, $Wert2->getUhrzeit())==0){
                return true;
            }
            if(strcasecmp($this->titel,$Wert2->getTitel())==0){
                return true;
            }
            if(strcasecmp($this->beschr, $Wert2->getBeschr())==0){
                return true;
            }
            return false;
        }

        public function vergleich3($Wert2){
            if(stripos($this->datum, $Wert2->getDatum())!==false){
                return true;
            }
            if(strstr($this->uhrzeit, $Wert2->getUhrzeit())!==false){
                return true;
            }
            if(stripos($this->titel,$Wert2->getTitel())!==false){
                return true;
            }
            if(stripos($this->beschr, $Wert2->getBeschr())!==false){
                return true;
            }
            return false;
        }
    }

?>