<?php
include 'koneksidb.php';

//langkah 1
    if(isset($_POST['submit']))
    {
        //langkah 1
        $username =  $_POST['username'];
        $pass     =  $_POST['password'];
        // $get_token = isset($_POST['get_token']) ? $_POST['get_token'] : '';
        // $ip_address = isset($_POST['ip_address']) ? $_POST['ip_address'] : '';

$query = mysqli_query($koneksi, "SELECT * FROM users1 WHERE username = '".$username."' AND password = '".$pass."' "); 

        $data = mysqli_fetch_array($query);
        $user_login = $data['username'];
        $user_role = $data['users_role'];
        $user_id = $data['users_id'];


        if (mysqli_num_rows($query)>0) 
        {
            session_start();
            $_SESSION['username']       = $username;
            $_SESSION['users_role']     = $user_role;
            $_SESSION['users_id']     = $user_id;
            // $hashed_password = $data['password'];

            echo "berhasil login";
            if ($user_role == 'admin') 
            {
                header('location: admin/admin.php');
            }
            elseif ($user_role == 'staff') 
            {
                header('location: paymentreceipt/data_paymentreceipt.php');
            }
            
        } 
        else 
        {
            $error = true;
        }
    }
    ?>

<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// require_once 'koneksidb.php';

// if (isset($_POST['submit'])) {
//     $username = $_POST['username'];
//     $password = $_POST['password'];

//     try {
//         $sql = "SELECT * FROM paymentreceipt_apps.users WHERE username = ?";
//         $stmt = $koneksi->prepare($sql);
//         $stmt->bind_param("s", $username);
//         $stmt->execute();

//         $result = $stmt->get_result();

//         if ($result->num_rows > 0) {
//             $row = $result->fetch_assoc();
//             $users_id = $row['users_id'];
//             $department_id = $row['department_id'];
//             $fullname = $row['fullname'];
//             $hashed_password = $row['password'];
//             $user_role = $row['users_role'];
//             $salt = $row['salt'];
//             $ip = $row['ip_address'];
//             $token_db = $row['token'];

//             if (password_verify($salt . $password . $salt, $hashed_password) && $_SERVER['REMOTE_ADDR'] === $ip && isset($_COOKIE['token']) && $_COOKIE['token'] === $token_db) {
//                 session_start();
//                 $_SESSION['users_id'] = $users_id;
//                 $_SESSION['department_id'] = $department_id;
//                 $_SESSION['fullname'] = $fullname;
//                 $_SESSION['user_role'] = $user_role;
                
//                 if ($user_role == 'admin') {
//                     header('location: admin/admin.php');
//                     exit;
//                 } elseif ($user_role == 'staff') {
//                     header('location: paymentreceipt/data_paymentreceipt.php');
//                     exit;
//                 } else {
//                     $error = true;
//                     $error_message = "Akun tidak memiliki peran yang valid!";
//                 }
//             } else {
//                 $error = true;
//                 $error_message = "Username atau password salah!";
//             }        
//         } else {
//             $error = true;
//             $error_message = "Username atau password salah!";
//         }
//     } catch (Exception $e) {
//         $error = true;
//         $error_message = "Terjadi kesalahan saat melakukan login!";
//     }
   
//     mysqli_close($koneksi);
// } else {
//     $error = false;
//     $error_message = "";
// }

?>




<html>
    <head>
        <script type="text/javascript" src="aset/bootstrap/js/jquery.js"></script>
        <script type="text/javascript" src="aset/bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="aset/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="aset/font-awesome/css/font-awesome.min.css">
        <title>Login PR Payment Receipt</title>
        <link rel="shortcut icon" href="aset/img/logo.png" type="image/x-icon">
    </head>
    <body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
        <div align="center">
            <br>
            <div align="center" style="width:320px;margin-top:5%;">
                <!-- <form method="post" action="proses_login.php" class="well well-lg" action="" style="-webkit-box-shadow: 0px 0px 20px #888888;" > -->
                <form method="post" name="login_form" class="well well-lg" action="" style="-webkit-box-shadow: 0px 0px 20px #888888;" >
                    <i class="fa fa-money fa-4x"></i>
                    <h4>Login Sistem Informasi PR (Payment Receipt)</h4>
                    <br>
                    <?php if (isset($error)) { ?>
                        <p style="font-style: italic; color: red;">Username / Password anda salah</p>
                    <?php } ?>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                        <input required name="username" id="username" class="form-control" type="text" placeholder="Username" autocomplete="off" />
                    </div>
                    <br/>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                        <input required name="password" id="password" class="form-control" type="password" placeholder="Password" autocomplete="off" />
                    </div>
                    <br />
                    <input name="submit" type="submit" value="Login" class="btn btn-primary btn-block">
                    <!-- <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button> -->
                    <!-- Langkah 2 pada proses login -->
                    <!-- <input type="hidden" name="token" value="<?php echo uniqid(); ?>">
                    <input type="hidden" name="ip_address" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>"> -->
                    <br>
                    <!-- <a href="register.php" class="btn btn-success btn-block">Register</a> -->
                </form>
            </div>
        </div>
        <br>

        <footer align="center">
            Created By Amirul Putra Justicia - Full Stack Web Developer - 2023 <a href="#" title="PR"><i class="fa fa-copyright" aria-hidden="true"> Sistem Payment Receipt</i></a>
        </footer>


        </body>

</html>