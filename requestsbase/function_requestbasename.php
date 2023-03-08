<?php
include '../koneksidb.php';

if($_GET['act']== 'tambahrequestbaseorder'){
    $regbase_id = $_POST['regbase_id'];
    $namarequestbase = $_POST['namarequestbase'];
    $jabatan = $_POST['jabatan'];
    $kode_base = $_POST['kode_base'];
    // $user_role = $_POST['role'];

    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO requestbase VALUES('$regbase_id' , '$namarequestbase' , '$jabatan', '$kode_base' )");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location:../requestsbase/data_requestbase.php");
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
}
elseif($_GET['act']=='updaterequestbaseorder'){
    $regbase_id = $_POST['regbase_id'];
    $namarequestbase = $_POST['namarequestbase'];
    $jabatan = $_POST['jabatan'];
    $kode_base = $_POST['kode_base'];
    // $role = $_POST['role'];

    //query update
    $queryupdate = mysqli_query($koneksi, "UPDATE requestbase SET namarequestbase='$namarequestbase' , jabatan='$jabatan', kode_base='$kode_base'  WHERE regbase_id='$regbase_id' ");

    if ($queryupdate) {
        # credirect ke page index
        header("location:../requestsbase/data_requestbase.php");    
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    }
}
elseif ($_GET['act'] == 'deleterequestbaseorder'){
    $regbase_id = $_GET['regbase_id'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM requestbase WHERE regbase_id = '$regbase_id'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:../requestsbase/data_requestbase.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}

// // menangkap data dari input
// $term = mysqli_real_escape_string($koneksi, $_GET['term']);
// $query = "SELECT kode_base, basename FROM base WHERE basename LIKE '%$term%' ORDER BY basename ASC";
// $result = mysqli_query($koneksi, $query);
// $data = array();
// while ($row = mysqli_fetch_assoc($result)) {
// $data[] = array(
// 'label' => $row['basename'],
// 'value' => $row['kode_base']
// );
// }
// echo json_encode($data);
?>