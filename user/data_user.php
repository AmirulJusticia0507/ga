<?php 
session_start();
include '../template/header_admin.php'; 
include '../koneksidb.php';
// //echo $_SESSION("users_id");
// $queryview = mysqli_query($koneksi, "SELECT * FROM users WHERE users_id='$user_id'");
// while ($row = mysqli_fetch_array($queryview)) {
//   $fullname=$row['fullname'];}
?>

<div class="content-wrapper">
<section class="content-header">
  <h1>Data User
    <small>Semua Data User dan CRUD Data User</small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="../admin/admin.php"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Data User</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">List Data User</h3> 
          <div class="box-tools pull-left"><br>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahuser"><i class="fa fa-male"></i> Tambah User</a>
          </div>
        </div>
        <div class="box-body">

          <div class="table-responsive22">
            <table id="table-datatables" class="display table table-bordered table-striped table-hover hover table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>No.</th>
                  <!-- <th>Id User</th> -->
                  <th>Nama Department</th>
                  <th>FullName</th>
                  <th>Username</th>
                  <!-- <th>Password</th> -->
                  <!-- <th width="20%">Photo Profile</th> -->
                  <th>User Role</th>
                  <!-- <th>IP Address</th> -->
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                    $no = 1;
                    $queryview = mysqli_query($koneksi, "SELECT 
                    users1.users_id, 
                    users1.fullname, 
                    users1.username, 
                    users1.password, 
                    users1.users_role,
                    department.keterangandepartment
                  FROM 
                    paymentreceipt_apps.users1 
                    JOIN paymentreceipt_apps.department ON users1.department_id = department.department_id                  
                      WHERE users1.users_id = $user_id
                      ORDER BY users_id ASC
                      LIMIT 0, 1000 ");
                    while ($row = mysqli_fetch_assoc($queryview)) {
                      // if($_SESSION['users_role'] == 'admin' || ($_SESSION['users_role'] == 'staff' && $row['departments_id'] == $_SESSION['departments_id'])) {
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <!-- <td><?php echo $row['users_id'];?></td> -->
                    <td><?php echo $row['keterangandepartment'];?></td>
                    <td><?php echo $row['fullname'];?></td>
                    <td><?php echo $row['username'];?></td>
                    <!-- <td><?php echo $row['password'];?></td> -->
                    <!-- <td><img src="upload/<?php echo $row['photo_profile'] ?>" width="35" height="40"></td> -->
                    <td><?php echo $row['users_role']; ?></td>
                    <!-- <td><?php echo $row['ip']; ?></td> -->
                    <td>
                      <!--<a href="../user/form_edituser.php?id=<?php echo $row['users_id']?>" class="btn btn-primary btn-flat btn-xs"><i class="fa fa-pencil"></i> Edit</a>-->
                      <a href="#" class="btn btn-primary btn-flat btn-xs" data-toggle="modal" data-target="#updateuser<?php echo $no; ?>"><i class="fa fa-pencil"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#deleteuser<?php echo $no; ?>"><i class="fa fa-trash"></i> Delete</a>                      
                      
                      <!-- modal delete -->
                      <div class="example-modal">
                        <div id="deleteuser<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Konfirmasi Delete Data User</h3>
                              </div>
                              <div class="modal-body">
                                <h4 align="center" >Apakah anda yakin ingin menghapus user id <?php echo $row['users_id'];?><strong><span class="grt"></span></strong> ?</h4>
                              </div>
                              <div class="modal-footer">
                                <button id="nodelete" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancle</button>
                                <a href="../user/function_user.php?act=deleteuser&users_id=<?php echo $row['users_id']; ?>" class="btn btn-primary">Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- modal delete -->

                      <!-- modal update user -->
                      <div class="example-modal">
                        <div id="updateuser<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Edit Data User</h3>
                              </div>
                              <div class="modal-body">
                                <form action="../user/function_user.php?act=updateuser" method="post" role="form" enctype="multipart/form-data">
                                  <?php
                                  $users_id = $row['users_id'];
                                  $query = "SELECT 
                                  users_id,
                                  departments_id,
                                  keterangandepartment,
                                  fullname,
                                  username,
                                  password,
                                  photo_profile,
                                  users_role,
                                  ip 
                                  FROM users
                                  LEFT JOIN department on users.departments_id = department.department_id
                                  WHERE users_id='$users_id'";
                                  $result = mysqli_query($koneksi, $query);
                                  while ($row = mysqli_fetch_assoc($result)) {
                                  ?>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Id User <span class="text-red">*</span></label>         
                                      <div class="col-sm-8">
                                        <!-- <input type="text" class="form-control" name="users_id" placeholder="Id User" value="<?php echo $row['users_id']; ?>" readonly></div> -->
                                      <input type="hidden" name="users_id" value="<?php echo $users_id; ?>">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                    <label class="col-sm-3 control-label text-right">Department <span class="text-red">*</span></label>
                                      <div class="col-sm-5">
                                        <select class="form-control" name="departments_id" id="departmentdata">
                                        <option value="<?php echo $row['departments_id']; ?>">Choose Department</option>
                                    <?php 
                                    $datadepartment = mysqli_query($koneksi,"SELECT 
                                    department_id,
                                    keterangandepartment 
                                    FROM paymentreceipt_apps.department 
                                    ");
                                    while($d = mysqli_fetch_array($datadepartment)){
                                        ?>
                                        <option value="<?php echo $d['department_id']; ?>" >
                                          
                                          <?php echo $d['keterangandepartment']; ?>
                                        </option>
                                        <?php 
                                    }
                                    ?>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                    <label class="col-sm-3 control-label text-right">Fullname: <span class="text-red">*</span></label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="fullname" placeholder="Nama Lengkap ..." value="<?php echo $row['fullname']; ?>"></div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Username <span class="text-red">*</span></label>
                                      <div class="col-sm-8"><input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $row['username']; ?>"></div>
                                    </div>
                                  </div>
                                  <div class="form-group">
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
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">User Role <span class="text-red">*</span></label>
                                    <div class="col-sm-4">
                                      <select name="users_role" class="form-control select2" style="width: 100%;">
                                          <option value="-" selected="selected">-- Pilih Satu --</option>
                                          <option value="admin"> <?php echo $row['users_role']=='Administrator'? 'selected':'';?> Administrator</option>
                                          <option value="staff"> <?php echo $row['users_role']=='Staff'? 'selected':'';?> Staff</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Upload Photo</label>
                                        <div class="col-sm-8">
                                          <input type="file" name="photo_profile" id="photo_profile" ><?php echo $row['photo_profile']; ?>
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
                  // }
                  ?>
              </tbody>
            </table>
          </div> 
        </div>

        <!-- modal insert -->
        <div class="example-modal">
          <div id="tambahuser" class="modal fade" role="dialog" style="display:none;">
            <div class="modal-dialog"> 
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h3 class="modal-title">Registrasi User Baru</h3>
                </div>
                <div class="modal-body">
                  <form action="../user/function_user.php?act=tambahuser" method="post" role="form" enctype="multipart/form-data">
                    <!-- <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Id User <span class="text-red">*</span></label>         
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="users_id" placeholder="Id User" value="" disabled></div>
                      </div>
                    </div> -->
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Department: <span class="text-red">*</span></label>
                        <div class="col-sm-5">
                          <select class="form-control" name="departments_id" id="departmentdata">
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
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Fullname: <span class="text-red">*</span></label>
                      <div class="col-sm-8"><input type="text" class="form-control" name="fullname" placeholder="Nama Lengkap ..." value=""></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Username <span class="text-red">*</span></label>
                      <div class="col-sm-8"><input type="text" class="form-control" name="username" placeholder="Username" value=""></div>
                      </div>
                    </div>
                    <div class="form-group">
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
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">User Role <span class="text-red">*</span></label>
                        <div class="col-sm-4">
                          <select name="users_role" class="form-control select2" style="width: 100%;">
                          <option value="User" selected="selected">-- Pilih Satu --</option>
                          <option value="admin">Administrator</option>
                          <option value="staff">Staff</option>
                        </select>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="form-group">
                      <div class="row">
                        <label class="col-sm-3 control-label text-right">Upload Photo</label>
                          <div class="col-sm-8">
                            <input type="file" name="photo_profile" id="photo_profile">
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