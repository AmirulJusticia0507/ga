<?php 
include '../template/header_admin.php'; 
include '../koneksidb.php';

$id = $_GET['id'];
$tgl = $_GET['tgl'];
// $statustransaksi = $_GET['status'];

//echo $_SESSION("users_id");
$queryview = mysqli_query($koneksi, "SELECT * FROM users WHERE users_id='$user_id'");
while ($row = mysqli_fetch_array($queryview)) {
  $fullname=$row['fullname'];}


// query untuk mengambil data dari tabel yang dibutuhkan
$query = mysqli_query($koneksi, "SELECT 
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
FROM paymentreceipt_apps.generalaffairspayment
LEFT JOIN department on generalaffairspayment.department_id = department.department_id
LEFT JOIN satuan ON generalaffairspayment.units_id = satuan.unit_id
WHERE request_id = '$id'");

?>
<!-- <link rel="stylesheet" href="./paymentreceipt.css"> -->
<style>
.signature {
    text-align: center;
}

.th-border,
.td-border {
    border: 2px solid black;
}

#myTable {
    border-color: black;
}
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Details PR
            <!-- <small>Semua Data Request Payment Receipt</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="../admin/admin.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Data PR</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                <div class="box-tools pull-right"><br>
                  <!-- <a href="#" class="btn btn-success" data-toggle="modal" data-target="#tambahpayments"><i class="fa fa-money"></i><span> New PR</span></a> -->
                  <button type="button" class="btn btn-danger" onclick="window.location.href = '../paymentreceipt/data_paymentreceipt.php'"><i class="fa fa-arrow-left"></i> Back</button> <a <?php echo " href='../paymentreceipt/printdocuments.php?id=$id&tgl=$tgl'"?> class="btn btn-primary"><i class="fa fa-print"></i> Cetak</a><br><br>

                </div>  
                <br><br><br><br>
                    <h4 class="text-left"><b class="text-black">&emsp;&emsp; PT. ASI PUDJIASTUTI AVIATION </b></h4>
                    <h3 class="text-center"><b> PURCHASE REQUISITION </b></h3>
                    <h5 class="text-center"><b> PR ID : <?php echo $id."/".date('Y/m/d', strtotime($tgl));?></b></h5>
                    <br><br>

                    <!-- &emsp;<button type="button" class="btn btn-primary" onclick="window.location.href = '../paymentreceipt/printdocuments.php?id=<?php echo $row['GApayment_id']; ?>'">Cetak</button> -->
                    <!-- &emsp;<button type="button" id="printButton" class="btn btn-primary" onclick="printFunction(<?php echo $row['GApayment_id']; ?>)">Cetak</button> -->
                    <!-- <button type="button" id="printButton" class="btn btn-primary" onclick="confirmPrint(<?php echo $row['GApayment_id']; ?>)">Cetak</button> -->
                    <!-- <button type="button" id="printButton" class="btn btn-primary" onclick="printFunction()">Cetak</button> -->

                    <!-- <b>Status : <b style="font-size: x-large;"><?php echo $statustransaksi; ?></b></b> -->
                    <!-- button back -->

                    <p class="modal-title text-end" align="left"><b>&emsp;&emsp;To : General Affair Department</b></p>
                    <p class="modal-title text-end" align="left"><b>&emsp;&emsp;UP</b></p>
                    <!-- <p class="modal-title text-end" align="right">
            <b>Status : <b style="font-size: x-large;"><?php echo $row['statustransaksi']; ?></b></b>
          </p> -->
                    <p class="modal-title text-end" align="right">
                        <b>Date : <?php echo date('d-M-Y'); ?></b>
                    </p>
                    <p class="modal-title text-end" align="right"><b>Received by GA : <?php echo date('d-M-Y'); ?></b>
                    </p>
                    <table
                        class="display table table-responsive table-bordered table-striped table-hover hover table-striped"
                        border="6" id="myTable">
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
            // $total_jumlah = 0;
            $no = 1;
            $total_harga = 0;
            // $total_harga = 0;
        while($row = mysqli_fetch_array($query)) {
        echo "<tr>";
          echo "<td class='td-border'>" . $no . "</td>";
          echo "<td class='td-border'>" . $row['deskripsi_items'] . "</td>";
          echo "<td class='td-border'>" . $row['jumlah_items'] . "</td>";
          echo "<td class='td-border'>" . $row['keterangansatuan'] . "</td>";
          echo "<td class='td-border'>Rp " . number_format($row['hargaitems'], 0, ',', '.') . "</td>";
          echo "<td class='td-border'>Rp " . number_format($row['total_harga'], 0, ',', '.') . "</td>";
          echo "<td class='td-border'>" . $row['usagegeneralaffair'] . "</td>";
        echo "</tr>";
        $no++;
        // $total_jumlah += $row['jumlah_items'];
        $total_harga += $row['total_harga'];
        $keterangan = $row['keterangandepartment'];
        // $no++;
    }

    echo "<tr>";
    echo "<td colspan='5' align='center'>TOTAL</td>";
    echo "<td colspan='2' align='center'>Rp ". number_format($total_harga, 0, ',', '.') ."</td>";
    echo "</tr>";
