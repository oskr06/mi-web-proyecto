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
  <title>Proyecto Fisica - Inicio</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
  <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
  <script type="text/javascript" src="js/jquery-1.4.2.min.js" ></script>
  <script type="text/javascript" src="js/cufon-yui.js"></script>
  <script type="text/javascript" src="js/Humanst521_BT_400.font.js"></script>
  <script type="text/javascript" src="js/Humanst521_Lt_BT_400.font.js"></script>
  <script type="text/javascript" src="js/gallery_init.js"></script>
  <script type="text/javascript" src="js/cufon-replace.js"></script>
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
        	<li><a href="index.php" class="current">Inicio</a></li>
          <li><a href="biografias.php">Biografias</a></li>
          <li><a href="materias.php">Materias</a></li>
          <li><a href="ejercitarios.php">Ejercitarios</a></li>
          <li><a href="registro.php">Registrarse</a></li>
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
            <h2>Noticias <span>Relevantes</span></h2>
            <!-- .news -->
            <ul class="news">
            	<li>
              	<figure><strong>09</strong>Abril</figure>
                <h3><a href="#">Se Descubre</a></h3>
                Diego Kadena predice la llegada del cometa a la tierra <a href="#">...</a>
              </li>
              <li>
              	<figure><strong>18</strong>Junio</figure>
                <h3><a href="#">Felicidades</a></h3>
                En este dia se conmemora el 105 cumplea&ntilde;os del famosisimo  <a href="#">...</a>
              </li>
              <li>
              	<figure><strong>30</strong>Mayo</figure>
                <h3><a href="#">Se inventa</a></h3>
                El arquitecto famoso Pedro Perez reconoce <a href="#">...</a>
              </li>
              <li>
              	<figure><strong>25</strong>Septiembre</figure>
                <h3><a href="#">Predicen</a></h3>
                Los astronomos de la NASA, traen una noticia que conmoveria <a href="#">...</a>
              </li>
            </ul>
            <!-- /.news -->
          </aside>
          <!-- content -->
          <section id="content">
            <article>
            	<h2>Bienvenidos a <span>Nuestro Proyecto!</span></h2>
              <p>La física (del lat. physĭca, y este del gr. τὰ φυσικά, neutro plural de φυσικός, "naturaleza") es una ciencia natural que estudia las propiedades del espacio, el tiempo, la materia y la energía, así como sus interacciones.</p>
             
              <p>«La física es una de las más antiguas disciplinas académicas, tal vez la más antigua a través de la inclusión de la astronomía. En los últimos dos milenios, la física había sido considerada sinónimo de la filosofía, la química, y ciertas ramas de la matemática y la biología, pero durante la Revolución Científica en el siglo XVII surgió para convertirse en una ciencia moderna, única por derecho propio. Sin embargo, en algunas esferas como la física matemática y la química cuántica, los límites de la física siguen siendo difíciles de distinguir.»
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


