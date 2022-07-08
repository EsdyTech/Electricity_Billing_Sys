<?php
 include "includes/session.php";
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
            <h1>Manage Electricity Users Consumptions</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">All Electricity Users</li>
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
     
            <!-- Horizontal Form -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">All Eelctricity Users</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>AccountNo</th>
                    <th>FullName</th>
                    <th>Email</th>
                    <th>Phone No</th>
                    <th>Home Address</th>
                    <th>Consumption(KWH)</th>
                    <th>Date Registered</th>
                    <th>View</th>
                </tr>
                </thead>
                <tbody>
              
               <?php
                $ret=mysqli_query($con,"SELECT * from users_tbl");
                $cnt=1;
                while ($row=mysqli_fetch_array($ret)) {
                ?>
                <tr>
                <td><?php echo $cnt;?></td>
                <td><?php  echo $row['accountNo'];?></td>
                <td><?php  echo $row['firstName'].' '.$row['lastName'];?></td>
                <td><?php  echo $row['emailAddress'];?></td>
                <td><?php  echo $row['phoneNo'];?></td>
                <td><?php  echo $row['address'];?></td>
                <td><?php  echo $row['consumption'];?> KWH</td>
                <td><?php  echo $row['dateRegistered'];?></td>
                <td><a href="userConsump.php?vid=<?php echo $row['id'];?>" title="View User"><i class="fa fa-eye fa-1x"></i></a></td>
                </tr>
                <?php 
                $cnt=$cnt+1;
                }?>
                                 
                </tbody>
                <tfoot>
                <tr>
                    <th>S/N</th>
                    <th>AccountNo</th>
                    <th>FullName</th>
                    <th>Email</th>
                    <th>Phone No</th>
                    <th>Home Address</th>
                    <th>Consumption(KWH)</th>
                    <th>Date Registered</th>
                    <th>View</th>
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
