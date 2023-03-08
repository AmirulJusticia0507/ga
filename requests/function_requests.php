<?php
include '../koneksidb.php';

if($_GET['act']== 'tambahrequests'){
    $request_id = $_POST['request_id'];
    $nama_request = $_POST['nama_request'];
    $department_id = $_POST['department_id'];
    // $user_role = $_POST['role'];

    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO requests VALUES('$request_id' , '$nama_request' , '$department_id' )");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location:../requests/data_request.php");
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
}
elseif($_GET['act']=='updaterequests'){
    $request_id = $_POST['request_id'];
    $nama_request = $_POST['nama_request'];
    $department_id = $_POST['department_id'];
    // $role = $_POST['role'];

    //query update
    $queryupdate = mysqli_query($koneksi, "UPDATE requests SET nama_request='$nama_request' , department_id='$department_id'  WHERE request_id='$request_id' ");

    if ($queryupdate) {
        # credirect ke page index
        header("location:../requests/data_request.php");    
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    }
}
elseif ($_GET['act'] == 'deleterequests'){
    $request_id = $_GET['request_id'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM requests WHERE request_id = '$request_id'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:../requests/data_request.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>