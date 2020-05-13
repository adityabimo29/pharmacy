<?php

include "../../../system/config.php";
$id = $_POST['id'];
	
        //kolom apa saja yang akan ditampilkan
        $columns = array(
            'kode_obat',
            'nama_obat',
            );
        
            //lakukan query data dari 3 table dengan inner join
            $query = $datatable->get_custom("SELECT id_obat,kode_obat,nama_obat,stok FROM obat WHERE kode_distributor ='$id' ",$columns);
            $data = array();
			foreach($query as $a){
                //array sementara data
                $ResultData = array();
                //masukan data ke array sesuai kolom table
                $ResultData[] = $a->kode_obat;
                $ResultData[] = $a->nama_obat;
                $ResultData[] = $a->stok;
                $ResultData[] = "<a href='pembelian-add-$a->kode_obat'  class='btn btn-warning btn-sm pilih-brg'  >Pilih</a>";
                //memasukan array ke variable $data
            
                $data[] = $ResultData;
				
            }
            //set data
            $datatable->set_data($data);
            //create our json
            $datatable->create_data();
	
	



?>