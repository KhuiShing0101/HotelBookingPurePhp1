<?php

session_start();
require("../requires/common.php");
session_unset();
session_destroy();

$cookie_name_id  = "user_id";
$cookie_value_id = "";
$cookie_time     = -3600;
setcookie($cookie_name_id, $cookie_value_id, $cookie_time, "/");

$cookie_name     = "user_name";
$cookie_value    = "";
setcookie($cookie_name, $cookie_value, $cookie_time, "/");

$url             = $cp_base_url."login.php";
header("Refresh: 0;url=$url");
exit();
