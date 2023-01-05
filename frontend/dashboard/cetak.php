<?php
session_start();
require '../../backend/function.php';
// Include the FPDF library
require('fpdf/fpdf.php');

$tgl_awal = $_SESSION['tgl_awal'];
// var_dump($tgl_awal);
// die;
$tgl_akhir = $_SESSION['tgl_akhir'];

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetFont('Times', 'B', 13);
$pdf->Cell(200, 10, 'APOTIK X', 0, 0, 'C');
$pdf->SetFont('Times');
$pdf->Cell(0, 5, '', 0, 1);
$pdf->Cell(200, 10, 'Jl. Rungkut Lor RL 1C/11 Surabaya, Telp.081234174423', 0, 0, 'C');
$pdf->Cell(0, 5, '', 0, 1);
$pdf->Cell(200, 10, 'SIA : 503.445/SIA/436.6.3/P/II/2022', 0, 0, 'C');
$pdf->Line(200, 30, 10, 30);
$pdf->Cell(0, 15, '', 0, 1);
// 
// 
$pdf->SetFont('Times', 'B', 13);
$pdf->Cell(200, 10, 'LAPORAN PENJUALAN ' . date("d/m/Y", strtotime("$tgl_awal")) . ' - ' . date("d/m/Y", strtotime("$tgl_akhir")), 0, 0, 'C');


$pdf->Cell(10, 15, '', 0, 1);
$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(10, 7, 'NO', 1, 0, 'C');
$pdf->Cell(40, 7, 'ID TRANSAKSI', 1, 0, 'C');
$pdf->Cell(40, 7, 'NAMA OBAT', 1, 0, 'C');
$pdf->Cell(20, 7, 'JUMLAH', 1, 0, 'C');
$pdf->Cell(50, 7, 'TOTAL HARGA', 1, 0, 'C');
$pdf->Cell(30, 7, 'TANGGAL', 1, 0, 'C');


$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Times', '', 10);
$no = 1;

$data = query("SELECT * from transaksi where tanggal between '$tgl_awal' and '$tgl_akhir'");
foreach ($data as $row) {
    $obat = $row['id_obat'];
    $sql = query("SELECT nama_obat from barang where id_obat='$obat'");
    $pdf->Cell(10, 6, $no++, 1, 0, 'C');
    $pdf->Cell(40, 6, $row['id_transaksi'], 1, 0, 'C');
    $pdf->Cell(40, 6, $sql[0]['nama_obat'], 1, 0, 'C');
    $pdf->Cell(20, 6, $row['jumlah'], 1, 0, 'C');
    $pdf->Cell(50, 6, 'Rp.' .  number_format($row['total_harga']), 1, 0, 'C');
    // date("d/m/Y", strtotime("$tgl_awal"))
    // $pdf->Cell(30, 6, $row['tanggal'], 1, 1, 'C');
    $tanggal = $row['tanggal'];
    $pdf->Cell(30, 6, date("d/m/Y", strtotime("$tanggal")), 1, 1, 'C');
}
$pdf->Cell(0, 0, '', 0, 1);
$pdf->Cell(190, 15, 'Pekanbaru, ' . date("d-m-Y"), 0, 0, 'R');
$pdf->Cell(0, 7, '', 0, 1);
$pdf->Cell(190, 10, 'Mengetahui', 0, 0, 'R');
$pdf->Cell(10, 15, '', 0, 1);
$pdf->Cell(190, 10, 'M. WIRA ADE KUSUMA', 0, 0, 'R');

$pdf->Cell(0, 4, '', 0, 1);
$pdf->Cell(190, 10, 'MANAJER PUSAT', 0, 0, 'R');
// Output the document as a PDF file
$pdf->Output();
