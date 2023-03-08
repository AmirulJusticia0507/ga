<?php 
session_start();
if (!isset($_SESSION['users_id']) || empty($_SESSION['users_id'])) {
  header("location: ../index.php");
  exit;
}

include '../template/header_admin.php'; 
include '../koneksidb.php';
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Sistem Payment Receipt Susi Air</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- <div class="callout callout-info">
      <h4>Hallo <?php echo $_SESSION['username']?> </h4>
    </div> -->

    <div class="col-sm-3 col-xs-2">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <?php 
              $data_pr = mysqli_query($koneksi, "SELECT 
                      GApayment_id,
                      nama_request,
                      keterangandepartment,
                      source_id,
                      namatoko,
                      user_id,
                      DATE_FORMAT(tanggal_pembelian,'%d/%m/%Y') AS tanggalbeli,
                          usagegeneralaffair,
                          deskripsi_items,
                          jumlah_items,
                          keterangansatuan,
                          hargaitems,COUNT(jumlah_items*hargaitems = total_harga) AS total_harga,
                          linkpembelian,
                          price_estimate,
                          keterangan,
                          inputdate,
                          CASE STATUS  
                              WHEN 'Checked' THEN 'Checked'  
                              WHEN 'Processed' THEN 'Processed'  
                              WHEN 'Pending' THEN 'Pending'  
                              WHEN 'Cancelled' THEN 'Cancelled'  
                              WHEN 'Finished' THEN 'Finished'  
                          END AS statustransaksi
                    from
                      paymentreceipt_apps.generalaffairspayment
                      left join requests on generalaffairspayment.request_id = requests.request_id
                      left join department on generalaffairspayment.department_id = department.department_id
                      left join sourcesproc on generalaffairspayment.source_id = sourcesproc.sources_id
                      LEFT JOIN satuan ON generalaffairspayment.units_id = satuan.unit_id
                      LEFT JOIN paymentreceipt_apps.users ON generalaffairspayment.user_id = users.users_id
                      WHERE users.users_id = $user_id 
                      -- LEFT JOIN categories ON generalaffairspayment.kategori_id = categories.categories_id           
                      GROUP BY nama_request, keterangandepartment");
              $total_pr = mysqli_num_rows($data_pr);
              ?>
          <h3><?php echo $total_pr; ?></h3>
          <b>
            <p>Total Data PR</p>
          </b>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="../paymentreceipt/data_paymentreceipt.php" class="small-box-footer">More info <i
            class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    <div class="col-sm-3 col-xs-2">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <?php 
              $data_basename = mysqli_query($koneksi, "SELECT 
              *
              FROM base
              ORDER BY basename ASC
              LIMIT 0, 100");
              $total_basename = mysqli_num_rows($data_basename);
              ?>
          <h3><?php echo $total_basename; ?></h3>
          <b>
            <p>Total Data Basename</p>
          </b>
        </div>
        <div class="icon">
          <i class="ion ion-ios-location"></i>
        </div>
        <a href="../basename/data_basename.php" class="small-box-footer">More info <i
            class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->



<?php include '../template/footer.php'; ?>