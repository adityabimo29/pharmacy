
          <ul class="sidebar-menu">
            <!-- <li class="header">Menu Utama</li> -->
			<?php if($_SESSION['leveladmin'] === 'admin') { ?>
            <li style="margin-top: 16px" class="<?php if($_GET['module']=='home'){echo "active";} ?>"><a href="home"><i class="fa fa-arrow-right"></i> <span>Dashboard</span></a></li>
			


            <li class="<?php if(($_GET['module']=='distributor')){echo "active";} ?>"><a href="distributor"><i class="fa fa-arrow-right"></i></i> <span>Distributor</span></a></li>

            <li class="<?php if(($_GET['module']=='obat')){echo "active";} ?>"><a href="obat"><i class="fa fa-arrow-right"></i></i> <span>Obat</span></a></li>

			<li class="<?php if(($_GET['module']=='pembelian')){echo "active";} ?>"><a href="pembelian"><i class="fa fa-arrow-right"></i></i> <span>Stok Obat</span></a></li>


			<li class="<?php if(($_GET['module']=='cek_stok')){echo "active";} ?>"><a href="cek-stok"><i class="fa fa-arrow-right"></i></i> <span>Cek Stok</span></a></li>


            <!-- <li class="<?php if(($_GET['module']=='page')AND($_GET['id']=='5')){echo "active";} ?>"><a href="page-edit-5"><i class="fa fa-envelope-o"></i></i> <span>cara pembayaran</span></a></li> -->


			

			<li class="<?php if(($_GET['module']=='penjualan')){echo "active";} ?>"><a href="penjualan"><i class="fa fa-arrow-right"></i> <span>Transaksi Penjualan</span></a></li>
			
			
			<li class="treeview <?php if(($_GET['module']=='laporan')OR($_GET['module']=='kategori')OR($_GET['module']=='subkategori')){echo "active";} ?>">
				<a href="#">
					<i class="fa fa-print"></i> <span>Laporan</span>
					<i class="fa fa-angle-right pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class="<?php if(($_GET['module']=='lap-pembelian')){echo "active";} ?>"><a href="lap-pembelian"><i class="fa fa-arrow-right" aria-hidden="true"></i> <span>Barang Masuk</span></a></li>

					<li class="<?php if(($_GET['module']=='lap-penjualan')){echo "active";} ?>"><a href="lap-penjualan"><i class="fa fa-arrow-right" aria-hidden="true"></i> <span>Penjualan</span></a></li>

					<!-- <li class="<?php if(($_GET['module']=='lap-stok')){echo "active";} ?>"><a href="lap-stok"><i class="fa fa-arrow-right" aria-hidden="true"></i> <span>Stok</span></a></li> -->
				</ul>
            </li>

            <li class="<?php if(($_GET['module']=='module')){echo "active";} ?>"><a href="module"><i class="fa fa-arrow-right"></i> <span>Module</span></a></li>
            <li class=""><a href="admin"><i class="fa fa-user"></i> <span>Admin</span></a></li>
            <li class="<?php if(($_GET['module']=='backup')){echo "active";} ?>"><a href="backup"><i class="fa fa-hdd-o"></i> <span>Backup Data</span></a></li>
			
			<?php } else if($_SESSION['leveladmin'] === 'gudang') { ?>
				<li style="margin-top: 16px" class="<?php if(($_GET['module']=='distributor')){echo "active";} ?>"><a href="distributor"><i class="fa fa-arrow-right"></i></i> <span>Distributor</span></a></li>

            	<li class="<?php if(($_GET['module']=='obat')){echo "active";} ?>"><a href="obat"><i class="fa fa-arrow-right"></i></i> <span>Obat</span></a></li>
				<li class="<?php if(($_GET['module']=='pembelian')){echo "active";} ?>"><a href="pembelian"><i class="fa fa-arrow-right"></i></i> <span>Stok Obat</span></a></li>
				<li class="<?php if(($_GET['module']=='cek_stok')){echo "active";} ?>"><a href="cek-stok"><i class="fa fa-arrow-right"></i></i> <span>Cek Stok</span></a></li>
				<li class="<?php if(($_GET['module']=='laporanStok')){echo "active";} ?>"><a href="modul/laporanStok/aksi.php?module=laporanStok&act=printLaporan" target=""><i class="fa fa-print"></i></i> <span>Laporan Stok</span></a></li>
			<?php }else { ?>
				<li style="margin-top: 16px" class="<?php if(($_GET['module']=='penjualan')){echo "active";} ?>"><a href="penjualan"><i class="fa fa-arrow-right"></i> <span>Transaksi Penjualan</span></a></li>
				<li class="<?php if(($_GET['module']=='cek_stok')){echo "active";} ?>"><a href="cek-stok"><i class="fa fa-arrow-right"></i></i> <span>Cek Stok</span></a></li>
				<li class="<?php if(($_GET['module']=='laporanApoteker')){echo "active";} ?>"><a href="modul/laporanApoteker/aksi.php?module=laporanApoteker&act=printLaporan" target=""><i class="fa fa-print"></i></i> <span>Laporan Harian</span></a></li>
			<?php } ?>
			 
          </ul>