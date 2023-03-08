<?php
include '../koneksidb.php';

if($_GET['act']== 'tambahbasename'){
    $base_id = $_POST['base_id'];
    $basename = $_POST['basename'];
    $keteranganbase = $_POST['keteranganbase'];
    // $user_role = $_POST['role'];

    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO base VALUES('$base_id' , '$basename' , '$keteranganbase' )");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location:../basename/data_basename.php");
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
}
elseif($_GET['act']=='updatebasename'){
    $base_id = $_POST['base_id'];
    $basename = $_POST['basename'];
    $keteranganbase = $_POST['keteranganbase'];
    // $role = $_POST['role'];

    //query update
    $queryupdate = mysqli_query($koneksi, "UPDATE base SET basename='$basename' , keteranganbase='$keteranganbase'  WHERE base_id='$base_id' ");

    if ($queryupdate) {
        # credirect ke page index
        header("location:../basename/data_basename.php");    
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    }
}
elseif ($_GET['act'] == 'deletebasename'){
    $base_id = $_GET['base_id'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM base WHERE base_id = '$base_id'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:../basename/data_basename.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>