?>
                            <tr>
                                <td class="signature" colspan="3" align="left"><b>Department : </b></td>
                                <td class="signature" colspan="3" align="center"><b>Approved by : </b></td>
                                <td class="signature" colspan="3" align="center"><b>Approved by : </b></td>
                            </tr>
                            <tr>
                                <td class="signature" colspan="3" align="center"><br><br><br> <?php echo $keterangan; ?></td>
                                <td class="signature" colspan="3" align="center"><br><br><br> Manager/Director in Charge
                                </td>
                                <td class="signature" colspan="3" align="center"><br><br><br>General Affairs Department
                                </td>
                            </tr>
                            <br><br>
                        </tbody>
                    </table>
                </div>
                          <!-- modal insert -->
          <div class="example-modal">
            <div id="tambahpayments" class="modal fade" role="dialog" style="display:none; size:auto;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Insert Request PR:</h3>
                  </div>
                  <div class="modal-body">
                    <form action="../paymentreceipt/function_paymentreceipt.php?act=tambahpayments" method="post" id="formD" name="formD" role="form" enctype="multipart/form-data" onSubmit="validasi()">
                        <div class="form-group">
                          <div class="row">
                          <label class="col-sm-3 control-label text-right">Nama Request: 
                            <span class="text-red">*</span></label>
                            <div class="col-sm-5">

                              <input type="text" name="users_id" id="requestdata" value="<?php echo $fullname?>" disabled>
                              
                              <!-- <select class="form-control" name="users_id" id="requestdata" required> -->
                            <!-- <option value="<?php echo $_SESSION['username']?>"><?php echo $_SESSION['username']?></option> -->
                          <?php  
                          //$id = $_GET['users_id'];
                          $datareq = mysqli_query($koneksi,"SELECT 
                          users_id,
                          username,
                          keterangandepartment 
                          FROM paymentreceipt_apps.users
                          LEFT JOIN department ON users.departments_id = department.department_id
                          WHERE users_id = '$user_id' 
                          ");
                          while($d = mysqli_fetch_array($datareq)){
                                $dept = $d['keterangandepartment']; 
                          }
                          ?>
                              <!-- </select> -->
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                                    <div class="row">
                                    <label class="col-sm-3 control-label text-right">Department: 
                                      <span class="text-red">*</span></label>
                                      <div class="col-sm-5">

                                      <input type="text" name="department_id" id="departmentdata" value="<?php echo $dept ?>" disabled> 
                                      </div>
                                    </div>
                                  </div>
                                  <!-- <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Source: 
                                        <span class="text-red">*</span></label>
                                      <div class="col-sm-5">
                                        <select class="form-control" name="source_id" id="sourcedata">
                                          <option value=""> - </option>
                                          <?php 
                                          // $datasources = mysqli_query($koneksi,"SELECT 
                                          // * 
                                          // FROM paymentreceipt_apps.sourcesproc
                                          // ORDER BY namabarang ASC
                                          // ");
                                          // while($d = mysqli_fetch_array($datasources)){
                                              ?>
                                          <option value="<?php echo $d['sources_id']; ?>" value="<?php echo $row['namabarang']; ?>"><?php echo $d['namabarang']; ?>
                                          </option>
                                          <?php 
                                          // }
                                          ?>
                                        </select>
                                      </div>
                                    </div>
                                  </div> -->

                  

                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">Categories : 
                            <span class="text-red">*</span></label>
                          <div class="col-sm-4">
                            <select name="categories" class="form-control select2" style="width: 100%;" >
                              <option value="" selected="selected">-- Pilih Salah Satu --</option>
                              <option value="Akomodasi">Accomodations</option>
                              <option value="Building Maintenance">Building Maintenance</option>
                              <option value="Inventory">Inventory</option>
                              <option value="Office Service">Office Service</option>
                              <option value="Percetakan">Percetakan</option>
                              <option value="Transportasi">Transportasi</option>
                            </select>
                          </div>
                        </div>
                      </div>

                    

                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-4 control-label text-right">Peruntukan/Usage: 
                            <span class="text-red">*</span></label>
                          <div class="col-sm-6">
                            <!-- <textarea name="usagegeneralaffair" class="form-control" id="usagegeneralaffair" cols="2" rows="2"></textarea> -->
                            <input type="text" name="usagegeneralaffair" id="usagegeneralaffair" class="form-control">
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-4 control-label text-right">Description Items: 
                            <span class="text-red">*</span></label>
                          <div class="col-sm-6">
                            <input type="text" name="deskripsi_items" id="deskripsi_items" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                          <div class="row">
                          <!-- <label class="col-sm-2 control-label text-right">Quantity: 
                            <span class="text-red">*</span></label>
                            <div class="col-sm-2">
                            <input type="number" class="form-control" name="jumlah_items" placeholder="xxx" value="" onkeyup="OnChange(this.value)" onKeyPress="return isNumberKey(event)" align="center">
                          </div> -->
                          <label class="col-sm-3 control-label text-right">Quantity: 
                            <span class="text-red">*</span></label>
                            <div class="col-sm-2">
                              <input type="number" class="form-control" name="jumlah_items" id="jumlah_items" placeholder="xxx" value="<?php echo $row['jumlah_items']; ?>" onkeyup="OnChange(this.value)" onKeyPress="return isNumberKey(event)">
                            </div>
                          <!-- </div>
                      </div> -->
                      <!-- <div class="form-group">
                          <div class="row"> -->
                          <label class="col-sm-2 control-label text-right">Units: 
                            <span class="text-red"></span></label>
                            <div class="col-sm-4">
                              <select class="form-control" name="units_id" id="sourcesatuan">
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
                            <!-- </div>
                        </div> -->
                        </div>
                      </div>

                      <!-- <div class="form-group">
  <div class="row">
    <label class="col-sm-3 control-label text-right">Jumlah Items: <span class="text-red">*</span></label>
    <div class="col-sm-2">
      <input type="number" class="form-control" name="jumlah_items" id="jumlah_items" placeholder="xxx" value="<?php echo $row['jumlah_items']; ?>" onkeyup="OnChange(this.value)" onKeyPress="return isNumberKey(event)">
    </div>
  </div>
</div> -->

                  <div class="form-group">
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
                  </div>

<div class="form-group">
  <div class="row">
    <label class="col-sm-3 control-label text-right">Total Price: 
      <span class="text-red">*</span></label>
    <div class="col-sm-5">
      <!-- <span class="input-group-addon">Rp </span> -->
      <input type="number" class="form-control" name="total_harga" id="total_harga" placeholder="Rp xxx" value="" readonly>
      <span class="input-group-addon">,00</span>
    </div>
  </div>
</div>


                      <!-- <div class="form-group">
                      <div class="row">
                        <label class="col-sm-3 control-label text-right">Upload File</label>
                          <div class="col-sm-8">
                            <input type="file" name="linkpembelian" id="linkpembelian">
                            <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg</p>
                          </div>
                      </div>  
                    </div> -->

                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">Price Estimated: <span
                              class="text-red"></span></label>
                          <div class="col-sm-6">
                            <input type="number" class="form-control" name="price_estimate" placeholder="xxx" value="">
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-4 control-label text-right">Keterangan Barang: <span
                              class="text-red"></span></label>
                          <div class="col-sm-5">
                            <textarea name="keterangan" id="keterangan" class="form-control" cols="2"
                              rows="2"></textarea>
                          </div>
                        </div>
                      </div>

                      <!-- <div class="form-group">
                      <div class="row">
                        <label class="col-sm-3 control-label text-right">Upload Photo</label>
                          <div class="col-sm-8">
                            <input type="file" name="photoprofile" id="photo_profile">
                            <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg</p>
                          </div>
                      </div>
                    </div> -->
                      <div class="modal-footer">
                        <button id="nosave" type="button" class="btn btn-danger pull-left"
                          data-dismiss="modal">Selesai</button>
                        <input type="submit" name="submit" class="btn btn-primary" value="Tambah Data">

                      </div>
                      <!--<div class="box-footer">
                      <a href="../user/data_user.php" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>
                      <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                    </div> /.box-footer -->
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- modal insert close -->
            </div>
        </div>
    </section>
</div>

<script>
function printFunction(id) {
    window.location.href = '../paymentreceipt/printdocuments.php?id=' + id;
    window.print();
}
</script>

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

<!-- <script>
// function printReport(id) {
//     var GApayment_id = id;
//     window.location.href = '../paymentreceipt/printdocuments.php?=' + GApayment_id;
// }
function printReport(id) {
    var GApayment_id = id;
    window.location.href = '../paymentreceipt/printdocuments.php?GApayment_id=' + GApayment_id;
}
</script> -->

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