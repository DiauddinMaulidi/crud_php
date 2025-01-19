<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("location: ./login/login.php");
    exit();
}

require './config.php';
require('./sisaUang.php')

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Informasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="./style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>

<body class="body bg-gradient-to-br from-teal-900 to-green-700 min-h-screen flex flex-col">
    <nav class="shadow-md">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex shrink-0 items-center">
                        <img class="h-12 w-auto" src="./logo.png" alt="my logo">
                        <h1 class="text-white">Management Keuangan</h1>
                    </div>
                </div>
                <div class="absolute items-center sm:static sm:pr-0">
                    <a href="./index.php" class="rounded-md mr-3 px-3 py-2 text-sm font-medium text-gray-300 hover:bg-teal-700 hover:shadow-md hover:text-white">Dashboard</a>
                    <a href="./informasi.php" class="rounded-md mr-3 px-3 py-2 text-sm font-medium text-gray-300 hover:bg-teal-700 hover:shadow-md hover:text-white">Informasi</a>
                    <a href="./logout.php">
                        <button class="bg-gray-100 text-black py-1 px-3 rounded-md hover:bg-teal-800 hover:text-white shadow-lg">
                            Logout
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto py-8 px-4 flex-1">
        <!-- Table Section -->
        <div class="bg-teal-100 p-6 rounded-lg shadow">
            <div class="flex">
                <h2 class="flex-1 text-lg font-bold mb-5">Informasi Keuangan</h2>
                <h2 class="text-lg text-gray-600 font-bold me-5">
                    <i class="fa-solid fa-user me-1"></i> <?= $_SESSION['nama'] ?>
                </h2>
            </div>
            <a href="./tambah/index.php">
                <button class="bg-green-600 text-white py-1 px-3 rounded-md text-sm mb-3 hover:bg-green-700">
                    <i class="fa-solid fa-square-plus"></i> Tambah Catatan
                </button>
            </a>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse border border-gray-300" id="dtabel">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">No</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">Nama Transaksi</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">Nominal</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">Kategori</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">Tanggal</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">Catatan</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">Sisa Uang</th>
                            <th class="border border-gray-300 px-4 py-2 text-center text-sm font-medium text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $keuangan = mysqli_query($koneksi, "SELECT * FROM transaksi");
                        while ($uang = mysqli_fetch_assoc($keuangan)) {
                            if ($uang['id_kategori'] == 1) {
                                $uang['id_kategori'] = 'pengeluaran';
                            } else {
                                $uang['id_kategori'] = 'pemasukan';
                            }
                        ?>
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2"><?= $no++; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= $uang['judul']; ?></td>
                                <td class="border border-gray-300 px-4 py-2">Rp.<?= number_format($uang['total'], 0, ',', '.') ?>,00</td>
                                <td class="border border-gray-300 px-4 py-2"><?= $uang['id_kategori']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= $uang['tanggal']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= $uang['catatan']; ?></td>
                                <td class="border border-gray-300 px-4 py-2">Rp.<?= number_format(sisaUang($uang['id']), 0, ',', '.') ?>,00</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <a href="./edit/index.php?id=<?= $uang['id'] ?>">
                                        <button class="relative group bg-yellow-500 text-white py-1 px-3 rounded-md text-sm hover:bg-yellow-600" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </a>
                                    <a href="./hapus/proses.php?id=<?= $uang['id'] ?>&aksi=hapus">
                                        <button
                                            class="relative group bg-red-500 text-white py-1 px-3 rounded-md text-sm hover:bg-red-600" title="Hapus">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="flex float-right mt-[-40px]">
                    <a href="download.php" target="_blank">
                        <button class="bg-teal-600 text-white py-1 px-3 rounded-md text-sm mb-3 hover:bg-green-700">
                            <i class="fa-solid fa-download mr-2"></i>Download
                        </button>
                    </a>
                </div>

            </div>
        </div>
    </main>

    <footer class="bg-gradient-to-br from-green-700 to-teal-700 text-white py-4 text-center">
        <p class="text-sm">Management Keuangan © 2025</p>
    </footer>
    <script>
        $(document).ready(function() {
            $('#dtabel').DataTable();
        });
    </script>
</body>

</html>