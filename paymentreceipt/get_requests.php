<?php
include '../koneksidb.php';

if(isset($_POST['department_id'])){
  $department_id = $_POST['department_id'];
  $requests = mysqli_query($koneksi, "SELECT 
  request_id,
  nama_request 
  FROM paymentreceipt_apps.requests
  WHERE department_id = '$department_id'
  ");
  while($r = mysqli_fetch_array($requests)){
    echo '<option value="'.$r['request_id'].'">';
    echo $r['nama_request'];
    echo '</option>';
  }
}
?>
