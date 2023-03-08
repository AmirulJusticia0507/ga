<?php

// Sertakan library Google OAuth 2.0 dan file client_secret.json
require_once __DIR__ . './vendor/autoload.php';
$client_secret_json = __DIR__ . '/client_secret_1058017296217-r7vf80lqh6n0041hl7vhddha6so2k1vh.apps.googleusercontent.com.json';

// Buat objek Google Client
$client = new Google_Client();
$client->setAuthConfig($client_secret_json);

// Set scope yang akan digunakan
$client->addScope(Google_Service_Oauth2::USERINFO_PROFILE);

// Cek apakah user sudah melakukan login dengan Google
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  // Jika sudah, set akses token ke objek Google Client
  $client->setAccessToken($_SESSION['access_token']);
} else {
  // Jika belum, cek apakah user telah mengirimkan permintaan login
  if (isset($_GET['code'])) {
    // Jika sudah, ambil akses token dari Google
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
  } else {
    // Jika belum, buat URL login Google dan redirect ke halaman tersebut
    $login_url = $client->createAuthUrl();
    header('Location: ' . $login_url);
  }
}

// Cek apakah akses token masih valid
if ($client->isAccessTokenExpired()) {
    // Jika tidak, ambil akses token baru
    $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
    $_SESSION['access_token'] = $client->getAccessToken();
  }
  
  // Buat objek Google Service Oauth2
  $service = new Google_Service_Oauth2($client);
  
  // Ambil informasi user dari Google
  $user_info = $service->userinfo->get();
  
  // Simpan informasi user ke dalam variabel
  $user_id = $user_info->getId();
  $user_name = $user_info->getName();
  $user_email = $user_info->getEmail();
  
  // Tambahkan logika untuk mengelola user yang telah login di aplikasi web Anda

  // Redirect ke halaman dashboard
header('Location:../admin/admin.php');
exit;

?>