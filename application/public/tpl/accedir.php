<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Daw Agency | Accedir</title>
<link rel="stylesheet" type="text/css" href="{APP_W}/application/public/css/style.css">
<script type="text/javascript" src="{APP_W}/application/public/js/jquery.js"></script>
<script type="text/javascript">
    var val1 = 0;
    var val2 = 0;
$(document).ready(function(){
    $("#form").change(function(){
            mail = $("#form").val();
            email =/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/;
            if(mail.match(email))
            {
                    $("#form").css("background-color","#0F6");
                    val1 = 1;
            }
            else{
                    $("#form").css("background-color","#F00");
                    val1 = 0;
            }
        });
        $("#pass").change(function(){
            nombre = $("#pass").val();
            patron_pass = /^[a-zA-Z0-9_-]{3,18}$/;
            if(nombre.match(patron_pass))
            {
                    $("#pass").css("background-color","#0F6");
                    val2 = 1;
            }
            else{
                    $("#pass").css("background-color","#F00");
                    val2 = 0;
            }
        });
         $("input").change(function(){
            
            if(val1 == 1 && val2==1)
            {
                $("#env").css("display","block");
            }
            else{
                $("#env").css("display","none");
            }
            
        });
        
    
    
    
})
</script>
<style>
/*BOTON ENVIAR FORM ACCEDER*/
#env{display: none;}    
</style>
</head>
<body>
<header>
    <div>
        <a href="{APP_W}/vols">Vols</a>
        <a href="{APP_W}/balnearis"><b>Balnearis</b></a>
        <a href="{APP_W}/parcs">Parcs de atraccions</a>
        <a href="{APP_W}/accedir">{Login}</a>
        <a href="{APP_W}/registrarse">{Registrarse}</a>
    </div>
</header>
<section><br/>
<div align="center" class="accedir">
  <form action="{APP_W}/accedir/login" method="POST">
      <table>
      <tr>
          <td><label for="id_username">Email:</label></td>
          <td><input type="text" id="form" name="nom"/></td>
      </tr>
      <tr>
          <td><label for="id_password">Contraseña:</label></td>
          <td><input type="password" id="pass" name="password"/></td>
      </tr>
    <tr>
        <td><a href="{APP_W}/registrarse">Registrarse</a></td>
        <td><input type="submit" id="env" value="Enviar"/></td>
    </tr>
    </table>
  </form>
</div><br/>
</section>
<footer>Tots els drets reservats per <a href="{APP_W}">Daw Agency</a></footer>
</body>
</html>
