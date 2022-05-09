

<?php

$login=false;
$showerror=false;
    if($_SERVER["REQUEST_METHOD"]=="POST"){


      include 'partials/_db_connect.php';

echo "connect";
$otp=$_POST["otp"]; 
    
  
    $sql="select * from user where otp = '$otp'  ";
    $res=mysqli_query($conn, $sql);
    $count=mysqli_num_rows($res);
    if($count>0){
        echo "yes";
        $login=true;
              
                      session_start();
                      $_SESSION['loggedin']= true;
                      $_SESSION['name']= $name;

            header("location: index.php");

    }
    else{
        
        $showerror="Invalid credencials";

    }
    
  }
  else{
  echo "not connect";
  }

  ?>




<html>
  <head>
    <title>Email Varification</title>

    <link rel="stylesheet" type="text/css" href="styleotp.css" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta />
  </head>
  <style></style>

  <body>
    <!-- add loading page  -->

    <?php
            if($showerror){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error ! </strong> '.$showerror.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
   ?>

    <section class="log">
      <div class="container">
        <div class="content">
          <h1>Email Varification</h1>
          <div class="emailVariy"  >
            <!-- <form  methode="post" action="emailOtp.php"> -->
            <form action="emailOtp.php" method="post">

              <div>
                <input type="text" class="form-control" name="otp" id="exampleInputEmail1"
                            aria-describedby="emailHelp" required="">
                <label>Enter OTP</label>
              </div>
             

              <button type="submit" class="btn btn-success" >Varify OTP</button>
            </form>

            
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
