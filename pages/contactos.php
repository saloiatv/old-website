<?php
header('Content-Type: text/html; charset=utf-8');
include_once("../php/saloia-tv.php");
?>
<html>
<head>
	<?php include_once("../php/head.php"); ?>
	<title>Saloia TV | Contactos</title>
	<meta property="og:title" content="Sobre a Saloia TV"/>
	<meta property="og:url" content="<?php echo $public_url; ?>contactos"/>
	<meta property="og:image" content="<?php echo $public_url; ?>files/logotipo.png"/>
	<meta property="og:site_name" content="Saloia TV"/>
	<meta property="og:description" content="A Saloia.TV pretende promover a região saloia, os seus produtos, as suas potencialidades, as suas belezas, as suas tradições, a sua história, a sua cultura, as suas gentes, as suas iniciativas, o seu empreendedorismo e a sua maneira de estar e de ser."/>
	<meta property="og:type" content="article" />
	
	<meta name="description" content="A Saloia.TV pretende promover a região saloia, os seus produtos, as suas potencialidades, as suas belezas, as suas tradições, a sua história, a sua cultura, as suas gentes, as suas iniciativas, o seu empreendedorismo e a sua maneira de estar e de ser.">

	<meta property="twitter:card" content="summary" />
	<meta property="twitter:site" content="Saloia TV" />
	<meta property="twitter:title" content="Sobre a Saloia TV" />
	<meta property="twitter:description" content="A Saloia.TV pretende promover a região saloia, os seus produtos, as suas potencialidades, as suas belezas, as suas tradições, a sua história, a sua cultura, as suas gentes, as suas iniciativas, o seu empreendedorismo e a sua maneira de estar e de ser." />
	<meta property="twitter:image" content="<?php echo $public_url; ?>files/logotipo.png" />
	<meta property="twitter:url" content="<?php echo $public_url; ?>sobre" />
	<script src="http://maps.googleapis.com/maps/api/js?sensor=false&language=pt-PT"></script>
	
	<link rel="stylesheet" type="text/css" href="../css/style.css">
<script type="text/javascript" src="../js/main.js"></script>
	<style>
	 #mapacontactos {
        height: 500px;
        width: 100%;
        z-index: 0;
        opacity: 1;
        margin-bottom:40px; 
    }
    </style>
    <script>
	function initialize() {
  var myLatlng = new google.maps.LatLng(38.792788,-9.328877);
  var mapOptions = {
    zoom: 15,
    scrollwheel: false,
    center: myLatlng
  };

  var map = new google.maps.Map(document.getElementById('mapacontactos'), mapOptions);
  var activeWindow;
  
  
  //videokey --------------
  var location0 = new google.maps.LatLng(38.792788,-9.328877);
  var info0 = new google.maps.InfoWindow({
      content: '<div class="infovideo"><a class="thumbnail" href="#"><i class="icon-home"></i><img src="<?php echo $public_url; ?>content/0B3QQaCdTY2LkaWkzMWV2NGgwSEU/florestacenter.jpg"><i class="entry"></i></a><h2><a href="#">Estúdio Saloia TV</a></h2><p>Floresta Center, Tapada das Mercês, Sintra</p><span></span><span class="right"></span></div>'
  });
  var marker0 = new google.maps.Marker({
      position: location0, map: map, title: 'Estúdio Saloia TV'
  });
  google.maps.event.addListener(marker0, 'click', function() {
  	if(activeWindow!=null){ activeWindow.close(); }
    info0.open(map,marker0);
    activeWindow=info0;
  });
  //------------------------ 
  
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
</head>
<body>
	
	<?php include_once("../php/header.php"); ?>
	
	<?php $navsearch=false; include_once("../php/nav.php"); ?>
	
<div class="main_wrap">
	
	
	<section class="breadcrumb">
		<a href="#">Saloia TV</a>
			<i class="divider">/</i>
		<a href="#">Contactos</a>
	</section>
	
	<section class="titulo">
		<h2>Contactos da Saloia TV</h2>
	</section>
	
	<div class="main contactospage" style="min-height:1300px; ">
	
	<p style="padding: 0px 30px 0px 30px; margin-bottom:20px; color: #616161;">A Saloia TV é a televisão da região saloia, estando actualmente disponível ao publico através da Internet. Pode contactar-nos através desta página directamente, através da nossa <a href="http://facebook.com/pages/Saloia-TV/255556074565169">página no facebook</a>, através do <a href="http://twitter.com/saloiatv">twitter</a> ou enviar um email para <a href="mailto:geral@saloia.tv">geral@saloia.tv</a> <br><br>
O estúdio da Saloia TV encontra-se instalado no Shopping Floresta Center, na Tapada das Mercês, freguesia de Algueirão-Mem Martins (Sintra).</p><br>

	<div id="mapacontactos"></div>

<div class="item">
	<img src="http://graph.facebook.com/255556074565169/picture/?type=large">
	<h2>Saloia TV</h2>
	<p>A televisão da Região Saloia</p>
	<a href="mailto:geral@saloia.tv">geral@saloia.tv</a>
	
</div>

<div class="item">
	<img src="http://graph.facebook.com/1523831154/picture/?type=large">
	<h2>Guilherme Leite</h2>
	<p>Direcção Geral</p>
	<a href="mailto:guilhermeleite@saloia.tv">guilhermeleite@saloia.tv</a>
	
</div>


<div class="item">
	<img src="http://graph.facebook.com/100001545669788/picture/?type=large">
	<h2>João leite</h2>
	<p>Direcção Técnica</p>
	<a href="mailto:joaoleite@saloia.tv">joaoleite@saloia.tv</a>
	
</div>


<div class="item">
	<img src="http://graph.facebook.com/100001023644259/picture/?type=large">
	<h2>Vitor Conceição</h2>
	<p>Direcção de Produção</p>
	<a href="mailto:vitorconceicao@saloia.tv">vitorconceicao@saloia.tv</a>
	
</div>

<div class="item">
	<img src="http://graph.facebook.com/1221515134/picture/?type=large">
	<h2>Adriano Filipe</h2>
	<p>Desporto e Cidadania</p>
	<a href="mailto:adrianofilipe@saloia.tv">adrianofilipe@saloia.tv</a>
	
</div>

<div class="item">
	<img src="http://graph.facebook.com/1312175083/picture/?type=large">
	<h2>João Rodil</h2>
	<p>Projectos Históricos</p>
	<a href="mailto:joaorodil@saloia.tv">joaorodil@saloia.tv</a>
	
</div>




	</div>
</div>
	
<div style="display:none;" itemscope itemtype="http://schema.org/Organization">
		<a itemprop="url" href="<?php echo $public_url; ?>"><div itemprop="name"><strong>Saloia TV</strong></div></a>
		<div itemprop="description">A Saloia.TV pretende promover a região saloia, os seus produtos, as suas potencialidades, as suas belezas, as suas tradições, a sua história, a sua cultura, as suas gentes, as suas iniciativas, o seu empreendedorismo e a sua maneira de estar e de ser.</div>
		<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
			<span itemprop="streetAddress">Florenta Center, Tapada das Mercês, Sintra</span><br>
			<span itemprop="addressLocality">Sintra</span><br>
			<span itemprop="addressRegion">Lisboa</span><br>
			<span itemprop="addressCountry">Portugal</span><br>
		</div>
	</div>
	
<?php include_once("../php/footer.php"); ?>

	

</body>
</html>