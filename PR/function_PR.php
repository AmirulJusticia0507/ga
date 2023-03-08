<?php
include '../koneksidb.php';

if($_GET['act']== 'tambahpr'){
    // $id_archieved   = $_POST['id_archieved'];
    // $namarequest    = $_POST['namarequestPR'];
    $tgl_beli       = $_POST['tanggal_selesai'];
    $departmentbase    = $_POST['namarequestPR'];
    $manager        = $_POST['managerapproved'];
    $description    = $_POST['description'];
    $qty            = $_POST['quantity'];
    $hargarencana   = $_POST['hargarencana'];
    // $user_role = $_POST['role'];

    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO archieved VALUES(null , now(), '$departmentbase','$manager' ,'$description' ,'$qty', '$hargarencana')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location:../PR/data_PR.php");
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
}

elseif($_GET['act']=='updatepr'){
    $id_archieved   = $_POST['id_archieved'];
    $tgl_beli       = $_POST['tanggal_selesai'];
    $departmentbase = $_POST['namarequestPR'];
    $manager        = $_POST['managerapproved'];
    $description    = $_POST['description'];
    $qty            = $_POST['quantity'];
    $hargarencana   = $_POST['hargarencana'];
    // $role = $_POST['role'];

    // //query update
    // $queryupdate = mysqli_query($koneksi, "UPDATE archieved SET namarequestPR='$departmentbase' , managerapproved='$manager' ,description='$description' , quantity='$qty', hargarencana='$hargarencana', tanggal_selesai = now()  WHERE id_archieved='$id_archieved' ");

    // if ($queryupdate) {
    //     # credirect ke page index
    //     header("location:../PR/data_PR.php");    
    // }
    // else{
    //     echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    // }

        $queryupdate = mysqli_prepare($koneksi, "UPDATE archieved SET namarequestPR=?, managerapproved=?, description=?, quantity=?, hargarencana=?, tanggal_selesai = ? WHERE id_archieved=?");
    mysqli_stmt_bind_param($queryupdate, 'sssssi', $departmentbase, $manager, $description, $qty, $hargarencana, $tgl_beli, $id_archieved);
    mysqli_stmt_execute($queryupdate);

    if (mysqli_stmt_affected_rows($queryupdate)) {
        # credirect ke page index
        header("location:../PR/data_PR.php");    
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    }
}
elseif ($_GET['act'] == 'deletepr'){
    $id_archieved = $_GET['id_archieved'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM archieved WHERE id_archieved = '$id_archieved'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:../PR/data_PR.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>