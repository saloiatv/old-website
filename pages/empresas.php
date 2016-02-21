<?php
header('Content-Type: text/html; charset=utf-8');
include_once("../php/saloia-tv.php");
?>
<html>
<head>
<?php include_once("../php/head.php"); ?>
<title>Saloia TV | Empresas da região saloia</title>

<link rel="stylesheet" type="text/css" href="../css/style.css">
<script type="text/javascript" src="../js/main.js"></script>

<style>
  body{ background-image: url('<?php echo $public_url; ?>images/empresasfundo.png'); background-repeat: no-repeat; }
  section.breadcrumb a, section.breadcrumb i.divider{ color:#fff;}
</style>
<script> selected("empresas"); </script>
</head>
<body>
	
	<?php include_once("../php/header.php"); ?>
	
<div class="main_wrap">
	
	
	<section class="breadcrumb" style="margin-top:20px;">
		<a href="./">Empresas</a>
			<i class="divider">/</i>
		<a href="#"><?php if($browser_url[2]){ echo $browser_url[2]; $categoria=" &".$browser_url[2]; }else{ echo "Todas as empresas"; } ?></a>
	</section>
	
	<section class="titulo empresas">
		<?php $menu[$browser_url[2]]='class="active"'; ?>
		<ul>
			<li><a <?php echo $menu['animais']; ?> href="<?php echo $public_url; ?>empresas/animais">Animais</a></li>
			<li><a <?php echo $menu['beleza']; ?> href="<?php echo $public_url; ?>empresas/beleza">Beleza</a></li>
			<li><a <?php echo $menu['carros']; ?> href="<?php echo $public_url; ?>empresas/carros">Carros</a></li>
			<li><a <?php echo $menu['casa']; ?> href="<?php echo $public_url; ?>empresas/casa">Casa</a></li>
			<li><a <?php echo $menu['comercio']; ?> href="<?php echo $public_url; ?>empresas/comercio">Comercio</a></li>
			<li><a <?php echo $menu['lazer']; ?> href="<?php echo $public_url; ?>empresas/lazer">Lazer</a></li>
			<li><a <?php echo $menu['restauracao']; ?> href="<?php echo $public_url; ?>empresas/restauracao">Restauração</a></li>
			<li><a <?php echo $menu['saude']; ?> href="<?php echo $public_url; ?>empresas/saude">Saúde</a></li>
			<li><a <?php echo $menu['servicos']; ?> href="<?php echo $public_url; ?>empresas/servicos">Serviços</a></li>
		<ul>
		<a onclick="procurar()" class="search" href="#"><i class="icon-search"></i></a>
		<form id="actionsearch" action="<?php echo $public_url; ?>search" method="post"><input type="text" placeholder="Procurar" value="" name="search" id="search" style="display:none;"></form>
	</section>
	<div id="section-border"></div>
	
	<?php if(!$browser_url[2]){ ?>
	<div class="main list empresas" style="color: #212121; margin-top: 0px; background: #fff; height:190px; font-family: Roboto, 'Helvetica Neue', Helvetica, Arial, sans-serif; background: url('<?php echo $public_url; ?>images/empresas.jpg'); border-radius: 0px 0px 0px 0px; margin-bottom: 0px;">
		<h2>BEM-VINDO AOS<br>CLASSIFICADOS EM VIDEO<br> <i>BONS VIZINHOS</i></h2>
		<p>Ao escolher uma Empresa deste directório está a ajudar a televisão da sua Terra.<br>
		Conheça as empresas da sua terra, encontrará uma empresa para o servir.<br>
		Ajude-nos a colocar a região saloia no mapa.</p>
		<img src="<?php echo $public_url; ?>images/bonsvizinhos.png" class="aquisim">
	</div>
	<?php } ?>
	<div style="clear: both"></div>
	<div class="directorio">
	
	<?php

		$videos=search1($token,"&empresas ".$categoria,30);
		foreach ($videos as $item) {
			$texto=explode("\n",$item['snippet']['description']);
		?>
		
		<div class="item">
			<a href="<?php echo $public_url."v/".IDtoPublicKey($item['id']['videoId']); ?>"><img src="<?php if($item['snippet']['thumbnails']['maxres']['url']){ echo $item['snippet']['thumbnails']['maxres']['url']; }else{ echo $item['snippet']['thumbnails']['medium']['url']; } ?>"></a>
			<h2><a href="<?php echo $public_url."v/".IDtoPublicKey($item['id']['videoId']); ?>"><?php echo $item['snippet']['title']; ?></a></h2>
			<h3><?php echo substr($texto[0],0,100); ?></h3>
			<p><?php echo substr($texto[1],0,300); ?></p>	
			<a class="video" href="<?php echo $public_url."v/".IDtoPublicKey($item['id']['videoId']); ?>">Ver video</a>
		</div>
		
		<?php } ?>
		<br><br>
		
		<div style="clear: both"></div>
		
		
	</div>
	
</div>
	
	
<?php include_once("../php/footer.php"); ?>

	

</body>
</html>