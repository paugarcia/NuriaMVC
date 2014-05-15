<?php
   $filename = "http://ep00.epimg.net/rss/elpais/portada.xml";
   header("Content-type:text/xml");
   readfile ($filename);
?>