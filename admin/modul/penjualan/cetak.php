<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css">
        <title>Struk Penjualan</title>
    </head>
    <body>
        <div class="ticket">
            <!-- <img src="./logo.png" alt="Logo"> -->
            <p class="centered">Faktur Penjualan
                <br><?php echo $namaweb ?>
                <br><?php echo $deskrip[2] ?></p>
            <table>
                <thead>
                    <tr>
                        <th class="quantity">Q.</th>
                        <th class="description">Description</th>
                        <th class="price">$$</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($_SESSION['print_penjualan'] as $row) : ?>
                    <tr>
                        <td class="quantity"><?php echo $row['qty'] ?></td>
                        <td class="description"><?php echo $row['nama_obat'] ?></td>
                        <td class="price"><?php echo $row['sub_total'] ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <p class="centered">Terima Kasih Telah Membeli
                <br><?php echo $namaweb ?></p>
        </div>
        <button id="btnPrint" class="hidden-print">Print</button>
        <script src="script.js"></script>
    </body>
</html>