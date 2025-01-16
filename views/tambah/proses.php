<?php

session_start();

require '../config.php';

if (isset($_POST['simpan'])) {
    $judul = htmlspecialchars($_POST['judul']);
    $kategori = (int) htmlspecialchars($_POST['kategori']); // Pastikan ini adalah angka (id_kategori)
    $total = (int) $_POST['total']; // Total di-cast ke integer
    $tanggal = $_POST['tanggal']; // Pastikan formatnya YYYY-MM-DD
    $catatan = htmlspecialchars($_POST['catatan']);

    $query = mysqli_prepare($koneksi, "INSERT INTO transaksi (judul, total, id_kategori, tanggal, catatan) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($query, 'siiss', $judul, $total, $kategori, $tanggal, $catatan);

    if (mysqli_stmt_execute($query)) {
        echo "<script>
                alert('Berhasil menambahkan catatan');
                window.location.href = '../index.php';
              </script>";
    } else {
        die("Error: " . mysqli_error($koneksi));
    }
    exit();
}
