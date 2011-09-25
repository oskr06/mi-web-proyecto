<?php
 $page = basename($_SERVER['PHP_SELF']);
?>


<div style="BACKGROUND: #212222; TEXT-ALIGN: center">
<div class="header-top">

<? if ($session == false) { ?>

<form action="login.php" method="POST">

<table align="right">
<tr>
 <td><font face="arial" size="2" color="white"><b> Usuario: <input type="text" name="username" size=18> </td>
 <td>&nbsp;<font face="arial" size="2" color="white"><b> Contrase&ntilde;a: <input type="password" name="password" size=18> </td>
 <td><input type="submit" value="Ingresar" name="login"> </td>
</tr>
</table>
</form> 

<? 
} 
else {

echo "<table width=100% style='FONT-SIZE: 14px; COLOR: white'>
       <tr>
         
        <td align=right style='PADDING-TOP: 5px;'>
           <b>Bienvenido $username ! &nbsp;&nbsp;
           | &nbsp;&nbsp;<a href='account.php?act=logout' style='FONT-SIZE: 14px'>Cerrar Sesion</a>
           </b></td>
        
       </tr></table>";

}

?>

</div>
</div>


