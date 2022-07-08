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
            <h1>Users Billing Transactions</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users Billing Transactions</li>
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
                <h3 class="card-title">All Users Billing Transactions</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S/N</th>
                  <th>Account No</th>
                  <th>Full Name</th>
                  <th>Energy Consumed</th>
                  <th>Bill Description</th>
                  <th>Bill Amount</th>
                  <th>Reference No</th>
                  <th>Amount Paid</th>
                  <th>Transaction Status</th>
                  <th>Date Paid</th>
                </tr>
                </thead>
                <tbody>
              
                <?php
                 $retsss=mysqli_query($con,"SELECT users_tbl.accountNo,users_tbl.firstName,users_tbl.lastName,users_tbl.emailAddress,
                 bill_tbl.description,bill_tbl.consumption,bill_tbl.tariffRate,bill_tbl.amount as billAmount,bill_tbl.status as billStatus,
                 bill_tbl.id,bill_tbl.billDate,bill_tbl.dueDate,bill_tbl.dateCreated,
                 transaction_tbl.userId,transaction_tbl.billId,transaction_tbl.referenceNo,transaction_tbl.amount as tranAmount,transaction_tbl.datePaid,
                 transaction_tbl.status as tranStatus, transaction_tbl.dateCreated as tranDateCreated
                 from transaction_tbl
                 INNER JOIN users_tbl ON users_tbl.id = transaction_tbl.userId
                 INNER JOIN bill_tbl ON bill_tbl.id = transaction_tbl.billId");
                  $cnt=1;
                  while ($row=mysqli_fetch_array($retsss)) {
                ?>
                <tr>
                <td><?php echo $cnt;?></td>
                <td><?php  echo $row['accountNo'];?></td>
                <td><?php  echo $row['firstName'].' '.$row['lastName'];?></td>
                <td><?php  echo $row['consumption'];?> KWH</td>
                <td><?php  echo $row['description'];?></td>
                <td><span>&#8358;</span> <?php  echo number_format($row['billAmount']);?></td>
                <td><?php  echo $row['referenceNo'];?></td>
                <td><span>&#8358;</span> <?php  echo number_format($row['tranAmount']);?></td>
                <td><?php  echo $row['tranStatus'];?></td>
                <td><?php  echo $row['datePaid'];?></td>
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
                  <th>Energy Consumed</th>
                  <th>Description</th>
                  <th>Bill Amount</th>
                  <th>Reference No</th>
                  <th>Amount Paid</th>
                  <th>Status</th>
                  <th>Date Paid</th>
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
