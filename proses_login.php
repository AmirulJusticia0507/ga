<?php
include './koneksidb.php';

if(isset($_POST['submit']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Step 1: Get user data from database
    $stmt = $koneksi->prepare("SELECT * FROM paymentreceipt_apps.users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $users_id = $row['users_id'];
        $department_id = $row['department_id'];
        $fullname = $row['fullname'];
        $hashed_password = $row['password'];
        $user_role = $row['users_role'];
        $salt = $row['salt'];
        $ip = $row['ip_address'];
        $token_db = $row['token'];

        // Step 2: Verify user's password
        if (password_verify($salt . $password . $salt, $hashed_password)) {
            // Step 3: Verify user's IP address
            if ($_SERVER['REMOTE_ADDR'] === $ip) {
                // Step 4: Verify user's token
                if (isset($_COOKIE['token']) && $_COOKIE['token'] === $token_db) {
                    // Step 5: Start a new session
                    session_start();
                    $_SESSION['users_id'] = $users_id;
                    $_SESSION['department_id'] = $department_id;
                    $_SESSION['fullname'] = $fullname;
                    $_SESSION['user_role'] = $user_role;
                    
                    if ($user_role == 'admin') {
                        header('location: admin/admin.php');
                        exit;
                    } elseif ($user_role == 'staff') {
                        header('location: paymentreceipt/data_paymentreceipt.php');
                        exit;
                    }
                } else {
                    $error = true;
                    echo "Token tidak valid!";
                }
            } else {
                $error = true;
                echo "Alamat IP tidak valid!";
            }
        } else {
            $error = true;
            echo "Username atau password salah!";
        }
    } else {
        $error = true;
        echo "Username atau password salah!";
    }
}

// If there is an error, redirect back to the login page
if(isset($error)) {
    header('location: index.php');
    exit;
}
?>
