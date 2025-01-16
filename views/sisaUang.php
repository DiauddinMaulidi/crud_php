<?php

function sisaUang($id_transaksi)
{
    global $koneksi;

    // Query untuk menghitung total pemasukan
    $pemasukan = mysqli_query($koneksi, "SELECT SUM(t.total) as total FROM transaksi t JOIN kategori k ON t.id_kategori = k.id_kategori WHERE k.nama_kategori = 'pemasukan' AND t.id <= $id_transaksi");
    if (!$pemasukan) {
        die("Error pada query pemasukan: " . mysqli_error($koneksi));
    }
    $total_pemasukan = mysqli_fetch_assoc($pemasukan)['total'] ?? 0;

    // Query untuk menghitung total pengeluaran
    $pengeluaran = mysqli_query($koneksi, "SELECT SUM(t.total) as total FROM transaksi t JOIN kategori k ON t.id_kategori = k.id_kategori WHERE k.nama_kategori = 'pengeluaran' AND t.id <= $id_transaksi");
    if (!$pengeluaran) {
        die("Error pada query pengeluaran: " . mysqli_error($koneksi));
    }
    $total_pengeluaran = mysqli_fetch_assoc($pengeluaran)['total'] ?? 0;

    // Hitung sisa uang
    $total = $total_pemasukan - $total_pengeluaran;

    return $total < 0 ? 0 : $total;
}
