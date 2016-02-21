<?php
header('Content-Type: text/html; charset=utf-8');
include_once("../php/saloia-tv.php");
?>
<html>
<head>
	<?php include_once("../php/head.php"); ?>
	<title>Saloia TV | Mapa da região saloia</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
<script type="text/javascript" src="../js/main.js"></script>


	  <script src="http://maps.googleapis.com/maps/api/js?sensor=false&language=pt-PT"></script>
    <script> selected("mapa"); </script>
	  <style>
    #map-canvas {
        height: 1000px;
        width: 100%;
        position:absolute;
        top: -30px;
        left: 0;
        z-index: 0;
        opacity: 1;
    }
    #info {
        position: relative;
        z-index: 1;
        width: 300px;
        margin: 50px auto 0;
    }
    footer{ margin-top:838px; z-index:9999; position:absolute; }
    body,html{ height:auto; background:none; }
    </style>
    
    <script>
// This example displays a marker at the center of Australia.
// When the user clicks the marker, an info window opens.

function initialize() {
  var myLatlng = new google.maps.LatLng(38.8715110,-9.2912989);
  var mapOptions = {
    zoom: 12,
    scrollwheel: false,
    center: myLatlng
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  var activeWindow;
  
  
  
  
 <?php
$xmlstring=file_get_contents("https://docs.google.com/uc?export=download&id=0B3QQaCdTY2Lkc25MQ29ENmJ1cTQ");
$xml = simplexml_load_string($xmlstring);
$json = json_encode($xml);
$videos = json_decode($json,TRUE);
$videos=$videos['video'];
$i=0;

foreach ($videos as $video) { ?>
  //videokey --------------
  var location<?php echo $i; ?> = new google.maps.LatLng(<?php echo $video['mapa']; ?>);
  var info<?php echo $i; ?> = new google.maps.InfoWindow({
      content: '<div class="infovideo"><a class="thumbnail" href="<?php echo $public_url."v/".$video['id']; ?>"><i class="icon-video"></i><img src="<?php echo $video['imagem']; ?>"><i class="entry"></i></a><h2><a href="<?php echo $public_url."v/".$video['id']; ?>"><?php echo $video['titulo']; ?></a></h2><p><?php echo str_replace(array("\r\n", "\r", "\n"), "", substr($video['descricao'],0,100)); ?>...</p><span><i class="icon-calendar"></i><?php echo substr($video['data'],0,10); ?></span><span class="right"></span></div>'
  });
  var marker<?php echo $i; ?> = new google.maps.Marker({
      position: location<?php echo $i; ?>, map: map, title: '<?php echo $video['titulo']; ?>'
  });
  google.maps.event.addListener(marker<?php echo $i; ?>, 'click', function() {
  	if(activeWindow!=null){ activeWindow.close(); }
    info<?php echo $i; ?>.open(map,marker<?php echo $i; ?>);
    activeWindow=info<?php echo $i; ?>;
  });
  //------------------------
<?php $i++; } ?>  
  
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
    
</head>
<body>
	
	<div id="map-canvas"></div>
	
	<?php include_once($public_folder."../php/header.php"); ?>
		
<div class="main_wrap">
		
</div>
	
	
<?php include_once($public_folder."../php/footer.php"); ?>

</body>
</html>