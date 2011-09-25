<?php
 session_start();
 
 include("db-info.php");
 $link = mysql_connect($server, $user, $pass);
 if(!mysql_select_db($database)) die(mysql_error());

 include("session.inc.php");
 include("loadsettings.inc.php");
?>
<?php

if (isset($_POST["username"]))  {

   $username = htmlspecialchars(trim($_POST["username"]));
   $password = htmlspecialchars(trim($_POST["password"]));
   
   echo "<br />";    
   if (($username != "") && ($password != ""))
   {
        $q = "SELECT username FROM `members` WHERE (username = '$username') and (password = '$password')";
        if(!($result_set = mysql_query($q))) die(mysql_error());
        $number = mysql_num_rows($result_set);
 
        if (!$number) {
            echo "Disculpas ! El usuario no existe, o, ha ingresado incorrectamente su contrasenha."; 
            
        } 
        else {
            $date = date("y-m-d");
            mysql_query("UPDATE `members` SET access = '$date' WHERE username = '$username'"); 
            $_SESSION["proyecto-user"] = $username;
            $_SESSION["proyecto-pass"] = $password;
            echo "<b>Has sido loggeado correctamente.</b> <br><br>Seras redirigido a la Pagina Principal.
                  <br> 
                 <a href=\"index.php\">Click aqui</a> si no es redireccionado automaticamente.";
            echo "<meta http-equiv=\"refresh\" content=\"3; url='index.php'\" />";
        }
   }
   else
     { echo "Por favor, llene los campos !";  }
}
else
{
  if ($session == false)
    
 
    echo "Disculpas ! Ya te encuentras loggeado.";
}


?>
