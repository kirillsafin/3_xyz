<?php
class Monat{
        private $days;
        private $firstDay;
        private $monthName;

        public function __construct($days, $firstDay, $monthName){
            $this->days=$days;
            $this->firstDay=$firstDay;
            $this->monthName=$monthName;
        }

        public function __clone(){
            $this->days=$this->days;
            $this->firstDay=$this->firstDay;
            $this->monthName=$this->monthName;
        }

        public function getDays(){
            return $this->days;
        }

        public function getFirstDay(){
            return $this->fistDay;
        }

        public function getMonthName(){
            return $this->monthDay;
        }

        public function setDays($days){
            $this->days=days;
        }
        public function setFirstDay($firstDay){
            $this->firstDay=firstDay;
        }
        public function setMonthName($monthName){
            $this->monthName=$monthName;
        }
    } //end class Monat

    class Day{
        private $id;
        private $datum;
        private $uhrzeit;
        private $titel;
        private $beschr;

        public function __construct($id, $datum, $uhrzeit, $titel, $beschr){
            $this->id=$id;
            $this->datum=$datum;
            $this->uhrzeit=$uhrzeit;
            $this->titel=$titel;
            $this->beschr=$beschr;
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
    }

?>