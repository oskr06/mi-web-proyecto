<?php

define('INCLUDE_CHECK',true);

require 'connect.php';
require 'functions.php';

// Those two files can be included only if INCLUDE_CHECK is defined

session_name('tzLogin');
// Starting the session

session_set_cookie_params(2*7*24*60*60);
// Making the cookie live for 2 weeks

session_start();

if($_SESSION['id'] && !isset($_COOKIE['tzRemember']) && !$_SESSION['rememberMe'])
{
	// If you are logged in, but you don't have the tzRemember cookie (browser restart)
	// and you have not checked the rememberMe checkbox:

	$_SESSION = array();
	session_destroy();

	// Destroy the session
}

if(isset($_GET['logoff']))
{
	$_SESSION = array();
	session_destroy();
	header("Location: index.php");
	exit;
}

if($_POST['submit']=='Login')
{
	// Checking whether the Login form has been submitted

	$err = array();
	// Will hold our errors

	if(!$_POST['username'] || !$_POST['password'])
		$err[] = 'All the fields must be filled in!';

	if(!count($err))
	{
		$_POST['username'] = mysql_real_escape_string($_POST['username']);
		$_POST['password'] = mysql_real_escape_string($_POST['password']);
		$_POST['rememberMe'] = (int)$_POST['rememberMe'];

		// Escaping all input data

		$row = mysql_fetch_assoc(mysql_query("SELECT id,usr FROM tz_members WHERE usr='{$_POST['username']}' AND pass='".md5($_POST['password'])."'"));

		if($row['usr'])
		{
			// If everything is OK login

			$_SESSION['usr']=$row['usr'];
			$_SESSION['id'] = $row['id'];
			$_SESSION['rememberMe'] = $_POST['rememberMe'];

			// Store some data in the session

			setcookie('tzRemember',$_POST['rememberMe']);
			// We create the tzRemember cookie
		}
		else $err[]='Wrong username and/or password!';
	}

	if($err)
		$_SESSION['msg']['login-err'] = implode('<br />',$err);
		// Save the error messages in the session

	header("Location: index.php");
	exit;

}
else if($_POST['submit']=='Register')
{
	// If the Register form has been submitted
	$err = array();

	if(strlen($_POST['username'])<4 || strlen($_POST['username'])>32)
	{
		$err[]='Your username must be between 3 and 32 characters!';
	}

	if(preg_match('/[^a-z0-9\-\_\.]+/i',$_POST['username']))
	{
		$err[]='Your username contains invalid characters!';
	}

	if(!checkEmail($_POST['email']))
	{
		$err[]='Your email is not valid!';
	}

	if(!count($err))
	{
		// If there are no errors
		$pass = substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
		// Generate a random password

		$_POST['email'] = mysql_real_escape_string($_POST['email']);
		$_POST['username'] = mysql_real_escape_string($_POST['username']);
		// Escape the input data

		mysql_query("	INSERT INTO miembros(usr,pass,email,regIP,dt)
					VALUES(
					'".$_POST['username']."',
					'".md5($pass)."',
					'".$_POST['email']."',
					'".$_SERVER['REMOTE_ADDR']."',

					NOW()
		)");

		if(mysql_affected_rows($link)==1)
		{
			send_mail(	'demo-test@tutorialzine.com',
					$_POST['email'],
					'Registration System Demo - Your New Password',
					'Your password is: '.$pass);
					$_SESSION['msg']['reg-success']='We sent you an email with your new password!';
		}
		else $err[]='This username is already taken!';
	}

	if(count($err))
	{
		$_SESSION['msg']['reg-err'] = implode('<br />',$err);
	}

	header("Location: index.php");
	exit;
}

$script = '';
if($_SESSION['msg'])
{
	// The script below shows the sliding panel on page load
	$script = '
	<script type="text/javascript">
	$(function(){
		$("div#panel").show();
		$("#toggle a").toggle();
	});
	</script>';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Home - Home Page | Design Company - Free Website Template from Templatemonster.com</title>
  <meta charset="utf-8">

<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
  <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="login_panel/css/slide.css" media="screen" />
  <script type="text/javascript" src="js/jquery-1.4.2.min.js" ></script>
  <script type="text/javascript" src="js/cufon-yui.js"></script>
  <script type="text/javascript" src="js/Humanst521_BT_400.font.js"></script>
  <script type="text/javascript" src="js/Humanst521_Lt_BT_400.font.js"></script>
	<script type="text/javascript" src="js/roundabout.js"></script>
  <script type="text/javascript" src="js/roundabout_shapes.js"></script>
  <script type="text/javascript" src="js/gallery_init.js"></script>
  <script type="text/javascript" src="js/cufon-replace.js"></script>
  <!--[if lt IE 7]>
  	<link rel="stylesheet" href="css/ie/ie6.css" type="text/css" media="all">
  <![endif]-->
  <!--[if lt IE 9]>
  	<script type="text/javascript" src="js/html5.js"></script>
    <script type="text/javascript" src="js/IE9.js"></script>
  <![endif]-->
 
    <script src="login_panel/js/slide.js" type="text/javascript"></script>
    
    <?php echo $script; ?>
</head>

<body>
  <!-- header -->
<!-- Panel -->
<div id="toppanel">

<div id="panel">
<div class="content clearfix">
<div class="left">
<h1>The Sliding jQuery Panel</h1>
<h2>A register/login solution</h2>
<p class="grey">You are free to use this login and registration system in you sites!</p>
<h2>A Big Thanks</h2>
<p class="grey">This tutorial was built on top of <a href="http://web-kreation.com/index.php/tutorials/nice-clean-sliding-login-panel-built-with-jquery" title="Go to site">Web-Kreation</a>'s amazing sliding panel.</p>
</div>

<?php
if(!$_SESSION['id']):
// If you are not logged in
?>

<div class="left">
<!-- Login Form -->
<form class="clearfix" action="" method="post">
<h1>Member Login</h1>

<?php
if($_SESSION['msg']['login-err'])
{
	echo '<div class="err">'.$_SESSION['msg']['login-err'].'</div>';
	unset($_SESSION['msg']['login-err']);
	// This will output login errors, if any
}
?>

<label class="grey" for="username">Username:</label>
<input class="field" type="text" name="username" id="username" value="" size="23" />
<label class="grey" for="password">Password:</label>
<input class="field" type="password" name="password" id="password" size="23" />
<label><input name="rememberMe" id="rememberMe" type="checkbox" checked="checked" value="1" /> &nbsp;Remember me</label>
<div class="clear"></div>
<input type="submit" name="submit" value="Login" class="bt_login" />
</form>

</div>

<div class="left right">

<!-- Register Form -->

<form action="" method="post">
<h1>Not a member yet? Sign Up!</h1>

<?php

if($_SESSION['msg']['reg-err'])
{
	echo '<div class="err">'.$_SESSION['msg']['reg-err'].'</div>';
	unset($_SESSION['msg']['reg-err']);
	// This will output the registration errors, if any
}

if($_SESSION['msg']['reg-success'])
{
	echo '<div class="success">'.$_SESSION['msg']['reg-success'].'</div>';
	unset($_SESSION['msg']['reg-success']);
	// This will output the registration success message
}

?>

<label class="grey" for="username">Username:</label>
<input class="field" type="text" name="username" id="username" value="" size="23" />
<label class="grey" for="email">Email:</label>
<input class="field" type="text" name="email" id="email" size="23" />
<label>A password will be e-mailed to you.</label>
<input type="submit" name="submit" value="Register" class="bt_register" />
</form>

</div>

<?php
else:
// If you are logged in
?>

<div class="left">
<h1>Members panel</h1>
<p>You can put member-only data here</p>
<a href="registered.php">View a special member page</a>
<p>- or -</p>
<a href="?logoff">Log off</a>
</div>
<div class="left right">
</div>

<?php
endif;
// Closing the IF-ELSE construct
?>

</div>
</div> <!-- /login -->

<!-- The tab on top -->
<div class="tab">
<ul class="login">
<li class="left">&nbsp;</li>
<li>Hello <?php echo $_SESSION['usr'] ? $_SESSION['usr'] : 'Guest';?>!</li>
<li class="sep">|</li>
<li id="toggle">
<a id="open" class="open" href="#"><?php echo $_SESSION['id']?'Open Panel':'Log In | Register';?></a>
<a id="close" style="display: none;" class="close" href="#">Close Panel</a>
</li>
<li class="right">&nbsp;</li>
</ul>

</div> <!-- / top -->
</div> <!--panel -->
  <header>
    <div class="container">
    	<h1><a href="index.html">Proyecto Fisica</a></h1>

      <nav>
        <ul>
        	<li><a href="index.html" class="current">Inicio</a></li>
          <li><a href="about.html">Biografias</a></li>
          <li><a href="privacy.html">Materias</a></li>
          <li><a href="gallery.html">Ejercitarios</a></li>
          <li><a href="contacts.html">Ingresar</a></li>
          <li><a href="sitemap.html">Acerca de</a></li>
        </ul>
      </nav>
    </div>
	</header>
  <!-- #gallery -->
  <section id="gallery">
  	<div class="container">
    	<ul id="myRoundabout">
      	<li><img src="images/slide3.jpg" alt=""></li>
        <li><img src="images/slide2.jpg" alt=""></li>
        <li><img src="images/slide5.jpg" alt=""></li>
        <li><img src="images/slide1.jpg" alt=""></li>
        <li><img src="images/slide4.jpg" alt=""></li>
      </ul>
  	</div>
  </section>
  <!-- /#gallery -->
  <div class="main-box">
    <div class="container">
      <div class="inside">
        <div class="wrapper">
        	<!-- aside -->
          <aside>
            <h2>Recent <span>News</span></h2>
            <!-- .news -->
            <ul class="news">
            	<li>
              	<figure><strong>22</strong>June</figure>
                <h3><a href="#">Sed ut perspiciatis unde</a></h3>
                Domnis iste natus error sit voluptam accusa doloremque <a href="#">...</a>
              </li>
              <li>
              	<figure><strong>09</strong>June</figure>
                <h3><a href="#">Totam rem aperiam</a></h3>
                Eaqueipsa quae abillo inventoretis et quasi architecto beatae <a href="#">...</a>
              </li>
              <li>
              	<figure><strong>31</strong>May</figure>
                <h3><a href="#">Inventore veritatis et quasi</a></h3>
                Architecto beatae vitae dicta sunt explicabo <a href="#">...</a>
              </li>
              <li>
              	<figure><strong>25</strong>May</figure>
                <h3><a href="#">Nemo enim ipsam</a></h3>
                Voluptatem quia voluptas sit asper natur aut odit aut fugit <a href="#">...</a>
              </li>
            </ul>
            <!-- /.news -->
          </aside>
          <!-- content -->
          <section id="content">
            <article>
            	<h2>Welcome to <span>Our Design Company!</span></h2>
              <p>Design Company is a free web template created by TemplateMonster.com team. This website template is optimized for 1024X768 screen resolution. It is also HTML5 &amp; CSS3 valid.</p>
              <figure><a href="#"><img src="images/banner1.jpg" alt=""></a></figure>
              <p>This website template has several pages: <a href="index.html">Home</a>, <a href="about.html">About us</a>, <a href="privacy.html">Privacy Policy</a>, <a href="gallery.html">Gallery</a>, <a href="contacts.html">Contact us</a> (note that contact us form – doesn’t work), <a href="sitemap">Site Map</a>.</p>
              This website template can be delivered in two packages - with PSD source files included and without them. If you need PSD source files, please go to the template download page at TemplateMonster to leave the e-mail address that you want the template ZIP package to be delivered to.
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
