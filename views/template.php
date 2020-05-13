<?php
  session_start();
?>


<!DOCTYPE html>

  <html>

    <head>

      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- TEST -->

      <title>Stock Management System</title>

      <!-- Responsive screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

      <link rel="icon" href="views/images/logosmall.png">

      <!-- CSS Plugins -->

      <!-- Theme style -->
      <link rel="stylesheet" href="views/dist/css/AdminLTE.css">
      <!-- AdminLTE -->
      <link rel="stylesheet" href="views/dist/css/skins/_all-skins.min.css"> 
      <!-- Ionicons -->
      <link rel="stylesheet" href="views/bower_components/Ionicons/css/ionicons.min.css">
      <!-- Bootstrap -->
      <link rel="stylesheet" href="views/bower_components/bootstrap/dist/css/bootstrap.min.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="views/bower_components/font-awesome/css/font-awesome.min.css">
      <!-- Google Font -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
      <!-- DataTables -->
      <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
      <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="views/bower_components/bootstrap-daterangepicker/daterangepicker.css">
      <!-- Morris chart -->
      <link rel="stylesheet" href="views/bower_components/morris.js/morris.css">  
      
      
      <!-- Javascript Plugins -->
    
      <!-- jQuery -->
      <script src="views/bower_components/jquery/dist/jquery.min.js"></script>
      <!-- jQuery Number -->
      <script src="views/plugins/jQueryNo/jQueryNo.min.js"></script>
      <!-- AdminLTE App -->
      <script src="views/dist/js/adminlte.min.js"></script>
      <!-- FastClick -->
      <script src="views/bower_components/fastclick/lib/fastclick.js"></script>
      <!-- Bootstrap -->
      <script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
      <!-- DataTables -->
      <script src="views/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
      <script src="views/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
      <script src="views/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
      <script src="views/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
      <!-- Sweet Alert -->
      <script src="views/plugins/sweetalert/sweetalert.all.js"></script>
      <!-- InputMask -->
      <script src="views/plugins/input-mask/jquery.inputmask.js"></script>
      <script src="views/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
      <script src="views/plugins/input-mask/jquery.inputmask.extensions.js"></script>
      <!-- jQuery Number -->
      <script src="views/plugins/jQueryNo/jQueryNo.min.js"></script>
      <!-- daterangepicker -->
      <!-- http://www.daterangepicker.com official website -->
      <script src="views/bower_components/moment/min/moment.min.js"></script>
      <script src="views/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
      <!-- Morris.js charts-->
      <!-- http://morrisjs.github.io/morris.js/ -->
      <script src="views/bower_components/raphael/raphael.min.js"></script>
      <script src="views/bower_components/morris.js/morris.min.js"></script>
      <!-- ChartJS -->
      <!-- http://www.chartjs.org/-->
      <script src="views/bower_components/chart.js/Chart.js"></script>
      
      
    </head>

    <body class="hold-transition skin-black sidebar-collapse sidebar-mini login-page">

      <!-- Specifying Routes -->
      <?php

          if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == "ok") {

            echo '<div class="wrapper">';

            include "modules/header.php";

            include "modules/menu.php";

            if(isset($_GET["route"])){

              if ($_GET["route"] == 'dashboard' ||
                  $_GET["route"] == 'users' ||
                  $_GET["route"] == 'categories' ||
                  $_GET["route"] == 'products' ||
                  $_GET["route"] == 'customers' ||
                  $_GET["route"] == 'open-tables' ||
                  $_GET["route"] == 'sales' ||
                  $_GET["route"] == 'resale' ||
                  $_GET["route"] == 'reopen-table' ||
                  $_GET["route"] == 'reports' ||
                  $_GET["route"] == 'till' ||
                  $_GET["route"] == 'logout'){

                include "modules/".$_GET["route"].".php";

              
            }else{
                include "modules/404.php";
              }

            }else{
              include "modules/dashboard.php";
            }

            include "modules/footer.php";
            echo '</div>';

          }else{
            include "modules/login.php";
          }
        
        ?>  

      <!-- Loading Javascript Files -->
      <script src="views/javascript/template.js"></script>
      <script src="views/javascript/users.js"></script>
      <script src="views/javascript/categories.js"></script>
      <script src="views/javascript/products.js"></script>
      <script src="views/javascript/sales.js"></script>
      <script src="views/javascript/customers.js"></script>
      <script src="views/javascript/reports.js"></script>
      <script src="views/javascript/opentables.js"></script>


    </body>

  </html>
