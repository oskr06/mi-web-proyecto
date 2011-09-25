<?php
 session_start();
 
 include("db-info.php");
 $link = mysql_connect($server, $user, $pass);
 if(!mysql_select_db($database)) die(mysql_error());

 include("session.inc.php");
 include("loadsettings.inc.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Registro - Proyecto de Fisica</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
  <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
  <script type="text/javascript" src="js/jquery-1.4.2.min.js" ></script>
  <script type="text/javascript" src="js/cufon-yui.js"></script>
  <script type="text/javascript" src="js/Humanst521_BT_400.font.js"></script>
  <script type="text/javascript" src="js/Humanst521_Lt_BT_400.font.js"></script>
  <script type="text/javascript" src="js/cufon-replace.js"></script>
  <script type="text/javascript" src="js/gallery_init.js"></script>
  <!--[if lt IE 7]>
  	<link rel="stylesheet" href="css/ie/ie6.css" type="text/css" media="all">
  <![endif]-->
  <!--[if lt IE 9]>
  	<script type="text/javascript" src="js/html5.js"></script>
    <script type="text/javascript" src="js/IE9.js"></script>
  <![endif]-->
</head>

<body>
  <?php include("headertop.php"); ?>
  <!-- header -->
  <header>
    <div class="container">
    	<h1><a href="index.php">Proyecto Fisica</a></h1>
      <nav>
        <ul>
        	<li><a href="index.php" >Inicio</a></li>
          <li><a href="biografias.php">Biografias</a></li>
          <li><a href="materias.php">Materias</a></li>
          <li><a href="ejercitarios.php">Ejercitarios</a></li>
          <li><a href="registro.php" class="current">Registrarse</a></li>
          <li><a href="acerca.php">Acerca de</a></li>
        </ul>
      </nav>
    </div>

</div>


	</header>
   <!-- #gallery -->
  <section id="gallery">
  	<div class="container">
      	<center><img src="images/image.gif"></center>
  	</div>
  </section>
  <!-- /#gallery -->
  <div class="main-box">
    <div class="container">
      <div class="inside">
        <div class="wrapper">
        	<!-- aside -->
          <aside>
            <h2>Para Qué <span>Registrarse?</span></h2>
                        El registro a la pagina, le ofrece la libertad de acceder a todo el contenido del mismo, ya como ejercitarios, biografias, etc.
          </aside>
          <!-- content -->
          <section id="content">
            <article>

            	<h2>Registrese <span>Ahora!</span></h2>
		<br>
<LABEL id="message">
<?php

if (isset($_POST["name"]))  {
   $name = htmlspecialchars(trim($_POST["name"]));
   $surname = htmlspecialchars(trim($_POST["surname"]));
   $edad = htmlspecialchars(trim($_POST["edad"]));
   $username = htmlspecialchars(trim($_POST["username"]));
   $password = htmlspecialchars(trim($_POST["password"]));
   $password1 = htmlspecialchars(trim($_POST["password1"]));
   $email = htmlspecialchars(trim($_POST["email"]));    
   
   echo "<br>";
   


   if (($name != "") && ($surname != "") && ($edad != "") && ($username != "") && ($password != "") && ($password1 != "") && ($email != ""))
   {
      if ((strlen($password)) > 5)  {
         
         if ($password == $password1)
         {
             $q = "SELECT username FROM `members` WHERE (username = '$username') or (email = '$email')";
             if(!($result_set = mysql_query($q))) die(mysql_error());
             $number = mysql_num_rows($result_set);

             if ($number) {
                 echo "Disculpe, ya existe una cuenta con el mismo Usuario/Email en la pagina<br><br>"; 
                 showForm();
             }
             else {
                 $q = "INSERT INTO `members` (name, surname, edad, username, password, email) VALUES('$name', '$surname','$edad', '$username', '$password', '$email')"; 
                 $result_set = mysql_query($q);
                 
 		echo "Tu cuenta ha sido creada exitosamente!.<br>";
            }
	 }
         else 
            { echo "Ups! Las Contraseñas no coinciden.<br><br>"; showForm();}       
     }
     else
        { echo "Su Contraseña debe ser de al menos 6 caracteres.<br><br>"; showForm(); } 
   } 
   else
     { echo "Por favor, rellene todos los campos primeramente !<br><br>"; showForm(); }    
}

else
{
   if ($session == false)
      showForm();
   else
      echo "Ups! Usted ya se encuentra loggeado.";
}



//**********************************************************************************************************
?>
</LABEL>
<? function showForm() { ?>
              <form id="myForm" action="registro.php" method="post" name="myForm">
                <fieldset>

		  <div class="field">
                    <label>Nombre</label>
                    <input type="text" value="" name="name"/>
                  </div>
		  <div class="field">
                    <label>Apellido</label>
                    <input type="text" value="" name="surname"/>
                  </div>
		  <div class="field">
                    <label>Edad</label>
                    <input type="text" value="" name="edad" maxlength=2/>
                  </div>
                  <div class="field">
                    <label>Usuario</label>
                    <input type="text" value="" name="username"/>
                  </div>
                  <div class="field">
                    <label>Contrase&ntilde;a</label>
                    <input type="password" value="" name="password"/>
                  </div>
                  <div class="field">
                    <label>Confirmar</label>
                    <input type="password" value="" name="password1"/>
                  </div>
 		  <div class="field">
                    <label>E-mail</label>
                    <input type="text" value="" name="email"/>
                  </div>
                  <div><a href="#" onclick="myForm.submit();">Registrarse :D</a></div>
                </fieldset>
              </form>
<? } ?>
            </article> 
          </section>
        </div>
      </div>
    </div>
  </div>
 <!-- footer -->
  <footer>
    <div class="container">
    	<div class="wrapper">
        <div class="fleft">Copyright - Proyecto Fisica</div>
        <div class="fright"><a href="http://www.spamdora.org/" target="_blank">Lo Mejor del Warez!</a> Designed por OsKr06 :D &nbsp; &nbsp; |&nbsp; &nbsp; <a href="http://www.taringa.net/" target="_blank">Taringa!</a> Para los amantes del Warez</div>
      </div>
    </div>
  </footer>
  <script type="text/javascript"> Cufon.now(); </script>
</body>
</html>
