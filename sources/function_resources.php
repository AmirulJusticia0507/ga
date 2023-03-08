<?php
include '../koneksidb.php';

// if($_GET['act']== 'tambahsources'){
//     // $sources_id     = $_POST['sources_id'];
//     $source         = $_POST['source'];
//     $namatoko       = $_POST['namatoko'];
//     $sumbertoko     = $_POST['sumbertoko'];
//     $nomortelptoko  = $_POST['nomortelptoko'];
//     $rekeningtoko   = $_POST['rekeningtoko'];
//     $namabarang     = $_POST['namabarang'];
//     $linkpembelian  = $_POST['linkpembelian'];
//     // $user_role = $_POST['role'];
  
//     if ($source == 'online') {
//       //query untuk data online
//       $querytambah =  mysqli_query($koneksi, "INSERT INTO sourcesproc VALUES('$source', '$namabarang', '$linkpembelian')");
//     } else {
//       //query untuk data offline
//       $querytambah =  mysqli_query($koneksi, "INSERT INTO sourcesproc VALUES('$source', '$sumbertoko', '$namatoko', '$nomortelptoko', '$rekeningtoko', '$namabarang')");
//     }
  
//     if ($querytambah) {
//         # code redicet setelah insert ke index
//         header("location:../resources/data_resources.php");
//     }
//     else{
//         echo "ERROR, tidak berhasil". mysqli_error($koneksi);
//     }
//   }

// Cek apakah ada aksi yang dilakukan
if (isset($_GET['act'])) {
  if ($_GET['act'] == 'tambahsources') {
    // Ambil data dari form
    // $sources_id     = $_POST['sources_id'];
    $source         = $_POST['source'];
    $namatoko       = $_POST['namatoko'];
    // $sumbertoko     = $_POST['sumbertoko'];
    $nomortelptoko  = $_POST['nomortelptoko'];
    $rekeningtoko   = $_POST['rekeningtoko'];
    $namabarang     = $_POST['namabarang'];
    $linkpembelian  = $_POST['linkpembelian'];
    // $user_role = $_POST['role'];
  
    // Query INSERT data ke tabel sourcesproc
    if ($source == 'online') {
      //query untuk data online
      $query = "INSERT INTO sourcesproc (source, namabarang, linkpembelian) VALUES('$source', '$namabarang', '$linkpembelian')";
      $querytambah = mysqli_query($koneksi, $query);
    } else {
      //query untuk data offline
      $query = "INSERT INTO sourcesproc (source, namatoko, nomortelptoko, rekeningtoko, namabarang) VALUES('$source',  '$namatoko', '$nomortelptoko', '$rekeningtoko', '$namabarang')";
      $querytambah = mysqli_query($koneksi, $query);
    }
  
    // Cek apakah query INSERT berhasil
    if ($querytambah) {
        // Jika berhasil, redirect ke halaman data_resources.php
        header("location:../resources/data_resources.php");
    }
    else{
        // Jika gagal, tampilkan pesan error
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
  }
}

elseif($_GET['act']=='updatesources'){
    $sources_id     = $_POST['sources_id'];
    $namatoko       = $_POST['namatoko'];
    // $sumbertoko     = $_POST['sumbertoko'];
    $source         = $_POST['source'];
    $nomortelptoko  = $_POST['nomortelptoko'];
    $rekeningtoko   = $_POST['rekeningtoko'];
    $namabarang     = $_POST['namabarang'];
    $linkpembelian  = $_POST['linkpembelian'];
    // $role = $_POST['role'];
  
    if ($source == 'online') {
      //query untuk update data online
      $queryupdate = mysqli_query($koneksi, "UPDATE sourcesproc SET sources_id ='$sources_id' ,source='$source' , namabarang='$namabarang' , linkpembelian='$linkpembelian' WHERE sources_id='$sources_id' ");
    } else {
      //query untuk update data offline
      $queryupdate = mysqli_query($koneksi, "UPDATE sourcesproc SET sources_id ='$sources_id' ,source='$source' , namatoko='$namatoko' , nomortelptoko='$nomortelptoko', rekeningtoko='$rekeningtoko', namabarang='$namabarang' WHERE sources_id='$sources_id' ");
    }
  
    if ($queryupdate) {
        # credirect ke page index
        header("location:../resources/data_resources.php");    
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    }
  }
elseif ($_GET['act'] == 'deletesources'){
    $sources_id = $_GET['sources_id'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM sourcesproc WHERE sources_id = '$sources_id'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:../resources/data_resources.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>