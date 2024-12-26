<?php
$hostname ="localhost";
$username ="root";
$password ="";
$database ="kasir";

$db = mysqli_connect($hostname, $username, $password, $database);
if($db->connect_error){
    echo "Koneksi Data Rusak";
    die("Error");
}
?>