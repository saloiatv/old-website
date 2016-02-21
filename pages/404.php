<?php

header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");

?>
<html>
<head>
	<?php include_once("../php/head.php"); ?>
	<title>Saloia TV | Página não encontrada!</title>
	<meta property="og:title" content="Saloia TV"/>
	<meta property="og:url" content="<?php echo $public_url; ?>"/>
	<meta property="og:image" content="<?php echo $public_url; ?>files/logotipo.png"/>
	<meta property="og:site_name" content="Saloia TV"/>
	<meta property="og:description" content="A Saloia TV é a televisão da região saloia, estando actualmente disponível ao publico através da Internet mas podendo a qualquer altura evoluir para outras formas de distribuição..."/>
	<meta property="og:type" content="website" />
	<meta name="google-site-verification" content="c6fY6GRR4drR1A6E1YFNFP-eZfqFVkBtn7PUb5KRNPI" />
</head>
<body style="height:1000px;">
	
	<?php include_once("../php/header.php"); ?>
	
	<?php include_once("../php/nav.php"); ?>
	
<div class="main_wrap error404">
	
	<h1>404</h1>
	<h2 class="e404"><? if($browser_url[1]=="v"){ echo "Vídeo não encontrado"; }else{ echo "Página não encontrada!"; } ?></h3>

	<div class="e404">
		<p>Esta página já não existe ou o link especificado está incorrecto.</p>
		<p>Se está a procura de um video, pode encontra-lo <a href="<? echo $public_url; ?>procurar">aqui</a></p>
		<p><a href="<? echo $public_url; ?>">Carregue aqui</a> para navegar para a página principal da Saloia TV</p>
	</div>

	
	<h3>Últimos videos</h3>
	<section>
		<span></span>
	<?php 

	$playlist=playlist($_SESSION["sltvtoken"],"PLFM2rShlvK9gF83YTlrovS9UvqpOLPv_k",3);
	foreach ($playlist as $item) {?>
		
		<div class="item">
			<a class="thumbnail" href="<?php echo $public_url."v/".IDtoPublicKey($item['snippet']['resourceId']['videoId']); ?>">
				<img src="<?php echo $item['snippet']['thumbnails']['medium']['url']; ?>">		
				<i class="entry"></i>
			</a>
			<h2><a href="<?php echo $public_url."v/".IDtoPublicKey($item['snippet']['resourceId']['videoId']); ?>"><?php echo $item['snippet']['title']; ?></a></h2>
			<p><?php echo limitarTexto($item['snippet']['description'],100); ?></p>
			<span><i class="icon-calendar"></i><?php echo substr($item['snippet']['publishedAt'],0,10); ?></span>
			<span><i class="icon-tags"></i><a href="#">destaques</a></span>
		</div>
		
		<?php } ?>
		
	</section>
	<br><br><br><br>
</div>
	
	
<?php include_once("../php/footer.php"); ?>

</div>
</body>
</html>