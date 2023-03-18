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
  <title>Attendance Report Report</title><link rel="icon" href="../img/favicon2.png">

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
        Attendance Report
        <small>Attendance Report Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Attendance Report</a></li>
        <li class="active">Details</li>
      </ol>
    </section>



    <section class="content">

 <div class="row">
 <div class="col-xs-4">

   

         <div class="alert alert-success alert-dismissible" style="display: none;" id="truemsg">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                New Attendance Report Successfully added
              </div>





          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Session Details</h3>
            </div>
            <form role="form" method="POST" >
              <div class="box-body">

                  <div class="form-group">
                  <label for="exampleInputPassword1">Attendance ID</label>
                  <input name="sid" type="text" class="form-control" id="exampleInputPassword1" disabled="disabled" value=<?php echo "'".$_GET['aid']."'"; ?>>
                </div>

                  <div class="form-group">
                  <label for="exampleInputPassword1">Date</label>
                  <input name="sid" type="text" class="form-control" id="exampleInputPassword1" disabled="disabled" value=<?php echo "'".$_GET['date']."'"; ?>>
                </div>


                  <div class="form-group">
                  <label for="exampleInputPassword1">Subject ID</label>
                  <input name="sid" type="text" class="form-control" id="exampleInputPassword1" disabled="disabled" value=<?php echo "'".$_GET['subject']."'"; ?>>
                </div>


               

                <div class="form-group">
                  <label for="exampleInputPassword1">Start Time</label>
                  <input name="sid" type="text" class="form-control" id="exampleInputPassword1" disabled="disabled" value=<?php echo "'".$_GET['stime']."'"; ?>>
                </div>


                 


               


       
              </div>

<div class="box-footer">

                  <?php

                  $sql = "SELECT * from attendancereport where aid =".$_GET['aid'];
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
            echo ' <a  href="attendancelist.php?view='.$_GET['aid'].'&aid='.$_GET['aid'].'&date='.$_GET['date'].'&subject='.$_GET['subject'].'&stime='.$_GET['stime'].'"  class="btn btn-primary">View Attendance</a>';
              
                                  }else{echo '<a href="attendancelist.php?mark='.$_GET['aid'].'&class='.$_GET['class'].'&aid='.$_GET['aid'].'&date='.$_GET['date'].'&subject='.$_GET['subject'].'&stime='.$_GET['stime'].'  "class="btn btn-primary">Mark Attendance</a>';}

                  ?>


              
               
                
              </div>
            </form>

              <?php

              if (isset($_POST['submit'])) {
             
                $sid = $_POST['schedule'];
               

               $date = date_format(new DateTime($_POST['date']),'Y-m-d');


                  try {

                    $sql = "INSERT INTO attendance Report (`date`,sid) VALUES ('".$date."', '".$sid."')";

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

            <?php if(isset($_GET['mark'])){ ?>




          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Students Attendance</h3>
            </div>
            
            <div class="box-body"><form action="" method="post">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Student ID</th>
                  <th>Name</th>
                  <th>Attendance</th>
                  
                  
                </tr>
                </thead>
                <tbody>


                  <?php

                  $sql = "SELECT * from student where classroom='".$_GET['class']."'";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    $x=0;
                     while($row = $result->fetch_assoc()) {
                      echo "<tr><td> " . $row["sid"]. " </td><td> " . $row["fname"]." " . $row["lname"]." </td>
                      <td><div class='form-group'>
                 <input type='hidden' name='sid[]'' value='".$row["sid"]."' />
                 <input type='hidden' name='aid[]'' value='".$_GET["aid"]."' />
                  <div class='radio '>
  <label style='width: 100px'><input type='radio' name='att[".$x."]' value='Present' checked> &nbsp&nbsp&nbspPresent</label>
  <label style='width: 100px'><input type='radio' name='att[".$x."]' value='Absent' checked> &nbsp&nbsp&nbspAbsent</label>

</div>
                 
                </div></td>


                      </tr>"; $x++;
                       }
                                  }

                  ?>


                </tbody>
                <tfoot>
                 
                </tfoot>
              </table>
            </div>
            <div class="box-footer">
                <button type="submit" name="submitatt" value="submit" class="btn btn-primary">Submit</button>
              </div>

            </form>
          </div>


          <?php }elseif (isset($_GET['view'])) { ?>




                

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Students Attendance</h3>
            </div>
            
            <div class="box-body"><form action="" method="post">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Student ID</th>
                  <th>Name</th>
                  <th>Attendance</th>
                  
                  
                </tr>
                </thead>
                <tbody>


                  <?php

                  $sql = "SELECT * from attendancereport,student where aid='".$_GET['aid']."' and attendancereport.sid = student.sid";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    
                     while($row = $result->fetch_assoc()) {
                      echo "<tr><td> " . $row["sid"]. " </td><td> " . $row["fname"]." " . $row["lname"]." </td>
                      <td>" . $row["status"]. " </td>


                      </tr>"; 
                       }
                                  }

                  ?>


                </tbody>
                <tfoot>
                 
                </tfoot>
              </table>
            </div>
         

        
          </div>







<?php



          } ?>
            
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


        
            var r = document.getElementById("attendance"); 
            r.className += "active"; 



            $('.timepicker').timepicker({
      showInputs: false
    })
           
    </script> 




</body>
</html>

<?php 

if(isset($_POST['submitatt']))
{
    foreach ($_POST['att'] as $id => $att)
    {


        $sid = $_POST['sid'][$id];
        $aid = $_POST['aid'][$id];
       
         
        $attendance = $conn->prepare("INSERT INTO attendancereport (aid,sid,status) VALUES (?, ?, ?)");
        $attendance->bind_param("iss", $aid,$sid, $att);
        $attendance->execute();

         echo "<script type='text/javascript'> var x = document.getElementById('truemsg');
x.style.display='block';</script>";
    }
     
    if ($conn->affected_rows>0) {
        $msg = "Attendance has been added successfully";
    }
} ?>