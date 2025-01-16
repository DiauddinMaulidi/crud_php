<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Manajemen Keuangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="bg-gradient-to-br from-teal-900 to-green-700 h-screen flex items-center justify-center">
    <div class="w-full max-w-4xl bg-teal-800 rounded-lg shadow-lg flex">
        <!-- Bagian Kiri -->
        <div class="w-1/2 p-8 bg-black text-white rounded-l-lg flex flex-col justify-center">
            <h1 class="text-3xl font-bold mb-6">Login</h1>
            <p class="text-sm mb-6">Silakan login menggunakan akun Anda</p>
            <form method="POST" action="./proses.php">
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium">Email</label>
                    <input type="email" id="email" name="email" class="w-full mt-2 p-3 rounded bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="contoh@gmail.com">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium">Kata Sandi</label>
                    <input type="password" id="password" name="password" class="w-full mt-2 p-3 rounded bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500">
                </div>
                <div class="flex justify-between items-center mb-4">
                    <a href="#" class="text-sm text-teal-400 hover:underline">Lupa Kata Sandi?</a>
                </div>
                <button type="submit" class="w-full bg-teal-600 hover:bg-teal-500 text-white py-2 px-4 rounded focus:outline-none">Masuk</button>
            </form>
            <div class="mt-6 flex justify-end items-center">
                <a href="../register/register.php" class="text-sm text-teal-400 hover:underline">Buat Akun Baru</a>
            </div>
        </div>

        <!-- Bagian Kanan -->
        <div class="w-1/2 p-8 bg-teal-100 rounded-r-lg flex flex-col justify-between relative">
            <h2 class="text-2xl font-semibold text-teal-900">Selamat Datang di aplikasi pengatur keuangan</h2>
            <blockquote class="mb-20 text-sm mt-4 text-gray-700">"Jadilah lebih bijak dalam mengelola pemasukan dan pengeluaran Anda. Mulailah perencanaan keuangan pribadi yang tepat hari ini."</blockquote>
            <div class="mt-8 bg-white p-4 rounded shadow-lg">
                <div class="chart-container">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Jenis grafik: Bar Chart
        const ctx = document.getElementById('barChart').getContext('2d');
        const barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                // Label kategori
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei'],
                datasets: [{
                        label: 'Pemasukan',
                        data: [5, 10, 15, 20, 25], // Data pemasukan
                        backgroundColor: '#66b3ff', // Warna batang pemasukan
                        borderColor: '#4682b4', // Border batang pemasukan
                        borderWidth: 1
                    },
                    {
                        label: 'Pengeluaran',
                        data: [10, 5, 20, 15, 25], // Data pengeluaran
                        backgroundColor: '#ff9999', // Warna batang pengeluaran
                        borderColor: '#b22222', // Border batang pengeluaran
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top' // Posisi legenda
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = context.raw.toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                });
                                return `${context.dataset.label}: ${value}`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Bulan',
                            font: {
                                weight: 'bold'
                            }
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Nominal (IDR)',
                            font: {
                                weight: 'bold'
                            }
                        },
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                });
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>