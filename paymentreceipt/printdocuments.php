<?php 
include '../koneksidb.php';
// Include the main TCPDF library (search for installation path).
require_once('../TCPDF/tcpdf.php');

$id = $_GET['id'];
$tgl = $_GET['tgl'];

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// add a page
$pdf->getPageDimensions();
$pdf->AddPage();
$pdf->SetFont('times', '', 11);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('AMIRUL PUTRA JUSTICIA');
$pdf->SetTitle('Purchase Requisition');
$pdf->SetSubject('TCPDF GENERAL AFFARIS DEPARTMENT');


// set font
// $pdf->SetFont('helvetica', 'B', 10);
// $pdf->SetFont('times', '', 11);

// Title
$pdf->Ln();
$pdf->MultiCell(0, 10, 'PT. ASI PUDJIASTUTI AVIATION', 0, 'C', 0, 0, '', '', true);
$pdf->Ln();
$pdf->MultiCell(0, 14, 'PURCHASE REQUISITION', 0, 'C', 0, 0, '', '', true);
$pdf->Ln();
$pdf->MultiCell(0, 7, 'PR no : '.$id.'/'.$tgl, 0, 'C', 0, 0, '', '', true);
$pdf->Ln();
$pdf->MultiCell(0, 10, 'To : General Affair Department', 0, 'L', 0, 0, '', '', true);
$pdf->Ln();
$pdf->MultiCell(0, 10, 'UP', 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(0, 10, 'Date : '.date('d-M-y'), 0, 'R', 0, 0, '', '', true);
$pdf->Ln();
$pdf->MultiCell(0, 10, 'Received by GA : '.date('d-M-y'), 0, 'R', 0, 0, '', '', true);
$pdf->Ln(20);

// add table
// $pdf->SetFont('helvetica', '', 5);
$pdf->SetFont('times', '', 11);
// $pdf->AddPage();

// table header
$pdf->Cell(10, 7, 'No', 1, 0, 'C', 0, '', 0, false, 'M', 'M');
$pdf->Cell(60, 7, 'Description', 1, 0, 'C', 0, '', 0, false, 'M', 'M');
$pdf->Cell(15, 7, 'Jumlah', 1, 0, 'C', 0, '', 0, false, 'M', 'M');
$pdf->Cell(20, 7, 'Satuan', 1, 0, 'C', 0, '', 0, false, 'M', 'M');
$pdf->Cell(30, 7, 'Harga', 1, 0, 'C', 0, '', 0, false, 'M', 'M');
$pdf->Cell(30, 7, 'Total', 1, 0, 'C', 0, '', 0, false, 'M', 'M');
$pdf->Cell(30, 7, 'Usage', 1, 1, 'C', 0, '', 0, false, 'M', 'M');

$no = 1;
// load data from database
$query = mysqli_query($koneksi, "SELECT 
GApayment_id, 
keterangandepartment, 
usagegeneralaffair, 
deskripsi_items, 
jumlah_items, 
keterangansatuan, 
hargaitems, 
(jumlah_items*hargaitems) AS total_harga,
CASE STATUS  
WHEN 'Checked' THEN 'Checked'  
WHEN 'Processed' THEN 'Processed'  
WHEN 'Pending' THEN 'Pending'  
WHEN 'Cancelled' THEN 'Cancelled'  
WHEN 'Finished' THEN 'Finished'
END AS statustransaksi
FROM paymentreceipt_apps.generalaffairspayment LEFT JOIN department on generalaffairspayment.department_id = department.department_id LEFT JOIN satuan ON generalaffairspayment.units_id = satuan.unit_id  
WHERE request_id = '$id'
-- GROUP BY keterangandepartment ORDER BY request_id ASC LIMIT 0, 1000 

");

// loop through data and add to table
$total_harga = 0;
// if (mysqli_num_rows($query) > 0) {
while($row = mysqli_fetch_array($query)) {
$pdf->Cell(10, 7, $no, 1, 0, 'C', 0);
$pdf->Cell(60, 7, $row['deskripsi_items'], 1, 0, 'L', 0);
$pdf->Cell(15, 7, $row['jumlah_items'], 1, 0, 'C', 0);
$pdf->Cell(20, 7, $row['keterangansatuan'], 1, 0, 'C', 0);
$pdf->Cell(30, 7, 'Rp '.number_format($row['hargaitems'], 0, ',', '.'), 1, 0, 'R', 0);
$pdf->Cell(30, 7, 'Rp '.number_format($row['total_harga'], 0, ',', '.'), 1, 0, 'R', 0);
$pdf->Cell(30, 7, $row['usagegeneralaffair'], 1, 1, 'C', 0);
$no++;
$total_harga += $row['total_harga'];
$keterangan = $row['keterangandepartment'];
    }
// }
// else {
//     $pdf->Cell(0, 10, 'Data tidak ditemukan', 1, 1, 'C', 0);
// }

// add total harga at the end of table
$pdf->Cell(135, 7, 'Total Harga', 1, 0, 'C', 0);
$pdf->Cell(30, 7, 'Rp '.number_format($total_harga, 0, ',', '.'), 1, 0, 'R', 0);
$pdf->Cell(30, 7, '', 1, 1, 'C', 0);
$pdf->Ln();
//$pdf->Cell(30, 7, '', 1, 1, 'C', 0);

// Signature
$pdf->Cell(60, 7, 'Prepared by :', 0, 0, 'L', 0);
$pdf->Cell(60, 7, 'Approved by :', 0, 0, 'C', 0);
$pdf->Cell(60, 7, 'Approved by :', 0, 1, 'C', 0);
$pdf->Ln(30);
$pdf->Cell(60, 7, $keterangan, 0, 0, 'L', 0);
$pdf->Cell(60, 7, 'General Affairs Department', 0, 0, 'C', 0);
$pdf->Cell(60, 7, 'Manager/Director in Charge', 0, 1, 'C', 0);
$pdf->Cell(0, 15, '', 0, 1, 'C', 0);
$pdf->Cell(0, 15, '', 0, 1, 'C', 0);


// output the pdf
$pdf->Output('Purchase Requisition.pdf', 'I');

// close connection to the database
mysqli_close($koneksi);

?>