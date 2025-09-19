<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <title>Document</title>

</head>

<body>
  <?php
  session_start();
  if ($_SESSION['logueado'] = true) {
    include_once("config_login.php"); // ver usar require()
    include_once("db.class.php");
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $link = new Db();
      $usr = $_POST['username'];
      $pass = $_POST['password'];
      $hashed_pass = hash('sha256', $pass);
      $sql = "select * from users where (username=? or email=?) and password=? and active='SI'";
      $stmt = $link->run($sql, [$usr, $usr, $hashed_pass]);
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if (!$row) {
  ?>
        <div class="alert alert-danger">
          <a href="login.html" class="close" data-dismiss="alert">×</a>
          <div class="text-center">
            <h5><strong>¡Error!</strong> Login Invalido.</h5>
          </div>
        </div>
  <?php
      } else {
        session_start();
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $_SESSION['time'] = date('H:i:s');
        $_SESSION['username'] = $usr;
        $_SESSION['logueado'] = true;
        header("location:welcome.php");
      }
    }
  }
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>



