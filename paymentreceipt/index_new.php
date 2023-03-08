<?php 
session_start();
include '../template/header_admin.php'; 
include '../koneksidb.php';
$user_id = $_SESSION['users_id'];
//echo $_SESSION("users_id");
 $queryview = mysqli_query($koneksi, "SELECT * FROM users1 WHERE users_id='$user_id'");
 while ($row = mysqli_fetch_array($queryview)) {
   $fullname=$row['fullname'];}
   $id_pr = 0;

?>
<link rel="stylesheet" href="./paymentreceipt.css">
<style>
  .signature {
  text-align: center;
}

.th-border, .td-border{
    border: 2px solid #000;
}

</style>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Data Request Payment Receipts
      <small>Semua Data Request Payment Receipt</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="../admin/admin.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">New PR Form</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Purchase Requisition Form</h3>
            <!-- <div class="box-tools pull-left"><br>
              <a href="#" class="btn btn-success" data-toggle="modal" data-target="#tambahpayments"><i
                  class="fa fa-money"></i><span> New PR</span></a>
            </div> -->
          </div>
          <div class="box-body">

          <form action="../paymentreceipt/function_paymentreceipt.php?act=tambahpayments" method="post" id="formD" name="formD" role="form" enctype="multipart/form-data" onSubmit="validasi()">
            <div class="form-group">
              <div class="row">
                <!-- input nama -->
                <input type="text" name="users_id" id="requestdata" value="<?php echo $fullname?>" hidden>

                <!-- input nomor PR -->
              <div class="form-group">
                <div class="row">
                  <label class="col-sm-1 control-label text-center">PR No : <span class="text-red">*</span></label>
                  <div class="col-sm-4">
                    <?php
                    $cari = mysqli_query($koneksi,"SELECT request_id FROM generalaffairspayment ORDER BY request_id ASC ");
                    while ($a = mysqli_fetch_array($cari)) {
                      $id_pr = $a['request_id'];
                    }
                    $id_baru = $id_pr+1;
                    ?>
                    <b><input type="text" name="request_id" id="request_id" style="width:13%; font-size: 40px;" class="form-control" value="<?php echo$id_baru;?>" readonly></b>
                  </div>
                </div>
              </div>

                <!-- input departemen -->
                <?php  
                  $datareq = mysqli_query($koneksi,"SELECT 
                    users_id,
                    username,
                    keterangandepartment 
                    FROM paymentreceipt_apps.users1
                    -- LEFT JOIN department ON users1.departments_id = department.department_id
                    JOIN paymentreceipt_apps.department ON users1.department_id = department.department_id
                      WHERE users1.users_id = '$user_id' ");
                        while($d = mysqli_fetch_array($datareq)){
                          $dept = $d['keterangandepartment']; 
                          }
                          ?>
                </div>
              </div>

              <!-- input departemen -->
              <div class="form-group">
                <div class="row">
                  <input type="text" name="department_id" id="departmentdata" value="<?php echo $dept ?>" hidden> 
                </div>
              </div>

              <!-- input user id -->
              <div class="form-group">
                <div class="row">
                  <input type="text" name="user_id" id="" value="<?php echo $user_id ?>" hidden>
                </div>
              </div>

              <!-- input usage -->
              <!-- <div class="form-group">
                <div class="row">
                  <label class="col-sm-4 control-label text-right">Peruntukan/Usage: 
                  <span class="text-red">*</span></label>
                  <div class="col-sm-6">
                    <input type="text" name="usagegeneralaffair" id="usagegeneralaffair" class="form-control">
                  </div>
                </div>
              </div> -->
              <div class="form-group">
                <div class="row">
                  <label class="col-sm-2">Peruntukan / Usage : </label><input type="text" name="usagegeneralaffair" id="usagegeneralaffair" class="form-control" style="width:30%;" require>
                </div>
              </div>
              

              <!-- deskripsi -->
              <!-- <div class="form-group">
                <div class="row">
                  <label class="col-sm-4 control-label text-right">Description Items: 
                  <span class="text-red">*</span></label>
                  <div class="col-sm-6">
                    <input type="text" name="deskripsi_items" id="deskripsi_items" class="form-control">
                  </div>
                </div>
              </div> -->
              <div class="form-group">
                <div class="row">
                  <label class="col-sm-2">Description Items: </label><input type="text" name="deskripsi_items" id="deskripsi_items" class="form-control" style="width:30%;" require>
                </div>
              </div>

              <!-- jumlah item -->
              <div class="form-group">
                <div class="row">
                  <label class="col-sm-2">Jumlah Item: </label><input type="number" class="form-control" name="jumlah_items" id="jumlah_items" placeholder="xxx" value="<?php echo $row['jumlah_items']; ?>" style="width:5%;" onkeyup="OnChange(this.value)" onKeyPress="return isNumberKey(event)">
                </div>  
              </div>

              <!-- Units atau satuan -->
              <div class="form-group">
                <div class="row">
                <label class="col-sm-2">Units : </label>
                <select class="form-control" name="units_id" style="width:8%;" id="sourcesatuan">
                        <option value=""> - </option>
                          <?php 
                          $datasatuan = mysqli_query($koneksi,"SELECT 
                          * 
                          FROM paymentreceipt_apps.satuan
                          ORDER BY keterangansatuan ASC
                          ");
                          while($d = mysqli_fetch_array($datasatuan)){
                              ?>
                              <option value="<?php echo $d['unit_id']; ?>">
                                
                                <?php echo $d['keterangansatuan']; ?>
                              </option>
                              <?php 
                          }
                          ?>
                      </select>
                </div>
              </div>

              <!-- input harga -->
              <div class="form-group">
                <div class="row">
                <label class="col-sm-2">Price : (Rp) </label><input type="number" class="form-control" name="hargaitems" id="hargaitems" placeholder="xxx" value="" onkeyup="OnChange(this.value)" onKeyPress="return isNumberKey(event)" style="width:15%;">
                <span id="rupiah"></span>       
                </div>
              </div>

              <!-- Total Harga -->
              <div class="form-group">
                <div class="row">
                <label class="col-sm-2">Total Price : (Rp) </label><input type="number" class="form-control" name="total_harga" id="total_harga" placeholder="Rp xxx" value="" style="width:15%;" readonly>
                </div>
              </div>

              <!-- Estimasi Harga -->
              <div class="form-group">
                <div class="row">
                <label class="col-sm-2">Price Estimate: (Rp) </label><input type="number" name="price_estimate" id="price_estimate" class="form-control" placeholder="Rp xxx" value="" style="width:15%;">
                </div>
              </div>
              <!-- <div class="form-group">
                <div class="row">
                  <label class="col-sm-2 control-label text-right">Quantity: 
                  <span class="text-red">*</span></label>
                  <div class="col-sm-2">
                    <input type="number" class="form-control" name="jumlah_items" id="jumlah_items" placeholder="xxx" value="<?php echo $row['jumlah_items']; ?>" style="width:30%;" onkeyup="OnChange(this.value)" onKeyPress="return isNumberKey(event)">
                  </div>
                    <label class="col-sm-2 control-label text-right">Units: 
                    <span class="text-red"></span></label>
                    <div class="col-sm-2">
                      <select class="form-control" name="units_id" style="width:50%;" id="sourcesatuan">
                        <option value=""> - </option>
                          <?php 
                          $datasatuan = mysqli_query($koneksi,"SELECT 
                          * 
                          FROM paymentreceipt_apps.satuan
                          ORDER BY keterangansatuan ASC
                          ");
                          while($d = mysqli_fetch_array($datasatuan)){
                              ?>
                              <option value="<?php echo $d['unit_id']; ?>">
                                
                                <?php echo $d['keterangansatuan']; ?>
                              </option>
                              <?php 
                          }
                          ?>
                      </select>
                    </div>
                </div>
              </div> -->

              <!-- input harga -->
              <!-- <div class="form-group">
                <div class="row">
                  <label class="col-sm-3 control-label text-right">Harga Items: 
                  <span class="text-red">*</span></label>
                    <div class="col-sm-3 input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="font-size: 14px;">Rp</span>
                      </div>
                        <input type="text" class="form-control" name="hargaitems" id="hargaitems" placeholder="xxx" value="" onkeyup="OnChange(this.value)" onKeyPress="return isNumberKey(event)">
                        <div class="input-group-append">
                          <span class="input-group-text" style="font-size: 14px;">,00</span>
                        </div>
                    </div>
                </div>
              </div> -->

              <!-- input total harga -->
              <!-- <div class="form-group">
                <div class="row">
                  <label class="col-sm-3 control-label text-right">Total Price: 
                  <span class="text-red">*</span></label>
                  <div class="col-sm-5">
                    <input type="number" class="form-control" name="total_harga" id="total_harga" placeholder="Rp xxx" value="" readonly>
                    <span class="input-group-addon">,00</span>
                  </div>
                </div>
              </div> -->
              
              <!-- input harga estimasi -->
              <!-- <div class="form-group">
                <div class="row">
                  <label class="col-sm-3 control-label text-right">Price Estimated: <span
                  class="text-red"></span></label>
                  <div class="col-sm-6">
                    <input type="number" class="form-control" name="price_estimate" placeholder="xxx" value="">
                  </div>
                </div>
              </div> -->
              

              <!-- input keterangan -->
              <!-- <div class="form-group">
                <div class="row">
                  <label class="col-sm-4 control-label text-right">Keterangan Barang: <span
                  class="text-red"></span></label>
                  <div class="col-sm-5">
                    <textarea name="keterangan" id="keterangan" class="form-control" cols="2"rows="2"></textarea>
                  </div>
                </div>
              </div> -->
              <div class="form-group">
                <div class="row">
                <label class="col-sm-2">Keterangan Barang: </label>
                <!-- <textarea name="keterangan" id="keterangan" class="form-control" cols="2"rows="2"></textarea> -->
                <input type="text" name="keterangan" id="keterangan" class="form-control" style="width: 50%;">
                </div>
              </div>

                      <div class="">
                        <!-- <a href="data_paymentreceipt.php?request_id=<?php echo $id_baru; ?>" class="btn btn-danger">Selesai</a> -->
                        <a href="f_pindahtabel.php" class="btn btn-danger">Selesai</a>
                        <input type="submit" name="submit" class="btn btn-primary" value="Tambah Data">
                      </div>       
          </form>
<br>
          <table id="" class="display table table-bordered table-striped table-hover hover table-striped" style="width:100%">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th nowrap>Nomor PR</th>
                    <!-- <th nowrap>Nama Department</th> -->
                    <th nowrap>Tanggal Request</th>
                   
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    $queryview = mysqli_query($koneksi, "SELECT 
                      generalaffairs_id,
                      -- nama_request,
                      request_id,
                      -- keterangandepartment,
                      source_id,
                      namabarang,
                      -- DATE_FORMAT(tanggal_pembelian,'%d/%m/%Y') AS tanggal_pembelian,
                      tanggal_pembelian,
                      
                          usagegeneralaffair,
                          deskripsi_items,
                          jumlah_items,
                          keterangansatuan,
                          hargaitems,
                          (jumlah_items*hargaitems) AS total_harga,
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
                      paymentreceipt_apps.generalaffairs
                      -- LEFT JOIN requests on generalaffairspayment.request_id = requests.request_id
                      LEFT JOIN department on generalaffairs.department_id = department.department_id
                      LEFT JOIN sourcesproc on generalaffairs.source_id = sourcesproc.sources_id
                      LEFT JOIN satuan ON generalaffairs.units_id = satuan.unit_id   
                      
                      -- WHERE GApayment_id
                      -- GROUP BY nama_request, keterangandepartment
                      WHERE request_id = '$id_baru'
                      -- GROUP BY request_id, tanggal_pembelian
                      -- ORDER BY request_id ASC LIMIT 0, 1000
                      ");
                    while ($row = mysqli_fetch_array($queryview)) {
                     $id=$row['request_id'];

                     $tgl=$row['inputdate'];
                      // $tgl = date('d F Y', $row);
                  ?>
                  <tr>
                    <td><?php echo $no++;//echo$id_pr;?></td>
                    <td>
                      <?php echo $row['request_id']."/". date('Y/m/d', strtotime($row['inputdate']));?>
                    </td>
                    <!-- <td nowrap> -->
                      <!-- <?php echo $row['keterangandepartment'];?> -->
                    <!-- </td> -->
                    <!-- <td><?php echo $row['namabarang'];?></td> -->
                    <td align="center" nowrap>
                      <?php echo date('d F Y', strtotime($row['inputdate'])); ?>
                    </td>
                    <!-- <td align="center">
                      <?php echo "Rp. ".number_format($row['hargaitems'])." ,-"; ?>
                    </td>
                    <td align="center">
                      <?php echo "Rp. ".number_format($row['total_harga'])." ,-"; ?>
                    </td>   -->
                    <!-- <td><img src="gambar/<?php echo $d['linkpembelian'] ?>" width="35" height="40"></td> -->
                    <!-- <td align="center">
                      <?php echo "Rp. ".number_format($row['price_estimate'])." ,-"; ?>
                    </td>
                    <td >
                      <?php echo $row['keterangan'];?>
                    </td> -->

                    <td nowrap>
                      <!--<a href="../user/form_edituser.php?id=<?php echo $row['users_id']?>" class="btn btn-primary btn-flat btn-xs"><i class="fa fa-pencil"></i> Edit</a>-->
                      <!-- <a href="#" class="btn btn-primary btn-flat btn-xs" data-toggle="modal" data-target="#updatepayments<?php echo $no; ?>"><i class="fa fa-pencil"></i> Edit</a> -->
                      <!-- <a href="#" class="btn btn-info btn-flat btn-xs" data-toggle="modal" data-target="#detailpayments<?php echo $no;?>"><i class="fa fa-eyes">Detail</i></a> -->
                      <!-- alternative tampilan PR -->
                      <?php echo "<a href='../smallapp?id=$id&tgl=$tgl' class='btn btn-info btn-flat btn-xs' ><i class='fa fa-eyes'>View</i></a>"?>
                      <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#deletepayments<?php echo $no; ?>"><i class="fa fa-trash"></i> Delete</a>
                      <!-- <a href="../paymentreceipt/cetaklaporanpayment.php?id=<?php echo $row['GApayment_id']; ?>" target="_blank" class="btn btn-warning btn-flat btn-xs"><i class="fa fa-print"></i>Cetak</a> -->
                      </td>
                  </tr>
                  <?php
                    }
                  ?>
                </tbody>
              </table>

              <!-- modal delete -->
    <div class="example-modal">
        <div id="deletepayments<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title">Konfirmasi Delete Data Payments</h3>
                    </div>
                    <div class="modal-body">
                        <h4 align="center">Apakah anda yakin ingin menghapus PR Request dari <?php echo $id_pr;?><strong><span class="grt"></span></strong> ?</h4>
                    </div>
                    <div class="modal-footer">
                        <button id="nodelete" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
                        <a href="../paymentreceipt/function_paymentreceipt.php?act=deletepayments&request_id=<?php echo $id_pr; ?>" class="btn btn-primary">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- fungsi delete -->
<?php
if(isset($_GET['act']) && $_GET['act'] == 'deletepayments' && isset($_GET['request_id'])) {
    $id_pr = $_GET['request_id'];
    $querydelete = mysqli_query($koneksi, "DELETE FROM generalaffairs WHERE request_id = '$id_pr'");
    if($querydelete) {
        header("location:../paymentreceipt/index_new.php");
    } else {
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
}
?>
        </div>
      </div>
    </div>
  </section><!-- /.content -->
</div>

<script>
  function OnChange(value) {
    var jumlah_items = parseInt(document.getElementById("jumlah_items").value);
    var harga_items = parseInt(document.getElementById("hargaitems").value);
    var total_harga = jumlah_items * harga_items;
    document.getElementById("total_harga").value = total_harga;
  }
</script>


<script type="text/javascript">
  function validasi() {
    var namareq = document.getElementById("request_id").value;
    var department = document.getElementById("department_id").value;
    var source = document.getElementById("source_id").value;
    var kategori = document.getElementById("categories").value;
    var unit = document.getElementById("units_id").value;
    var tglbeli = document.getElementById("tanggal_pembelian").value;
    var usage = document.getElementById("usagegeneralaffair").value;
    var deskripsibarang = document.getElementById("deskripsi_items").value;
    var jumlahbarang = document.getElementById("jumlah_items").value;
    var hargabarang = document.getElementById("hargaitems").value;
    var totalharga = document.getElementById("total_harga").value;
    var estimasiharga = document.getElementById("price_estimate").value;
    if (nama != "" && department_id != "" && source != "" && kategori != "" && unit != "" && tglbeli != "" && usage !=
      "" && deskripsibarang != "" && jumlahbarang != "" && hargabarang != "" && totalharga != "" && estimasiharga != ""
      ) {
      return true;
    } else {
      alert('You have to fill the blank ... !');
    }
  }
</script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>

<script>
  $(document).ready(function() {
    $('#hargaitems').inputmask("decimal", {
      radixPoint: ",",
      groupSeparator: ".",
      digits: 0,
      autoGroup: true,
      prefix: 'Rp ',
      rightAlign: false,
      onBeforeMask: function (value, opts) {
        return value;
      },
      onUnMask: function(maskedValue, unmaskedValue) {
        return unmaskedValue;
      }
    });
  });
</script>

<script>
  function OnChange(value) {
  if (value < 1) {
    document.getElementById("jumlah_items").value = 1;
  }
}

</script>

<script>
// function printReport(id) {
//     var GApayment_id = id;
//     window.location.href = '../paymentreceipt/printdocuments.php?=' + GApayment_id;
// }
function printReport(id) {
    var GApayment_id = id;
    window.location.href = '../paymentreceipt/printdocuments.php?GApayment_id=' + GApayment_id;
}
</script>

<script>
document.querySelector("input[name='tanggal_pembelian']").addEventListener("change", function(){
    var today = new Date();
    var selected = new Date(this.value);
    if(selected < today){
        alert("Tanggal tidak valid, harus lebih besar atau sama dengan hari ini");
        this.value = "";
    }
});
</script>


  <?php include '../template/footer.php'; ?>