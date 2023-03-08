<?php
include '../koneksidb.php';

$department = mysqli_query($koneksi, "SELECT 
  department_id,
  nama_department,
  keterangandepartment 
  FROM paymentreceipt_apps.department
  ");
  while($d = mysqli_fetch_array($department)){
    echo '<option value="'.$d['department_id'].'">';
    echo $d['nama_department'];
    echo '</option>';
  }
?>
