<?php
include '../koneksidb.php';


    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO generalaffairspayment (request_id, department_id, user_id,usagegeneralaffair, deskripsi_items, jumlah_items, units_id, hargaitems, total_harga, price_estimate, keterangan, inputdate)
    SELECT request_id, department_id, user_id,usagegeneralaffair, deskripsi_items, jumlah_items, units_id, hargaitems, total_harga, price_estimate, keterangan, inputdate FROM generalaffairs");

  
    if ($querytambah) {
        # code redicet setelah insert ke index
        mysqli_query($koneksi, "DELETE FROM generalaffairs");

        header("location:../paymentreceipt/data_paymentreceipt.php");
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
  
?>