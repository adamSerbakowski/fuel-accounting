<?php

class Purchase {
    public $dostawca;
        public $nr_dokumentu;
        public $ilosc_paliwa;
        public $ilosc_adblue;
        public $data_zakupu;
    public function __construct($dostawca,$nr_dokumentu,$ilosc_paliwa,$ilosc_adblue,$data_zakupu) {
        $this->dostawca = $dostawca;
        $this->nr_dokumentu = $nr_dokumentu;
        $this->ilosc_paliwa = $ilosc_paliwa;
        $this->ilosc_adblue = $ilosc_adblue;
        $this->data_zakupu = $data_zakupu;
    }
}