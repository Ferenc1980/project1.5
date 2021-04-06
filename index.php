<?php
 session_start();
 include "config.php";

 function currentUrl() {
  $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
  $host     = $_SERVER['HTTP_HOST'];
  $script   = $_SERVER['SCRIPT_NAME'];
  $params   = $_SERVER['QUERY_STRING'];

  return $protocol . '://' . $host . $script . '?' . $params;
}
?>  

<!DOCTYPE html>
<html lang="hu">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Jelenlét</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 
  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">
  <link rel="stylesheet" href="myStyle.css">
  <script src="menu.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="stylesheet" href="kategoria/style.css">
  
</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading"><img class="" src="ora3.jpg" alt="óra"></div>
      <div class="list-group list-group-flush">
        <a href="index.php" class="list-group-item list-group-item-action bg-light">Főoldal - ki/bejelentkezés</a>
        <a href="index.php?p=alkalmazottak.php" class="list-group-item list-group-item-action bg-light">Alkalmazottak</a>
        <a href="index.php?p=szabadsag/szabadsag.php" class="list-group-item list-group-item-action bg-light">Évenként változó adatok</a>
        <a href="index.php?p=unnepek/unnepek.php" class="list-group-item list-group-item-action bg-light">Ünnepnapok</a>
        <a href="index.php?p=kategoria/kategoria.php" class="list-group-item list-group-item-action bg-light">Kategóriák</a>
        <a href="index.php?p=jelenlet.php" class="list-group-item list-group-item-action bg-light">Jelenlét</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Kapcsoló</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="#">
                <?=isset($_SESSION['user'])? $_SESSION['user'] : (isset($_SESSION['msg'])? $_SESSION['msg'] :"Nem vagy bejelentkeztel!")?>
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <?php if(isset($_SESSION['user']))
                echo '<li class="nav-item">
				        <a class="nav-link btn btn-outline-warning text-warning" href="index.php?p=logout.php">Kijelentkezés</a>
			        </li>';
                
            ?>
              
              
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
     
          <?php
            if(isset($_GET['p'])){
              $program=$_GET['p'];
              switch ($program) {
                case 'jelenlet.php':
                  $program=isset($_SESSION['user']) && preg_match('/\badminisztrator\b/', $_SESSION['user']) ? 'jelenlet.php' : 'jelenlet/jelenletView.php';
                  break;
                case "szabadsag/szabadsag.php":
                  $program=isset($_SESSION['user']) && preg_match('/\badminisztrator\b/', $_SESSION['user']) ? 'szabadsag/szabadsag.php' : 'szabadsag/szabadsagView.php';
                  
                  break;
               }
               include $program; 
            }else
              include "fooldal.php";
          ?>
      </div>

    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>
