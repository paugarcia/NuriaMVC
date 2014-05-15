<!DOCTYPE html>
<html lang="ca">
<head>
    <link rel="stylesheet" type="text/css" href="{APP_W}/application/public/css/style.css">
    <title>Daw Agency | Home</title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="{APP_W}/application/public/js/main.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js">        </script>
    <script>
        
    $(document).ready(function() {

	var strCookieName = "cookie-compliance";
	var strApprovedVal = "approved";

	var cookieVal = readCookie(strCookieName);
	var $displayMsg = $('#cookieMessageWrapper');

	if (cookieVal != strApprovedVal) {
		setTimeout(function() { $displayMsg.slideDown(200); }, 200);
	} else if (!$displayMsg.is(':hidden')) {
		$displayMsg.slideUp();
	};

	$('#cookieClose').click(function() {
		$displayMsg.slideUp();
		createCookie(strCookieName, strApprovedVal, 365);
	});
});

    //Cookie functions
    function createCookie(name, value, days) {
            if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    var expires = "; expires=" + date.toGMTString();
            }
            else var expires = "";
            document.cookie = name + "=" + value + expires + "; path=/";
    }

    function readCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
    }
    function desaparecer()
    {
        document.getElementById("cookieMessageWrapper").style = "Display:none";
    }

    function eraseCookie(name) 
    {
       createCookie(name, "", -1);
    }
    
    
    </script>
</head>
<body>
<header>
    <div class="logo">
        <a href="{APP_W}">
            <img id="imag_log" src="{APP_W}/application/public/img/logo.png" />
        </a>
    </div>
    <div class="botones">
        <a href="{APP_W}/vols">Vols</a>
        <a href="{APP_W}/balnearis">Balnearis</a>
        <a href="{APP_W}/parcs">Parcs de atraccions</a>
        <a href="{APP_W}/accedir">{Login}</a>
        <a href="{APP_W}/registrarse">{Registrarse}</a>
    </div>
    
</header>
<section>
    <h1>DAW AGENCY PREUS DE LOCURA!</h1>
    <a href="{APP_W}/vols"><div class="boton" style='background-image:"{APP_W}/aplication/public/img/pic1.jpg"'>VOLS</div></a>
    <a href="{APP_W}/balnearis"><div class="boton">BALNEARIS</div></a>
    <a href="{APP_W}/parcs"><div class="boton">PARCS DE ATRACCIONS</div></a>
    <h1>TOT AIXO I MOLT MES...</h1>
    <br/>
    <h4>Noticies del mon</h4>
    <div id="rss">
        <load>Loading...</load>
    </div>
</section>

<footer>Tots els drets reservats per <a href="{APP_W}">Daw Agency</a></footer>
<div id="cookieMessageWrapper">
<div id="cookieMessage">
<strong>Este Sitio Utiliza Cookies.</strong>Usted Puede Leer En Nuestra <a href="{APP_W}/Politica"><b>Politica De Privacidad</b></a>. <button onclick="desaparecer()">Aceptar</button>
</div>
</div>
</body>
</html>