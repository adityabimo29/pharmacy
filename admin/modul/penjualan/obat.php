<?php

include "../../../system/config.php";
	
        //kolom apa saja yang akan ditampilkan
        $columns = array(
            'kode_obat',
            'nama_obat',
            'stok',
            'harga_jual'
            );
        
            //lakukan query data dari 3 table dengan inner join
            $query = $datatable->get_custom("SELECT o.kode_obat,o.nama_obat,o.stok,o.kode_distributor,MAX(d.harga_jual) AS harga_jual,MIN(d.expired) AS exp FROM obat o JOIN detail_pembelian d ON o.kode_obat = d.kode_obat GROUP BY o.nama_obat",$columns);
            $data = array();
			foreach($query as $a){
                //array sementara data
                $ResultData = array();
                //masukan data ke array sesuai kolom table
                $ResultData[] = $a->kode_obat;
                $ResultData[] = $a->nama_obat;
                $ResultData[] = $a->stok;
                $ResultData[] = $a->harga_jual;
                $ResultData[] = "<a   class='btn btn-warning btn-sm pilih-brg pilih'  >Pilih</a>";
                //memasukan array ke variable $data
            
                $data[] = $ResultData;
				
            }
            //set data
            $datatable->set_data($data);
            //create our json
            $datatable->create_data();
	
	



?>