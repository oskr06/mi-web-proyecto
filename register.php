<?php
 session_start();
 
 include("db-info.php");
 $link = mysql_connect($server, $user, $pass);
 if(!mysql_select_db($database)) die(mysql_error());

 include("session.inc.php");
 include("loadsettings.inc.php");
?>



<html>

<head>

<title><? echo $webtitle; ?> - Free Image Hosting</title>
<link rel="stylesheet" href="style.css" type="text/css" />

<meta name="description" content="<? echo $description; ?>" />
<meta name="keywords" content="<? echo $keywords; ?>" />

</head>


<body link=#336699 vlink=#336699 alink=#336699>
<?php include("header.php"); ?>

<center>
<div class="content-container">
   
 
<!-- ################################################################################################# -->

<br>
<LABEL id="message" style="COLOR: maroon">
<?php

if (isset($_POST["username"]))  {
   $username = htmlspecialchars(trim($_POST["username"]));
   $password = htmlspecialchars(trim($_POST["password"]));
   $password1 = htmlspecialchars(trim($_POST["password1"]));
   $userpass = htmlspecialchars(trim($_POST["userpass"]));
   $email = htmlspecialchars(trim($_POST["email"]));    
   
   echo "<br>";
   
 if (isset($_POST["agree"])) {

   if (($username != "") && ($password != "") && ($password1 != "") && ($email != ""))
   {
      if ((strlen($password) > 5) && (strlen($userpass) > 5))  {
         
         if ($password == $password1) 
         {
             $q = "SELECT username FROM `members` WHERE (username = '$username') or (email = '$email')";
             if(!($result_set = mysql_query($q))) die(mysql_error());
             $number = mysql_num_rows($result_set);

             if ($number) {
                 echo "Sorry ! An account with the specified username and/or email already exists.<br><br>"; 
                 showForm();
             }
             else {
                 $q = "INSERT INTO `members` (username, password, userpass, email) VALUES('$username', '$password', '$userpass', '$email')"; 
                 $result_set = mysql_query($q);
                 
                 $to = $email;
                 $subject = "Welcome to $webtitle !";
                 $body = "Hello $username, \n\nThank you for registering at $webtitle !\n\nThis email contains your registration information.\nYour username & password are shown below for your reference\n\nUser: $username\nPass: $password\nUser Pass: $userpass \n\nThanks!\n{$website}";                 
                 $headers = "From: $webtitle <{$website}>";                 

                 if(mail ($to, $subject, $body, $headers)) {
                     echo "Your account has been created successfully. 
                         <br>A welcome email has been sent to the email address you specified. 
                         <br><a href=\"login.php\">Click here</a> to login.";
                 }                 
                 else
                   echo "Your account has been created successfully.<br>Sorry ! The email could not be sent due to some reason.";
                 
                 $invite = $_POST["invite"]; 
                 for ($i=0; $i < 5; $i++) {
                    if (trim($invite[$i]) != "") {   
                        $to = $invite[$i];
                        $subject = "$webtitle Invitation";
                        $features = "Upload multiple pictures at one time\nCreate public and private galleries\nTheir dedicated servers host your images\nLink your photos in websites, email, blogs\nRegister an account to manage your files\nAdd tags to each of your photos\nUpload private images with password\nShare your images with friends and family";
 
                        $body = "Hello ! \n\nI have just joined $webtitle .\nIt provides free image hosting service with a whole bunch of features!\n\nFeatures:\n{$features}\n\nSo what are you waiting for?\nGoto $website and join instantly.\n\nThanks,\n$username";
                        $headers = "From: $username <$email>";                 
                       
                        mail($to, $subject, $body, $headers);
                    }    
                 }         

             }
         }
         else 
            { echo "Sorry ! Your passwords do not match.<br><br>"; showForm();}       
     }
     else
        { echo "Your password should be atleast 6 characters long.<br><br>"; showForm(); } 
   }
   else
     { echo "Please fill in all the fields first !<br><br>"; showForm(); }    
}
else
{ echo "Sorry! You must abide by our <a href='terms.php'>Terms and Conditions</a>
       in order to proceed in the signup process.<br><br>"; showForm(); }


}
else
{
   if ($session == false)
      showForm();
   else
      echo "Sorry ! You are already logged in.";
}


//**********************************************************************************************************
?>
</LABEL>


<? function showForm() { ?>

<div>

<table>
<tr>
<td width=600 valign=top>

<form method="POST" action="register.php" name="myForm">

<h1>Join Us Today</h1>

<LABEL id="text">Please use a valid email address. We will never sell or reveal your email address.</LABEL>
<br><br><br>

<table>
<tr>
  <td><LABEL id="title">Username: </td> <td> <input type="text" maxlength=30 size=30 name="username"> </td>
</tr>
<tr>
  <td><LABEL id="title">Password: </td> <td> <input type="password" maxlength=30 size=30 name="password"> </td>
</tr>
<tr>
  <td><LABEL id="title">Confirm Password:  </td> <td> <input type="password" maxlength=30 size=30 name="password1"> </td>
</tr>
<tr>
  <td>&nbsp;</td> <td><br> (Password for the users to view private images)</td>
</tr>
<tr>
  <td><LABEL id="title">User Password:  </td> <td> <input type="password" maxlength=30 size=30 name="userpass"> </td>
</tr>
<tr>
  <td><LABEL id="title">Email-ID: </td> <td> <input type="text" maxlength=40 size=30 name="email"> </td>
</tr>

<tr>
  <td>&nbsp;</td> <td> </td>
</tr>


<tr>
  <td><h2>Send Invitation:</h2> </td> <td> </td>
</tr>

<tr>
  <td><LABEL id="title">Email 1:</td> <td> <input type="text" maxlength=40 size=30 name="invite[]">  </td>
</tr>

<tr>
  <td><LABEL id="title">Email 2:</td> <td> <input type="text" maxlength=40 size=30 name="invite[]">  </td>
</tr>

<tr>
  <td><LABEL id="title">Email 3:</td> <td> <input type="text" maxlength=40 size=30 name="invite[]">  </td>
</tr>

<tr>
  <td><LABEL id="title">Email 4:</td> <td> <input type="text" maxlength=40 size=30 name="invite[]">  </td>
</tr>

<tr>
  <td><LABEL id="title">Email 5:</td> <td> <input type="text" maxlength=40 size=30 name="invite[]">  </td>
</tr>


<tr>
  <td></td>
  <td><br><input type="checkbox" name="agree"> &nbsp; By checking this box, you agree to abide by our <a href="terms.php">Terms and Conditions</a>.</td>
</tr>



<tr>
  <td></td>
  <td> <br><a href=#><img src="images/joinnow.png" border=0 onclick="myForm.submit();"></a></td>
</tr>
</table>

</form>
<br><br>

<b>NOTE:</b> Your email provider MAY accidentally place the registration email into your Junk Mail Folder. 
Please check that folder if you do not receive your registration email within 15 minutes of registration. 
<br><br>


</td>

<td valign=top>
<br>
<h2>Why Join?</h2>
<LABEL id='title'>Joining is free and takes only 30 seconds!<br>You'll get access to these great features:</LABEL>
<br><br>

<ul>
 <li>Upload private images
 <li>Create public and private galleries
 <li>Add images to your favourites
 <li>Post comments on images
 <li>Manage your images and galleries
 <li>Keep track of your images
 <li><b>Registration is absolutely free!</b>
</ul>




</td>
</tr></table>

</div>



<? } ?>

<!-- ################################################################################################# -->
 


<?php  include("footer.php"); ?>


</div>
</center>
</body>
</html>
