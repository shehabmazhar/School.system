<?php session_start(); 


include_once 'database.php';
if (!isset($_SESSION['user'])) {
  
  header('Location:./login.php');
}
?>



<!DOCTYPE html>


<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Dashboard</title><link rel="icon" href="../img/favicon2.png">
 
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">

  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
 
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
 
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
 
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  
 <?php include_once 'header.php'; ?>

  <?php include_once 'sidebar.php'; ?>


  <div class="content-wrapper">
  
    <section class="content-header">
      <h1>
        School
        <small>Overview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> School</a></li>
        <li class="active">Stat</li>
      </ol>
    </section>

   


    <section class="content">

    
       
 <div class="row">
        <div class="col-lg-3 col-xs-6">
      
          <div class="small-box bg-aqua">
            <div class="inner">

            <?php $sql1="SELECT count(*) as a from student"; 
            $result = $conn->query($sql1);

              if ($result->num_rows > 0) {
                  
                  while($row = $result->fetch_assoc()) {
                      echo "<h3>".$row['a']."</h3>";
                  }
                }

            ?>

              
              <p>Total Students</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fa fa-users"></i></a>
          </div>
        </div>
      
        <div class="col-lg-3 col-xs-6">
         
          <div class="small-box bg-green">
            <div class="inner">
               <?php $sql2="SELECT count(*) as a from teacher"; 
            $result = $conn->query($sql2);

              if ($result->num_rows > 0) {
                 
                  while($row = $result->fetch_assoc()) {
                      echo "<h3>".$row['a']."</h3>";
                  }
                }

            ?>
              

              <p>Total Teachers</p>
            </div>
            <div class="icon">
              <i class="fa fa-black-tie"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fa fa-black-tie"></i></a>
          </div>
        </div>
  
        <div class="col-lg-3 col-xs-6">

          <div class="small-box bg-yellow">
            <div class="inner">
              <?php $sql3="SELECT count(*) as a from subject"; 
            $result = $conn->query($sql3);

              if ($result->num_rows > 0) {
                 
                  while($row = $result->fetch_assoc()) {
                      echo "<h3>".$row['a']."</h3>";
                  }
                }

            ?>

              <p>Total Subjects</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fa fa-book"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
        
          <div class="small-box bg-red">
            <div class="inner">
              <?php $sql4="SELECT count(*) as a from parent"; 
            $result = $conn->query($sql4);

              if ($result->num_rows > 0) {
             
                  while($row = $result->fetch_assoc()) {
                      echo "<h3>".$row['a']."</h3>";
                  }
                }

            ?>


              <p>Registered Parents</p>
            </div>
            <div class="icon">
              <i class="fa fa-female"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fa fa-female"></i></a>
          </div>
        </div>
 
      </div>
 

   
    </section>

   
  </div>
  

  
   <?php include_once 'footer.php'; ?>

  

  <div class="control-sidebar-bg"></div>
</div>

<script src="bower_components/jquery/dist/jquery.min.js"></script>

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>



<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>

<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>

<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<script src="plugins/iCheck/icheck.min.js"></script>

<script src="bower_components/fastclick/lib/fastclick.js"></script>

<script src="dist/js/adminlte.min.js"></script>

<script src="dist/js/demo.js"></script>




<script>   $('.select2').select2()
  $('#datepicker').datepicker({
      autoclose: true
    });


        
            var r = document.getElementById("stat"); 
            r.className += "active"; 
           
    </script>

</body>
</html>