<?php
include '../koneksidb.php';

if($_GET['act']== 'tambahpayments'){
    //$GApayment_id = $_POST['GApayment_id'];
    // $request_id = $_POST['request_id'];
    $request_id = mysqli_real_escape_string($koneksi, $_POST['request_id']);
    // $department_id = $_POST['department_id'];
    $department_id = mysqli_real_escape_string($koneksi, $_POST['department_id']);
    // $source_id = $_POST['source_id'];
    // $source_id = mysqli_real_escape_string($koneksi, $_POST['source_id']);
    // $categories = $_POST['kategori_id'];
    $user_id = mysqli_real_escape_string($koneksi, $_POST['user_id']);
    // $usagegeneralaffair = $_POST['usagegeneralaffair'];
    $usagegeneralaffair = mysqli_real_escape_string($koneksi, $_POST['usagegeneralaffair']);
    // $deskripsi_items = $_POST['deskripsi_items'];
    $deskripsi_items = mysqli_real_escape_string($koneksi, $_POST['deskripsi_items']);
    // $jumlah_items = $_POST['jumlah_items'];
    $jumlah_items = mysqli_real_escape_string($koneksi, $_POST['jumlah_items']);
    // $units_id = $_POST['units_id'];
    $units_id = mysqli_real_escape_string($koneksi, $_POST['units_id']);
    // $hargaitems = $_POST['hargaitems'];
    $hargaitems = mysqli_real_escape_string($koneksi, $_POST['hargaitems']);
    // $total_harga = $_POST['total_harga'];
    $total_harga = mysqli_real_escape_string($koneksi, $_POST['total_harga']);
    // $price_estimate = $_POST['price_estimate'];
    $price_estimate = mysqli_real_escape_string($koneksi, $_POST['price_estimate']);
    // $keterangan = $_POST['keterangan'];
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);
    // $inputdate = $_POST['inputdate'];
    // $status = $_POST['status'];
    //$status = mysqli_real_escape_string($koneksi, $_POST['status']);
  
    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO generalaffairs (request_id, department_id, user_id,usagegeneralaffair, deskripsi_items, jumlah_items, units_id, hargaitems, total_harga, price_estimate, keterangan, inputdate ) VALUES( '$request_id', '$department_id', '$user_id', '$usagegeneralaffair', '$deskripsi_items', '$jumlah_items', '$units_id', '$hargaitems', '$total_harga', '$price_estimate', '$keterangan', now())");

    if ($querytambah) {
        if ($status == 'Checked') {
            $query = mysqli_query($koneksi, "UPDATE generalaffairspayment SET status = 'Processed' WHERE GApayment_id = $GApayment_id");
        } elseif ($status == 'Processed') {
            $query = mysqli_query($koneksi, "UPDATE generalaffairspayment SET status = 'Pending' WHERE GApayment_id = $GApayment_id");
        } elseif ($status == 'Pending') {
            $query = mysqli_query($koneksi, "UPDATE generalaffairspayment SET status = 'Cancelled' WHERE GApayment_id = $GApayment_id");
        } elseif ($status == 'Cancelled') {
            $query = mysqli_query($koneksi, "UPDATE generalaffairspayment SET status = 'Finished' WHERE GApayment_id = $GApayment_id");
        }
        header("location:../paymentreceipt/data_paymentreceipt.php");
    } else {
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
  
    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location:../paymentreceipt/index_new.php");
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
  }
  
  // if($_GET['act']== 'updatepayments'){
  //   $GApayment_id = $_POST['GApayment_id'];
  //   $request_id = $_POST['request_id'];
  //   $department_id = $_POST['department_id'];
  //   $source_id = $_POST['source_id'];
  //   $tanggal_pembelian = $_POST['tanggal_pembelian'];
  //   $categories = $_POST['categories'];
  //   $usagegeneralaffair = $_POST['usagegeneralaffair'];
  //   $deskripsi_items = $_POST['deskripsi_items'];
  //   $jumlah_items = $_POST['jumlah_items'];
  //   $units_id = $_POST['units_id'];
  //   $hargaitems = $_POST['hargaitems'];
  //   $total_harga = $_POST['total_harga'];
  //   $price_estimate = $_POST['price_estimate'];
  //   $keterangan = $_POST['keterangan'];
  //   // $inputdate = $_POST['inputdate'];
  //   $status = $_POST['status'];
  //   switch ($status) {
  //       case "checked":
  //         echo "Status: Checked<br>";
  //         echo "Payment sudah dicek dan valid.";
  //         break;
  //       case "processed":
  //         echo "Status: Processed<br>";
  //         echo "Payment sedang diproses.";
  //         break;
  //       case "pending":
  //         echo "Status: Pending<br>";
  //         echo "Payment belum diproses.";
  //         break;
  //       case "cancelled":
  //         echo "Status: Cancelled<br>";
  //         echo "Payment dibatalkan.";
  //         break;
  //       case "finished":
  //         echo "Status: Finished<br>";
  //         echo "Payment selesai diproses.";
  //         break;
  //       default:
  //         echo "Status: Unknown<br>";
  //         echo "Status tidak diketahui.";
  //     }
      
  //   //query
  //   // $queryupdate =  mysqli_query($koneksi, "UPDATE generalaffairspayment SET GApayment_id = '$GApayment_id', request_id = '$request_id', department_id = '$department_id', source_id = '$source_id', tanggal_pembelian = '$tanggal_pembelian', categories = '$categories', usagegeneralaffair = '$usagegeneralaffair', deskripsi_items = '$deskripsi_items', jumlah_items = '$jumlah_items', units_id = '$units_id', hargaitems = '$hargaitems', total_harga = '$total_harga', price_estimate = '$price_estimate', keterangan = '$keterangan', status = '$status' WHERE GApayment_id = '$GApayment_id'");
  //   $queryupdate =  mysqli_query($koneksi, "UPDATE generalaffairspayment SET GApayment_id = '$GApayment_id', request_id = '$request_id', department_id = '$department_id', source_id = '$source_id', tanggal_pembelian = '$tanggal_pembelian', categories = '$categories', usagegeneralaffair = '$usagegeneralaffair', deskripsi_items = '$deskripsi_items', jumlah_items = '$jumlah_items', units_id = '$units_id', hargaitems = '$hargaitems', total_harga = '$total_harga', price_estimate = '$price_estimate', keterangan = '$keterangan', status = '$status' WHERE GApayment_id = '$GApayment_id'");

  
  //   if ($queryupdate) {
  //       # code redicet setelah insert ke index
  //       header("location:../paymentreceipt/data_paymentreceipt.php");
  //   }
  //   else{
  //       echo "ERROR, tidak berhasil". mysqli_error($koneksi);
  //   }
  // }

  
  if($_GET['act']== 'deletepayments'){
    $request_id = $_GET['request_id'];
  
    //query
    $querydelete =  mysqli_query($koneksi, "DELETE FROM generalaffairspayment WHERE request_id = '$request_id'");
  
    if ($querydelete) {
        # code redicet setelah delete
        header("location:../paymentreceipt/data_paymentreceipt.php");
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
  }
  
?>