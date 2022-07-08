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
            <h1>All Electricity Bills</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">All Electricity Bills</li>
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
                <h3 class="card-title">All Electricity Bills</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>S/N</th>
                  <th>Account No</th>
                  <th>Full Name</th>
                  <th>Description</th>
                  <th>Consumption</th>
                  <th>Tarrif Rate</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Bill Date</th>
                  <th>Due Date</th>
                  <th>Date Generated</th>
                </tr>
                </thead>
                <tbody>
              
                <?php
                 $retp=mysqli_query($con,"SELECT users_tbl.accountNo,users_tbl.firstName,users_tbl.lastName,users_tbl.emailAddress,
                 bill_tbl.userId,bill_tbl.description,bill_tbl.consumption,bill_tbl.tariffRate,bill_tbl.amount,bill_tbl.status,
                 bill_tbl.id,bill_tbl.billDate,bill_tbl.dueDate,bill_tbl.dateCreated
                 from bill_tbl
                 INNER JOIN users_tbl ON users_tbl.id = bill_tbl.userId
                 where userId = '$user_id'");
                  $cnt=1;
                  while ($row=mysqli_fetch_array($retp)) {
                ?>
                <tr>
                <td><?php echo $cnt;?></td>
                <td><?php  echo $row['accountNo'];?></td>
                <td><?php  echo $row['firstName'].' '.$row['lastName'];?></td>
                <td><?php  echo $row['description'];?></td>
                <td><?php  echo $row['consumption'];?> KWH</td>
                <td><?php  echo $row['tariffRate'];?></td>
                <td><span>&#8358;</span> <?php  echo number_format($row['amount']);?></td>
                <td><?php  echo $row['status'];?></td>
                <td><?php  echo $row['billDate'];?></td>
                <td><?php  echo $row['dueDate'];?></td>
                <td><?php  echo $row['dateCreated'];?></td>
                </tr>
                <?php 
                $cnt=$cnt+1;
                }?>
                                 
                </tbody>
                <tfoot>
                <tr>
                <th>S/N</th>
                  <th>Account No</th>
                  <th>Full Name</th>
                  <th>Description</th>
                  <th>Consumption</th>
                  <th>Tarrif Rate</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Bill Date</th>
                  <th>Due Date</th>
                  <th>Date Generated</th>
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
