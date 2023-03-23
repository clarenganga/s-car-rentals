<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>S-CAR RENTALS</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="forms.css">
    <link rel="stylesheet" href="registration.css">
    <link rel="stylesheet" href="fixed.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <script type="text/javascript">
        function preventBack() {
            window.history.forward(); 
        }
          
        setTimeout("preventBack()", 0);
          
        window.onunload = function () { null };
    </script>
    
</head>
<body  data-spy="scroll" data-target="#navbarResponsive">

<style>
    
        /*- adminlogin.php  Start-*/
        body {
        background-color: black;
      }
.banner-text {
  color: white;
  padding: 100px 0;
}
.content {
  display: flex;
  justify-content: center;
  align-items: center;
  
}
            
  .form {
    background-color: black;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.3);
    padding: 40px;
    width: 400px;
  }
  
  .h {
    background-color: white;
    border: none;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.3);
    margin: 10px 0;
    padding: 10px;
    width: 100%;
  }
  
  .btnn {
    background-color: crimson;
    border: none;
    border-radius: 5px;
    color: white;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    margin: 10px 0;
    padding: 10px;
    transition: all 0.3s ease;
    width: 100%;
  }
  
  .btnn:hover {
    background-color: black;
  }
  
  h2 {
    margin-bottom: 20px;
    text-align: center;
  }
  
  

</style>

<?php
require_once('connection.php');

if(isset($_GET['token'])) {
  // If a token is provided, check if it's valid
  $token = $_GET['token'];
  $query = "SELECT * FROM admin WHERE reset_token='$token' AND reset_timestamp >= DATE_SUB(NOW(), INTERVAL 1 HOUR)";
  $result = mysqli_query($con, $query);
  if(mysqli_num_rows($result) == 1) {
    // If the token is valid, display a form for the admin to reset their password
    echo '<form method="post" action="resetpasswordconfirm.php">';
    echo '<label for="password">Enter a new password:</label>';
    echo '<input type="password" id="password" name="password" required>';
    echo '<label for="confirm_password">Confirm your new password:</label>';
    echo '<input type="password" id="confirm_password" name="confirm_password" required>';
    echo '<button type="submit" name="reset_password">Reset Password</button>';
    echo '<input type="hidden" name="token" value="' . $token . '">';
    echo '</form>';
  } else {
    // If the token is invalid, display an error message
    echo 'Invalid or expired token.';
  }
} else if(isset($_POST['email'])) {
  // If an email address is submitted, generate a token and send an email with a link to reset the password
  $email = $_POST['email'];
  $query = "SELECT * FROM admin WHERE email='$email'";
  $result = mysqli_query($con, $query);
  if(mysqli_num_rows($result) == 1) {
    $admin = mysqli_fetch_assoc($result);
    $reset_token = bin2hex(random_bytes(32));
    $reset_timestamp = date('Y-m-d H:i:s');
    $query = "UPDATE admin SET reset_token='$reset_token', reset_timestamp='$reset_timestamp' WHERE id=".$admin['id'];
    mysqli_query($con, $query);
    $reset_link = 'http://yourwebsite.com/resetpassword.php?token=' . $reset_token;
    $to = $admin['email'];
    $subject = 'Reset Password';
    $message = 'Hello '.$admin['name'].',<br><br>';
    $message .= 'You recently requested to reset your password. Please click on the following link to reset your password:<br><br>';
    $message .= '<a href="'.$reset_link.'">'.$reset_link.'</a><br><br>';
    $message .= 'If you did not request to reset your password, please ignore this message.<br><br>';
    $message .= 'Best regards,<br>';
    $message .= 'Your Website Team';
    $headers = "From: Your Website <noreply@yourwebsite.com>\r\n";
    $headers .= "Reply-To: noreply@yourwebsite.com\r\n";
    $headers .= "Content-type: text/html\r\n";
    mail($to, $subject, $message, $headers);
    echo 'An email with instructions to reset your password has been sent to your email address.';
  } else {
    echo 'This email address is not registered.';
  }
} else {
  // Display a form for the admin to enter their email address
  echo '<form method="post" action="forgotpassword.php">';
  echo '<label for="email">Enter your email address:</label>';
  echo '<input type="email" id="email" name="email" required>';
  echo '<button type="submit">';
}

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="index.php">
            <h2>S-CAR RENTALS</h2>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">HOME</a>
                </li>
                <li  class="nav-item">
                    <a class="nav-link"  href="about.php">ABOUT US</a>
                </li>
                <li  class="nav-item">
                    <a class="nav-link"  href="contact.php">CONTACT</a>
                </li>
                <li  class="nav-item">
                    <a class="nav-link"  href="adminlogin.php">SYSTEM ADMIN</a>
                </li>
            </ul>
        </div>
    </nav>

                        <div class="banner-text">
                            <h2>Reset Password</h2>
                            <div class="content">
                                    
                                        <form class="form" method="POST">
                                            <label for="email">Please enter your email address:</label>
                                            <input class="h" type="email" id="email" name="email" required>
                                            <input type="submit" class="btnn" value="SUBMIT" name="adlog" >
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
<!--- Script Source Files -->

    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="jquery-3.3.1.min.js"></script>
    <script src="bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"></script>
 <!--- End of Script Source Files -->

  
</body>

</html>