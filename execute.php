<?php
    class Data{
        public $member;
        public $jenis;
        public $waktu;
        public $diskon;
        public $pajak;
        private $Vario,$Beat,$Nmax,$Mio;
        private $listMember = ['Christy','Sam','Alex','Ara'];

        function __construct(){
            $this->pajak = 10000;
        }

        public function getMember(){
            if(in_array($this->member, $this->listMember)){
                return "Member";
            }else{
                return "Non Member";
            }
        }

        public function setHarga($Jenis1,$Jenis2,$Jenis3,$Jenis4){
            $this->Vario = $Jenis1;
            $this->Beat = $Jenis2;
            $this->Nmax = $Jenis3;
            $this->Mio = $Jenis4;
        }

        public function getHarga(){
            $data['Vario'] = $this->Vario;
            $data['Beat'] = $this->Beat;
            $data['Nmax'] = $this->Nmax;
            $data['Mio'] = $this->Mio;
            return $data;
        }
    }

    class Rental extends Data {
        public function hargaRental(){
            $dataHarga = $this->getHarga()[$this->jenis];
            $diskon = $this->getMember() == "Member" ? 5 : 0;
            if($this->waktu === 1){
                $bayar = ($dataHarga - ($dataHarga * $diskon / 100)) + $this->pajak;
            }else{
                $bayar = (($dataHarga * $this->waktu) - ($dataHarga * $diskon/100)) + $this->pajak;
            }
            return [$bayar,$diskon];
        }

        public function pembayaran(){
            echo '<div style="border : 1px solid black; width: 40%; padding: 10px; margin: 10px;">';
            echo "<center>";
            echo $this->member . " berstatus sebagai " . $this->getMember() . " mendapatkan diskon sebesar " . $this->hargaRental()[1] . "%";
            echo "<br>";
            echo "Jenis motor yang dirental adalah" . $this->jenis . " selama " . $this->waktu . " hari";
            echo "<br>";
            echo "Harga rental per-harinya : Rp. " . number_format($this->getHarga()[$this->jenis],0,',','.');
            echo "<br>";
            echo "<br>";
            echo "Besar yang harus dibayarkan adalah Rp. " . number_format($this->hargaRental()[0], 0,',','.');
            echo "</center>";
            echo '</div>';
        }
    }  
?>