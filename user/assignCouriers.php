<?php include "../includes/session.php";?>


 <?php     
 error_reporting(0);

 //------------------GET THE ID--------------------------------------------

  if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "edit")
	{
        $Id = $_GET['Id'];
        $query = mysqli_query($con,"select * from tblassignedmailcourier where Id='$Id'");
        $row = mysqli_fetch_array($query);

    }

//-------------------------DELETE---------------------------------------

  if (isset($_GET['Id']) && isset($_GET['mailId']) && isset($_GET['action']) && $_GET['action'] == "delete")
	{
       $Id= $_GET['Id'];
       $mailId= $_GET['mailId'];

        $que = mysqli_query($con,"DELETE FROM tblassignedmailcourier WHERE Id='$Id'");

        if($que == TRUE){

             $query=mysqli_query($con,"update tblmails set isPickedUp = '0'where Id ='$mailId'");

                if($query == True) {

                  $message = "<div class='alert alert-success' role='alert'>Deleted Successfully!</div>";
                    
                }
                else
                {
                    $message = "<div class='alert alert-danger' role='alert'>An Error Occured!</div>";
                }
        }
        else{

            $message = "<div class='alert alert-danger' role='alert'>An Error Occured!</div>";
        }
       
    }

   
    //--------------------------SAVE------------------------------------------------------

	if (isset($_POST['save']))
	{
        $courierId = $_POST['courierId'];
        $mailId = $_POST['mailId'];
        $dateAssigned = date("Y-m-d");

            $queryy=mysqli_query($con,"insert into tblassignedmailcourier(courierId,mailId,dateAssigned) value('$courierId','$mailId','$dateAssigned')");

            if ($queryy == True) {

                $query=mysqli_query($con,"update tblmails set isPickedUp = '1'where Id ='$mailId'");

                if($query == True) {

                    $message = "<div class='alert alert-success' role='alert'>Assigned Successfully!</div>";
                    
                }
                else
                {
                    $message = "<div class='alert alert-danger' role='alert'>An Error Occured!</div>";
                }
            }
            else
            {
                $message = "<div class='alert alert-danger' role='alert'>An Error Occured!</div>";
            }
		
	}

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
            <h1>Assign Couriers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Assign Couriers</li>
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
                <h3 class="card-title">Assign Couriers</h3>
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
                        <label>Courier</label>
                         <?php 
                            $query=mysqli_query($con,"select * from tblcouriers");                        
                            $count = mysqli_num_rows($query);
                            if($count > 0){                       
                                echo ' <select required name="courierId" class="custom-select form-control">';
                                echo'<option value="">--Select Courier--</option>';
                                while ($row = mysqli_fetch_array($query)) {
                                echo'<option value="'.$row['Id'].'" >'.$row['firstName'].'-'.$row['lastName'].'</option>';
                                    }
                                echo '</select>';
                            }
                            ?>        
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Customer Mail</label>
                         <?php 
                            $query=mysqli_query($con,"SELECT tblmails.Id,tblcustomers.firstName,tblcustomers.lastName,tblmailpackages.packageName,tblmailpackagecategory.categoryName
                            from tblmails    
                            INNER JOIN tblcustomers ON tblcustomers.Id = tblmails.customerId
                            INNER JOIN tblmailpackages ON tblmailpackages.Id = tblmails.mailPackageId
                            INNER JOIN tblmailpackagecategory ON tblmailpackagecategory.Id = tblmails.mailPackageCategoryId
                            where tblmails.isPickedUp = '0'");                       
                            $count = mysqli_num_rows($query);
                            if($count > 0){                       
                                echo ' <select required name="mailId" class="custom-select form-control">';
                                echo'<option value="">--Select Customer Mail--</option>';
                                while ($row = mysqli_fetch_array($query)) {
                                echo'<option value="'.$row['Id'].'" >'.$row['firstName'].' '.$row['lastName'].'('.$row['packageName'].' '.$row['categoryName'].')</option>';
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
                    <button type="submit" name="save" class="btn btn-primary">Assign</button>
                   <!-- <button type="button" class="btn btn-success swalDefaultSuccess">
                  Launch Success Toast
                </button> -->
                </div>
              </form>
            </div>
     
            <!-- Horizontal Form -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">All Assigned Couriers</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>S/N</th>
                   <th>Courier FullName</th>
                    <th>Customer FullName</th>
                   <th>Mail Package</th>
                    <th>Mail Package Category</th>
                   <th>Date Assigned</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
              
               <?php
        $query=mysqli_query($con,"SELECT tblassignedmailcourier.Id,tblassignedmailcourier.mailId,tblassignedmailcourier.dateAssigned,tblcouriers.firstName,tblcouriers.lastName,tblmails.customerId,tblmails.mailPackageId,tblmails.mailPackageCategoryId,tblmailpackages.packageName,tblmailpackagecategory.categoryName,
        tblcustomers.firstName AS customerFirstName,tblcustomers.lastName AS customerLastName
        from tblassignedmailcourier    
        INNER JOIN tblcouriers ON tblcouriers.Id = tblassignedmailcourier.courierId
        INNER JOIN tblmails ON tblmails.Id = tblassignedmailcourier.mailId
        INNER JOIN tblcustomers ON tblcustomers.Id = tblmails.customerId
        INNER JOIN tblmailpackages ON tblmailpackages.Id = tblmails.mailPackageId
        INNER JOIN tblmailpackagecategory ON tblmailpackagecategory.Id = tblmails.mailPackageCategoryId
        "); 
        $cnt=1;
        while ($row=mysqli_fetch_array($query)) {
                            ?>
                <tr>
                <td><?php echo $cnt;?></td>
                <td><?php  echo $row['firstName'].' '.$row['lastName'];?></td>
                <td><?php  echo $row['customerFirstName'].' '.$row['customerLastName'];?></td>
                <td><?php  echo $row['packageName'];?></td>
                 <td><?php  echo $row['categoryName'];?></td>
                <td><?php  echo $row['dateAssigned'];?></td>
                <td><a onclick="return confirm('Are you sure you want to delete?')" href="?action=delete&Id=<?php echo $row['Id'];?>&mailId=<?php echo $row['mailId'];?>" title="Delete"><i class="fa fa-trash fa-1x"></i></a></td>
                </tr>
                <?php 
                $cnt=$cnt+1;
                }?>
                                 
                </tbody>
                <tfoot>
                <tr>
                  <th>S/N</th>
                   <th>Courier FullName</th>
                    <th>Customer FullName</th>
                   <th>Mail Package</th>
                    <th>Mail Package Category</th>
                   <th>Date Assigned</th>
                  <th>Delete</th>
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
