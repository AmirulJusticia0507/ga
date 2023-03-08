<?php 
include '../template/header_admin.php'; 
include '../koneksidb.php';
?>

<div class="content-wrapper">
<section class="content-header">
  <h1>Data Requests
    <small>Semua Data Request dan CRUD Data Request</small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="../admin/admin.php"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Data Requests</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">List Data Request</h3> 
          <div class="box-tools pull-left"><br>
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#tambahrequests"><i class="fa fa-male"></i> Tambah Requests from Department</a>
          </div>
        </div>
        <div class="box-body">

          <div class="table-responsive22">
            <table id="datatable" class="display table table-bordered table-striped table-hover hover table-striped" style="width:100%" >
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Requests</th>
                  <th>Nama Department</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                    $no = 1;
                    $queryview = mysqli_query($koneksi, "SELECT 
                      request_id,
                      keterangandepartment,
                      nama_request
                      FROM requests
                      left join department on requests.department_id = department.department_id
                      ORDER BY nama_request ASC
                      LIMIT 0, 1000 ");
                    while ($row = mysqli_fetch_assoc($queryview)) {
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <!-- <td><?php echo $row['nama_request'];?></td> -->
                    <td><?php echo $row['nama_request'];?></td>
                    <td><?php echo $row['keterangandepartment'];?></td>
                    <td>
                      <!--<a href="../user/form_edituser.php?id=<?php echo $row['users_id']?>" class="btn btn-primary btn-flat btn-xs"><i class="fa fa-pencil"></i> Edit</a>-->
                      <a href="#" class="btn btn-primary btn-flat btn-xs" data-toggle="modal" data-target="#updaterequests<?php echo $no; ?>"><i class="fa fa-pencil"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#deleterequests<?php echo $no; ?>"><i class="fa fa-trash"></i> Delete</a>                      
                      
                      <!-- modal delete -->
                      <div class="example-modal">
                        <div id="deleterequests<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Konfirmasi Delete Data Request</h3>
                              </div>
                              <div class="modal-body">
                                <h4 align="center" >Apakah anda yakin ingin menghapus request id <?php echo $row['request_id'];?><strong><span class="grt"></span></strong> ?</h4>
                              </div>
                              <div class="modal-footer">
                                <button id="nodelete" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
                                <a href="../requests/function_requests.php?act=deleterequests&request_id=<?php echo $row['request_id']; ?>" class="btn btn-primary">Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- modal delete -->

                      <!-- modal update user -->
                      <div class="example-modal">
                        <div id="updaterequests<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Edit Data Request</h3>
                              </div>
                              <div class="modal-body">
                                <form action="../requests/function_requests.php?act=updaterequests" method="post" role="form" enctype="multipart/form-data">
                                  <?php
                                  $request_id = $row['request_id'];
                                  $query = "SELECT 
                                  request_id,
                                  keterangandepartment,
                                  nama_request
                                  FROM requests
                                  left join department on requests.request_id = department.department_id
                                  WHERE request_id='$request_id'";
                                  $result = mysqli_query($koneksi, $query);
                                  while ($row = mysqli_fetch_assoc($result)) {
                                  ?>
                                  <!-- <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Id User <span class="text-red">*</span></label>         
                                      <div class="col-sm-8"><input type="text" class="form-control" name="request_id" placeholder="Id User" value="<?php echo $row['request_id']; ?>" readonly></div>
                                    </div>
                                  </div> -->
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Nama Requests: <span class="text-red">*</span></label>
                                      <div class="col-sm-8"><input type="text" class="form-control" name="nama_request" placeholder="Nama Request ..." value="<?php echo $row['nama_request']; ?>"></div>
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
                                    <label class="col-sm-3 control-label text-right">Department: <span class="text-red">*</span></label>
                                      <div class="col-sm-5">
                                        <select class="form-control" name="department_id" id="departmentdata">
                                        <option value="">Choose Department</option>
                                    <?php 
                                    $datadepartment = mysqli_query($koneksi,"SELECT 
                                    department_id,
                                    keterangandepartment 
                                    FROM paymentreceipt_apps.department 
                                    ");
                                    while($d = mysqli_fetch_array($datadepartment)){
                                        ?>
                                        <option value="<?php echo $d['department_id']; ?>">
                                          
                                          <?php echo $d['keterangandepartment']; ?>
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
          <div id="tambahrequests" class="modal fade" role="dialog" style="display:none;">
            <div class="modal-dialog"> 
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h3 class="modal-title">Insert Request :</h3>
                </div>
                <div class="modal-body">
                  <form action="../requests/function_requests.php?act=tambahrequests" method="post" role="form" enctype="multipart/form-data">
                    <!-- <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Id User <span class="text-red">*</span></label>         
                      <div class="col-sm-8"><input type="text" class="form-control" name="reqeues_id" placeholder="Id User" value=""></div>
                      </div>
                    </div> -->
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Nama Requests: <span class="text-red">*</span></label>
                      <div class="col-sm-8"><input type="text" class="form-control" name="nama_request" placeholder="Nama Request..." value=""></div>
                      </div>
                    </div>
                    <!-- <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Password <span class="text-red">*</span></label>
                      <div class="col-sm-8"><input type="password" class="form-control" name="password" placeholder="Password" id="myPassword" value="">
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
                      <label class="col-sm-3 control-label text-right">Department: <span class="text-red">*</span></label>
                        <div class="col-sm-5">
                          <select class="form-control" name="department_id" id="departmentdata">
                          <option value="">Choose Department</option>
                      <?php 
                      $datadepartment = mysqli_query($koneksi,"SELECT 
                      department_id,
                      keterangandepartment 
                      FROM paymentreceipt_apps.department
                      ORDER BY keterangandepartment ASC
                       ");
                      while($d = mysqli_fetch_array($datadepartment)){
                          ?>
                          <option value="<?php echo $d['department_id']; ?>">
                            
                            <?php echo $d['keterangandepartment']; ?>
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

<?php include '../template/footer.php'; ?>