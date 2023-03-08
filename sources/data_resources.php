<?php 
session_start();
include '../template/header_admin.php'; 
include '../koneksidb.php';
?>
   
<div class="content-wrapper">
<section class="content-header">
  <h1>Data Resources
    <small>Semua Data Resources</small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="../admin/admin.php"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Data Resources</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">List Data Resources</h3> 
          <div class="box-tools pull-left"><br>
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#tambahsources"><i class="fa fa-file-text"></i> Tambah Resources</a>
          </div>
        </div>
        <div class="box-body">

          <div class="table-responsive22">
            <table id="datatable" class="display table table-bordered table-striped table-hover hover table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Source</th>
                  <th>Nama Toko</th>
                  <th>No. Hp Toko</th>
                  <th>No. Rekening</th>
                  <th>Nama Barang</th>
                  <th>Link Pembelian</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                    $no = 1;
                    $queryview = mysqli_query($koneksi, "SELECT 
                      *
                      FROM sourcesproc
                    ORDER BY sources_id ASC
                      LIMIT 0, 1000 ");
                    while ($row = mysqli_fetch_array($queryview)) {
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $row['source'];?></td>
                    <!-- <td><?php echo $row['sumbertoko'];?></td> -->
                    <td><?php echo $row['namatoko'];?></td>
                    <td><?php echo $row['nomortelptoko'];?></td>
                    <td><?php echo $row['rekeningtoko'];?></td>
                    <td ><?php echo $row['namabarang'];?></td>
                    <td ><?php echo $row['linkpembelian'];?></td>

                    <td>
                      <!--<a href="../user/form_edituser.php?id=<?php echo $row['users_id']?>" class="btn btn-primary btn-flat btn-xs"><i class="fa fa-pencil"></i> Edit</a>-->
                      <a href="#" class="btn btn-primary btn-flat btn-xs" data-toggle="modal" data-target="#updatesources<?php echo $no; ?>"><i class="fa fa-pencil"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#deletesources<?php echo $no; ?>"><i class="fa fa-trash"></i> Delete</a>                      
                      
                      <!-- modal delete -->
                      <div class="example-modal">
                        <div id="deletesources<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Konfirmasi Delete Data Resource</h3>
                              </div>
                              <div class="modal-body">
                                <h4 align="center" >Apakah anda yakin ingin menghapus source id <?php echo $row['sources_id'];?><strong><span class="grt"></span></strong> ?</h4>
                              </div>
                              <div class="modal-footer">
                                <button id="nodelete" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
                                <a href="../sources/function_resources.php?act=deletesources&sources_id=<?php echo $row['sources_id']; ?>" class="btn btn-primary">Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- modal delete -->

                      <!-- modal update user -->
                      <div class="example-modal">
                        <div id="updatesources<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Edit Data Resources</h3>
                              </div>
                              <div class="modal-body">
                                <form action="../sources/function_resources.php?act=updatesources" method="post" role="form" enctype="multipart/form-data">
                                  <?php
                                  $sources_id = $row['sources_id'];
                                  $query = "SELECT 
                                  *
                                  FROM sourcesproc
                                  WHERE sources_id='$sources_id'";
                                  $result = mysqli_query($koneksi, $query);
                                  while ($row = mysqli_fetch_array($result)) {
                                  ?>
                                  <!-- <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Id User <span class="text-red">*</span></label>         
                                      <div class="col-sm-8"><input type="text" class="form-control" name="request_id" placeholder="Id User" value="<?php echo $row['request_id']; ?>" readonly></div>
                                    </div>
                                  </div> -->
                                <div class="form-group">
                                  <div class="row">
                                  <label class="col-sm-3 control-label text-right">Sources of spending <span class="text-red" >*</span></label>
                                      <div class="col-sm-5">
                                      <select name="source" class="form-control select2" style="width: 100%;" id="combo2" required>
                                      <option value="" selected="selected">-- Pilih media pembelian --</option>
                                      <option value="offline" <?php echo $row['source']=='offline'? 'selected':'';?>>Offline</option>
                                      <option value="online" <?php echo $row['source']=='online'? 'selected':'';?>>Online</option>
                                      </select>
                                      </div>
                                  </div>
                                </div>
                                  <div class="form-group" id="kode">
                                    <div class="row">
                                    <label class="col-sm-3 control-label text-right">Nama Toko: <span class="text-red">*</span></label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="namatoko" placeholder="Nama Toko..." value="<?php echo $row['namatoko']; ?>"></div>
                                    </div>
                                  </div>
                                  <div class="form-group" id="kode">
                                    <div class="row">
                                    <label class="col-sm-3 control-label text-right">No. Telp Toko: 
                                      <span class="text-red">*</span></label>
                                    <div class="col-sm-5 input-group">
                                        <div class="input-group-addon">
                                          <i class="fa fa-phone"></i>
                                        </div>
                                          <input type="number" class="form-control" name="nomortelptoko" placeholder="No. Contact Toko ..." value="<?php echo $row['nomortelptoko']; ?>" maxlength="12">
                                    </div>
                                    </div>
                                  </div>

                                  <div class="form-group" id="kode">
                                    <div class="row">
                                    <label class="col-sm-4 control-label text-right">No. Rekening Toko: 
                                      <span class="text-red">*</span></label>
                                    <div class="col-sm-6 input-group">
                                        <div class="input-group-addon">
                                          <i class="fa fa-cc-mastercard"></i>
                                        </div>
                                          <input type="number" class="form-control" name="rekeningtoko" placeholder="No. rekening Toko ..." value="<?php echo $row['rekeningtoko']; ?>" >
                                    </div>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <div class="row">
                                    <label class="col-sm-3 control-label text-right">Nama Barang: 
                                      <span class="text-red">*</span></label>
                                    <div class="col-sm-8"><input type="text" class="form-control" name="namabarang" placeholder="Nama Barang..." value="<?php echo $row['namabarang']; ?>"></div>
                                    </div>
                                  </div>
                                  
                                  <div class="form-group">
                                    <div class="row">
                                    <label class="col-sm-3 control-label text-right">Link Pembelian: 
                                      <span class="text-red">(unless purchased <b>online</b>)</span>
                                    </label>
                                    <div class="col-sm-8">
                                      <input type="text" name="linkpembelian" class="form-control" value="<?php echo $row['linkpembelian']; ?>">
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
          <div id="tambahsources" class="modal fade" role="dialog" style="display:none;">
            <div class="modal-dialog"> 
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h3 class="modal-title">Insert Resources :</h3>
                </div>
                <div class="modal-body">
                  <form action="../sources/function_resources.php?act=tambahsources" method="post" role="form" enctype="multipart/form-data">
                    <!-- <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Id User <span class="text-red">*</span></label>         
                      <div class="col-sm-8"><input type="text" class="form-control" name="reqeues_id" placeholder="Id User" value=""></div>
                      </div>
                    </div> -->
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Sources of spending 
                        <span class="text-red">*</span></label>
                        <div class="col-sm-5">
                          <select name="source" class="form-control select2" style="width: 100%;" id="combo2" required>
                          <option value="" selected="selected">-- Pilih media pembelian --</option>
                          <option value="offline">Offline</option>
                          <option value="online">Online</option>
                        </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group" id="kode">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Nama Toko: <span class="text-red">*</span></label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="namatoko" placeholder="Nama Toko..." value="" ></div>
                      </div>
                    </div>
                    <div class="form-group" id="kode">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">No. Telp Toko: 
                        <span class="text-red">*</span></label>
                      <div class="col-sm-5 input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                      </div>
                            <input type="number" class="form-control" name="nomortelptoko" placeholder="No. Contact Toko ..." value="" maxlength="12" >
                      </div>
                      </div>
                    </div>

                    <div class="form-group" id="kode">
                      <div class="row">
                      <label class="col-sm-4 control-label text-right">No. Rekening Toko: 
                        <span class="text-red">*</span></label>
                      <div class="col-sm-6 input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-cc-mastercard"></i>
                      </div>
                            <input type="number" class="form-control" name="rekeningtoko" placeholder="No. rekening Toko ..." value="" >
                      </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Nama Barang: 
                        <span class="text-red">*</span></label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="namabarang" placeholder="Nama Barang..." value="" ></div>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Link Pembelian:
                        <span class="text-red">(unless purchased <b>online</b>)</span>
                      </label>
                      <div class="col-sm-8">
                        <input type="text" name="linkpembelian" id="linkpembelian" class="form-control" >
                      </div>
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

<script>
$(document).ready(function(){ 
  $("select[id=combo2]").on("change", function() { 
    if ($(this).val() === "offline") {
      $('select[id=kodeonline]').prop('selectedIndex',0);
      // $("select[id=kode]").prop("disabled", true);
      $("div[id=kodeonline]").hide(); 
    } 
    else { 
      $("select[id=kodeonline]").prop("enabled", false);
    } 
  }); 
  $("select[id=combo2]").trigger("change"); 
 
 
  $("select[id=combo2]").on("change", function() { 
    if ($(this).val() === "online") {
      $("div[id=kode]").hide();
      $('select[id=kodeonline]').prop('selectedIndex',0); 
    } 
    else { 
      $("div[id=kode]").show();
      $("select[id=kodeonline]").prop("enabled", true);
    } 
    // $('select[id=kode]').prop('selectedIndex',0);
      // $("select[id=kodeonline]").prop("disabled", true);
  }); 
  $("select[id=combo2]").trigger("change");
 
 
});
</script>

<?php include '../template/footer.php'; ?>