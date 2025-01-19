<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("location: ../login/login.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="./style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>

<body class="body bg-gray-100 min-h-screen flex flex-col">
    <header class="bg-gradient-to-br from-teal-900 to-green-700 text-white p-4 shadow flex">
        <h1 class="text-xl font-bold text-center flex-1">Aplikasi Management Keuangan</h1>
        <a href="./logout.php">
            <button class="bg-gray-100 text-black py-1 px-3 rounded-md hover:bg-green-800 hover:text-white shadow-lg">
                Logout
            </button>
        </a>
    </header>

    <main class="container mx-auto py-8 px-4 flex-1">

        <!-- Form Section -->
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h2 class="text-lg font-bold mb-4 text-center">Form Tambah Catatan</h2>
            <form class="space-y-4" action="./proses.php" method="post">
                <div>
                    <input type="hidden" name="id">
                </div>
                <div>
                    <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select id="kategori" class="border-2 ms-3" name="kategori">
                        <option value="1">Pengeluaran</option>
                        <option value="2">Pemasukan</option>
                    </select>
                </div>
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700">Nama Transaksi</label>
                    <input type="text" id="judul" name="judul" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div>
                    <label for="total" class="block text-sm font-medium text-gray-700">Nominal</label>
                    <input type="number" id="total" name="total" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div>
                    <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                    <textarea name="catatan" id="catatan" cols="100" class="border-2"></textarea>
                </div>
                <div class="flex justify-between">
                    <button type="submit" name="simpan" class="bg-blue-600 text-white py-1 px-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"> Tambah
                    </button>
                    <div class="flex items-center">
                        <a href="../informasi.php" class="flex justify-end">
                            <i class="fa-solid fa-backward me-1 mt-1"></i>
                            kembali
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <footer class="bg-gradient-to-br from-green-700 to-teal-700 text-white py-4 text-center">
        <p class="text-sm">Management Keuangan © 2025</p>
    </footer>
</body>

</html>