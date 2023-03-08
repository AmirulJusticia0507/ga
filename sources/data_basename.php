<?php 
include '../template/header_admin.php'; 
include '../koneksidb.php';
?>
                <?php
$timeout = 10; // Set timeout minutes
$logout_redirect_url = "../index.php"; // Set logout URL

$timeout = $timeout * 60; // Converts minutes to seconds
if (isset($_SESSION['start_time'])) {
    $elapsed_time = time() - $_SESSION['start_time'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
        echo "<script>alert('Session Anda Telah Habis!'); window.location = '$logout_redirect_url'</script>";
    }
}
$_SESSION['start_time'] = time();
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
          <div class="box-tools pull-left">
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#tambahsources"><i class="fa fa-map-marker"></i> Tambah Resources</a>
          </div>
        </div>
        <div class="box-body">

          <div class="table-responsive22">
            <table id="datatable" class="display table table-bordered table-striped table-hover hover table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>No.</th>
                  <th>Source</th>
                  <th>Sumber Toko</th>
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
                    ORDER BY sumbertoko ASC
                      LIMIT 0, 1000 ");
                    while ($row = mysqli_fetch_assoc($queryview)) {
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $row['source'];?></td>
                    <td><?php echo $row['sumbertoko'];?></td>
                    <td><?php echo $row['namatoko'];?></td>
                    <td><?php echo $row['nomortelptoko'];?></td>
                    <td><?php echo $row['rekeningtoko'];?></td>
                    <td><?php echo $row['namabarang'];?></td>
                    <td><?php echo $row['linkpembelian'];?></td>
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
                                <h3 class="modal-title">Konfirmasi Delete Data Source</h3>
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
                                --   left join department on requests.sources_id = department.department_id
                                  WHERE sources_id='$sources_id'";
                                  $result = mysqli_query($koneksi, $query);
                                  while ($row = mysqli_fetch_assoc($result)) {
                                  ?>
                                  <!-- <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Id User <span class="text-red">*</span></label>         
                                      <div class="col-sm-8"><input type="text" class="form-control" name="sources_id" placeholder="Id User" value="<?php echo $row['sources_id']; ?>" readonly></div>
                                    </div>
                                  </div> -->
                                  <div class="form-group">
                                    <div class="row">
                                    <label class="col-sm-3 control-label text-right">Sources of spending <span class="text-red" id="combo2">*</span></label>
                                        <div class="col-sm-5">
                                        <select name="source" class="form-control select2" style="width: 100%;">
                                        <option value="" selected="selected">-- Pilih media pembelian --</option>
                                        <option value="offline" <?php echo $row['source']=='offline'? 'selected':'';?>>Offline</option>
                                        <option value="online" <?php echo $row['source']=='online'? 'selected':'';?>>Online</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>

                                  <div class="form-group">
                                      <div class="row">
                                      <label class="col-sm-3 control-label text-right">Keterangan Base:</label>
                                      <div class="col-sm-8">
                                          <input type="text" class="form-control" name="keteranganbase" placeholder="keterangan basename Susi Air..." value="<?php echo $row['keteranganbase']; ?>"></div>
                                      </div>
                                    </div>

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
                  <h3 class="modal-title">Insert Base :</h3>
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
                          <select name="source" class="form-control select2" style="width: 100%;" id="combo2">
                          <option value="" selected="selected">-- Pilih media pembelian --</option>
                          <option value="offline">Offline</option>
                          <option value="online">Online</option>
                        </select>
                        </div>
                      </div>
                    </div>

                    <div class="form-group" id="kode">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Nama Toko: 
                        <span class="text-red">*</span></label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="namatoko" placeholder="Nama Toko..." value="">
                      </div>
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
                            <input type="number" class="form-control" name="nomortelptoko" placeholder="No. Contact Toko ..." value="" maxlength="12">
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

<?php include '../template/footer.php'; ?>