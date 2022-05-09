<?php

$login=false;
$showerror=false;
    if($_SERVER["REQUEST_METHOD"]=="POST"){


      include 'partials/_db_connect.php';

echo "connect";
    
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql="select * from user where email = '$email' AND password='$password' ";
    $res=mysqli_query($conn, $sql);
    $count=mysqli_num_rows($res);
    if($count>0){
        $otp=rand(111111,999999);
        mysqli_query($conn, "update user set otp= '$otp' where email= '$email' ");
        echo "yes";


        header("location: emailOtp.php");


        // //Import PHPMailer classes into the global namespace
        // //These must be at the top of your script, not inside a function
        // use PHPMailer\PHPMailer\PHPMailer;
        // use PHPMailer\PHPMailer\SMTP;
        // use PHPMailer\PHPMailer\Exception;
        
        
        // require('includes/Exception.php');
        // require('includes/SMTP.php');
        // require('includes/PHPMailer.php');


        
        // //Create an instance; passing `true` enables exceptions
        // $mail = new PHPMailer(true);
        
        // try {
        //     //Server settings
        //     $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        //     $mail->isSMTP();                                            //Send using SMTP
        //     $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        //     $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        //     $mail->Username   = 'guptadeepak6575@gmail.com';                     //SMTP username
        //     $mail->Password   = 'ankita@1607';                               //SMTP password
        //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        //     $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
        //     //Recipients
        //     $mail->setFrom('guptadeepak6575@gmail.com', 'deepak');
        //     $mail->addAddress('guptadeepak6575@gmail.com', 'Joe User');     //Add a recipient
           
        
           
        //     //Content
        //     $mail->isHTML(true);                                  //Set email format to HTML
        //     $mail->Subject = 'Here is the subject';
        //     $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        
        //     $mail->send();
        //     echo 'Message has been sent';
        // } catch (Exception $e) {
        //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        // }
        

    }
    else{
        echo " not_exist";
        $showerror="Invalid credentials";

    }



 
    
//         $sql="select * from user where email='$email' AND password='$password' ";

//         $result=mysqli_query($conn, $sql);
//         $num= mysqli_num_rows($result);
//           if($num== 1){
//               $login=true;
              
//             //   session_start();
//             //   $_SESSION['loggedin']= true;
//             //   $_SESSION['name']= $name;

          

// // otp

//             //   header("location:index.php");
//             // header("location:emailOtp.php");


//           }
//           else{
//               $showerror="Invalid credencials";
//           }


//         //   otp

       

} 


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Login</title>

    <style>
    .btn {
        font-size: 15px;
        font-weight: 600;
        color: #fff;
        background: #005450;
        border: 2px solid #005450;
        border-radius: 50px;
        padding: 10px 20px;
        transition: all 0.5s ease;
        text-decoration: none;
        margin-right: 20px;
    }
    </style>

</head>

<body>

    <?php

  if($login){
 echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
 <strong>Success!</strong> you are logged in. 
 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

if($showerror){
 echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
 <strong>Error ! </strong> ' .$showerror.'
 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
 

?>



    <div class="container col-md-4 my-5" styel="height:50vh;">


        <div class="card" style="width: 25rem;">

            <div class="card-body">

                <h2 class="text-center my-3" style="color:#005450;">Blood </h2>
                <p class=" text-center my-3">Please log in to your Blood account</p>


                <form action="login.php" method="post">
                    <div class="mb-3">
                        <label for="exampleinputnumber" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                    </div>


                    <button type="submit" class="btn btn-success" onclick="send_otp()" style="margin-bottom:20px;">LogIn</button>
                </form>

                <a href="signup.php">If You are new  on Blood website click here</a>


            </div>
        </div>

    </div>



<script>
    function send_otp(){
        var email = jQuery('$email').val();
        jQuery.ajax({
            url:'emailOtp.php',
            type: 'post',
            date : 'email= '+ email,
            success:function(result){
                if($result=='yes'){
                    jQuesry('.second_box').show();
                    jQuesry('.first_box').hide();

                }
                if(result =='not_exist'){
                    jQuery('#email_error').html('please enter valid email');
                    
                }

            }
        });
    }
</script>




    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
</body>

</html>