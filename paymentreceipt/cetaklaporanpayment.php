<?php
// include '../koneksidb.php';
include '../koneksidb.php';
$id = $_GET['GApayment_id'];
// $query = mysqli_query($koneksi, "SELECT * FROM generalaffairspayment WHERE GApayment_id = '$id'");
$queryview = mysqli_query($koneksi, "SELECT GApayment_id, keterangandepartment, usagegeneralaffair, deskripsi_items, jumlah_items, keterangansatuan, hargaitems, (jumlah_items*hargaitems) AS total_harga FROM paymentreceipt_apps.generalaffairspayment LEFT JOIN department on generalaffairspayment.department_id = department.department_id LEFT JOIN satuan ON generalaffairspayment.units_id = satuan.unit_id WHERE GApayment_id = '$id' GROUP BY keterangandepartment ORDER BY GApayment_id ASC LIMIT 0, 1000 ");
$row = mysqli_fetch_array($queryview);
// tampilkan data di halaman cetak
?>

<!DOCTYPE html>
<html>
<head>
  <title>Laporan Purchase Requisition</title>
  <style>
    /* Styling untuk judul dan subjudul */
    .modal-title {
      font-size: 20px;
      font-weight: bold;
    }
    /* Styling untuk tabel */
    /* table {
      border-collapse: collapse;
      width: 100%;
    } */
    /* th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    } */
    /* th {
      background-color: #f2f2f2;
    } */
    /* Styling untuk tombol cetak */
    /* .btn {
      padding: 10px 20px;
      font-size: 18px;
      margin-bottom: 20px;
    } */
    table {
  border-collapse: collapse;
  width: 100%;
}
th, td {
  border: 1px solid black;
  padding: 8px;
  text-align: center;
}
.th-border {
  border: 1px solid black;
  background-color: #f2f2f2;
}
.signature {
  font-size: 12px;
  text-align: center;
}

  </style>
</head>
<body>
  <h6 class="modal-title text-left"><b> PT. ASI PUDJIASTUTI AVIATION </b></h6><br><br>
  <h3 class="modal-title text-center" align="center"><b> PURCHASE REQUISITION </b></h3><br><br>
  <!-- <button type="button" class="btn btn-primary" onclick="printReport(<?php echo $row['GApayment_id'];?>)">Cetak</button> -->
  <button type="button" class="btn btn-primary" onclick="window.print()">Cetak</button>
  <p class="modal-title text-end" align="left"><b>To : General Affair Department</b></p>
  <p class="modal-title text-end" align="left"><b>&emsp;&emsp;UP</b></p>
  <p class="modal-title text-end" align="right"><b>Date : <?php echo date('d-M-Y'); ?></b></p>
  <p class="modal-title text-end" align="right"><b>Received by GA : <?php echo date('d-M-Y'); ?></b></p>
  <div class="modal-body">
    <div class="">
      <div class="row justify-content-center">
        <div class="col">
          <table class="table table-responsive table-bordered table-striped table-hover hover table-striped" border="2">
            <thead>
              <tr>
                <th class="th-border">No</th>
                <th class="th-border">Description</th>
                <th class="th-border">Jumlah</th>
                <th class="th-border">Satuan</th>
                <th class="th-border">Harga</th>        
                <th class="th-border">Total</th>
                <th class="th-border">Usage</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
                $queryview = mysqli_query($koneksi, "SELECT 
                GApayment_id, 
                keterangandepartment, 
                usagegeneralaffair, 
                deskripsi_items, 
                jumlah_items, 
                keterangansatuan, 
                hargaitems, 
                (jumlah_items*hargaitems) AS total_harga 
                FROM paymentreceipt_apps.generalaffairspayment 
                LEFT JOIN department on generalaffairspayment.department_id = department.department_id 
                LEFT JOIN satuan ON generalaffairspayment.units_id = satuan.unit_id 
                WHERE GApayment_id = '$id' 
                GROUP BY keterangandepartment 
                ORDER BY GApayment_id ASC LIMIT 0, 1000 ");
                $total_harga = 0;
                while($row = mysqli_fetch_array($queryview)) {
                    echo "<tr>";
                    echo "<td>" . $no . "</td>";
                    echo "<td>" . $row['deskripsi_items'] . "</td>";
                    echo "<td>" . $row['jumlah_items'] . "</td>";
                    echo "<td>" . $row['keterangansatuan'] . "</td>";
                    echo "<td>Rp " . number_format($row['hargaitems'], 0, ',', '.') . "</td>";
                    echo "<td>Rp " . number_format($row['total_harga'], 0, ',', '.') . "</td>";
                    echo "<td>" . $row['usagegeneralaffair'] . "</td>";
                    echo "</tr>";
                    $no++;
                    $total_harga += $row['total_harga'];
                    // $keterangandepartment = $_GET['keteangandeparment'];
                    $keterangandepartment = $row['keterangandepartment'];
                }
                
    echo "<tr>";
    echo "<td colspan='5' align='center'>TOTAL</td>";
    echo "<td>Rp ". number_format($total_harga, 0, ',', '.') ."</td>";
    echo "</tr>";
                ?>
        </tbody>
    </table>
    <br>
    <tr align="center">
        <td class="signature" colspan="3" align="left"><b>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Prepared by : </b></td>
        <td class="signature" colspan="3" align="center"><b>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Approved by : </b></td>
        <td class="signature" colspan="3" align="center"><b>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Approved by : </b></td>
      </tr>
      <tr align="center">
        <td class="signature" colspan="6" align="center"><br><br><br></td>
        <td class="signature" colspan="6" align="center"><br><br><br> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Manager/Director in Charge &emsp;&emsp;&emsp;General Affairs Department</td>
        <!-- <td class="signature" colspan="6" align="center"><br><br><br> General Affairs Department</td> -->
      </tr>
      
      <script>
  function printReport() {
    window.print();
  }
</script>

</body>
</html>

