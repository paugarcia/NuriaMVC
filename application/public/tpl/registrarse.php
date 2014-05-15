<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Daw Agency | Registrarse</title>
<script type="text/javascript" src="{APP_W}/application/public/js/jquery.js"></script>
<script type="text/javascript">
    var val1 = 0;
    var val2 = 0;
    var val3 = 0;
    var val4 = 0;
$(document).ready(function(){
     
        $("#form-email").change(function(){
            mail = $("#form-email").val();
            email =/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/;
            if(mail.match(email))
            {
                    $("#form-email").css("background-color","#0F6");
                    val1 = 1;
            }
            else{
                    $("#form-email").css("background-color","#F00");
                    val1 = 0;
            }
        });
        $("#form-name").change(function(){
            nombre = $("#form-name").val();
            patron =/^[a-zA-Z]{2,10}$/;
            if(nombre.match(patron))
            {
                    $("#form-name").css("background-color","#0F6");
                    val2 = 1;
            }
            else{
                    $("#form-name").css("background-color","#F00");
                    val2 = 0;
            }
        });
         $("#form-surname").change(function(){
            nombre = $("#form-surname").val();
            patron =/^[a-zA-Z]{2,10}$/;
            if(nombre.match(patron))
            {
                    $("#form-surname").css("background-color","#0F6");
                    val3 = 1;
            }
            else{
                    $("#form-surname").css("background-color","#F00");
                    val3 = 0;
            }
        });
        $("#form-pass").change(function(){
            nombre = $("#form-pass").val();
            patron_pass = /^[a-zA-Z0-9_-]{3,18}$/;
            if(nombre.match(patron_pass))
            {
                    $("#form-pass").css("background-color","#0F6");
                    val4 = 1;
            }
            else{
                    $("#form-pass").css("background-color","#F00");
                    val4 = 0;
            }
        });
        $("input").change(function(){
            
            if(val1 == 1 && val2==1 && val3==1 && val4==1)
            {
                $("#env").css("display","block");
            }
            else{
                $("#env").css("display","none");
            }
            
        })
});
</script>
<style>
/*BOTON ENVIAR FORM ACCEDER*/
#env{display: none;}    
</style>
<link rel="stylesheet" type="text/css" href="{APP_W}/application/public/css/style.css"/>
</head>
<body>
<header>
    <div>
        <a href="{APP_W}/vols">Vols</a>
        <a href="{APP_W}/balnearis">Balnearis</a>
        <a href="{APP_W}/parcs">Parcs de atraccions</a>
        <a href="{APP_W}/accedir">Login</a>
        <a href="{APP_W}/registrarse"><b>Registrarse</b></a>
    </div>
</header>
<section>
    <h1>{REGISTRARSE}</h1>
<div align="center" class="accedir">
	<form action="{APP_W}/registrarse/regis" method="POST">
            <table>
                <tr>
                    <td>Email:</td>
                    <td><input type="text" name="email" id="form-email"/></td>
                </tr>
                <tr>
                    <td>Nom:</td>
                    <td><input type="text" name="nombre" id="form-name"/></td>
                </tr>
                <tr>
                    <td>Cognoms:</td>
                    <td><input type="text" name="apellidos" id="form-surname"/></td>
                </tr>
                <tr>
                    <td>Passsword:</td>
                    <td><input type="password" name="contra" id="form-pass"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" id="env" value="Enviar"/> </td>
                </tr>
            </table>	
            <!--Email:<input type="text" name="email"/><br/>
		Nom:<input type="text" name="nombre"/> <br/>
                Cognoms:<input type="text" name="apellidos"/> <br/>   
  		Passsword:<input type="password" name="contra"/><br/>
    	<input type="submit" id="env" value="Enviar"/>--> 
    </form>
</div>
</section>
<footer>  Tots els drets reservats per <a href="{APP_W}">Daw Agency</a></footer>
</body>
</html>
