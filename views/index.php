<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("location: ./login/login.php");
    exit();
}

require './config.php';
require('./sisaUang.php');

$query = mysqli_query($koneksi, 'SELECT total, tanggal FROM transaksi');

$dataTransaksi = [];
while ($data = mysqli_fetch_assoc($query)) {
    $dataTransaksi[] = $data;
}

$dataTanggal = array_map(function ($item) {
    return $item['tanggal'];
}, $dataTransaksi);

$dataNominal = array_map(function ($item) {
    return (int)$item['total'];
}, $dataTransaksi);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="./style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            <div style="width: 80%; margin: auto;">
                <canvas id="chart"></canvas>
            </div>
        </div>
    </main>

    <footer class="bg-gradient-to-br from-green-700 to-teal-700 text-white py-4 text-center">
        <p class="text-sm">Management Keuangan © 2025</p>
    </footer>
    <script>
        const ctx = document.getElementById('chart').getContext('2d');

        const tanggal = <?php echo json_encode($dataTanggal); ?>;
        const nominal = <?php echo json_encode($dataNominal); ?>;

        // Data untuk chart
        const data = {
            labels: tanggal,
            datasets: [{
                label: 'keuangan',
                data: nominal,
                fill: true,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                tension: 0.4,
            }]
        };

        // Opsi untuk chart
        const options = {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Laporan Keuangan',
                    font: {
                        size: 24,
                        weight: 'bold',
                        family: 'Arial',
                    },
                },
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'waktu',
                    },
                },
                y: {
                    title: {
                        display: true,
                        text: 'nominal (dalam ribuan)',
                    },
                    beginAtZero: true, // Mulai dari nol
                },
            },
        };

        // Buat chart
        new Chart(ctx, {
            type: 'line', // Jenis chart (line digunakan untuk area chart)
            data: data,
            options: options,
        });
    </script>
</body>

</html>


<!-- register : https://youtu.be/TCmQNHFN5Ag -->
<!-- login : https://youtu.be/lIW6Q07EGPM -->
<!-- crud : https://youtu.be/K-KV9p4nmW4 -->