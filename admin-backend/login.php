<?php
require('../requires/common.php');
require('../requires/connect.php');
$title = "Hotel Booking:Admin Login";

$userName = "";
$remember = 0;

if (isset($_POST["form-sub"]) && $_POST["form-sub"] == "1") {
  $userName     = $mysqli->real_escape_string($_POST['username']);
  $password     = $mysqli->real_escape_string($_POST['password']);
  $remember     = (isset($_POST['remember'])) ? $_POST['remember'] : 0;
  $encrypt_pss  = md5(md5($password) . $config['key']);
  if ($remember == 0) {
    $sql          = "SELECT * FROM `users` WHERE name = '$userName' OR email = '$userName'";
    $result       = $mysqli->query($sql);
    $res_rows      = $result->num_rows;
    if ($res_rows >= 1) {
      while($row = $result->fetch_assoc()) {
        $user_id      = (int)($row['id']);
        $user_name    = htmlspecialchars($row['name']);
        $user_email   = htmlspecialchars($row['email']);
        $db_password  = $row['password'];
        if ($db_password == $encrypt_pss) {
          $_SESSION['id']        = $user_id;
          $_SESSION['username']  = $user_name;
          $_SESSION['email']     = $user_email;
          $url  = $base_url . "index.php";
          header("Refresh:0; url = $url");
          exit();
        } else {
          echo "Wrong Password";
        }
      }
    }
    else {
      echo "Wrong User Name";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php echo $title ?> </title>

  <!-- Bootstrap -->
  <link href="<?php echo $base_url ?>assets/backend/css/bootstrap/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="<?php echo $base_url ?>assets/backend/css/font-awesome/font-awesome.min.css" rel="stylesheet">
  <!-- Animate.css -->
  <link href="<?php echo $base_url ?>assets/backend/animate/animate.min.css" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="<?php echo $base_url ?>assets/backend/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
  <div>
    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content">

          <form action="<?php echo $cp_base_url ?>login.php" method="POST">

            <h1>Login Form</h1>

            <div>
              <input type="text" value="<?php echo $userName ?>" name="username" class="form-control" placeholder="Username" required="" />
            </div>

            <div>
              <input type="password" name="password" class="form-control" placeholder="Password" required="" />
            </div>

            <div class="my-3 d-flex ml-4 justify-content-start">
              <input type="checkbox" name="remember" value="1" <?php if ($remember == 1) {echo "checked";} ?>>
              <label for="remember" class="form-check-label">Remember me</label>
            </div>

            <div>
              <button type="submit" class="btn btn-secondary">Login</button>
              <input type="hidden" name="form-sub" value="1"> </input>
            </div>

            <div>
              <h1><?php echo $config['name'] ?></h1>
            </div>

          </form>

        </section>
      </div>
    </div>
  </div>
  </div>
</body>

</html>