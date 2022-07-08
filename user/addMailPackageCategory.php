<?php include "../includes/session.php";?>


 <?php     
 error_reporting(0);

 //------------------GET THE ID--------------------------------------------

  if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "edit")
	{
        $Id = $_GET['Id'];
        $query = mysqli_query($con,"select * from tblmailpackagecategory where Id='$Id'");
        $rows = mysqli_fetch_array($query);

    }

//-------------------------DELETE---------------------------------------

  if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "delete")
	{
        $Id= $_GET['Id'];

        $que = mysqli_query($con,"DELETE FROM tblmailpackagecategory WHERE Id='$Id'");

        if($que == TRUE){

            $message = "<div class='alert alert-success' role='alert'>Mail Package Category Deleted!</div>";
        }
        else{

            $message = "<div class='alert alert-danger' role='alert'>An Error Occured!</div>";
        }
       
    }

   
    //--------------------------SAVE------------------------------------------------------

	if (isset($_POST['save']))
	{
        $packageId = $_POST['packageId'];
        $categoryName = $_POST['categoryName'];
        $categoryDescription = $_POST['categoryDescription'];
        $estimatedDeliveryPeriod = $_POST['estimatedDeliveryPeriod'];
        $categoryPrice = $_POST['categoryPrice'];
          
        $dateAdded = date("Y-m-d");

        $query=mysqli_query($con,"select * from tblmailpackagecategory where packageId ='$packageId' and categoryName = '$categoryName'");
        $ret=mysqli_fetch_array($query);
        if($ret > 0){

            $message = "<div class='alert alert-danger' role='alert'>Mail Package Category Already Exists!</div>";

        }
        else{

            $queryy=mysqli_query($con,"insert into tblmailpackagecategory(packageId,categoryName,categoryDescription,estimatedDeliveryPeriod,categoryPrice,dateAdded) value('$packageId','$categoryName','$categoryDescription','$estimatedDeliveryPeriod','$categoryPrice','$dateAdded')");

            if ($queryy == True) {

                $message = "<div class='alert alert-success' role='alert'>Mail Package Category Added Successfully!</div>";
            }
            else
            {
                $message = "<div class='alert alert-danger' role='alert'>An Error Occured!</div>";
            }

        }

		
	}


 //-------------------------UPDATE----------------------------------------

    if (isset($_POST['update']))
	{
        $packageId = $_POST['packageId'];
        $categoryName = $_POST['categoryName'];
        $categoryDescription = $_POST['categoryDescription'];
        $estimatedDeliveryPeriod = $_POST['estimatedDeliveryPeriod'];
        $categoryPrice = $_POST['categoryPrice'];
          
         $query=mysqli_query($con,"update tblmailpackagecategory set packageId='$packageId',categoryName='$categoryName',categoryDescription='$categoryDescription',estimatedDeliveryPeriod='$estimatedDeliveryPeriod',
         categoryPrice='$categoryPrice' where Id='$Id'");

        if($query == True) {

             $message = "<div class='alert alert-success' role='alert'>Mail Package Category Edited Successfully!</div>";
             
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
  <script>
//Only allows Numbers
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

</script>
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
            <h1>Mail Package Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Mail Package Category</li>
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
                <h3 class="card-title">Add Mail Package Category</h3>
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
                        <label>Package Name</label>
                          <?php 
                            $query=mysqli_query($con,"select * from tblmailpackages ORDER BY packageName ASC");                        
                            $count = mysqli_num_rows($query);
                            if($count > 0){                       
                                echo ' <select required name="packageId" class="custom-select form-control">';
                                echo'<option value="">--Select Package--</option>';
                                while ($row = mysqli_fetch_array($query)) {
                                echo'<option value="'.$row['Id'].'" >'.$row['packageName'].'</option>';
                                    }
                                echo '</select>';
                            }
                            ?>        
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" required name="categoryName" value="<?php echo $rows['categoryName'];?>" class="form-control" placeholder="Enter Category Name">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Category Description</label>
                        <input type="text" required name="categoryDescription" value="<?php echo $rows['categoryDescription'];?>" class="form-control" placeholder="Enter Category Description">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Estimated Delivery Period</label>
                        <input type="text" required name="estimatedDeliveryPeriod" value="<?php echo $rows['estimatedDeliveryPeriod'];?>" class="form-control" placeholder="Enter Estimated Delivery Period">
                      </div>
                    </div>
                  </div>
                   <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Category Price</label>
                        <input type="text" required name="categoryPrice" onkeypress="return isNumber(event)" value="<?php echo $rows['categoryPrice'];?>" class="form-control" placeholder="Enter Category Price">
                      </div>
                    </div>
                   
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <?php
                    if (isset($Id))
                    {
                    ?>
                    <button type="submit" name="update" class="btn btn-warning">Update</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php
                    } else {           
                    ?>
                    <button type="submit" name="save" class="btn btn-primary">Submit</button>
                    <?php
                    }         
                    ?>
                   <!-- <button type="button" class="btn btn-success swalDefaultSuccess">
                  Launch Success Toast
                </button> -->
                </div>
              </form>
            </div>
     
            <!-- Horizontal Form -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">All Mail Packages</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>S/N</th>
                   <th>Package Name</th>
                    <th>Category</th>
                  <th>Description</th>
                   <th>Delivery Period</th>
                    <th>Price</th>
                   <th>Date Added</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
              
               <?php
        $ret=mysqli_query($con,"SELECT tblmailpackages.Id,tblmailpackages.packageName,tblmailpackagecategory.categoryName,tblmailpackagecategory.categoryDescription,tblmailpackagecategory.estimatedDeliveryPeriod,
        tblmailpackagecategory.categoryPrice,tblmailpackagecategory.dateAdded
        from tblmailpackagecategory 
        INNER JOIN tblmailpackages ON tblmailpackages.Id = tblmailpackagecategory.packageId");
        $cnt=1;
        while ($row=mysqli_fetch_array($ret)) {
                            ?>
                <tr>
                <td><?php echo $cnt;?></td>
                <td><?php  echo $row['packageName'];?></td>
                <td><?php  echo $row['categoryName'];?></td>
                <td><?php  echo $row['categoryDescription'];?></td>
                <td><?php  echo $row['estimatedDeliveryPeriod'];?></td>
                <td><?php  echo $row['categoryPrice'];?></td>
                <td><?php  echo $row['dateAdded'];?></td>
                <td><a href="?action=edit&Id=<?php echo $row['Id'];?>" title="Edit Package"><i class="fa fa-edit fa-1x"></i></a></td>
                <td><a onclick="return confirm('Are you sure you want to delete?')" href="?action=delete&Id=<?php echo $row['Id'];?>" title="Delete Package"><i class="fa fa-trash fa-1x"></i></a></td>
                </tr>
                <?php 
                $cnt=$cnt+1;
                }?>
                                 
                </tbody>
                <tfoot>
                <tr>
                 <th>S/N</th>
                   <th>Package Name</th>
                    <th>Category</th>
                  <th>Description</th>
                   <th>Delivery Period</th>
                    <th>Price</th>
                   <th>Date Added</th>
                  <th>Edit</th>
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
