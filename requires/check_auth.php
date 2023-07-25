<?php

$checkAuth  = false;
if(isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['email'])) {
    $sqlRes = "SELECT count(id) AS total FROM `users` WHERE id ='". $_SESSION['id']."'";
    $resultSql = $mysqli->query($sqlRes);
    while($row=$resultSql->fetch_assoc()) {
        $total_user = $row['total'];
        if($total_user) {
            $checkAuth = true;
        }
        if($checkAuth == false) {
            $url  = $cp_base_url . "login.php";
            header("Refresh:0; url = $url");
            exit();
        }
    }
}


if(isset($_COOKIE['id']) && isset($_COOKIE['username']) && isset($_COOKIE['email'])) {
    $sqlRes = "SELECT count(id) AS total FROM `users` WHERE id ='". $_COOKIE['id']."'";
    $resultSql = $mysqli->query($sqlRes);
    while($row=$resultSql->fetch_assoc()) {
        $total_user = $row['total'];
        if($total_user) {
            $checkAuth = true;
        }
        if($checkAuth == false) {
            $url  = $cp_base_url . "login.php";
            header("Refresh:0; url = $url");
            exit();
        }
        if($checkAuth == false) {
            $url  = $cp_base_url . "login.php";
            header("Refresh:0; url = $url");
            exit();
        }
    }
}
