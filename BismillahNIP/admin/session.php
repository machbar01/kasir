<?php 
include "../admin/cong.php";
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>