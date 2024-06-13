<?php
require 'functions.php';

// Membuat koneksi ke database
$pdo = pdo_connect_mysql();

// Memeriksa apakah data telah dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form
    $nama = $_POST['nama'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $no_ktp = $_POST['no_ktp'];
    $alamat = $_POST['alamat'];
    $jenis_keanggotaan = $_POST['jenis_keanggotaan'];

    // Membuat query SQL untuk memasukkan data baru
    $sql = "INSERT INTO agen_pulsa (nama_lengkap, tanggal_lahir, no_ktp, alamat, jenis_keanggotaan) 
            VALUES (:nama_lengkap, :tanggal_lahir, :no_ktp, :alamat, :jenis_keanggotaan)";

    // Menyiapkan dan mengeksekusi query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nama_lengkap' => $nama,
        ':tanggal_lahir' => $tanggal_lahir,
        ':no_ktp' => $no_ktp,
        ':alamat' => $alamat,
        ':jenis_keanggotaan' => $jenis_keanggotaan,
    ]);

    // Redirect kembali ke halaman utama setelah berhasil memasukkan data
    header('Location: index.php');
    exit;
}
