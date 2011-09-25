<?php
 
  $userid = "";
  $session = false;

   if (isset($_SESSION["imagehost-user"]))
   {
      $session = true;
      $username = $_SESSION["imagehost-user"];
      $password = $_SESSION["imagehost-pass"];

      $q = "SELECT id, userpass FROM `members` WHERE (username = '$username') and (password = '$password')";
      if(!($result_set = mysql_query($q))) die(mysql_error());
      $number = mysql_num_rows($result_set);

      if (!$number) {
         session_destroy();
         $session = false;
      }
      else {
        $r = mysql_fetch_array($result_set);
        $userid = $r['id'];
        $userpass = $r['userpass'];
      }
   }
   else
      $session = false;

?>