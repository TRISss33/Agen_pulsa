<?php
require 'functions.php';
$pdo = pdo_connect_mysql();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $no_ktp = $_POST['no_ktp'];
    $alamat = $_POST['alamat'];
    $jenis_keanggotaan = $_POST['jenis_keanggotaan'];

    $stmt = $pdo->prepare('UPDATE agen_pulsa SET nama_lengkap = ?, tanggal_lahir = ?, no_ktp = ?, alamat = ?, jenis_keanggotaan = ? WHERE id = ?');
    $stmt->execute([$nama, $tanggal_lahir, $no_ktp, $alamat, $jenis_keanggotaan, $id]);

    header('Location: index.php');
    exit;
} else {
    exit('No ID specified.');
}
?>
