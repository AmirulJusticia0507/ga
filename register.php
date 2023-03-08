<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('koneksidb.php');

if(isset($_POST['submit'])){

    // Generate random token
    $token = bin2hex(random_bytes(32));

    // Get IP address
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Get form data
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $users_role = $_POST['users_role'];
    $department_id = $_POST['department_id'];
// Generate salt
$salt = bin2hex(random_bytes(32));

// Generate hashed password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare statement
$stmt = $koneksi->prepare("INSERT INTO users (department_id, fullname, username, password, salt, users_role, ip_address, token) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $department_id, $fullname, $username, $hashed_password, $salt, $users_role, $ip_address, $token);

// Execute statement
if($stmt->execute()){
    // Redirect to login page
    header("Location: index.php");
    exit();
} else {
    $register_error = "Register failed";
}
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Sistem Informasi PR (Payment Receipt)</title>
    <link rel="shortcut icon" href="aset/img/logo.png" type="image/x-icon">
    <script type="text/javascript" src="aset/bootstrap/js/jquery.js"></script>
    <script type="text/javascript" src="aset/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="aset/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="aset/font-awesome/css/font-awesome.min.css">
</head>

<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <div align="center">
        <br>
        <div align="center" style="width:320px;margin-top:5%;">
            <form name="register_form" method="post" class="well well-lg" action=""
                style="-webkit-box-shadow: 0px 0px 20px #888888;">
                <i class="fa fa-user-plus fa-4x"></i>
                <h4>Register Sistem Informasi PR (Payment Receipt)</h4>
                <br>
                <?php if (isset($register_error)) { ?>
                <p style="font-style: italic; color: red;"><?php echo $register_error; ?></p>
                <?php } ?>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                    <input required name="fullname" id="fullname" class="form-control" type="text"
                        placeholder="Fullname" autocomplete="off" />
                </div>
                <br />
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                    <input required name="username" id="username" class="form-control" type="text"
                        placeholder="Username" autocomplete="off" />
                </div>
                <br />
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select class="form-control" id="users_role" name="users_role">
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="department_id">Department:</label>
                    <select class="form-control" id="department_id" name="department_id">
                        <?php
            // ambil data dari tabel department
            $sql = "SELECT department_id, nama_department, keterangandepartment FROM paymentreceipt_apps.department";
            $result = mysqli_query($koneksi, $sql);

            // tampilkan opsi dari hasil query
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['department_id'] . "'>" . $row['keterangandepartment'] . "</option>";
                }
            }
            ?>
                    </select>
                </div>
                <br />
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                    <input required name="password" id="password" class="form-control" type="password"
                        placeholder="Password" autocomplete="off" />
                </div>
                <br />
                <!-- <input name="submit" type="submit" value="Register" class="btn btn-primary btn-block"> -->
                <input name="submit" type="submit" value="Register" class="btn btn-primary btn-block">

                <!-- Langkah 2 pada proses register -->
                <input type="hidden" name="register_token" value="<?php echo uniqid(); ?>">
                <input type="hidden" name="ip_address" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
            </form>
        </div>
    </div>


</body>

</html>