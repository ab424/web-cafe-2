<?php 
    include('koneksi.php');
    session_start();
    if(!isset($_SESSION['login_user'])) {
        header("location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<body>
    <span id='id-pesanan' konten="<?= $_GET['id'] ?>"/>
    <div class='container mt-5'>
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <h4 class="text-center">Struk Pembelian</h4>
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pesanan</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Sub Harga</th>
                    </tr>
                </thead>
                <tbody>
                <?php $nomor=1; ?>
                <?php $totalbelanja = 0; ?>
                <?php 
                    $ambil = $koneksi->query("SELECT * FROM pemesanan_produk JOIN produk ON pemesanan_produk.id_menu=produk.id_menu 
                        WHERE pemesanan_produk.id_pemesanan='$_GET[id]'");
                ?>
                <?php while ($pecah=$ambil->fetch_assoc()) { ?>
                <?php $subharga1=$pecah['harga']*$pecah['jumlah']; ?>
                <tr>
                    <th scope="row"><?php echo $nomor; ?></th>
                    <td><?php echo $pecah['nama_menu']; ?></td>
                    <td>Rp. <?php echo number_format($pecah['harga']); ?></td>
                    <td><?php echo $pecah['jumlah']; ?></td>
                    <td>
                    Rp. <?php echo number_format($pecah['harga']*$pecah['jumlah']); ?>
                    </td>
                </tr>
                <?php $nomor++; ?>
                <?php $totalbelanja+=$subharga1; ?>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="4">Total Bayar</th>
                    <th>Rp. <?php echo number_format($totalbelanja) ?></th>
                </tr>
            </table>
            </div>
        </div>
    </div>
    <script>
        window.print()
        const id = document.querySelector("#id-pesanan")
        setTimeout(() => {
            window.location.href = "/cafe-legend/detail_pesanan.php?id=" + id.getAttribute("konten")
        }, 1000);
    </script>
</body>
</html>