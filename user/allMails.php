<?php include "../includes/session.php";?>


 <?php     
 error_reporting(0);

 
//-------------------------DELETE---------------------------------------

  if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "delete")
	{
       $Id= $_GET['Id'];

        $que = mysqli_query($con,"DELETE FROM tblmails WHERE Id='$Id'");

        if($que == TRUE){

            $message = "<div class='alert alert-success' role='alert'>Deleted Successfully!</div>";
               
        }
        else{

            $message = "<div class='alert alert-danger' role='alert'>An Error Occured!</div>";
        }
       
    }

    
//-------------------------UPDATE DELIVERY-------------------------------------------------------------

  if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "deliver")
	{
       $Id= $_GET['Id'];

        $query=mysqli_query($con,"update tblmails set deliveryStatus='1' where Id='$Id'");

        if($query == True) {

             $message = "<div class='alert alert-success' role='alert'>Updated Successfully!</div>";

        }
        else
        {
            $message = "<div class='alert alert-danger' role='alert'>An Error Occured!</div>";
        }
       
    }

       
//-------------------------UPDATE APPROVAL-------------------------------------------------------------

  if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "approve")
	{
       $Id= $_GET['Id'];

        $query=mysqli_query($con,"update tblmails set isApproved='1' where Id='$Id'");

        if($query == True) {

             $message = "<div class='alert alert-success' role='alert'>Updated Successfully!</div>";

        }
        else
        {
            $message = "<div class='alert alert-danger' role='alert'>An Error Occured!</div>";
        }
       
    }


    //-------------------------UPDATE VERIFICATION-------------------------------------------------------------

  if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "verify")
	{
       $Id= $_GET['Id'];

        $query=mysqli_query($con,"update tblmails set isVerified='1' where Id='$Id'");

        if($query == True) {

             $message = "<div class='alert alert-success' role='alert'>Updated Successfully!</div>";

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


  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "includes/sidebar.php";?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="width:200%">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Mails</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">All Mails</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row" style="width:100%">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
             

              <!-- /.card-header -->
              <!-- form start -->
          
            </div>
     
            <!-- Horizontal Form -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">All Mails</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                 <table id="example1" style="width:100%" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>S/N</th>
                <th>Customer FullName</th>
                <th>Recipients FullName</th>
                <th>Package</th>
                <th>Package Category</th>
                <th>Package Size</th>
                <th>Package Weight</th>
                <th>Postage Stamp</th>
                <th>Value of Item</th>
                <th>Item Type</th>
                <th>Quantity</th>
                <th>Mailing Date</th>
                <th>Mailing Time</th>
                <th>Country</th>        
                <th>Region/State</th>
                <th>Zip Code</th>
                <th>Postage Price</th>
                <th>Approval Status</th>
                <th>Verification Status</th>
                <th>Picked Up Status</th>
                <th>Delivery Status</th>
                <th>Date Created</th>
                <th>Approve</th>
                <th>Verify</th>
                <th>Delivered</th>
                <th>Delete</th>
                </tr>
                </thead>
                <tbody>
              
               <?php
        $query=mysqli_query($con,"SELECT tblmails.Id,tblcustomers.firstName,tblcustomers.lastName,tblmailpackages.packageName,tblmailpackagecategory.categoryName,
        tblpostagestamps.stampName,tblcustomerrecipients.firstName AS recipientsFirstName,tblcustomerrecipients.lastName AS recipientsLastName,tblitemtype.itemTypeName,
        tblmails.valueOfItem,tblmails.quantity,tblmails.dateToBeMailed,tblmails.timeToBeMailed,tblmails.destinationCountry,tblmails.destinationRegion,tblmails.destinationZipCode,
        tblmails.totalPostagePrice,tblmails.isApproved,tblmails.isVerified,tblmails.isPickedUp,tblmails.deliveryStatus,tblmails.dateAdded,
        tblpackagesize.sizeFrom,tblpackagesize.sizeTo,tblpackageweight.weightFrom,tblpackageweight.weightTo
        from tblmails  
        INNER JOIN tblcustomers ON tblcustomers.Id = tblmails.customerId
        INNER JOIN tblmailpackages ON tblmailpackages.Id = tblmails.mailPackageId
        INNER JOIN tblmailpackagecategory ON tblmailpackagecategory.Id = tblmails.mailPackageCategoryId
        INNER JOIN tblpackagesize ON tblpackagesize.Id = tblmails.packageSizeId
        INNER JOIN tblpackageweight ON tblpackageweight.Id = tblmails.packageWeightId
        INNER JOIN tblpostagestamps ON tblpostagestamps.Id = tblmails.postageStampId
        INNER JOIN tblitemtype ON tblitemtype.Id = tblmails.typeOfItemId
        INNER JOIN tblcustomerrecipients ON tblcustomerrecipients.Id = tblmails.recipientsId
        "); 
        $cnt=1;
        while ($row=mysqli_fetch_array($query)) {
                            ?>
                <tr>
                <td><?php echo $cnt;?></td>
                <td><?php  echo $row['firstName'].' '.$row['lastName'];?></td>
                <td><?php  echo $row['recipientsFirstName'].' '.$row['recipientsLastName'];?></td>
                <td><?php  echo $row['packageName'];?></td>
                <td><?php  echo $row['categoryName'];?></td>
                <td><?php  echo $row['sizeFrom'].'-'.$row['sizeTo'];?></td>
                <td><?php  echo $row['weightFrom'].'-'.$row['weightTo'];?></td>
                <td><?php  echo $row['stampName'];?></td>
                <td><?php  echo $row['valueOfItem'];?></td>
                <td><?php  echo $row['itemTypeName'];?></td>
                <td><?php  echo $row['quantity'];?></td>
                <td><?php  echo $row['dateToBeMailed'];?></td>
                <td><?php  echo $row['timeToBeMailed'];?></td>
                <td><?php  echo $row['destinationCountry'];?></td>
                <td><?php  echo $row['destinationRegion'];?></td>
                <td><?php  echo $row['destinationZipCode'];?></td>
                <td><?php  echo $row['totalPostagePrice'];?></td>
                <td><?php  if($row['isApproved'] == '1'){echo '<small class="badge badge-success">Approved</small>';} else{echo '<small class="badge badge-danger">UnApproved</small>';}?></td>
                <td><?php  if($row['isVerified'] == '1'){echo '<small class="badge badge-success">Verified</small>';} else{echo '<small class="badge badge-danger">UnVerified</small>';}?></td>
                <td><?php  if($row['isPickedUp'] == '1'){echo '<small class="badge badge-success">PickedUp</small>';} else{echo '<small class="badge badge-danger">Pending</small>';}?></td>
                <td><?php  if($row['deliveryStatus'] == '1'){echo '<small class="badge badge-success">Delivered</small>';} else{echo '<small class="badge badge-danger">Pending</small>';}?></td>
                <td><?php  echo $row['dateAdded'];?></td>
                <td><a onclick="return confirm('Are you sure you want to Approve?')" href="?action=approve&Id=<?php echo $row['Id'];?>" title="Approve"><i class="fa fa-check fa-1x"></i></a></td>
                <td><a onclick="return confirm('Are you sure you want to Verify?')" href="?action=verify&Id=<?php echo $row['Id'];?>" title="Verify"><i class="fa fa-check fa-1x"></i></a></td>
                <td><a onclick="return confirm('Are you sure you want to Update Delivery Status?')" href="?action=deliver&Id=<?php echo $row['Id'];?>" title="Delivery Status"><i class="fa fa-check fa-1x"></i></a></td>
                <td><a onclick="return confirm('Are you sure you want to delete?')" href="?action=delete&Id=<?php echo $row['Id'];?>" title="Delete"><i class="fa fa-trash fa-1x"></i></a></td>
                </tr>
                <?php 
                $cnt=$cnt+1;
                }?>
                                 
                </tbody>
                <tfoot>
                <tr>
                <th>S/N</th>
                <th>Customer FullName</th>
                <th>Recipients FullName</th>
                <th>Package</th>
                <th>Package Category</th>
                <th>Package Size</th>
                <th>Package Weight</th>
                <th>Postage Stamp</th>
                <th>Value of Item</th>
                <th>Item Type</th>
                <th>Quantity</th>
                <th>Mailing Date</th>
                <th>Mailing Time</th>
                <th>Country</th>        
                <th>Region/State</th>
                <th>Zip Code</th>
                <th>Postage Price</th>
                <th>Approval Status</th>
                <th>Verification Status</th>
                <th>Picked Up Status</th>
                <th>Delivery Status</th>
                <th>Date Created</th>
                <th>Approve</th>
                <th>Verify</th>
                <th>Delivered</th>
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
