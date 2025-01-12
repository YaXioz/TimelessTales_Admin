<?php
//Informasi Database
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "timelesstales"); //sesuai dengan nama database
// define("BASE_URL", "www.cilukba.kesug.com");
define("BASE_URL", "//localhost/timelesstales");

//Membuat Koneksi
// $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//Cek Koneksi Database
// if (!$conn) {
//     echo "Koneksi Gagal;", mysqli_connect_error();
// } else {
// }

// SUPABASE
define("SUPABASE_URL", "https://mppsjkhhkmkwzbcxwvwi.supabase.co");
define("SUPABASE_KEY", "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Im1wcHNqa2hoa21rd3piY3h3dndpIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjQ1MDMyNzgsImV4cCI6MjA0MDA3OTI3OH0.mEg7DQjeW7ccHLGiNKIkcZtOkBnFZV9aOXX7_FDeGbI");
define("STORAGE_ID", "mppsjkhhkmkwzbcxwvwi");
