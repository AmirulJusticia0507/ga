<?php 
  header("Content-Type: application/json; charset=UTF-8");
  include '../koneksidb.php';
  
  // if(isset($_GET["query"])){
  //   $key = "%".$_GET["query"]."%";
  //   $query = "SELECT * FROM base WHERE basename LIKE ? LIMIT 10";
  //   $dewan1 = $db1->prepare($query);
  //   $dewan1->bind_param('s', $key);
  //   $dewan1->execute();
  //   $res1 = $dewan1->get_result();
 
  //   while ($row = $res1->fetch_assoc()) {
  //       $output['suggestions'][] = [
  //           'value' => $row['basename'],
  //           'basename'  => $row['basename']
  //       ];
  //   }
 
  //   if (! empty($output)) {
  //       echo json_encode($output);
  //   }
  // }
  // menangkap data dari input
$term = mysqli_real_escape_string($koneksi, $_GET['term']);
$query = "SELECT kode_base, basename FROM base WHERE basename LIKE '%$term%' ORDER BY basename ASC";
$result = mysqli_query($koneksi, $query);
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
$data[] = array(
'label' => $row['basename'],
'value' => $row['kode_base']
);
}
echo json_encode($data);
?>