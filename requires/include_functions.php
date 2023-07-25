<?php function insertQuery($mysqli, $table, $data) {
    $currentDt   = date("Y-m-d H:i:s");

    if (isset($_SESSION["user_id"])) {
        $loginId = $_SESSION["user_id"];
    } else if (isset($_COOKIE["user_id"])) {
        $loginId = $_COOKIE["user_id"];
    } else {
        $loginId = 0;
    }

    $column      = "";
    $value       = "";
    $count       =0;
    foreach ($data as $key => $val) {
        $count++;
        if($count >= 1){
        $column .= $key . ",";
        $value  .= "'" . $val . "',";
        }
        $column .= $key . ",";
        $value  .= "'" . $val . "',";
    }

    $sql         = "";
    $sql        .= "INSERT INTO $table (";
    $sql        .= $column;
    $sql        .= "created_at,updated_at,created_by,updated_by";
    $sql        .= ")";
    $sql        .= " VALUES (";
    $sql        .= $value;
    $sql        .= "'$currentDt','$currentDt','$loginId','$loginId'";
    $sql        .= ")";
    $res_sql     = $mysqli->query($sql);

    return $res_sql;
}

function checkDatabaseExistence($mysqli, $table, $name, $id = null) {
    $return        = [];
    $error         = false;
    $error_message = "";

    if ($id == null) {
        $sql           = "SELECT id FROM $table WHERE name = '" . $name . "' AND deleted_at IS NULL";
        $res_sql       = $mysqli->query($sql);
        $res_row       = $res_sql->num_rows;
    } else {
        $sql           = "SELECT id FROM $table WHERE name = '" . $name . "' AND id != '" . $id . "' AND deleted_at IS NULL";
        $res_sql       = $mysqli->query($sql);
        $res_row       = $res_sql->num_rows;
    }

    if ($res_row >= 1) {
        $error         = true;
        $error_message = $name ." is already exit!";
    }

    if ($error == true) {
        $return["error"]         = $error;
        $return["error_message"] = $error_message;
    }

    return $return;
}

?>