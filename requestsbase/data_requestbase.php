<?php 
include '../template/header_admin.php'; 
include '../koneksidb.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.css" integrity="sha512-uq8QcHBpT8VQcWfwrVcH/n/B6ELDwKAdX4S/I3rYSwYldLVTs7iII2p6ieGCM13QTPEKZvItaNKBin9/3cjPAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="content-wrapper">
<section class="content-header">
  <h1>Data Request dari Base Susi Air
    <small>Semua Data Request dari Base</small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="../admin/admin.php"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Data Request Base</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">List Data Request Base</h3> 
          <div class="box-tools pull-left"><br>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahrequestbaseorder"><i class="fa fa-male"></i> Tambah Request from Base</a>
          </div>
        </div>
        <div class="box-body">

          <div class="table-responsive22">
            <table id="datatable" class="display table table-bordered table-striped table-hover hover table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Request dari Base</th>
                  <th>Jabatan</th>
                  <th>Basename</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                    $no = 1;
                    $queryview = mysqli_query($koneksi, "SELECT 
                        regbase_id,
                        namarequestbase,
                        jabatan,
                        kode_base,
                        basename
                        FROM
                        paymentreceipt_apps.requestbase
                        LEFT JOIN base ON requestbase.kode_base = base.base_id
                        LIMIT 0, 1000 ");
                    while ($row = mysqli_fetch_assoc($queryview)) {
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $row['namarequestbase'];?></td>
                    <td><?php echo $row['jabatan'];?></td>
                    <td nowrap><?php echo $row['basename'];?></td>
                    <td>
                      <!--<a href="../user/form_edituser.php?id=<?php echo $row['users_id']?>" class="btn btn-primary btn-flat btn-xs"><i class="fa fa-pencil"></i> Edit</a>-->
                      <a href="#" class="btn btn-primary btn-flat btn-xs" data-toggle="modal" data-target="#updaterequestbase<?php echo $no; ?>"><i class="fa fa-pencil"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#deleterequestbase<?php echo $no; ?>"><i class="fa fa-trash"></i> Delete</a>                      
                      
                      <!-- modal delete -->
                      <div class="example-modal">
                        <div id="deleterequestbase<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Konfirmasi Delete Data Request Basename</h3>
                              </div>
                              <div class="modal-body">
                                <h4 align="center" >Apakah anda yakin ingin menghapus Request base id <?php echo $row['regbase_id'];?><strong><span class="grt"></span></strong> ?</h4>
                              </div>
                              <div class="modal-footer">
                                <button id="nodelete" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
                                <a href="../requestbase/function_requestbasename.php?act=deleterequestbase&regbase_id=<?php echo $row['regbase_id']; ?>" class="btn btn-primary">Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- modal delete -->

                      <!-- modal update user -->
                      <div class="example-modal">
                        <div id="updaterequestbase<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Edit Data Request Basename</h3>
                              </div>
                              <div class="modal-body">
                                <form action="../requestbase/function_requestbasename.php?act=updaterequestbase" method="post" role="form" enctype="multipart/form-data">
                                  <?php
                                  $regbase_id = $row['regbase_id'];
                                  $query = "SELECT 
                                    regbase_id,
                                    namarequestbase,
                                    jabatan,
                                    kode_base,
                                    basename
                                    FROM
                                    paymentreceipt_apps.requestbase
                                    LEFT JOIN base ON requestbase.kode_base = base.base_id
                                  WHERE regbase_id='$regbase_id'";
                                  $result = mysqli_query($koneksi, $query);
                                  while ($row = mysqli_fetch_assoc($result)) {
                                  ?>
                                  <!-- <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Id User <span class="text-red">*</span></label>         
                                      <div class="col-sm-8"><input type="text" class="form-control" name="base_id" placeholder="Id User" value="<?php echo $row['base_id']; ?>" readonly></div>
                                    </div>
                                  </div> -->
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Nama Base: <span class="text-red">*</span></label>
                                      <div class="col-sm-8"><input type="text" class="form-control" name="basename" placeholder="Nama Base Susi Air ..." value="<?php echo $row['basename']; ?>"></div>
                                    </div>
                                  </div>
                                  <!-- <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Password <span class="text-red">*</span></label>
                                      <div class="col-sm-8"><input type="password" class="form-control" name="password" placeholder="Password" id="myPassword" value="<?php echo $row['password']; ?>">
                                        <input type="checkbox" onclick="myFunction()"> Lihat Password
                                          <script>
                                          function myFunction() {
                                            var x = document.getElementById("myPassword");
                                            if (x.type === "password") {
                                              x.type = "text";
                                            } else {
                                              x.type = "password";
                                            }
                                          }
                                          </script>
                                      </div>
                                    </div>
                                  </div> -->
                                  <div class="form-group">
                                    <div class="row">
                                    <label class="col-sm-3 control-label text-right">Keterangan Base:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="keteranganbase" placeholder="keterangan basename Susi Air..." value="<?php echo $row['keteranganbase']; ?>"></div>
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
          <div id="tambahrequestbaseorder" class="modal fade" role="dialog" style="display:none;">
            <div class="modal-dialog"> 
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h3 class="modal-title">Insert Request from Base :</h3>
                </div>
                <div class="modal-body">
                  <form action="../requestbase/function_requestbasename.php?act=tambahrequestbaseorder" method="post" role="form" enctype="multipart/form-data">
                    <!-- <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Id User <span class="text-red">*</span></label>         
                      <div class="col-sm-8"><input type="text" class="form-control" name="reqeues_id" placeholder="Id User" value=""></div>
                      </div>
                    </div> -->
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Nama Request from Base: <span class="text-red">*</span></label>
                      <div class="col-sm-8"><input type="text" class="form-control" name="namarequestbase" placeholder="Nama Request..." value=""></div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Jabatan: <span class="text-red">*</span></label>
                      <div class="col-sm-8"><input type="text" class="form-control" name="jabatan" placeholder="Jabatan di Base ..." value=""></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Basename: <span class="text-red">*</span></label>
                        <div class="col-sm-5">
                        <!-- <input type="text" name="kode_base" id="kode_base" class="form-control" autocomplete="off" required> -->
                          <select class="form-control" name="kode_base" id="kode_base" autocomplete="off">
                          <option value="">Choose Base</option>
                              <?php 
                              $database = mysqli_query($koneksi,"SELECT 
                              * 
                              FROM paymentreceipt_apps.base
                              ORDER BY basename ASC 
                              ");
                              while($d = mysqli_fetch_array($database)){
                                  ?>
                                  <option value="<?php echo $d['base_id']; ?>">
                                    
                                    <?php echo $d['basename']; ?>
                                  </option>
                                  <?php 
                              }
                              ?>
                          </select>
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
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
// $(function() {
//   // memanggil fungsi autocomplete dengan parameter id input yang akan diberi autocomplete
//   $("#kode_base").autocomplete({
//     // source adalah parameter yang menentukan sumber data untuk autocomplete.
//     // Dalam hal ini, sumber data adalah file ajax_autocomplete.php yang mengolah data dari database
//     source: "../requestbase/searchbase.php",
//     // setelah user memilih salah satu data dari hasil autocomplete, pilihan tersebut akan ditampilkan
//     // di input form dengan id kode_base
//     select: function(event, ui) {
//       $('#kode_base').val(ui.item.value);
//     }
//   });
// });
$(document).ready(function() {
  // menangkap elemen input dengan id kode_base
  $("#kode_base").autocomplete({
    // mengambil data dari server menggunakan AJAX
    source: function(request, response) {
      $.ajax({
        url: "../requestbase/searchbase.php",
        type: "GET",
        data: {
          term: request.term
        },
        dataType: "json",
        success: function(data) {
          response(data);
        }
      });
    },
    // menampilkan data yang dipilih pada input
    select: function(event, ui) {
      $("#kode_base").val(ui.item.value);
    }
  });
});
</script> -->

<?php include '../template/footer.php'; ?>