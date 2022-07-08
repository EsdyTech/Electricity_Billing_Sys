<?php
 include "includes/session.php";
 include "currentBill_action.php";
?>

<!DOCTYPE html>
<html>
<head>
  <?php include "includes/head.php";?>

  <script>
   
    var paymentForm = document.getElementById('paymentForm');
    paymentForm.addEventListener('submit', payWithPaystack, true);
    function payWithPaystack() {
        var handler = PaystackPop.setup({
            key: 'pk_test_74c53a49cf86f2b421b52ae3b7e5bf15cd106dd0', // Replace with your public key
            email: document.getElementById('email-address').value,
            amount: document.getElementById('amount').value * 100, // the amount value is multiplied by 100 to convert to the lowest currency unit
            currency: 'NGN', // Use GHS for Ghana Cedis or USD for US Dollars
            firstname: document.getElementById('first-name').value,
            lastname: document.getElementById('last-name').value,
            reference: 'YOUR_REFERENCE', // Replace with a reference you generated
            callback: function (response) {
                //this happens after the payment is completed successfully
                var reference = response.reference;
                document.getElementById('reference').value = reference;

                var billId = document.getElementById('billId').value;
                var theamount = document.getElementById('amount').value;

                // alert('Payment Successful and complete! Reference: ' + reference);
                alert('Payment Successful and complete!');
                window.location.href = 'paymentComplete.php?reference='+ reference +'&amount='+ theamount +'&billId='+ billId +'';
                // Make an AJAX call to your server with the reference to verify the transaction
            },
            onClose: function () {

                alert('Transaction was not completed.');
                 //window.location.href = '/customer/checkout';
            },
        });
        handler.openIframe();
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
            <h1>Current Month Bill</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Current Month Bill</li>
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


            <?php

            if($row > 0){
            ?>
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Current Month Bill</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                    <?php if(isset($message)){echo $message;}?>
                 <div class="row">
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Account</label><br>
                        <?php  echo $row['accountNo'];?>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Full Name</label><br>
                        <?php  echo $row['firstName'].' '.$row['lastName'];?>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Description</label><br>
                        <?php  echo $row['description'];?>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Consumption (KWH)</label><br>
                        <?php  echo $row['consumption'];?> KWH
                      </div>
                    </div>
                  </div>     

                  <div class="row">
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Tarrif Rate</label><br>
                        <?php  echo $row['tariffRate'];?>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Amount</label><br>
                        <span>&#8358;</span> <?php  echo number_format($row['amount']);?>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Status</label><br>
                        <?php  echo $row['status'];?>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Bill Date</label><br>
                        <?php  echo $row['billDate'];?>
                      </div>
                    </div>
                  </div>     
                  <div class="row">
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Due Date</label><br>
                        <?php  echo $row['dueDate'];?>
                      </div>
                    </div>
                  </div>     
                            
                </div>
                <form id="paymentForm">
                    <input type="hidden" id="email-address" value="<?php echo $row['emailAddress'];?>" required />
                    <input type="hidden" id="amount" value="<?php echo $row['amount'];?>" required />
                    <input type="hidden" id="first-name" value="<?php echo $row['firstName'];?>" />
                    <input type="hidden" id="last-name" value="<?php echo $row['lastName'];?>" />
                    <input type="hidden" id="billId" name="billId" value="<?php echo $row['id'];?>" />
                    <input type="hidden" id="reference" name="reference" />
               
                <!-- /.card-body -->
                <div class="card-footer">     
                <button type="button" class="btn btn-primary" onclick="payWithPaystack()">Continue To Payment >></button>
                <script src="https://js.paystack.co/v1/inline.js"></script>              
                    <!-- <input type="submit" name="action" value="Pay" class="btn btn-primary" /> -->
                </div>
              </form>
            </div>

            <?php
            }else{
            ?>

            <div class="card card-primary">
              <!-- <div class="card-header">
                <h3 class="card-title">Current Month Bill</h3>
              </div> -->
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <label><h2>YOU DO NOT HAVE AN OUTSTANDING BILL FOR THIS MONTH!!!<h2></label>
                </div>
            </div>

            <?php
              }
            ?>


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
