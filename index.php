<?php 
include('index_action.php');
date_default_timezone_set('Africa/Lagos');
$currentDate = date("Y-m-d H:i:s",  STRTOTIME(date('h:i:sa')));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="data:image/x-icon;base64,AAABAAEAEBAAAAEAIABoBAAAFgAAACgAAAAQAAAAIAAAAAEAIAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAoJiIKKCYiWgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAoJiIgKCYiuygmIhgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAoJiJDKCYi7SgmIlIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAoJiJzKCYi/SgmIqAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACgmIgooJiKmKCYi/ygmIuAoJiIOAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACgmIh8oJiLPKCYi/ygmIv4oJiI/AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACgmIkEoJiLrKCYi/ygmIv8oJiKMAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACgmInAoJiL8KCYi/ygmIv8oJiL/KCYiySgmIpwoJiJzKCYiKQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACgmIhYoJiJyKCYinCgmIsIoJiL8KCYi/ygmIv8oJiL/KCYinygmIgkAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAoJiJTKCYi/ygmIv8oJiL5KCYiaAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAoJiIeKCYi7ygmIv8oJiLjKCYiNwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAoJiIDKCYixCgmIv8oJiK+KCYiFQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAKCYigigmIv8oJiKJKCYiAwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAKCYiPigmIvAoJiJSAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAKCYiEigmIrooJiInAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACgmIlooJiIMAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA//8AAP/3AAD/7wAA/88AAP8fAAD+PwAA/D8AAPgfAAD4DwAA/j8AAPx/AAD4/wAA8f8AAPf/AADv/wAA//8AAA==" rel="icon" type="image/x-icon" />
    <title>Ebill</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>
    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php"><b>Ebill</b></a>
            </div>
            <div class="navbar-collapse collapse" >
            <form class="navbar-form navbar-right" method="post">
                <div class="form-group">
                    <input type="text" placeholder="Email Address" required name="emailAddress" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Password" required name="password" id="pass" class="form-control">
                </div>
                <input type="submit" class="btn btn-success" name="action" value="Sign in" />
                <?php if(isset($message)){echo $message;}?>

            </form>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>

    <div id="headerwrap">
        <div class="darkhearderwrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 signup">
                        <h1>Electricity Bill<br>Management System</h1>
                        <p>This website at the end of its construction will act as a consumer oriented service for users for easy payment of their respective <b>Electricity Bill</b> as well as interact with their providers in case of any queries or grivances.</p>
                    </div>
                    <!-- /col-lg-6 -->
                    <div class="col-lg-6">
                        <h1>Sign Up</h1>
                        <?php if(isset($signUpMsg)){echo $signUpMsg;}?>
                        <form method="post" class="form-horizontal" role="form" onsubmit="return validateForm()">
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="firstName" id="name" placeholder="First Name" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="lastName" id="name" placeholder="Last Name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="email" class="form-control" name="emailAddress" id="email" placeholder="Email Address" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="phoneNo" placeholder="Contact No." required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="address" class="form-control" name="address" placeholder="Address" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                <input type="submit" class="btn btn-primary" name="action" value="Register" />
                                </div>
                            </div>

                        </form>
                    </div>
                    <!-- /col-lg-6 -->
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
            </div>
    </div>
    <!-- /headerwrap -->


    <div class="container">
        <div class="row mt centered">
            <div class="col-lg-6 col-lg-offset-3">
                <h1>How this Portal woks</h1>
                <h3></h3>
            </div>
        </div>
        <!-- /row -->

        <div class="row mt centered">
            <div class="col-lg-4">
                <img src="assets/img/ser01.png" width="180" alt="">
                <h4>1 - Login</h4>
                <p></p>
            </div>
            <!--/col-lg-4 -->

            <div class="col-lg-4">
                <img src="assets/img/ser02.png" width="180" alt="">
                <h4>2 - Peruse Bills</h4>
                <p></p>
            </div>
            <!--/col-lg-4 -->

            <div class="col-lg-4">
                <img src="assets/img/ser03.png" width="180" alt="">
                <h4>3 - Transact</h4>
                <p></p>
            </div>
            <!--/col-lg-4 -->

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->

    <?php 
    require_once("footer.php");
    ?>

    <!--=======================JS=========================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery-1.11.0.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- jQuery Version 1.11.0 -->

    <script src="assets/js/custom.js"></script>
    <script>

    function validateForm() {
            var x = document.forms["myForm"]["email"].value;
            var atpos = x.indexOf("@");
            var dotpos = x.lastIndexOf(".");
            if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=x.length) {
                alert("Not a valid e-mail address");
                return false;
            }
        }  </script> 

    
</body>

</html>
