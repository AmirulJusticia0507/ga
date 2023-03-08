<?php 
include '../template/header_admin.php'; 
include '../koneksidb.php';
?>

<div class="content-wrapper">
<section class="content-header">
  <h1>Data PR
    <small>Semua Data PR dan CRUD Data PR</small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="../admin/admin.php"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Data PR</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">List Data PR</h3> 
          <div class="box-tools pull-left"><br>
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#tambahpr"><i class="fa fa-male"></i> Tambah PR baru</a>
          </div>
        </div>
        <div class="box-body">

          <div class="table-responsive22">
            <table id="table-datatables" class="display table table-bordered table-striped table-hover hover table-striped" style="width: 100%;" >
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Date PR</th>
                  <th>Nama Request PR</th>
                  <th>Approved By</th>
                  <th>Descrition Items</th>
                  <th>Quantity Items</th>
                  <th>Price</th>
                  <th>Total</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                $no = 1;
                $queryview = mysqli_query($koneksi, "SELECT 
                    id_archieved,
                    payments_id,
                    namarequestPR,
                    managerapproved,
                    DATE_FORMAT(tanggal_selesai,'%d/%m/%Y') AS tanggal_selesai,
                    hargarencana,
                    description,
                    quantity,
                    COUNT(quantity*hargarencana=hargaaktual) AS Total
                    FROM
                    paymentreceipt_apps.archieved
                LEFT JOIN generalaffairspayment ON archieved.payments_id= generalaffairspayment.GApayment_id
                            ORDER BY tanggal_selesai ASC
                            LIMIT 0, 1000 ");
                while ($row = mysqli_fetch_assoc($queryview)) {
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td align="center" nowrap><?php echo date('d/m/y', strtotime($row['tanggal_selesai'])); ?></td>
                    <td><?php echo $row['namarequestPR'];?></td>
                    <td><?php echo $row['managerapproved'];?></td>
                    <td><?php echo $row['description'];?></td>
                    <td><?php echo $row['quantity'];?></td>
                    <td align="center"><?php echo "Rp. ".number_format($row['hargarencana'])." ,-"; ?></td>
                    <td align="center"><?php echo "Rp. ".number_format($row['Total']). " ,-"; ?></td>
                    <td>
                      <!--<a href="../user/form_edituser.php?id=<?php echo $row['users_id']?>" class="btn btn-primary btn-flat btn-xs"><i class="fa fa-pencil"></i> Edit</a>-->
                      <a href="#" class="btn btn-primary btn-flat btn-xs" data-toggle="modal" data-target="#updatepr<?php echo $no; ?>"><i class="fa fa-pencil"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#deletepr<?php echo $no; ?>"><i class="fa fa-trash"></i> Delete</a>                      
                      
                      <!-- modal delete -->
                      <div class="example-modal">
                        <div id="deletepr<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Konfirmasi Delete Data PR</h3>
                              </div>
                              <div class="modal-body">
                                <h4 align="center" >Apakah anda yakin ingin menghapus PR id <?php echo $row['id_archieved'];?><strong>--<?php echo $row['tanggal_selesai'];?><span class="grt"></span></strong> ?</h4>
                              </div>
                              <div class="modal-footer">
                                <button id="nodelete" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
                                <a href="../PR/function_PR.php?act=deletepr&id_archieved=<?php echo $row['id_archieved']; ?>" class="btn btn-primary">Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- modal delete -->

                      <!-- modal update user -->
                      <div class="example-modal">
                        <div id="updatepr<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Detail form Data Purchase Request</h3>
                              </div>
                              <div class="modal-body">
                                <form action="../PR/function_PR.php?act=updatepr" method="post" role="form" enctype="multipart/form-data">
                                  <?php
                                  $id_archieved = $row['id_archieved'];
                                  $query = "SELECT 
                                    id_archieved,
                                    payments_id,
                                    namarequestPR,
                                    managerapproved,
                                    tanggal_selesai,
                                    hargarencana,
                                    description,
                                    quantity,
                                    COUNT(quantity*hargarencana=hargaaktual) AS Total
                                    FROM paymentreceipt_apps.archieved
                                    LEFT JOIN generalaffairspayment ON archieved.payments_id= generalaffairspayment.GApayment_id
                                    WHERE id_archieved='$id_archieved'
                                    ORDER BY tanggal_selesai ASC";
                                  $result = mysqli_query($koneksi, $query);
                                  while ($row = mysqli_fetch_array($result)) {
                                  ?>
                                  <div class="form-group">
                                    <div class="row">
                                    <label class="col-sm-4 control-label text-right">Request by Department / Base: 
                                        <span class="text-red">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="namarequestPR" placeholder="Nama Request by ...." value="<?php echo $row['namarequestPR']; ?>">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                    <div class="row">
                                    <label class="col-sm-4 control-label text-right">Approved by: 
                                        <span class="text-red">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="managerapproved" placeholder="yang menyetujui ...." value="<?php echo $row['managerapproved']; ?>">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                    <div class="row">
                                    <label class="col-sm-3 control-label text-right">Description: 
                                        <span class="text-red">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="description" placeholder="Deskripsi barang ...." value="<?php echo $row['description']; ?>">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                    <div class="row">
                                    <label class="col-sm-3 control-label text-right">Items: 
                                        <span class="text-red">*</span></label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" name="quantity" placeholder="Jumlah barang ...." value="<?php echo $row['quantity']; ?>">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                        <label class="col-sm-3 control-label text-right">Est. Price: 
                                            <span class="text-red"></span></label>
                                        <div class="col-sm-5">
                                            <input type="number" class="form-control" name="hargarencana" id="hargarencana" placeholder="Rp xxx" value="<?php echo $row['hargarencana']; ?>" onKeyPress="return isNumberKey(event)"></div>
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
                                    <button id="noedit" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
                                    <input type="submit" name="submit" class="btn btn-primary" value="Update">
                                  </div>
                                  <?php
                                  }
                                  ?>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- modal update user -->
                    </td>
                  </tr>
                  <?php
                    }
                  ?>
              </tbody>
            </table>
          </div> 
        </div>

        <!-- modal insert -->
        <div class="example-modal">
          <div id="tambahpr" class="modal fade" role="dialog" style="display:none;">
            <div class="modal-dialog"> 
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h3 class="modal-title">Insert Request :</h3>
                </div>
                <div class="modal-body">
                  <form action="../PR/function_PR.php?act=tambahpr" method="post" role="form" enctype="multipart/form-data">
                  <div class="form-group">
                      <div class="row">
                      <label class="col-sm-4 control-label text-right">Request by Department / Base: 
                        <span class="text-red">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="namarequestPR" placeholder="Nama Request by ...." value="">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-4 control-label text-right">Approved by: 
                        <span class="text-red">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="managerapproved" placeholder="yang menyetujui ...." value="">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Description: 
                        <span class="text-red">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="description" placeholder="Deskripsi barang ...." value="">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Items: 
                        <span class="text-red">*</span></label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="quantity" placeholder="Jumlah barang ...." value="">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                        <label class="col-sm-3 control-label text-right">Est. Price: 
                            <span class="text-red"></span></label>
                          <div class="col-sm-5">
                            <input type="number" class="form-control" name="hargarencana" id="hargarencana"
                              placeholder="Rp xxx" value="" onKeyPress="return isNumberKey(event)"></div>
                        </div>
                    </div>

                    <div class="modal-footer">
                      <button id="nosave" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
                      <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
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
  </div>
</section><!-- /.content -->
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"
  integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
  $(document).ready(function () {

    // Format mata uang.
    $('.hargarencana').mask('000.000.000', {
      reverse: true
    });
    // $('.total_harga').mask('000.000.000', {
    //   reverse: true
    // });
    // $('.price_estimate').mask('000.000.000', {
    //   reverse: true
    // });

  })
</script>

<script>
        hargasatuan = document.formD.hargarencana.value;
        document.formD.hargaaktual.value = hargasatuan;
        jumlah = document.formD.quantity.value;
        document.formD.hargaaktual.value = jumlah;

    function OnChange(value) {
    hargasatuan = document.formD.hargarencana.value;
    jumlah = document.formD.quantity.value;
    total = hargasatuan * jumlah;
    document.formD.hargaaktual.value = total;
    }
</script>

<?php include '../template/footer.php'; ?>