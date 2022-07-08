<?php
 include "includes/session.php";
 include "userComplaints_action.php";
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
            <h1>User Complaints</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Complaints</li>
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
                <h3 class="card-title">All User Complaints</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                <?php if(isset($message)){echo $message;}?>
                 <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S/N</th>
                  <th>Account No</th>
                  <th>Full Name</th>
                  <th>Description</th>
                  <th>Complaint Type</th>
                  <th>Complaint</th>
                  <th>Status</th>
                  <th>Date Created</th>
                  <th>Date Treated</th>
                  <th>Update</th>
                </tr>
                </thead>
                <tbody>
              
                <?php
                  $qqq=mysqli_query($con,"SELECT users_tbl.accountNo,users_tbl.firstName,users_tbl.lastName,
                  bill_tbl.description,complaint_tbl.id,complaint_tbl.userId,complaint_tbl.complaintTypeId,
                  complaint_tbl.complaint,complaint_tbl.status,complaint_tbl.dateCreated,complaint_tbl.dateTreated,
                  complainttype_tbl.typeName
                  from complaint_tbl
                  INNER JOIN users_tbl ON users_tbl.id = complaint_tbl.userId
                  INNER JOIN bill_tbl ON bill_tbl.id = complaint_tbl.billId
                  INNER JOIN complainttype_tbl ON complainttype_tbl.id = complaint_tbl.complaintTypeId");
                  $cnt=1;
                  while ($row=mysqli_fetch_array($qqq)) {
                ?>
                <tr>
                <td><?php echo $cnt;?></td>
                <td><?php  echo $row['accountNo'];?></td>
                <td><?php  echo $row['firstName'].' '.$row['lastName'];?></td>
                <td><?php  echo $row['description'];?></td>
                <td><?php  echo $row['typeName'];?></td>
                <td><?php  echo $row['complaint'];?></td>
                <td><?php  echo $row['status'];?></td>
                <td><?php  echo $row['dateCreated'];?></td>
                <td><?php  echo $row['dateTreated'];?></td>
                <td><a onclick="return confirm('Are you sure you want to update this complaint?')" href="?upid=<?php echo $row['id'];?>" title="Update Complaint"><i class="fa fa-check fa-1x"></i></a></td>
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
                  <th>Complaint Type</th>
                  <th>Complaint</th>
                  <th>Status</th>
                  <th>Date Created</th>
                  <th>Date Treated</th>
                  <th>Update</th>
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
