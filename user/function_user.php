<?php
include '../koneksidb.php';

if($_GET['act']== 'tambahuser'){
    $users_id       = $_POST['users_id'];
    $departments_id = $_POST['departments_id'];
    $fullname       = $_POST['fullname'];
    $username       = $_POST['username'];
    $password       = $_POST['password'];
    $user_role      = $_POST['users_role'];
    $photo_profile  = $_FILES['photo_profile']['name'];
    $ip_address     = $_SERVER['REMOTE_ADDR'];

    // proses upload foto profile
    $target = "../upload/".basename($photo_profile);
    move_uploaded_file($_FILES['photo_profile']['tmp_name'], $target);
    
    // $querytambah =  mysqli_query($koneksi, "INSERT INTO users VALUES('$users_id' , '$departments_id' ,'$fullname' ,'$username' , '$password' , '$user_role','$ip_address')");
    $query = "INSERT INTO users (departments_id, fullname, username, password, photo_profile, users_role, ip) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "issssss", $departments_id, $fullname, $username, $password, $photo_profile, $users_role, $ip);
    mysqli_stmt_execute($stmt);
    
    // menampilkan pesan berhasil atau gagal
    if (mysqli_affected_rows($koneksi) > 0) {
    header("location:../user/data_user.php?alert=Data berhasil disimpan");
    } else {
    echo "Error: " . $query . "tidak berhasil<br>" . mysqli_error($koneksi);
    }
    
    // menutup koneksi database
    mysqli_close($koneksi);

    // if ($querytambah) {
    //     # code redicet setelah insert ke index
    //     header("location:../user/data_user.php?alert=success");
    // }
    // else{
    //     echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    // }
}

elseif($_GET['act']=='updateuser'){
    $users_id       = $_POST['users_id'];
    $departments_id = $_POST['departments_id'];
    $fullname       = $_POST['fullname'];
    $username       = $_POST['username'];
    $password       = $_POST['password'];
    $photo_profile  = $_FILES['photo_profile']['name'];
    $users_role      = $_POST['users_role'];

    // $queryupdate = mysqli_query($koneksi, "UPDATE users SET departments_id='$departments_id' , fullname='$fullname' , username='$username' , password='$password' , users_role='$user_role' WHERE users_id='$users_id' ");

    // if ($queryupdate) {
    //     # credirect ke page index
    //     header("location:../user/data_user.php");    
    // }
    // else{
    //     echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    // }

    if ($_POST['departments_id'] == $row['departments_id']) {
        // kode yang akan dijalankan jika data yang dipilih sesuai dengan data di database
      } 

    if ($_POST['users_role'] == $row['users_role']) {
        // kode yang akan dijalankan jika data yang dipilih sesuai dengan data di database
      }

    // $target_dir = "../upload/";
    // $target_file = $target_dir . basename($_FILES["photo_profile"]["name"]);
    // move_uploaded_file($_FILES["photo_profile"]["tmp_name"], $target_file);
    $target_dir = "../upload/";
    $folder_name = "user_$users_id"; // nama folder dengan ID user yang akan diupload
    $target_dir .= $folder_name; // tambahkan nama folder ke direktori tujuan

    // cek apakah folder dengan nama tersebut sudah ada
    if (!is_dir($target_dir)) {
    // jika tidak ada, buat folder baru dengan nama tersebut
    mkdir($target_dir);
    }

    // ubah target file menjadi folder yang sudah dibuat tadi
    $target_file = $target_dir . "/" . basename($_FILES["photo_profile"]["name"]);

    // pindahkan file ke folder yang sudah dibuat
    move_uploaded_file($_FILES["photo_profile"]["tmp_name"], $target_file);

    // ubah nama file di database menjadi nama file di folder yang sudah dibuat
    $photo_profile = $folder_name . "/" . basename($_FILES["photo_profile"]["name"]);

    // menyiapkan query
  $query = "UPDATE users SET departments_id = ?, fullname = ?, username = ?, password = ?, photo_profile = ?, users_role = ? WHERE users_id = ?";
  $stmt = mysqli_prepare($koneksi, $query);

  // menyiapkan parameter untuk mengeksekusi query
  mysqli_stmt_bind_param($stmt, "isssssi", $departments_id, $fullname, $username, $password, $photo_profile, $users_role, $users_id);

  // mengeksekusi query
  mysqli_stmt_execute($stmt);

  // menutup statement
  mysqli_stmt_close($stmt);
  
  if (mysqli_affected_rows($koneksi) > 0) {
    // kode yang akan dijalankan jika update berhasil
    // misalnya menampilkan pesan sukses
    echo "Data berhasil diupdate";
  } 
  else {
    // kode yang akan dijalankan jika update gagal
    // misalnya menampilkan pesan error
    echo "Error: " . mysqli_error($koneksi);
  }

  // mengalihkan ke halaman ../user/data_user.php
  header("Location:../user/data_user.php");
}

elseif ($_GET['act'] == 'deleteuser'){
    $users_id = $_GET['users_id'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM users WHERE users_id = '$users_id'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:../user/data_user.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>