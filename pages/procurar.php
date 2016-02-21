<?php
header('Content-Type: text/html; charset=utf-8');
include_once("../php/saloia-tv.php");
?>
<html>
<head>
	<?php 
	include_once("../php/head.php"); 
	$procura=urldecode($browser_url[2]);
	$procura=str_replace("+"," ",$procura);
	?>
	<title>Saloia TV | Procurar videos</title>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<script type="text/javascript" src="../js/main.js"></script>
</head>
<body>
	
	<?php include_once("../php/header.php"); ?>
	
	<?php $navsearch=false; include_once("../php/nav.php"); ?>
	
<div class="main_wrap">
	
	
	<section class="breadcrumb">
		<a href="#">Saloia TV</a>
			<i class="divider">/</i>
		<a href="#">Procurar videos</a>
		<?php if($procura){ ?>
			<i class="divider">/</i>
		<a href="#">"<?php echo $procura; ?>"</a>
		<?php } ?>
	</section>
	
	<section class="titulo">
		<?php if($procura){ echo'<h2>Procurar por "'.$procura.'"</h2>'; } ?>
		
		<a <?php if(!$procura){ echo'style="margin-top:3px; float:left;"'; } ?> onclick="procurar();" class="search" href="#"><i class="icon-search"></i></a>
		<form id="actionsearch" onsubmit="return procurar();"><input type="text" placeholder="Procurar" value="" name="search" id="search" <?php if(!$procura){ echo'style="display: block; float: left; margin-top: 5px; margin-left: 5px;"'; }else{ echo 'style="display:none;"'; } ?> ></form>
	</section>
	
	<p class="sugestao">Está à procura de uma pessoa? Visite a página <a href="/pessoas"><b>Pessoas</b></a> para conhecer os protagonistas da saloia tv.</p>

	<div class="main list" style="min-height:1300px; ">
	
<?php
if($procura){
		$videos=search1($token,"&online ".$procura,30);
		foreach ($videos as $item) {
			$desc=explode("@",$item['snippet']['description']);
			$vid_autor=$desc[1];
			$descricao=$desc[0];
		?>
	
		<div class="item" style="min-height:420px;">
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
		
<?php } }else{ ?>
	
	<p style="width:100%; text-align:center;">Procure aqui em toda a biblioteca de vídeos da Saloia TV</p>


<?php } ?>
		
	</div>

	<div class="topo">

		<iframe scrolling="no" style="overflow-y:hidden; height:90px;" width="728px" height="90px" src="/files/cabecalho1.html" frameborder="0"></iframe>

	</div>
	
</div>
	
	
<?php include_once("../php/footer.php"); ?>

	

</body>
</html>