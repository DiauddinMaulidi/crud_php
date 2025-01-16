<?php

require('../library/fpdf.php'); // Include library FPDF
require('./config.php');       // Include koneksi database
require('./sisaUang.php');     // Include fungsi sisa uang

class PDF extends FPDF
{
    // Header dokumen
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Laporan Keuangan', 0, 1, 'C');
        $this->Ln(10);
    }

    // Footer dokumen
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'File ini dibuat oleh aplikasi catatan keuangan', 0, 1, 'C');
        $this->Cell(0, 5, 'Download: https://play.google.com/store/apps/details?id=com.chad.financialrecord', 0, 0, 'C');
    }
}

// Buat instance PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Header tabel
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 10, 'No', 1, 0, 'C');
$pdf->Cell(40, 10, 'Nama Transaksi', 1, 0, 'C');
$pdf->Cell(30, 10, 'Nominal', 1, 0, 'C');
$pdf->Cell(30, 10, 'Kategori', 1, 0, 'C');
$pdf->Cell(30, 10, 'Tanggal', 1, 0, 'C');
$pdf->Cell(50, 10, 'Catatan', 1, 1, 'C');

// Ambil data dari database
$query = mysqli_query($koneksi, "SELECT * FROM transaksi t JOIN kategori k ON t.id_kategori = k.id_kategori");

$no = 1;
$total_pemasukan = 0;
$total_pengeluaran = 0;

while ($row = mysqli_fetch_assoc($query)) {
    // Hitung total pemasukan dan pengeluaran
    if ($row['id_kategori'] == 2) {
        $total_pemasukan += $row['total'];
    } else if ($row['id_kategori'] == 1) {
        $total_pengeluaran += $row['total'];
    }

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(10, 10, $no++, 1, 0, 'C');
    $pdf->Cell(40, 10, $row['judul'], 1, 0, 'L');
    $pdf->Cell(30, 10, 'Rp. ' . number_format($row['total'], 0, ',', '.'), 1, 0, 'R');
    $pdf->Cell(30, 10, ucfirst($row['nama_kategori']), 1, 0, 'C');
    $pdf->Cell(30, 10, $row['tanggal'], 1, 0, 'C');
    $pdf->MultiCell(50, 10, $row['catatan'], 1, 'L');
}

// Hitung sisa uang
$sisa_uang = $total_pemasukan - $total_pengeluaran;

$pdf->Ln(10);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Total pemasukan = Rp. ' . number_format($total_pemasukan, 0, ',', '.'), 0, 1);
$pdf->Cell(0, 10, 'Total pengeluaran = Rp. ' . number_format($total_pengeluaran, 0, ',', '.'), 0, 1);
$pdf->Cell(0, 10, 'Sisa uang = Rp. ' . number_format($sisa_uang, 0, ',', '.'), 0, 1);

// Output PDF
$pdf->Output('D', 'Laporan_Keuangan.pdf');
