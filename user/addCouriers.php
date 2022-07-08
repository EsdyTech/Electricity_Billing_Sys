<?php include "../includes/session.php";?>


 <?php     
 error_reporting(0);

 //------------------GET THE ID--------------------------------------------

  if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "edit")
	{
        $Id = $_GET['Id'];
        $query = mysqli_query($con,"select * from tblcouriers where Id='$Id'");
        $row = mysqli_fetch_array($query);

    }

//-------------------------DELETE---------------------------------------

  if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "delete")
	{
       $Id= $_GET['Id'];

        $que = mysqli_query($con,"DELETE FROM tblcouriers WHERE Id='$Id'");

        if($que == TRUE){

            $message = "<div class='alert alert-success' role='alert'>Deleted!</div>";
        }
        else{

            $message = "<div class='alert alert-danger' role='alert'>An Error Occured!</div>";
        }
       
    }

   
    //--------------------------SAVE------------------------------------------------------

	if (isset($_POST['save']))
	{
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
		$emailAddress = $_POST['emailAddress'];
        $phoneNo = $_POST['phoneNo'];
        $homeAddress = $_POST['homeAddress'];
        $dateCreated = date("Y-m-d");

        $query=mysqli_query($con,"select * from tblcouriers where emailAddress ='$emailAddress'");
        $ret=mysqli_fetch_array($query);
        if($ret > 0){

            $message = "<div class='alert alert-danger' role='alert'>Courier with Email Address Already Exists!</div>";

        }
        else{

             $queryy=mysqli_query($con,"insert into tblcouriers(firstName,lastName,emailAddress,phoneNo,homeAddress,isAvailable,dateCreated) value('$firstName','$lastName','$emailAddress','$phoneNo','$homeAddress','0','$dateCreated')");

            if ($queryy == True) {

                $message = "<div class='alert alert-success' role='alert'>Added Successfully!</div>";
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
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
		$emailAddress = $_POST['emailAddress'];
        $phoneNo = $_POST['phoneNo'];
        $homeAddress = $_POST['homeAddress'];
        $dateCreated = date("Y-m-d");
        
         $query=mysqli_query($con,"update tblcouriers set firstName='$firstName',lastName='$lastName',emailAddress='$emailAddress',phoneNo='$phoneNo',homeAddress='$homeAddress'
         where Id='$Id'");

        if($query == True) {

             $message = "<div class='alert alert-success' role='alert'>Edited Successfully!</div>";

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
            <h1>Mail Couriers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Mail Couriers</li>
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
                <h3 class="card-title">Add Mail Couriers</h3>
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
                        <label>FirstName</label>
                        <input type="text" required name="firstName" value="<?php echo $row['firstName'];?>" class="form-control" placeholder="Enter FirstName">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>LastName</label>
                        <input type="text" required name="lastName" value="<?php echo $row['lastName'];?>" class="form-control" placeholder="Enter LastName">
                      </div>
                    </div>
                     </div>
                    <div class="row">
                   <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Email Address</label>
                        <input type="text" required name="emailAddress" value="<?php echo $row['emailAddress'];?>" class="form-control" placeholder="Enter Email Address">
                      </div>
                    </div>
                     <div class="col-sm-6">
                      <div class="form-group">
                        <label>Phone No</label>
                        <input type="text" required name="phoneNo" value="<?php echo $row['phoneNo'];?>" class="form-control" placeholder="Enter Phone No">
                      </div>
                    </div>
                    </div>
                     <div class="row">
                   <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Home Address</label>
                        <input type="text" name="homeAddress" value="<?php echo $row['homeAddress'];?>"  class="form-control" placeholder="Enter Home Address">
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
                <h3 class="card-title">All Mail Couriers</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>S/N</th>
                   <th>FirstName</th>
                  <th>LastName</th>
                   <th>Email</th>
                     <th>Phone Number</th>
                    <th>Address</th>
                     <th>Availability</th>
                   <th>Date Added</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
              
               <?php
        $ret=mysqli_query($con,"SELECT * from tblcouriers");
        $cnt=1;
        while ($row=mysqli_fetch_array($ret)) {
                            ?>
                <tr>
                <td><?php echo $cnt;?></td>
                <td><?php  echo $row['firstName'];?></td>
                <td><?php  echo $row['lastName'];?></td>
                <td><?php  echo $row['emailAddress'];?></td>
                <td><?php  echo $row['phoneNo'];?></td>
                <td><?php  echo $row['homeAddress'];?></td>
                <td><?php  if($row['isAvailable'] == "0"){echo "Available";}else{echo "UnAvailable";}?></td>
                <td><?php  echo $row['dateCreated'];?></td>
                <td><a href="?action=edit&Id=<?php echo $row['Id'];?>" title="Edit"><i class="fa fa-edit fa-1x"></i></a></td>
                <td><a onclick="return confirm('Are you sure you want to delete?')" href="?action=delete&Id=<?php echo $row['Id'];?>" title="Delete"><i class="fa fa-trash fa-1x"></i></a></td>
                </tr>
                <?php 
                $cnt=$cnt+1;
                }?>
                                 
                </tbody>
                <tfoot>
                <tr>
                  <th>S/N</th>
                   <th>FirstName</th>
                  <th>LastName</th>
                   <th>Email</th>
                     <th>Phone Number</th>
                    <th>Address</th>
                    <th>Availability</th>
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
