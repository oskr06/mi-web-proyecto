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

<title><? echo $webtitle; ?> - Alojamiento de Imagenes</title>
<link rel="stylesheet" href="style.css" type="text/css" />

<meta name="description" content="<? echo $description; ?>" />
<meta name="keywords" content="<? echo $keywords; ?>" />

</head>


<body link="#336699" vlink="#336699" alink="#336699">
<?php include("header.php"); ?>

<center>
<div class="content-container">
<br>

<!-- ######################################################################################### -->

         
<?php

if ($session == true)
{ 
         
   //*********************************************************************************************************
    
   if (isset($_GET["act"])) {
      $act = $_GET["act"];
       
 
       if ($act == "logout") {
          session_destroy();      
          echo "Has cerrado sesion correctamente.";
          echo "<br /><br /><a href='index.php'>Click aqui</a> para ir a la Pagina Principal";
          echo "<meta http-equiv=\"refresh\" content=\"2; url='index.php'\" />"; 
       } 
       
       
   //***********************************************************************************************************
   }
   else {

      echo "<center><h1>Area de Miembros</h1></center>";
      echo "<font color=#233c9b size=3><center><b>";    
           

      if (isset($_POST["newpass"])) {
          $oldpass = trim($_POST["oldpass"]);
          $newpass = trim($_POST["newpass"]);
          $userpass = trim($_POST["userpass"]);
          
          echo "<br />"; 
          if (($oldpass != "") and ($newpass != "") and ($userpass != "")) {
              if (strlen($newpass) > 5) {
                  $r = mysql_query("SELECT * FROM `members` WHERE (id = '$userid') AND (password = '$oldpass')");
                  $n = mysql_num_rows($r);
                   
                  if ($n) {
                     if (mysql_query("UPDATE `members` SET password = '$newpass', userpass = '$userpass' WHERE id = '$userid'"))
                     {
                         echo "Tu contraseña ha sido cambiada correctamente !";
                         $_SESSION["imagehost-pass"] = $newpass;
                     } 
                     else
                        echo "Disculpas ! La contraseña no puede ser modificada por alguna razon.";                  
 
                  }
                  else
                     echo "Disculpas ! Tu antigua contraseña es erronea.";
              }
              else
                  echo "Disculpas ! Tu nueva contraseña tiene menos de 6 caracteres.";
          }
          else
              echo "Por favor, llene todos los campos primero !";
      }      
 

      echo "</font></center></b>";
     
      echo "<br /><center><a href='#' 
               onclick=\"getElementById('privatepass').style.display='block';\">
               <img src='images/view_private.png' border=0></a><br>";

      echo "<div class='PrivatePassBox' id='privatepass'>
               <img src='images/help.gif' border=0> &nbsp; 
               Tu contraseña para ver la imagen privada es \"$userpass\"<br><br>
               <a href='#' onclick=\"getElementById('privatepass').style.display='none'\">Ocultar Ventana</a>
            </div>";


      echo "<br><br><table align=center style=\"BORDER: #b1ddf6 2px solid; BACKGROUND: #edf7fd\" width=400>
            <tr align=center>
              <td width=100><a href='myimages.php'><img src='images\images.jpg'></a></td>
              
              <td>  
               <table width=250><tr>
                  <td valign=top style=\"BORDER-BOTTOM: #42679c 1px dashed; PADDING-BOTTOM: 5px\">
                     <a href='myimages.php'>Mis Imagenes</a>
                  </td>
               </tr><tr height=50>
                  <td><LABEL id='text'>Administrar tus imagenes publicas y privadas</LABEL></td>
               </tr></table>
            
              </td>
            </tr> 
            </table>";
      
          
      echo "<br><br><table align=center style=\"BORDER: #b1ddf6 2px solid; BACKGROUND: #edf7fd\" width=400>
            <tr align=center>
              <td width=100><a href='mygalleries.php'><img src='images\gallery.jpg'></a></td>
              
              <td>  
               <table width=250><tr>
                  <td valign=top style=\"BORDER-BOTTOM: #42679c 1px dashed; PADDING-BOTTOM: 5px\">
                     <a href='mygalleries.php'>Mis Galerias</a>
                  </td>
               </tr><tr height=50>
                  <td><LABEL id='text'>Crear, editar y eliminar pgalerias publicas y privadas</LABEL></td>
               </tr></table>
            
              </td>
            </tr> 
            </table>";
  
      

      echo "<br><br><table align=center style=\"BORDER: #b1ddf6 2px solid; BACKGROUND: #edf7fd\" width=400>
            <tr align=center>
              <td width=100><a href='myfavourites.php'><img src='images\myfavourites.png'></a></td>
              
              <td>  
               <table width=250><tr>
                  <td valign=top style=\"BORDER-BOTTOM: #42679c 1px dashed; PADDING-BOTTOM: 5px\">
                     <a href='myfavourites.php'>My Favourite Images</a>
                  </td>
               </tr><tr height=50>
                  <td><LABEL id='text'>Ver y administrar tus imagenes  favoritas.</LABEL></td>
               </tr></table>
            
              </td>
            </tr> 
            </table>";


      echo "<br><br><a href='index.php'><img src='images/upload.png' border=0></a></center>";

      echo "<br><br><hr color=#b1ddf6><br><table align=center><tr><td height=30 valign=top><h2>Cambiar Contraseña:</h2></td></tr>";
      echo "<tr><td><form method=POST action='account.php' name='myForm'><font size=2>Contraseña Antigua:</td>
            <td><input type=password name='oldpass' size=28></td></tr>
            <tr><td><font size=2>Nueva Contraseña:</td><td><input type=password name='newpass' size=28></td></tr>
            <tr><td><font size=2>Contraseña de Usuario:</td><td><input type=password name='userpass' size=28></td></tr>
            <tr><td>&nbsp;</td><td>&nbsp;<a href=#><img src='images/save_changes.png' border=0 onclick='myForm.submit();'></a>
            </td></tr>
            <tr><td>&nbsp; &nbsp; &nbsp;</td></tr></form></table>";

   } 


}
else
  echo "Debes primeramente iniciar sesion para acceder a la cuenta.<br><a href=\"login.php\">Click here</a> to login.";


?>

       
<!-- ######################################################################################### -->          
   
 

<?php  include("footer.php"); ?>


</div>
</center>
</body>
</html>