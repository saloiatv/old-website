<?php
header('Content-Type: text/html; charset=utf-8');
include_once("../php/saloia-tv.php");
?>
<html>
<head>
	<?php include_once("../php/head.php"); $categoria=$browser_url[1]; ?>
	<title>Saloia TV | <?php echo ucfirst($categoria); ?></title>
	
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script type="text/javascript" src="../js/main.js"></script>
</head>
<body onload="selected('<?php echo $categoria; ?>');">
	
	<?php include_once("../php/header.php"); ?>
	
	<?php $navsearch=false; include_once("../php/nav.php"); ?>
	
<div class="main_wrap">
	
	
	<section class="breadcrumb">
		<a href="#">Saloia TV</a>
			<i class="divider">/</i>
		<a href="#"><?php echo $categoria; ?></a>
			<i class="divider">/</i>
		<a href="#">Todos os videos</a>
	</section>
	
	<section class="titulo">
		<h2>Videos de <?php echo $categoria; ?></h2>
		
		<a onclick="procurar();" class="search" href="#"><i class="icon-search"></i></a>
		<form id="actionsearch" onsubmit="return procurar();"><input type="text" placeholder="Procurar" value="" name="search" id="search" style="display:none;"></form>
	</section>
	
	<div class="main list" style="min-height:1300px; ">
	
<?php 
		$videos=search1($token,"&online  &".$categoria,30);
		foreach ($videos as $item) {
			$desc=explode("@",$item['snippet']['description']);
			$vid_autor=$desc[1];
			$descricao=$desc[0];
		?>
	
		<div class="item">
			<a href="<?php echo $public_url."v/".IDtoPublicKey($item['id']['videoId']); ?>">
				<img alt="<?php echo limitarTexto($descricao,100); ?>" src="<?php if($item['snippet']['thumbnails']['maxres']['url']){ echo $item['snippet']['thumbnails']['maxres']['url']; }else{ echo $item['snippet']['thumbnails']['medium']['url']; } ?>">
				<i class="entry"></i>
				<i class="icon-play"></i>	
			</a>
			<h2><a href="<?php echo $public_url."v/".IDtoPublicKey($item['snippet']['resourceId']['videoId']); ?>"><?php echo $item['snippet']['title']; ?></a></h2> 
			<span><i class="icon-calendar"></i><?php echo substr($item['snippet']['publishedAt'],0,10); ?></span>
			<span><i class="icon-user"></i><?php if($vid_autor){ echo $vid_autor; } else{ echo "(não disponível)"; } ?></span>
			<p><?php echo limitarTexto($descricao,180); ?></p>		
		</div>
		
<?php } ?>
		
	</div>
	
</div>
	
	
<?php include_once("../php/footer.php"); ?>

	

</body>
</html>