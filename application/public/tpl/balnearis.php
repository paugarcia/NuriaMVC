<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="{APP_W}/application/public/css/style.css">
<title>Daw Agency | Balnearis</title>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="{APP_W}/application/public/js/jquery.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"/>
<script type="text/javascript" src="{APP_W}/application/public/js/gmap3.js"></script>
<script type="text/javascript" src="{APP_W}/application/public/js/gmap3.min.js"></script>
<script>
        function Mapa(lat,long,id)
            {
                var idnt = "#"+id;
                var longi = 0 + eval(long);
                var lati = 0 + eval(lat);
                console.log(idnt);
                $(idnt).gmap3({
                map:{
                    options:{
                      center:[longi,lat],
                      zoom: 15,
                    }
                  }
                
               });
            }
        </script>
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
<section>
    <br/>
    <p>{balnearios}</p>
    <br/>
</section>
<footer>Tots els drets reservats per <a href="{APP_W}">Daw Agency</a></footer>
</body>
</html>
