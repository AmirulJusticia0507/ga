<?php 
session_start();
include '../template/header_admin.php'; 
include '../koneksidb.php';
//echo $_SESSION("users_id");
 $queryview = mysqli_query($koneksi, "SELECT * FROM users1 WHERE users_id='$user_id'");
 while ($row = mysqli_fetch_array($queryview)) {
   $fullname=$row['fullname'];}
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
      <li class="active">Data Requests Payment Receipt</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">List Data Request Payment Request</h3>
            <!-- <div class="box-tools pull-left"><br>
              <a href="#" class="btn btn-success" data-toggle="modal" data-target="#tambahpayments"><i
                  class="fa fa-money"></i><span> New PR</span></a>
            </div> -->
            <div class="box-tools pull-left"><br>
              <a href="index_new.php" class="btn btn-success" ><i
                  class="fa fa-money"></i><span> New PR</span></a>
            </div>
          </div>
          <div class="box-body">

            <div class="table-responsive22">
              <table id="datatable" class="display table table-bordered table-striped table-hover hover table-striped" style="width:100%">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th nowrap>Nomor PR</th>
                    <!-- <th nowrap>Nama Department</th> -->
                    <th nowrap>Tanggal Request</th>
                    <th nowrap>User</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    $queryview = mysqli_query($koneksi, "SELECT 
                      GApayment_id,
                      -- nama_request,
                      request_id,
                      -- keterangandepartment,
                      source_id,
                      namabarang,
                      -- DATE_FORMAT(tanggal_pembelian,'%d/%m/%Y') AS tanggal_pembelian,
                      tanggal_pembelian,
                      user_id,
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
                      paymentreceipt_apps.generalaffairspayment
                      -- LEFT JOIN requests on generalaffairspayment.request_id = requests.request_id
                      LEFT JOIN department on generalaffairspayment.department_id = department.department_id
                      LEFT JOIN sourcesproc on generalaffairspayment.source_id = sourcesproc.sources_id
                      LEFT JOIN satuan ON generalaffairspayment.units_id = satuan.unit_id   
                      LEFT JOIN paymentreceipt_apps.users ON generalaffairspayment.user_id = users.users_id
                      WHERE users.users_id = $user_id
                      -- WHERE GApayment_id
                      -- GROUP BY nama_request, keterangandepartment
                      GROUP BY request_id, tanggal_pembelian
                      ORDER BY request_id ASC LIMIT 0, 1000");
                    while ($row = mysqli_fetch_array($queryview)) {
                     $id=$row['request_id'];
                     $id_user=$row['user_id'];
                     $tgl=$row['inputdate'];
                     $id_row=$row['GApayment_id'];
                      // $tgl = date('d F Y', $row);
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td>
                      <?php echo $row['request_id']."/". date('Y/m/d', strtotime($row['inputdate']));?>
                    </td>
                    <td align="center" nowrap>
                      <?php echo date('d F Y', strtotime($row['inputdate'])); ?>
                    </td>
                    
                    <td align="center" nowrap>
                      <?php
                      $query_user = mysqli_query($koneksi, "SELECT * FROM users WHERE users_id = '$id_user'");
                      while ($data = mysqli_fetch_array($query_user)) {
                       echo $nama = $data['fullname'];
                      };
                      
                      ?>
                      <!--  
                                <select name="statustransaksi" class="form-control" value="">
                                  <option value="Checked" <?php if($row['statustransaksi'] == 'Checked'){echo "selected";} ?>>Checked</option>
                                  <option value="Processed" <?php if($row['statustransaksi'] == 'Processed'){echo "selected";} ?>>Processed</option>
                                  <option value="Pending" <?php if($row['statustransaksi'] == 'Pending'){echo "selected";} ?>>Pending</option>
                                  <option value="Cancelled" <?php if($row['statustransaksi'] == 'Cancelled'){echo "selected";} ?>>Cancelled</option>
                                  <option value="Finished" <?php if($row['statustransaksi'] == 'Finished'){echo "selected";} ?>>Finished</option>
                                </select>-->
                      </td>

                    <td nowrap>
                      <!-- tombol view -->
                      <?php echo "<a href='../smallapp?id=$id&tgl=$tgl' class='btn btn-info btn-flat btn-xs' ><i class='fa fa-eyes'>View</i></a>"?>

                      <!-- tombol delete -->
                      <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#deletepayments<?php echo $no; ?>"><i class="fa fa-trash"></i> Delete</a>

                      <!-- modal delete -->
                      <div class="example-modal">
                        <div id="deletepayments<?php echo $no; ?>" class="modal fade" role="dialog"
                          style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Konfirmasi Delete Data Payments</h3>
                              </div>
                              <div class="modal-body">
                                <h4 align="center">Apakah anda yakin ingin menghapus PR Request dari 
                                  <?php echo $nama;?><strong><span class="grt"></span></strong> ?</h4>
                              </div>
                              <div class="modal-footer">
                                <button id="nodelete" type="button" class="btn btn-danger pull-left"
                                  data-dismiss="modal">Cancel</button>
                                <?php echo "<a href='../paymentreceipt/function_paymentreceipt.php?act=deletepayments&request_id=$id' class='btn btn-primary'>Delete</a>"; ?>
                                  
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- modal delete -->

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
                        <div id="deletepayments<?php echo $no; ?>" class="modal fade" role="dialog"
                          style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Konfirmasi Delete Data Payments</h3>
                              </div>
                              <div class="modal-body">
                                <h4 align="center">Apakah anda yakin ingin menghapus payment id
                                  <?php echo $row['GApayment_id'];?><strong><span class="grt"></span></strong> ?</h4>
                              </div>
                              <div class="modal-footer">
                                <button id="nodelete" type="button" class="btn btn-danger pull-left"
                                  data-dismiss="modal">Cancel</button>
                                <a href="../paymentreceipt/function_paymentreceipt.php?act=deletepayments&GApayment_id=<?php echo $row['GApayment_id']; ?>"
                                  class="btn btn-primary">Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- modal delete -->

                      
<!--MODAL START FROM HERE-->
                      <!-- modal update user -->
                      <div class="example-modal">
                        <div id="detailpayments<?php echo $no; ?>" class="modal fade" role="dialog"
                          style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                                    
                                <!-- <h3 class="modal-title align-center">Edit Data User</h3> --> <br><br>
                                <h6 class="modal-title text-left"><b class="text-primary"> PT. ASI PUDJIASTUTI AVIATION </b></h6><br><br>
                                <h3 class="modal-title text-center"><b> PURCHASE REQUISITION </b></h3><br><br>
                                
                                <button type="button" class="btn btn-primary" onclick="window.location.href = '../paymentreceipt/printdocuments.php?id=<?php echo $row['GApayment_id']; ?>'" >Cetak</button>


                                <p class="modal-title text-end" align="left"><b>To : General Affair Department</b></p>
                                <p class="modal-title text-end" align="left"><b>&emsp;&emsp;UP</b></p>
                                <p class="modal-title text-end" align="right">
                                  <b>Status : <b style="font-size: x-large;"><?php echo $row['statustransaksi']; ?></b></b></p>
                                <p class="modal-title text-end" align="right">
                                  <b>Date : <?php echo date('d-M-Y'); ?></b>
                                </p>
                                <p class="modal-title text-end" align="right"><b>Received by GA : <?php echo date('d-M-Y'); ?></b></p>
                              </div>
                              <div class="modal-body">
                                <div class="">
                                <div class="row justify-content-center">
                                  <div class="col">
                                  <table class="display table table-responsive table-bordered table-striped table-hover hover table-striped" border="2">
                                        <thead>
                                          <tr>
                                              <th class="th-border">No</th>
                                              <th class="th-border">Description</th>
                                              <th class="th-border">Jumlah</th>
                                              <th class="th-border">Satuan</th>
                                              <th class="th-border">Harga</th>
                                              <th class="th-border">Total</th>
                                              <th class="th-border">Usage</th>
                                          </tr>
                                        </thead>
                                    <tbody>
                                    <?php
                    $no = 1;
                    $queryview = mysqli_query($koneksi, "SELECT 
                          GApayment_id,
                          keterangandepartment,
                          usagegeneralaffair,
                          deskripsi_items,
                          jumlah_items,
                          keterangansatuan,
                          hargaitems,
                          (jumlah_items*hargaitems) AS total_harga,
                          CASE STATUS  
                              WHEN 'Checked' THEN 'Checked'  
                              WHEN 'Processed' THEN 'Processed'  
                              WHEN 'Pending' THEN 'Pending'  
                              WHEN 'Cancelled' THEN 'Cancelled'  
                              WHEN 'Finished' THEN 'Finished'  
                          END AS statustransaksi
                    FROM
                      paymentreceipt_apps.generalaffairspayment
                      LEFT JOIN department on generalaffairspayment.department_id = department.department_id
                      LEFT JOIN satuan ON generalaffairspayment.units_id = satuan.unit_id
                      GROUP BY keterangandepartment
                      ORDER BY GApayment_id ASC
                      LIMIT 0, 1000 ");
                                    ?>
                                    <?php
                                    // $total_jumlah = 0;
                                    $total_harga = 0;
    while($row = mysqli_fetch_array($queryview)) {
        echo "<tr>";
          echo "<td >" . $no . "</td>";
          echo "<td>" . $row['deskripsi_items'] . "</td>";
          echo "<td>" . $row['jumlah_items'] . "</td>";
          echo "<td>" . $row['keterangansatuan'] . "</td>";
          echo "<td>Rp " . number_format($row['hargaitems'], 0, ',', '.') . "</td>";
          echo "<td>Rp " . number_format($row['total_harga'], 0, ',', '.') . "</td>";
          echo "<td>" . $row['usagegeneralaffair'] . "</td>";
        echo "</tr>";
        $no++;
        // $total_jumlah += $row['jumlah_items'];
        $total_harga += $row['total_harga'];
        // $no++;
    }

    echo "<tr>";
    echo "<td colspan='5' align='center'>TOTAL</td>";
    echo "<td colspan='2' align='center'>Rp ". number_format($total_harga, 0, ',', '.') ."</td>";
    echo "</tr>";
?>

              </tbody>
                <tr>
                  <td class="signature" colspan="3" align="left"><b>Department : </b></td>
                  <td class="signature" colspan="3" align="center"><b>Approved by : </b></td>
                  <td class="signature" colspan="3" align="center"><b>Approved by : </b></td>
                </tr>
                <tr>
                  <td class="signature" colspan="3" align="center"><br><br><br></td>
                  <td class="signature" colspan="3" align="center"><br><br><br> Manager/Director in Charge</td>
                  <td class="signature" colspan="3" align="center"><br><br><br>General Affairs Department</td>
                </tr>
            </table>
                
            </div>
          </div>
          </div>
      
  </div>
</div>
<!-- modal update user -->
                    
                    <!-- </td>
                  </tr>
                </tbody>
              </table> -->
            </div>
          </div>


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