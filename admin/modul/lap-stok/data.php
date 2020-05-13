<?php
include "../../../system/koneksi.php";
	
		$tampil = $pdo->query("SELECT * FROM obat  ")->fetchAll();
		

?>

<table>
    <thead>
        <th>Kode</th>
        <th>Nama</th>
        <th>Kode Distributor</th>
        <th>Stok</th>
    </thead>
    <tbody>
        <?php
            foreach($tampil as $row) :
        ?>
        <tr>
                <td><?php echo $row['kode_obat'] ?></td>
                <td><?php echo $row['nama_obat'] ?></td>
                <td><?php echo $row['kode_distributor'] ?></td>
                <td><?php echo $row['stok'] ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>