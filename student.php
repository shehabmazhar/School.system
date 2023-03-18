<?php session_start(); 


include_once 'database.php';
if (!isset($_SESSION['user'])||$_SESSION['role']!='Teacher') {
  header('Location:./logout.php');
}
?>
<?php

 $sid =$fname =$lname = $classroom = $dob = $gender = $address = $parent=" ";
              

if(isset($_GET['update'])){
  $update = "SELECT * FROM student WHERE sid='".$_GET['update']."'";
  $result = $conn->query($update);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $sid = $row['sid'];
                $fname = $row['fname'];
                $lname = $row['lname'];
                $classroom = $row['classroom'];
$email = $row['email'];
                $dob = date_format(new DateTime($row['bday']),'m/d/Y');
                $gender = $row['gender'];
                  $address = $row['address'];
                $parent=$row['parent'];
                
    }
}
}

?>


<!DOCTYPE html>


<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Student</title><link rel="icon" href="../img/favicon2.png">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

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
        Student
        <small>Student Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Student</a></li>
        <li class="active">Details</li>
      </ol>
    </section>



    <section class="content">

 <div class="row">

  <?php if (!isset($_GET['update'])) { ?>
 <div class="col-xs-4">

   

         <div class="alert alert-success alert-dismissible" style="display: none;" id="truemsg">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                New Student Successfully added
              </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">New Student</h3>
            </div>
            <form role="form" method="POST" >
              <div class="box-body">

                 <div class="form-group">
                  <label for="exampleInputPassword1">Student ID</label>
                  <input name="sid" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Student ID No" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">First Name</label>
                  <input name="fname" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Student First Name" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Last Name</label>
                  <input name="lname" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Student Last Name" required>
                </div>

                 <div class="form-group">
                 
                <label>Date of Birth</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name='dob' class="form-control pull-right" id="datepicker" placeholder="Select Student's Data of Birth">
                </div>
              
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Gender</label>
                  <div class="radio ">
  <label style="width: 100px"><input type="radio" name="gender" value="Male" checked>Male</label>
  <label style="width: 100px"><input type="radio" name="gender" value="Female" checked>Female</label>

</div>
                 
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Email</label>
                  <input name="email" type="email" class="form-control" id="exampleInputPassword1" placeholder="Enter Student email" required>
                </div>


                <div class="form-group">
    <label for="exampleFormControlTextarea1">Address</label>
    <textarea name="address" class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
  </div>
 <div class="form-group">
                <label>Class Room</label>
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="classroom"><option >Select Class Room</option>
                  <?php
                  $sql = "SELECT * FROM classroom";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                     while($row = $result->fetch_assoc()) {
                  echo "<option value='".$row["hno"]."' >".$row["title"]."_ID:".$row["hno"]."</option>";
                       }
                        }
                  ?>
                </select>
                </div>


                <div class="form-group">
                 
                <label>Parent</label>
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="parent">
                  <option value="0">Select Parent</option>
                 

                      <?php 

                  $sql = "SELECT * FROM parent";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                     while($row = $result->fetch_assoc()) {
                      

                      echo "<option value='".$row["pid"]."' >".$row["fname"]." ".$row["lname"]." - ID:".$row["pid"]."</option>";
                       }
                                  }

                  ?>
                </select>
              
                </div>
 </div>

              <div class="box-footer">
                <button type="submit" name="submit" value="submit" class="btn btn-primary">Add Student</button>
              </div>
            </form>

              <?php

              if (isset($_POST['submit'])) {
                $sid = $_POST['sid'];
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                 $email = $_POST['email'];
                $classroom = $_POST['classroom'];

                $dob = date_format(new DateTime($_POST['dob']),'Y-m-d');
                $gender = $_POST['gender'];
                  $address = $_POST['address'];
                $parent=" ";
                if(isset($_POST['parent'])){
                $parent = $_POST['parent'];}





                  try {


                   

                    $sql = "INSERT INTO student (sid,fname,lname,bday,address,gender,parent,classroom,email) VALUES ('".$sid."', '".$fname."', '".$lname."','".$dob."','".$address."','".$gender."','".$parent."','".$classroom."','".$email."')";

                  if ($conn->query($sql) === TRUE) {
                         echo "<script type='text/javascript'> var x = document.getElementById('truemsg');
x.style.display='block';</script>";
                      } else {
                            }
                    
                  } catch (Exception $e) {
                    
                  }





                  
                                            }

              ?>



          </div></div> <?php }elseif (isset($_GET['update'])) { ?>



     <div class="col-xs-4">

   

         <div class="alert alert-success alert-dismissible" style="display: none;" id="truemsg">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                Update Student Successfully 
              </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update Student</h3>
            </div>
            
            <form role="form" method="POST" >
              <div class="box-body">

                 <div class="form-group">
                  <label for="exampleInputPassword1">Student ID</label>
                  <input name="sid" type="text" class="form-control" id="exampleInputPassword1"  required value=<?php echo "'".$sid."'"; ?>>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">First Name</label>
                  <input name="fname" type="text" class="form-control" id="exampleInputPassword1" required value=<?php echo "'".$fname."'"; ?>>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Last Name</label>
                  <input name="lname" type="text" class="form-control" id="exampleInputPassword1"  required value=<?php echo "'".$lname."'"; ?>>
                </div>

                 <div class="form-group">
                 
                <label>Date of Birth</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name='dob' class="form-control pull-right" id="datepicker" placeholder="Select Student's Data of Birth" value=<?php echo "'".$dob."'"; ?>>
                </div>
              
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Gender</label>
                  <div class="radio ">
  <label style="width: 100px"><input type="radio" name="gender" value="Male"  <?php if($gender=='Male'){echo 'checked';} ?>>Male</label>
  <label style="width: 100px"><input type="radio" name="gender" value="Female" <?php if($gender=='Female'){echo 'checked';} ?>>Female</label>

</div>
                 
                </div>

                 <div class="form-group">
                  <label for="exampleInputPassword1">Email</label>
                  <input name="email" type="email" class="form-control" id="exampleInputPassword1"  required value=<?php echo "'".$email."'"; ?>>
                </div>



                <div class="form-group">
    <label for="exampleFormControlTextarea1">Address</label>
    <textarea name="address" class="form-control" id="exampleFormControlTextarea1" rows="2"><?php echo $address; ?></textarea>
  </div>
 <div class="form-group">
                <label>Class Room</label>
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="classroom"><option >Select Class Room</option>
                  <?php
                  $sql = "SELECT * FROM classroom";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                     while($row = $result->fetch_assoc()) {
                  echo "<option "; if($classroom==$row["hno"]){echo 'selected="selected"';} echo " value='".$row["hno"]."' >".$row["title"]."_ID:".$row["hno"]."</option>";
                       }
                        }
                  ?>
                </select>
                </div>


                <div class="form-group">
                 
                <label>Parent</label>
                <select name="parent" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" >
                 <option value="0">Select Parent</option>

                      <?php

                  $sql = "SELECT * FROM parent";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                     while($row = $result->fetch_assoc()) {
                      

                      echo "<option "; if($parent==$row["pid"]){echo 'selected="selected"';} echo " value='".$row["pid"]."' >".$row["fname"]." ".$row["lname"]." - ID:".$row["pid"]."</option>";
                       }
                                  }

                  ?>
                </select>
              
                </div>
 </div>

              <div class="box-footer">
                <button type="submit" name="submit" value="submit" class="btn btn-primary">Update Student</button>
              </div>
            </form>

              <?php

              if (isset($_POST['submit'])) {
                $sid = $_POST['sid'];
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $classroom = $_POST['classroom'];
$email = $_POST['email'];
                $dob = date_format(new DateTime($_POST['dob']),'Y-m-d');
                $gender = $_POST['gender'];
                  $address = $_POST['address'];
               
                $parent = $_POST['parent'];





                  try {

                    $sql = "UPDATE student set fname='".$fname."',lname='".$lname."',bday='".$dob."',address='".$address."',gender='".$gender."',parent=".$parent.",classroom='".$classroom."',email='".$email."' where sid='".$sid."'";
                   


                  if ($conn->query($sql) === TRUE) {
                         echo "<script type='text/javascript'> var x = document.getElementById('truemsg');
x.style.display='block';</script>";
                      } else {
                            }
                    
                  } catch (Exception $e) {
                    
                  }





                  
                                            }

              ?></div></div>

          
          <?php } ?>

          <div class="col-xs-8">


          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">All Students</h3>
            </div>
            
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Student ID</th>
                  <th>Full Name</th>
                  <th>Date of Birth</th>
                  <th>Gender</th>
                  <th>Address</th>
                  <th>Classroom</th>
                  <th>Parent</th>
                  <th>Actions</th>
                  
                </tr>
                </thead>
                <tbody>


                  <?php

                  $sql = "SELECT * FROM student";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                     while($row = $result->fetch_assoc()) {
                      echo "<tr><td> " . $row["sid"]. " </td><td> " . $row["fname"]." ". $row["lname"]. " </td><td> " . $row["bday"]. "</td><td>" . $row["gender"]. "</td><td>" . $row["address"]. "</td><td>" . $row["classroom"]. "</td><td>" . $row["parent"]. "</td><td><a href='student.php?update=". $row["sid"]."'><small class='label  bg-orange'>Update</small></a></td></tr>";
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


        
            var r = document.getElementById("new"); 
            r.className += "active"; 
           
    </script>

</body>
</html>