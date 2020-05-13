<?php
	function tgl3($tgl2){
			//2018-12-23 16:07:10.000000
			$jam = substr($tgl2,11,5);
			$tanggal = substr($tgl2,8,2);
			$bulan = getBulan3(substr($tgl2,5,2));
			$tahun = substr($tgl2,0,4);
			return $tanggal.' '.$bulan.' '.$tahun.' '.$jam;		 
	}

	function getBulan3($bln){
				switch ($bln){
					case 1: 
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}
			} 
?>
