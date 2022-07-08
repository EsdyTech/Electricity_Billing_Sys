<?php include "../includes/session.php";?>


 <?php     
 error_reporting(0);

    ?>

<!DOCTYPE html>
<html>
<head>
  <?php include "includes/head.php";?>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->

   <?php include "includes/navbar.php"; ?>

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "includes/sidebar.php";?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Customer Recipients</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Customer Recipients</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Customer Recipients</h3>
              </div>

              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post">
                <div class="card-body">
                    <?php if(isset($message)){echo $message;}else{}?>
                 <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Customer</label>
                         <?php 
                            $query=mysqli_query($con,"select * from tblcustomers");                        
                            $count = mysqli_num_rows($query);
                            if($count > 0){                       
                                echo ' <select required name="customerId" class="custom-select form-control">';
                                echo'<option value="">--Select Customer--</option>';
                                while ($row = mysqli_fetch_array($query)) {
                                echo'<option value="'.$row['Id'].'" >'.$row['firstName'].'-'.$row['lastName'].'</option>';
                                    }
                                echo '</select>';
                            }
                            ?>        
                      </div>
                    </div>
                   
                  </div>                 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" name="view" class="btn btn-primary">View</button>
                   <!-- <button type="button" class="btn btn-success swalDefaultSuccess">
                  Launch Success Toast
                </button> -->
                </div>
              </form>
            </div>
     
            <!-- Horizontal Form -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Customer Recipients</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>S/N</th>
                   <th>FirstName</th>
                    <th>LastName</th>
                  <th>Phone Number</th>
                   <th>Email Address</th>
                    <th>Postal Address</th>
                   <th>Date Added</th>
                </tr>
                </thead>
                <tbody>
              
               <?php
         
    if (isset($_POST['view']))
	{
        $customerId = $_POST['customerId'];
        $ret=mysqli_query($con,"SELECT * from tblcustomerrecipients where customerId = '$customerId'");
        $cnt=1;
        while ($row=mysqli_fetch_array($ret)) {
                            ?>
                <tr>
                <td><?php echo $cnt;?></td>
                <td><?php  echo $row['firstName'];?></td>
                <td><?php  echo $row['lastName'];?></td>
                <td><?php  echo $row['phoneNo'];?></td>
                <td><?php  echo $row['emailAddress'];?></td>
                <td><?php  echo $row['postalAddress'];?></td>
                <td><?php  echo $row['dateCreated'];?></td>
                </tr>
                <?php 
                $cnt=$cnt+1;
                }
    }?>
                                 
                </tbody>
                <tfoot>
                <tr>
                 <th>S/N</th>
                   <th>FirstName</th>
                    <th>LastName</th>
                  <th>Phone Number</th>
                   <th>Email Address</th>
                    <th>Postal Address</th>
                   <th>Date Added</th>
                </tr>
                </tfoot>
              </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->
          
            <!-- /.card -->
           
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include "includes/footer.php";?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include "includes/scripts.php";?>

</body>
</html>
