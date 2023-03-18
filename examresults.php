<?php session_start(); 


include_once 'database.php';
if (!isset($_SESSION['user'])||$_SESSION['role']!='Teacher') {
 
  header('Location:./logout.php');
}
?>



<!DOCTYPE html>


<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Exam</title><link rel="icon" href="../img/favicon2.png">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
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
        Exam Reuslts
        <small>Exam Reuslts Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Exam Reuslts</a></li>
        <li class="active">Details</li>
      </ol>
    </section>



    <section class="content">

 <div class="row">
 <div class="col-xs-4">

   

         <div class="alert alert-success alert-dismissible" style="display: none;" id="truemsg">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                New Exam Reuslts Successfully added
              </div>






          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">New Exam Reuslts</h3>
            </div>
            <form role="form" method="POST" >
              <div class="box-body">



                <div class="form-group">
                <label>Exam</label>
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="exam"><option >Select Exam</option>
                  <?php
                  $sql = "SELECT * FROM exam";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                     while($row = $result->fetch_assoc()) {
                  echo "<option value='".$row["id"]."' >".$row["subject"]." - ID:".$row["id"]." - Date:".$row["date"]."</option>";
                       }
                        }
                  ?>
                </select>
                </div>

                


                <div class="form-group">
                <label>Student</label>
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="student"><option >Select Student</option>
                  <?php
                  $sql = "SELECT * FROM student";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                     while($row = $result->fetch_assoc()) {
                  echo "<option value='".$row["sid"]."' >".$row["fname"]." ".$row["lname"]." -ID:".$row["sid"]."</option>";
                       }
                        }
                  ?>
                </select>
                </div>


                <div class="form-group">
                  <label for="exampleInputPassword1">Marks</label>
                  <input name="marks" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Marks" required>
                </div>

                <div class="form-group">
                <label>Grade </label>
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="grade"><option >Select Grade</option>
                 <option value="A+">A+</option>
                 <option value="A">A</option>
                 <option value="A-">A-</option>
                 <option value="B+">B+</option>
                 <option value="B">B</option>
                 <option value="B-">B-</option>
                 <option value="C+">C+</option>
                 <option value="C">C</option>
                 <option value="C-">C-</option>
                 <option value="D+">D+</option>
                 <option value="D">D</option>
                 <option value="E">E</option>
                </select>
                </div>

       
              </div>

              <div class="box-footer">
                <button type="submit" name="submit" value="submit" class="btn btn-primary">Add Result</button>
              </div>
            </form>

              <?php

              if (isset($_POST['submit'])) {
                $exam = $_POST['exam'];
                $student = $_POST['student'];
                $marks = $_POST['marks'];

              
                   $grade = $_POST['grade'];
             





                  try {


                   

                    $sql = "INSERT INTO examresult(exam,student,marks,grade) VALUES (".$exam.", '".$student."', ".$marks.",'".$grade."')";

                  if ($conn->query($sql) === TRUE) {
                         echo "<script type='text/javascript'> var x = document.getElementById('truemsg');
x.style.display='block';</script>";
                      } else {
                            }
                    
                  } catch (Exception $e) {
                    
                  }





                  
                
                                            }

              ?>



          </div></div>

          <div class="col-xs-8">


          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">All Exams</h3>
            </div>
            
        
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Exam ID</th>
                  <th>Student ID</th>
                  <th>Marks</th>
                  <th>Grade</th>
                  
                  
                </tr>
                </thead>
                <tbody>


                  <?php

                  $sql = "SELECT * FROM examresult";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                   
                     while($row = $result->fetch_assoc()) {
                      echo "<tr><td> " . $row["exam"]. " </td><td> " . $row["student"]." </td><td> " . $row["marks"]." </td><td> " . $row["grade"]. "</td></tr>";
                       }
                                  }

                  ?>


                </tbody>
                <tfoot>
                 
                </tfoot>
              </table>
            </div>
        
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
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>

<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>

<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>

<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>




<script>   $('.select2').select2()
  $('#datepicker').datepicker({
      autoclose: true
    });


        
            var r = document.getElementById("examresults"); 
            r.className += "active"; 



            $('.timepicker').timepicker({
      showInputs: false
    })
           
    </script> 




</body>
</html>