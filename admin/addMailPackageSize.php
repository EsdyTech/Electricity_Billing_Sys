<?php include "../includes/session.php";?>


 <?php     
 error_reporting(0);

 //------------------GET THE ID--------------------------------------------

  if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "edit")
	{
        $Id = $_GET['Id'];
        $query = mysqli_query($con,"select * from tblpackagesize where Id='$Id'");
        $rows = mysqli_fetch_array($query);

    }

//-------------------------DELETE---------------------------------------

  if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "delete")
	{
        $Id= $_GET['Id'];

        $que = mysqli_query($con,"DELETE FROM tblpackagesize WHERE Id='$Id'");

        if($que == TRUE){

            $message = "<div class='alert alert-success' role='alert'>Package Size Deleted!</div>";
        }
        else{

            $message = "<div class='alert alert-danger' role='alert'>An Error Occured!</div>";
        }
       
    }

   
    //--------------------------SAVE------------------------------------------------------

	if (isset($_POST['save']))
	{
        $sizeFrom = $_POST['sizeFrom'];
        $sizeTo = $_POST['sizeTo'];
        $sizePrice = $_POST['sizePrice'];
        $dateAdded = date("Y-m-d");

        $query=mysqli_query($con,"select * from tblpackagesize where sizeFrom ='$sizeFrom' and sizeTo = '$sizeTo'");
        $ret=mysqli_fetch_array($query);
        if($ret > 0){

            $message = "<div class='alert alert-danger' role='alert'>Package Size Already Exists!</div>";

        }
        else{

            $queryy=mysqli_query($con,"insert into tblpackagesize(sizeFrom,sizeTo,sizePrice,dateAdded) value('$sizeFrom','$sizeTo','$sizePrice','$dateAdded')");

            if ($queryy == True) {

                $message = "<div class='alert alert-success' role='alert'>Package Size Added Successfully!</div>";
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
        $sizeFrom = $_POST['sizeFrom'];
        $sizeTo = $_POST['sizeTo'];
        $sizePrice = $_POST['sizePrice'];
        $dateAdded = date("Y-m-d");
          
        $query=mysqli_query($con,"update tblpackagesize set sizeFrom='$sizeFrom', sizeTo='$sizeTo', sizePrice='$sizePrice' where Id='$Id'");

        if($query == True) {

             $message = "<div class='alert alert-success' role='alert'>Package Size Edited Successfully!</div>";
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
            <h1>Mail Package Size</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Mail Package Size</li>
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
                <h3 class="card-title">Add Mail Package Size</h3>
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
                        <label>Size From</label>
                     <input type="text" required name="sizeFrom" value="<?php echo $rows['sizeFrom'];?>" onkeypress="return isNumber(event)" class="form-control" placeholder="Size From">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Size To</label>
                        <input type="text" required name="sizeTo" value="<?php echo $rows['sizeTo'];?>" onkeypress="return isNumber(event)" class="form-control" placeholder="Size To">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Price (Naira)</label>
                        <input type="text" required name="sizePrice" value="<?php echo $rows['sizePrice'];?>" onkeypress="return isNumber(event)" class="form-control" placeholder="Size Price">
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
                <h3 class="card-title">All Package Sizes</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>S/N</th>
                   <th>Size From</th>
                    <th>Size To</th>
                  <th>Price</th>
                   <th>Date Added</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
              
               <?php
        $ret=mysqli_query($con,"SELECT * from tblpackagesize");
        $cnt=1;
        while ($row=mysqli_fetch_array($ret)) {
                            ?>
                <tr>
                <td><?php echo $cnt;?></td>
                <td><?php  echo $row['sizeFrom'];?></td>
                <td><?php  echo $row['sizeTo'];?></td>
                <td><?php  echo $row['sizePrice'];?></td>
                <td><?php  echo $row['dateAdded'];?></td>
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
                   <th>Size From</th>
                    <th>Size To</th>
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
