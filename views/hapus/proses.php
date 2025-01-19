<?php

require '../config.php';

if (@$_GET['aksi'] == 'hapus') {
  $id = $_GET['id'];

  mysqli_query($koneksi, "DELETE FROM transaksi WHERE id = $id ");

  echo "<script>
            alert('berhasil menghapus catatan');
            window.location.href = '../informasi.php';
          </script>";
  exit();
}
